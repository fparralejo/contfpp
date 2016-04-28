<?php 
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use Input;
use Illuminate\Http\Request;
//use Mail;


use App\Empresa;
use App\Usuario;
use App\Empleado;
use App\Cliente;
use App\Pedido;
use App\Presupuesto;
use App\PresupuestoDetalle;
use App\Articulo;

use App\Http\Controllers\adminController;
//cargo la libreria FPDF
use Anouar\Fpdf\Fpdf as baseFpdf;


class pedidosController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


        
    //NO
    public function alta(){
        //control de sesion
        $admin = new adminController();
        if (!$admin->getControl()) {
            return redirect('/')->with('login_errors', 'La sesión a expirado. Vuelva a logearse.');
        }
        
        $datos = Empresa::on('contfpp')->find((int)Session::get('IdEmpresa'));
        
        $clientes = Cliente::on(Session::get('conexionBBDD'))
                          ->where('borrado', '=', '1')
                          ->where('tipo', '=', 'C')
                          ->get();
        
        //numero nuevo
        //buscamos el numero mas alto
        
        $numeroNuevo = $admin->numeroNuevo('Presupuesto',$datos->TipoContador);
        
        $numero = $admin->formatearNumero($numeroNuevo,$datos->TipoContador);
        $editarCampoNumero = $admin->editarCampoNumero($datos->TipoContador);

        return view('presupuestos.ver')->with('presupuesto', json_encode(''))->with('clientes', json_encode($clientes))
                                       ->with('datos', json_encode($datos))->with('presupuestoDetalle', json_encode(''))
                                       ->with('numero', json_encode($numero))->with('editarCampoNumero', json_encode($editarCampoNumero));
    }

    //NO
    public function editar($idPresupuesto){
        //control de sesion
        $admin = new adminController();
        if (!$admin->getControl()) {
            return redirect('/')->with('login_errors', 'La sesión a expirado. Vuelva a logearse.');
        }
        
        $datos = Empresa::on('contfpp')->find((int)Session::get('IdEmpresa'));
        
        $clientes = Cliente::on(Session::get('conexionBBDD'))
                          ->where('borrado', '=', '1')
                          ->where('tipo', '=', 'C')
                          ->get();
        
        $presupuesto = Presupuesto::on(Session::get('conexionBBDD'))
                        ->find($idPresupuesto);

        $presupuestoDetalle = PresupuestoDetalle::on(Session::get('conexionBBDD'))
                          ->where('IdPresupuesto', '=', $idPresupuesto)
                          ->where('Borrado', '=', '1')
                          ->get();
        
        //numero
        $numero = $admin->formatearNumero($presupuesto->NumPresupuesto,$datos->TipoContador);
        $editarCampoNumero = $admin->editarCampoNumero($datos->TipoContador);
                
        //var_dump($numero);die;

        return view('presupuestos.ver')->with('presupuesto', json_encode($presupuesto))->with('clientes', json_encode($clientes))
                                       ->with('datos', json_encode($datos))->with('presupuestoDetalle', json_encode($presupuestoDetalle))
                                       ->with('numero', json_encode($numero))->with('editarCampoNumero', json_encode($editarCampoNumero));
    }
        
    public function listar(){
        //control de sesion
        $admin = new adminController();
        if (!$admin->getControl()) {
            return redirect('/')->with('login_errors', 'La sesión a expirado. Vuelva a logearse.');
        }
        
        $datos = Empresa::on('contfpp')->find((int)Session::get('IdEmpresa'));
        
        $pedidos = Pedido::on(Session::get('conexionBBDD'))
                        ->where('Borrado', '=', '1')
                        ->get();
        
        $presupuestos = Presupuesto::on(Session::get('conexionBBDD'))
                        ->where('Borrado', '=', '1')
                        ->get();
        
        $clientes = Cliente::on(Session::get('conexionBBDD'))
                          ->where('borrado', '=', '1')
                          ->where('tipo', '=', 'C')
                          ->get();
        
        for ($i = 0; $i < count($pedidos); $i++) {
            $pedidos[$i]->NumPedido = $admin->formatearNumero($pedidos[$i]->NumPedido,$datos->TipoContador);
        }

        for ($i = 0; $i < count($presupuestos); $i++) {
            $presupuestos[$i]->NumPresupuesto = $admin->formatearNumero($presupuestos[$i]->NumPresupuesto,$datos->TipoContador);
        }

        return view('pedidos.listado')->with('pedidos', json_encode($pedidos))->with('presupuestos', json_encode($presupuestos))->with('clientes', json_encode($clientes));
    }
       
    
    //NO
    public function createEdit(Request $request){
        $admin = new adminController();
        $datos = Empresa::on('contfpp')->find((int)Session::get('IdEmpresa'));
        //dd($request);die;
        
        //hago las operaciones en transaccion, trabajo con las tablas presupuestos y presupuestosdetalle
        //1º inserto o actualizo los datos de la tabla presupuesots por el IdPresupuesto
        //2º si edito, borro los datos de la tabla presupuestosdetalle por el IdPresupuesto (campo Borrado=0)
        //3º inserto los nuevos detalles con el IdPresupuesto
        
        \DB::connection(Session::get('conexionBBDD'))->beginTransaction(); //Comienza transaccion
        
        try{
            //1º
            //editar
            if(isset($request->IdPresupuesto) && $request->IdPresupuesto !== ""){
                //sino se edita este IdPresupuesto
                $presupuesto = Presupuesto::on(Session::get('conexionBBDD'))->find($request->IdPresupuesto);
                
                
                //2º
                $presupuestoDetalle = PresupuestoDetalle::on(Session::get('conexionBBDD'))
                                     ->where('IdPresupuesto', '=', $request->IdPresupuesto)
                                     ->where('Borrado', '=', '1')
                                     ->get();
                
                foreach ($presupuestoDetalle as $detalle) {
                    $detalle->Borrado = 0;
                    $detalle->save();
                }

                $ok = 'Se ha editado correctamente el presupuesto.';
                $error = 'ERROR al edtar el presupuesto.';
            }
            //nuevo
            else{
                //si es nuevo este valor viene vacio
                $presupuesto = new Presupuesto();
                $presupuesto->setConnection(Session::get('conexionBBDD'));

                //indicamos el nuevo IdPresupuesto
                $idPresupNuevo = Presupuesto::on(Session::get('conexionBBDD'))
                                  ->max('IdPresupuesto') + 1;
                $presupuesto->IdPresupuesto = $idPresupNuevo;
                $presupuesto->Estado = 'Pendiente';
                

                $ok = 'Se ha dado de alta correctamente el presupuesto.';
                $error = 'ERROR al dar de alta el presupuesto.';
            }
            
            //Continuo 1º (editar o nuevo), recojo los datos del formulario
            //NumPresupuesto: formateo el numero que viene 
            $numPresupuesto = $admin->desFormatearNumero($request->numPresupuesto,$datos->TipoContador);
            $presupuesto->NumPresupuesto = $numPresupuesto;
            $presupuesto->IdCliente = (isset($request->idCliente)) ? $request->idCliente : '';
            $presupuesto->FechaPresupuesto = (isset($request->fechaPresup)) ? \Carbon\Carbon::createFromFormat('d/m/Y',$request->fechaPresup)->format('Y-m-d H:i:s') : '';
            $presupuesto->FechaVtoPresupuesto = (isset($request->FechaVtoPresupuesto)) ? \Carbon\Carbon::createFromFormat('d/m/Y',$request->FechaVtoPresupuesto)->format('Y-m-d H:i:s') : '';
            $presupuesto->FormaPago = (isset($request->FormaPago)) ? $request->FormaPago : '';
            $presupuesto->Retencion = (isset($request->Retencion)) ? $request->Retencion : '';
            $presupuesto->Proforma = (isset($request->Proforma)) ? $request->Proforma : '';
            $presupuesto->Borrado = '1';
            $presupuesto->BaseImponible = (isset($request->totalImporte)) ? $request->totalImporte : '';
            $presupuesto->Cuota = (isset($request->totalCuota)) ? $request->totalCuota : '';
            $presupuesto->total = (isset($request->Total)) ? $request->Total : '';
            //guardo los cambios
            $presupuesto->save();
            
            
            //3º
            //recojo en un array los valores nuevos, que vienen de las variables 
            foreach ($request as $key => $value) {
                if($key === 'request'){
                    foreach ($value as $key2 => $value2) {
                        //ahora vamos buscando las distintas request que comiencen por:
                        //busco Cantidad
                        if(substr($key2,0,8) === 'Cantidad'){
                            //extraigo en numero de cantidad para buscar el resto de valores que terminen en ese numero 
                            //(son de la misma linea de presupuesto)
                            $num = substr($key2,8);
                            //Cantidad
                            $propCantidad = 'Cantidad' . $num;
                            $valorCantidad = $request->$propCantidad;
                            if($valorCantidad === ''){
                                $valorCantidad = 0;
                            }

                            //Concepto
                            $propConcepto = 'Concepto' . $num;
                            $valorConcepto = $request->$propConcepto;
                            //cambio las comillas simples si hay por dobles, me da error sino al leer este dato el formulario html
                            $valorConcepto = str_replace("'", "\"", $valorConcepto);

                            //IdArticulo
                            $propIdArticulo='IdArticulo' . $num;
                            $valorIdArticulo = $request->$propIdArticulo;

                            //Importe
                            $propImporte = 'Importe' . $num;
                            $valorImporte = $request->$propImporte;
                            if($valorImporte === ''){
                                $valorImporte = 0;
                            }

                            //Precio
                            $propPrecio = 'Precio' . $num;
                            $valorPrecio = $request->$propPrecio;
                            if($valorPrecio === ''){
                                $valorPrecio = 0;
                            }

                            //iva
                            $propIVA = 'IVA' . $num;
                            $valorIVA = $request->$propIVA;

                            //cuota
                            $propCuota = 'Cuota' . $num;
                            $valorCuota = $request->$propCuota;

                            //REVISAR  *************************  13/4/2016 FALLA
                            //compruebo que la cuota viene bien (importe * IVA / 100), sino la recalculo
                            //por si del formulario viene mal 
//                            $cuotaCalculada = round($valorImporte * $valorIVA,2);
//
//                            if((int)($valorCuota * 100) !== (int)($cuotaCalculada)){
//                                $valorCuota = (float) $cuotaCalculada / 100;
//                            }

                            //ahora guardo el valor en el array
                            $presupuestoDetalleNuevo[]=array(
                                "Cantidad"=>$valorCantidad, 
                                "Concepto"=>$valorConcepto,
                                "IdArticulo"=>$valorIdArticulo,
                                "Precio"=>$valorPrecio,
                                "Importe"=>$valorImporte,
                                "IVA"=>$valorIVA,
                                "Cuota"=>$valorCuota,
                            );
                        }
                    }
                }
            }

            //por ultimo inserto estas lineas en la tabla presupuesotsDetalle
            for ($i = 0; $i < count($presupuestoDetalleNuevo); $i++) {
                $nuevoDetalle = new PresupuestoDetalle();
                $nuevoDetalle->setConnection(Session::get('conexionBBDD'));
                $idNuevo = PresupuestoDetalle::on(Session::get('conexionBBDD'))
                                             ->max('IdPresupDetalle') + 1;
                
                $nuevoDetalle->IdPresupDetalle = $idNuevo;
                $nuevoDetalle->IdPresupuesto = $presupuesto->IdPresupuesto;
                $nuevoDetalle->NumLineaPresup = (int)($i +1);
                $nuevoDetalle->IdArticulo = (isset($presupuestoDetalleNuevo[$i]['IdArticulo'])) ? $presupuestoDetalleNuevo[$i]['IdArticulo'] : '';
                $nuevoDetalle->DescripcionProducto = (isset($presupuestoDetalleNuevo[$i]['Concepto'])) ? $presupuestoDetalleNuevo[$i]['Concepto'] : '';
                $nuevoDetalle->TipoIVA = (isset($presupuestoDetalleNuevo[$i]['IVA'])) ? $presupuestoDetalleNuevo[$i]['IVA'] : '';
                $nuevoDetalle->Cantidad = (isset($presupuestoDetalleNuevo[$i]['Cantidad'])) ? $presupuestoDetalleNuevo[$i]['Cantidad'] : '';
                $nuevoDetalle->ImporteUnidad = (isset($presupuestoDetalleNuevo[$i]['Precio'])) ? $presupuestoDetalleNuevo[$i]['Precio'] : '';
                $nuevoDetalle->Importe = (isset($presupuestoDetalleNuevo[$i]['Importe'])) ? $presupuestoDetalleNuevo[$i]['Importe'] : '';
                $nuevoDetalle->CuotaIva = (isset($presupuestoDetalleNuevo[$i]['Cuota'])) ? $presupuestoDetalleNuevo[$i]['Cuota'] : '';

                
                
                $nuevoDetalle->save();

            }
        }
        catch(\Exception $e)
        {
          //failed logic here
           \DB::connection(Session::get('conexionBBDD'))->rollback();
           throw $e;
           echo "falla";die;
        }

        \DB::connection(Session::get('conexionBBDD'))->commit();
        
        
        //echo json_encode($txt);**PONER RESULTADO DE EDITAR BORRAR, ETC..
        return redirect('presupuestos/editar/'.$presupuesto->IdPresupuesto);
    }
    

    
    //NO
    public function verPDF($idPresupuesto,$accion, Request $request){
        //control de sesion
        $admin = new adminController();
        if (!$admin->getControl()) {
            return redirect('/')->with('login_errors', 'La sesión a expirado. Vuelva a logearse.');
        }

        
        //busco los datos
        $datos = Empresa::on('contfpp')->find((int)Session::get('IdEmpresa'));

        $presupuesto = Presupuesto::on(Session::get('conexionBBDD'))
                        ->find($idPresupuesto);
        
        $cliente = Cliente::on(Session::get('conexionBBDD'))
                          ->where('borrado', '=', '1')
                          ->where('tipo', '=', 'C')
                          ->where('idCliente', '=', $presupuesto->IdCliente)
                          ->get();

        $presupuestoDetalle = PresupuestoDetalle::on(Session::get('conexionBBDD'))
                          ->where('IdPresupuesto', '=', $idPresupuesto)
                          ->where('Borrado', '=', '1')
                          ->get();

        
        
        //ahora hacemos el fichero PDF
        //llamo al objeto PDF
        $pdf = new PDF();
 
        
        //cargo adminController (tiene funciones auxiliares)
        $admin = new adminController();

        //decodifico los datos JSON
        $pdf->cliente = json_decode($cliente);
        $pdf->datos = json_decode($datos);
        $pdf->presupuesto = json_decode($presupuesto);
        $pdf->presupuestoDetalle = json_decode($presupuestoDetalle);
        //numero
        $numero = $admin->formatearNumero($pdf->presupuesto->NumPresupuesto,$pdf->datos->TipoContador);
        $pdf->numero = $numero;
        $pdf->accion = $accion;
        //var_dump($pdf->datos);die;

        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetAutoPageBreak(true,60);
        $pdf->SetFont('Arial','',9);
        $pdf->DatosNuestrosYCliente();
        $pdf->SetDrawColor(0,0,0);
        $pdf->Ln();
        //$pdf->Cell(180, 4, 'Referencia: '.utf8_decode($pdf->datosPresupuesto['Referencia']));

        $fecha = explode('/',date('d/m/Y',strtotime($pdf->presupuesto->FechaPresupuesto)));

        //escribir mes en texto
        switch ($fecha[1]) {
            case '01':
                $mes='Enero';
                break;
            case '02':
                $mes='Febrero';
                break;
            case '03':
                $mes='Marzo';
                break;
            case '04':
                $mes='Abril';
                break;
            case '05':
                $mes='Mayo';
                break;
            case '06':
                $mes='Junio';
                break;
            case '07':
                $mes='Julio';
                break;
            case '08':
                $mes='Agosto';
                break;
            case '09':
                $mes='Septiembre';
                break;
            case '10':
                $mes='Octubre';
                break;
            case '11':
                $mes='Noviembre';
                break;
            case '12':
                $mes='Diciembre';
                break;
        }

        $pdf->Cell(180, 4, utf8_decode($pdf->datos->municipio.', '.$fecha[0].' de '.$mes.' de '.$fecha[2]),0, 0, 'L');

        $pdf->Ln();
        $pdf->Ln();


        $pdf->columCantidad=15;
        $pdf->columConcepto=75;
        $pdf->columPrecio=20;
        $pdf->columImporte=20;
        $pdf->columIva=10;
        $pdf->columCuota=20;
        $pdf->columTotal=25;

        //Cuadro del presupuesto
        //cabecera
        $pdf->SetFillColor(240,248,255);
        $pdf->SetDrawColor(200,200,200);
        $pdf->SetLineWidth(0.1);
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell($pdf->columCantidad+0.1, 6, 'Cantidad','LTBR',0,'R',true);
        $pdf->SetLineWidth(0.1);
        $pdf->Cell(0.1, 6, '','R',0,'R');
        $pdf->SetLineWidth(0.1);
        $pdf->Cell($pdf->columConcepto-0.1, 6, '  Concepto','BTR',0,'L',true);
        $pdf->SetLineWidth(0.1);
        $pdf->Cell(0.1, 6, '','R',0,'R');
        $pdf->SetLineWidth(0.1);
        $pdf->Cell($pdf->columPrecio-0.1, 6, 'Precio','BTR',0,'R',true);
        $pdf->SetLineWidth(0.1);
        $pdf->Cell(0.1, 6, '','R',0,'R');
        $pdf->SetLineWidth(0.1);
        $pdf->Cell($pdf->columImporte-0.1, 6, 'Importe','BTR',0,'R',true);
        $pdf->SetLineWidth(0.1);
        $pdf->Cell(0.1, 6, '','R',0,'R');
        $pdf->SetLineWidth(0.1);
        $pdf->Cell($pdf->columIva-0.1, 6, 'IVA','BTR',0,'R',true);
        $pdf->SetLineWidth(0.1);
        $pdf->Cell(0.1, 6, '','R',0,'R');
        $pdf->SetLineWidth(0.1);
        $pdf->Cell($pdf->columCuota-0.1, 6, 'Cuota','BTR',0,'R',true);
        $pdf->SetLineWidth(0.1);
        $pdf->Cell(0.1, 6, '','R',0,'R');
        $pdf->SetLineWidth(0.1);
        $pdf->Cell($pdf->columTotal-0.2, 6, 'Total','TBR',0,'R',true);
        $pdf->Ln();


        //las lineas del cuerpo
        $altura=6;
        $pdf->totalImporte=0;
        $pdf->totalCuota=0;
        for ($i = 0;$i < count($pdf->presupuestoDetalle);$i++){
            //metemos las palabras que hay en el texto en un array
            $palabras=  explode(' ',utf8_decode($pdf->presupuestoDetalle[$i]->DescripcionProducto));
            //prepararmos un array con las lineas de texto rellenas de palabras que no sobrepasen 40 caracteres
            $linea = '';
            $k = 0;//indice de $palabras
            $lineas = array();
            while($k < count($palabras)){
                $lineaAux = $linea . ' ' . $palabras[$k];
                if(strlen($lineaAux) < 49){
                    //es menor de 30 caracteres, se incluye
                    $linea = $lineaAux;
                }else{
                    //es mayor o igual , no se incluye
                    $lineas[] = $linea;
                    $linea = $palabras[$k];
                }
                $k++;
            }

            //alternar en sombreados por lineas
            if($i % 2 === 0){
                $pdf->fill = false;
            }else{
                $pdf->fill = true;
            }

            //se guarda las ultimas palabras
            $lineas[]=$linea;

            //recorrer lineas
            for($j = 0;$j < count($lineas);$j++){
                $altura2 = 6;
                $pdf->SetFillColor(244,244,244);
                $pdf->SetLineWidth(0.1);
                $pdf->SetFont('Arial','',9);
                if($j === 0){
                    if($pdf->presupuestoDetalle[$i]->Cantidad === '0'){
                        $pdf->presupuestoDetalle[$i]->Cantidad = '';
                    }
                    $pdf->Cell($pdf->columCantidad+0.1, $altura, $admin->formateaNumeroContabilidad($pdf->presupuestoDetalle[$i]->Cantidad),'L',0,'R',$pdf->fill);
                }else{
                    $pdf->Cell($pdf->columCantidad+0.1, $altura, '','L',0,'R',$pdf->fill);
                }
                $pdf->SetLineWidth(0.1);
                if($j==0){
                    $pdf->Cell($pdf->columConcepto, $altura, trim($lineas[$j]) ,'L',0,'L',$pdf->fill);
                }else{
                    $pdf->Cell($pdf->columConcepto, $altura, trim($lineas[$j]) ,'L',0,'L',$pdf->fill);
                }
                if($j==0){
                    if($pdf->presupuestoDetalle[$i]->ImporteUnidad === '0'){
                        $pdf->presupuestoDetalle[$i]->ImporteUnidad = '';
                    }
                    $pdf->Cell($pdf->columPrecio, $altura, $admin->formateaNumeroContabilidad($pdf->presupuestoDetalle[$i]->ImporteUnidad),'L',0,'R',$pdf->fill);
                }else{
                    $pdf->Cell($pdf->columPrecio, $altura,'' ,'L',0,'R',$pdf->fill);
                }
                if($j==0){
                    $pdf->Cell($pdf->columImporte, $altura, $admin->formateaNumeroContabilidad($pdf->presupuestoDetalle[$i]->Importe),'L',0,'R',$pdf->fill);
                }else{
                    $pdf->Cell($pdf->columImporte, $altura, '','L',0,'R',$pdf->fill);
                }
                if($j==0){
                    $pdf->Cell($pdf->columIva, $altura, $pdf->presupuestoDetalle[$i]->TipoIVA." %",'L',0,'R',$pdf->fill);
                }else{
                    $pdf->Cell($pdf->columIva, $altura,'' ,'L',0,'R',$pdf->fill);
                }
                if($j==0){
                    $pdf->Cell($pdf->columCuota, $altura, $admin->formateaNumeroContabilidad($pdf->presupuestoDetalle[$i]->CuotaIva),'L',0,'R',$pdf->fill);
                }else{
                    $pdf->Cell($pdf->columCuota, $altura,'' ,'L',0,'R',$pdf->fill);
                }
                if($j==0){  
                    $pdf->Cell($pdf->columTotal-0.2, $altura, $admin->formateaNumeroContabilidad((float)$pdf->presupuestoDetalle[$i]->Importe + (float)$pdf->presupuestoDetalle[$i]->CuotaIva),'L',0,'R',$pdf->fill);//VOY POR AQUI 18/4/2016
                    $pdf->SetLineWidth(0.1);
                    $pdf->Cell(0.1, 6, '','R',0,'R');
                }else{
                    $pdf->Cell($pdf->columTotal-0.2, $altura,'' ,'L',0,'R',$pdf->fill);
                    $pdf->SetLineWidth(0.1);
                    $pdf->Cell(0.1, 6, '','R',0,'R');
                }
                $pdf->Ln();
            }
            //sumas de importe y cuota
            $pdf->totalImporte = (float)$pdf->totalImporte + (float)$pdf->presupuestoDetalle[$i]->Importe;
            $pdf->totalCuota = (float)$pdf->totalCuota + (float)$pdf->presupuestoDetalle[$i]->CuotaIva;
        }

        //linea inferior
        $pdf->Cell(185, 0,'','B',0,'R');
        $pdf->Ln();


        if($pdf->accion === 'ver'){
            //se renderiza el PDF
            $pdf->Output();
            exit;
        }else{
            //se renderiza el PDF y se guarda
            $file = "../public/pdf_files/Presupuesto_".$pdf->datos->IdEmpresa.'-'.$pdf->presupuesto->NumPresupuesto.".pdf";
            $pdf->Output($file,"F");
            $pdf->Close();
            
            

            //envio del correo en si
            $to = $request->email;
            $Cc = $request->emailCC;
            
            //ESTE CAMPO FALLA MISTERIOSAMENTE
            //NO SE DEBE PONER EL CORREO AL QUE SE ENVIA, ES INCONGRUENTE 23/4/2016
            $from = $pdf->datos->email1;
            //$from = "soporte@aluminiosmarquez.esy.es";
            $subject = $pdf->datos->identificacion.'. Presupuesto: '.$numero;

            require '../resources/views/emails/phpmailer/PHPMailerAutoload.php';
            $mail = new \PHPMailer();

            //Correo desde donde se envía (from)
            $mail->setFrom($from, '');
            //Correo de envío (to)
            $mail->addAddress($to, '');
            //cc
            if($Cc<>''){
                $mail->addAddress($Cc, '');
            }
            //copia oculta al correo del usuario
            $mail->addBCC($from);

            
            $mail->CharSet = "UTF-8";
            $mail->Subject = $subject;

            $html='<!DOCTYPE html>
                    <html>
                        <head>
                            <title>'.$pdf->datos->identificacion.'. Presupuesto: '.$numero.'</title>
                            <meta charset="UTF-8">
                            <meta name="viewport" content="width=device-width">
                        </head>
                        <body>
                            <div>'.($request->mensaje).'</div><br/><br/>
                        </body>
                    </html>';

            //Lee un HTML message body desde un fichero externo,
            //convierte HTML un plain-text básico 
            $mail->msgHTML($html);
            //Reemplaza al texto plano del body
            $mail->AltBody = 'Presupuesto';
            //incluye el fichero adjunto
            $mail->addAttachment($file);

            $txtError = '';
            if($mail->send()){
                $txtError = 'El presupuesto ha sido enviado correctamente.';
            }else{
                $txtError = 'El presupuesto NO ha sido enviado.';
            }


            //redirecciono al presupuesto
            return redirect('presupuestos/editar/'.$pdf->presupuesto->IdPresupuesto)->with('errors', json_encode($txtError));    
        }
    }

    
    //NO
    public function duplicar($idPresupuesto){
        //control de sesion
        $admin = new adminController();
        if (!$admin->getControl()) {
            return redirect('/')->with('login_errors', 'La sesión a expirado. Vuelva a logearse.');
        }
        
        //extraigo los datos de este presupuesto
        $presupuesto = Presupuesto::on(Session::get('conexionBBDD'))
                        ->find($idPresupuesto);
        //lo clono
        $nuevo_presupuesto = $presupuesto->replicate();
        $nuevo_presupuesto->setConnection(Session::get('conexionBBDD'));

        //indicamos el nuevo IdPresupuesto
        $idPresupNuevo = Presupuesto::on(Session::get('conexionBBDD'))
                          ->max('IdPresupuesto') + 1;
        $nuevo_presupuesto->IdPresupuesto = $idPresupNuevo;
        $nuevo_presupuesto->Estado = 'Pendiente';
        
        //saco un numero nuevo
        $datos = Empresa::on('contfpp')->find((int)Session::get('IdEmpresa'));
        $numeroNuevo = $admin->numeroNuevo('Presupuesto',$datos->TipoContador);
        $numero = $admin->formatearNumero($numeroNuevo,$datos->TipoContador);
        
        $nuevo_presupuesto->NumPresupuesto = $numeroNuevo;
        date_default_timezone_set('Europe/Madrid');
        $nuevo_presupuesto->FechaPresupuesto = date('Y-m-d H:i:s');
        $nuevo_presupuesto->FechaVtoPresupuesto = date('Y-m-d H:i:s');
        
        
        //ahora busco las lineas del presupuesto
        $presupuestoDetalleNuevo = PresupuestoDetalle::on(Session::get('conexionBBDD'))
                          ->where('IdPresupuesto', '=', $idPresupuesto)
                          ->where('Borrado', '=', '1')
                          ->get();
        
        //ahora las operaciones que voy a hacer son por transaccion
        
        \DB::connection(Session::get('conexionBBDD'))->beginTransaction(); //Comienza transaccion
        try{
            //guardo el presupuesto
            $nuevo_presupuesto->push();

            //ahora inserto estas lineas en la tabla presupuesotsDetalle
            for ($i = 0; $i < count($presupuestoDetalleNuevo); $i++) {
                $nuevoDetalle = new PresupuestoDetalle();
                $nuevoDetalle->setConnection(Session::get('conexionBBDD'));
                $idNuevo = PresupuestoDetalle::on(Session::get('conexionBBDD'))
                                             ->max('IdPresupDetalle') + 1;

                $nuevoDetalle->IdPresupDetalle = $idNuevo;
                $nuevoDetalle->IdPresupuesto = $nuevo_presupuesto->IdPresupuesto;
                $nuevoDetalle->NumLineaPresup = (int)($i +1);
                $nuevoDetalle->IdArticulo = (isset($presupuestoDetalleNuevo[$i]->IdArticulo)) ? $presupuestoDetalleNuevo[$i]->IdArticulo : '';
                $nuevoDetalle->DescripcionProducto = (isset($presupuestoDetalleNuevo[$i]->DescripcionProducto)) ? $presupuestoDetalleNuevo[$i]->DescripcionProducto : '';
                $nuevoDetalle->TipoIVA = (isset($presupuestoDetalleNuevo[$i]->TipoIVA)) ? $presupuestoDetalleNuevo[$i]->TipoIVA : '';
                $nuevoDetalle->Cantidad = (isset($presupuestoDetalleNuevo[$i]->Cantidad)) ? $presupuestoDetalleNuevo[$i]->Cantidad : '';
                $nuevoDetalle->ImporteUnidad = (isset($presupuestoDetalleNuevo[$i]->ImporteUnidad)) ? $presupuestoDetalleNuevo[$i]->ImporteUnidad : '';
                $nuevoDetalle->Importe = (isset($presupuestoDetalleNuevo[$i]->Importe)) ? $presupuestoDetalleNuevo[$i]->Importe : '';
                $nuevoDetalle->CuotaIva = (isset($presupuestoDetalleNuevo[$i]->CuotaIva)) ? $presupuestoDetalleNuevo[$i]->CuotaIva : '';

                $nuevoDetalle->save();
            }
        }
        catch(\Exception $e)
        {
          //failed logic here
           \DB::connection(Session::get('conexionBBDD'))->rollback();
           throw $e;
           echo "falla";die;
        }

        \DB::connection(Session::get('conexionBBDD'))->commit();
        

        //por ultimo voy al nuevo presupuesto clonado
        return redirect('presupuestos/editar/'.$nuevo_presupuesto->IdPresupuesto);
    }
    
    //NO
    public function borrar($idPresupuesto){
        //control de sesion
        $admin = new adminController();
        if (!$admin->getControl()) {
            return redirect('/')->with('login_errors', 'La sesión a expirado. Vuelva a logearse.');
        }
        
        $txt = '';
        
        \DB::connection(Session::get('conexionBBDD'))->beginTransaction(); //Comienza transaccion
        try{
            //se busca este presupuesto
            $presupuesto = Presupuesto::on(Session::get('conexionBBDD'))->find($idPresupuesto);
            $presupuesto->Borrado = 0;
            $presupuesto->save();

            //2º
            $presupuestoDetalle = PresupuestoDetalle::on(Session::get('conexionBBDD'))
                                 ->where('IdPresupuesto', '=', $idPresupuesto)
                                 ->where('Borrado', '=', '1')
                                 ->get();

            foreach ($presupuestoDetalle as $detalle) {
                $detalle->Borrado = 0;
                $detalle->save();
            }

            $txt = 'Se ha borrado correctamente el presupuesto.';
        }
        catch(\Exception $e)
        {
          //failed logic here
           \DB::connection(Session::get('conexionBBDD'))->rollback();
           throw $e;
           $txt = 'ERROR al borrar el presupuesto.';
        }

        \DB::connection(Session::get('conexionBBDD'))->commit();
        
        //por ultimo voy al nuevo presupuesto clonado
        return redirect('presupuestos/mdb')->with('errors', json_encode($txt));
    }
    
    
    //NO
    public function buscar_articulos(){
        $term = Input::get('term');

        $listarArticulos = Articulo::on(Session::get('conexionBBDD'))->where('Descripcion','LIKE','%'.$term.'%')->get();

        //pasarlo a JSON
        //primero lo paso a array
        $listar = "";
        foreach ($listarArticulos as $articulo) {
            $listar[] = array("value"=>$articulo->Descripcion);
        }

        //devuelvo el array en JSON
        echo json_encode($listar);
    }
    
    
    //NO
    public function datos_articulo(){
        $concepto = Input::get('concepto');

        $articulo = Articulo::on(Session::get('conexionBBDD'))
                              ->where('Descripcion','=',$concepto)
                              ->where('Borrado','=','1')
                              ->get();

        //pasarlo a JSON
//        //primero lo paso a array
//        $listar = "";
//        foreach ($listarArticulos as $articulo) {
//            $listar[] = array("value"=>$articulo->Descripcion);
//        }

        //devuelvo el array en JSON
        echo json_encode($articulo);
    }

    
    //NO
    public function actualizarEstado(){
        $IdPresupuesto = Input::get('IdPresupuesto');
        $opcion = Input::get('opcion');

        Presupuesto::on(Session::get('conexionBBDD'))
                   ->where('IdPresupuesto','=',$IdPresupuesto)
                   ->where('Borrado','=','1')
                   ->update(['Estado' => $opcion]);
        
        echo true;
    }
    
}

//defino el objeto PDF
class PDF extends baseFpdf{

    public $datos;
    public $cliente;
    public $presupuesto;
    public $presupuestoDetalle;
    public $numero;
    public $accion;

    //anchos de columnas
    public $columCantidad;
    public $columConcepto;
    public $columPrecio;
    public $columImporte;
    public $columIva;
    public $columCuota;
    public $columTotal;
    
    public $totalImporte;
    public $totalCuota;
    
    public $IRPFCuota;
    public $totalFinal;
    public $fill;

    
    // Cabecera de página
    function Header(){
        $this->Ln(10);
        // Logo
        $this->Image('images/'.$this->datos->Logo,10,22,36,18);//  36/18 proporcional a 140/70 tamaño de la imagen

        // Arial bold 14
        $this->SetFont('Arial','B',14);
        // Movernos a la derecha
        $this->Cell(150);
        // Título
        $this->Cell(30,20,utf8_decode('PRESUPUESTO Nº ').utf8_decode($this->numero),0,0,'R');
        // Salto de línea
        $this->Ln(25);
    }

    
    // Pie de página
    function Footer()
    {
        //cargo adminController (tiene funciones auxiliares)
        $admin = new adminController();

        //por último los subtotales y totales
        // Posición: a 1,5 cm del final
        $Y = -58;
        $this->SetY($Y);
        $altura = 6;

        $this->SetFillColor(240,248,255);
        $this->SetLineWidth(0.1);
        $this->SetFont('Arial','B',9);
        $this->Cell(($this->columCantidad+$this->columConcepto+$this->columPrecio-0.2), $altura, 'Subtotales','LT','L', 'R',true);
        $this->Cell($this->columImporte, $altura, $admin->formateaNumeroContabilidad($this->totalImporte),'T','L', 'R',true);
        $this->Cell(($this->columIva+$this->columCuota), $altura, $admin->formateaNumeroContabilidad($this->totalCuota),'T','L', 'R',true);
        $this->Cell($this->columTotal, $altura, $admin->formateaNumeroContabilidad($this->totalImporte+$this->totalCuota),'TR','L', 'R',true);
        $this->Ln();
        $Y = $Y + 6;
        $this->SetY($Y);
        $this->IRPFCuota = $this->totalImporte * $this->presupuesto->Retencion / 100;
        $this->totalFinal = $this->totalImporte + $this->totalCuota - $this->IRPFCuota;
        if($this->presupuesto->Retencion <> '0'){
            $this->Cell(145-0.2, $altura, utf8_decode('Retención %'),'L','L', 'R',true);
            $this->Cell(15, $altura, $this->presupuesto->Retencion,0,'L', 'R',true);
            $this->Cell(25, $altura, $admin->formateaNumeroContabilidad($this->IRPFCuota),'R','L', 'R',true);
            $this->Ln();
            $Y = $Y + 6;
            $this->SetY($Y);
        }
        $this->Cell(160-0.2, $altura, utf8_decode('TOTAL '),'LB','L', 'R',true);
        $this->Cell(25, $altura, $admin->formateaNumeroContabilidad($this->totalFinal),'BR','L', 'R',true);
        $this->Ln();
        $this->Ln();
        $Y = $Y + 9;
        $this->SetY($Y);
    
        //forma de pago y validez presupuesto
        $this->SetFillColor(232,232,232);
        $this->Cell(25, $altura, 'Forma de Pago:',0,'L', 'R');
        $this->Cell(35, $altura, utf8_decode($this->presupuesto->FormaPago),0,'R', 'L',true);
        $this->Cell(40, $altura, 'Vencimiento:',0,'L', 'R');
        $this->Cell(25, $altura, \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$this->presupuesto->FechaVtoPresupuesto)->format('d/m/Y'),0,'R', 'C',true);
        //$this->Cell(10, $altura, utf8_decode('días f.f.'),0,'L', 'L');
        $this->Ln();
//        $this->Cell(25, $altura, '',0,'L', 'R');
//        if($this->presupuesto['FormaPago'] === 'Transferencia'){
//            $this->Cell(35, $altura, utf8_decode($this->datosPresupuesto['CC_Trans']),0,'R', 'L');
//        }
//        $this->Ln();
        
        
        
        
        $this->SetFillColor(255,255,255);
        $this->SetTextColor(120,120,120);
        // Posición: a 1,5 cm del final
        $this->SetY(-25);
        // Arial italic 8
        $this->SetFont('Arial','',8);
        //calculo las palabras que tiene el texto
        $numPalabras = explode(' ',utf8_decode($this->datos->TextoPie));
        
        $textoLinea = '';
        $altura = 0;
        for($i = 0;$i < count($numPalabras);$i++){
            //voy rellenando la linea de palabras
            $textoLinea = $textoLinea . $numPalabras[$i].' ';
            //compruebo que no paso de un limite
            if(strlen($textoLinea) > 125){
                $this->Cell(180, $altura,$textoLinea,0,0,'C',false);
                $textoLinea = '';
                $altura = $altura + 8;
                $this->Ln();
            }
        }
        //imprimo la ultima linea sino esta vacia
        if(strlen($textoLinea) > 0){
            $this->Cell(180, $altura,$textoLinea,0,0,'C',false);
        }

        // Posición: a 1,5 cm del final
        $this->SetY(-18);
        // Arial italic 8
        $this->SetFont('Arial','',9);
        // Número de página
        $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
    }
    

    // Una tabla más completa
    function DatosNuestrosYCliente()
    {
        $this->SetFillColor(244,244,244);
        $this->SetDrawColor(200,200,200);
        $altura = 5;

        // Datos nuestros: 1 linea
        $this->SetFont('Arial','B',10);
        $this->Cell(55, $altura, utf8_decode($this->datos->identificacion),0,'L', 'L');
        $this->Cell(30, $altura, ' ',0,0, 0);
        $this->Ln();
        // Datos nuestros: 2 linea
        $this->Cell(55, $altura, utf8_decode($this->datos->direccion),0,'L', 'L');
        $this->Cell(30, $altura, ' ',0,0, 0);
        // Datos Cliente: 1 linea
        $this->SetFont('Arial','',9);
        $this->Cell(25, $altura, utf8_decode("Att de D./Dña: "),'LT', 0, 'R',true);
        $this->Cell(75, $altura, utf8_decode($this->cliente[0]->nombre . ' ' . $this->cliente[0]->apellidos),'TR', 0, 'L');
        $this->Ln();
        // Datos nuestros: 3 linea
        $this->Cell(55, $altura, $this->datos->CP.' - '.utf8_decode($this->datos->municipio),0,'L', 'L');
        $this->Cell(30, $altura, ' ',0,0, 0);
        // Datos Cliente: 2 linea
        $this->Cell(25, $altura, "Cliente: ",'L', 0, 'R',true);
        $this->Cell(75, $altura, utf8_decode($this->cliente[0]->nombreEmpresa),'R', 0, 'L');
        $this->Ln();
        // Datos nuestros: 4 linea
        $this->Cell(55, $altura, utf8_decode($this->datos->provincia),0,'L', 'L');
        $this->Cell(30, $altura, ' ',0,0, 0);
        // Datos Cliente: 3 linea
        $this->Cell(25, $altura, "CIF: ",'L', 0, 'R',true);
        $this->Cell(75, $altura, $this->cliente[0]->CIF,'R', 0, 'L');
        $this->Ln();
        // Datos nuestros: 5 linea
        $this->Cell(55, $altura, 'CIF: '.utf8_decode($this->datos->CIF),0,'L', 'L');
        $this->Cell(30, $altura, ' ',0,0, 0);
        // Datos Cliente: 4 linea
        $this->Cell(25, $altura, utf8_decode("Dirección: "),'L', 0, 'R',true);
        $this->Cell(75, $altura, utf8_decode($this->cliente[0]->direccion),'R', 0, 'L');
        $this->Ln();
        // Datos nuestros: 6 linea
        $this->Cell(55, $altura, utf8_decode('Teléfono: ').$this->datos->telefono,0,'L', 'L');
        $this->Cell(30, $altura, ' ',0,0, 0);
        // Datos Cliente: 5 linea
        $this->Cell(25, $altura, utf8_decode("Población: "),'L', 0, 'R',true);
        $this->Cell(75, $altura, utf8_decode($this->cliente[0]->municipio),'R', 0, 'L');
        $this->Ln();
        // Datos nuestros: vacio
        $this->Cell(85, $altura, ' ',0,0, 0);
        // Datos Cliente: 6 linea
        $this->Cell(25, $altura, "Provincia: ",'LB', 0, 'R',true);
        $this->Cell(75, $altura, utf8_decode($this->cliente[0]->provincia),'BR', 0, 'L');
        $this->Ln();
    }


}        
