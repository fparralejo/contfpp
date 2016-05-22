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
use App\Factura;
use App\FacturaDetalle;
use App\Pedido;
use App\PedidoDetalle;
use App\Presupuesto;
use App\PresupuestoDetalle;
use App\Articulo;

use App\Http\Controllers\adminController;
//cargo la libreria FPDF
use Anouar\Fpdf\Fpdf as baseFpdf;


class facturasController extends Controller {

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
        
        $numeroNuevo = $admin->numeroNuevo('Factura',$datos->TipoContador);
        
        $numero = $admin->formatearNumero($numeroNuevo,$datos->TipoContador);
        $editarCampoNumero = $admin->editarCampoNumero($datos->TipoContador);

        return view('facturas.ver')->with('factura', json_encode(''))->with('clientes', json_encode($clientes))
                                  ->with('datos', json_encode($datos))->with('facturaDetalle', json_encode(''))
                                  ->with('numero', json_encode($numero))->with('editarCampoNumero', json_encode($editarCampoNumero));
    }

    
    public function editar($idFactura){
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
        
        $factura = Factura::on(Session::get('conexionBBDD'))
                        ->find($idFactura);

        $facturaDetalle = FacturaDetalle::on(Session::get('conexionBBDD'))
                          ->where('IdFactura', '=', $idFactura)
                          ->where('Borrado', '=', '1')
                          ->get();
        
        //numero
        $numero = $admin->formatearNumero($factura->NumFactura,$datos->TipoContador);
        $editarCampoNumero = $admin->editarCampoNumero($datos->TipoContador);
                
        //var_dump($numero);die;

        return view('facturas.ver')->with('factura', json_encode($factura))->with('clientes', json_encode($clientes))
                                       ->with('datos', json_encode($datos))->with('facturaDetalle', json_encode($facturaDetalle))
                                       ->with('numero', json_encode($numero))->with('editarCampoNumero', json_encode($editarCampoNumero));
    }
        
    public function listar(){
        //control de sesion
        $admin = new adminController();
        if (!$admin->getControl()) {
            return redirect('/')->with('login_errors', 'La sesión a expirado. Vuelva a logearse.');
        }
        
        $datos = Empresa::on('contfpp')->find((int)Session::get('IdEmpresa'));
        
        $facturas = Factura::on(Session::get('conexionBBDD'))
                        ->where('Borrado', '=', '1')
                        ->get();
        
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
        
        for ($i = 0; $i < count($facturas); $i++) {
            $numero = $admin->formatearNumero($facturas[$i]->NumFactura,$datos->TipoContador);
            $numeroOrdenar = $admin->formatearNumeroOrdenar($facturas[$i]->NumFactura,$datos->TipoContador);
            $facturas[$i]->NumFactura = "<!--" . $numeroOrdenar . "-->" . $numero;
        }

        for ($i = 0; $i < count($pedidos); $i++) {
            $numero = $admin->formatearNumero($pedidos[$i]->NumPedido,$datos->TipoContador);
            $numeroOrdenar = $admin->formatearNumeroOrdenar($pedidos[$i]->NumPedido,$datos->TipoContador);
            $pedidos[$i]->NumPedido = "<!--" . $numeroOrdenar . "-->" . $numero;
        }

        for ($i = 0; $i < count($presupuestos); $i++) {
            $numero = $admin->formatearNumero($presupuestos[$i]->NumPresupuesto,$datos->TipoContador);
            $numeroOrdenar = $admin->formatearNumeroOrdenar($presupuestos[$i]->NumPresupuesto,$datos->TipoContador);
            $presupuestos[$i]->NumPresupuesto = "<!--" . $numeroOrdenar . "-->" . $numero;
        }

        return view('facturas.listado')->with('pedidos', json_encode($pedidos))
                ->with('presupuestos', json_encode($presupuestos))->with('clientes', json_encode($clientes))
                ->with('facturas', json_encode($facturas));
    }
    
    
    public function listarAbono(){
        //control de sesion
        $admin = new adminController();
        if (!$admin->getControl()) {
            return redirect('/')->with('login_errors', 'La sesión a expirado. Vuelva a logearse.');
        }
        
        $datos = Empresa::on('contfpp')->find((int)Session::get('IdEmpresa'));
        
        $facturas = Factura::on(Session::get('conexionBBDD'))
                        ->where('Borrado', '=', '1')
                        ->Where('esAbono', '=', null)
                        ->orWhere('esAbono', '=', '')
                        ->get();
       
        $clientes = Cliente::on(Session::get('conexionBBDD'))
                          ->where('borrado', '=', '1')
                          ->where('tipo', '=', 'C')
                          ->get();


        //ahora extraigo un listado de las facturas abonada (campo esAbono)
        $facturasAbonadas = Factura::on(Session::get('conexionBBDD'))
                            ->where('Borrado', '=', '1')
                            ->Where('esAbono', '<>', '')
                            ->select("esAbono")
                            ->get();
        
        //genero el array final de las facturas que no estan abonadas
        //formateo el numero NumFactura
        $facturasFinal = new \Illuminate\Support\Collection();
        for ($i = 0; $i < count($facturas); $i++) {
            //busco si esta en alguna factura de abono (en el array $facturasAbonadas)
            $estaAbonada = 'NO';
            for ($j = 0; $j < count($facturasAbonadas); $j++) {
                if((int)$facturasAbonadas[$j]->esAbono === (int)$facturas[$i]->NumFactura){
                    $estaAbonada = 'SI';
                    break;
                    //dd($facturasAbonadas[$j]->esAbono);
                }
            }

            if($estaAbonada === 'NO'){
                $numero = $admin->formatearNumero($facturas[$i]->NumFactura,$datos->TipoContador);
                $numeroOrdenar = $admin->formatearNumeroOrdenar($facturas[$i]->NumFactura,$datos->TipoContador);
                $facturas[$i]->NumFactura = "<!--" . $numeroOrdenar . "-->" . $numero;
                
                $facturasFinal[] = $facturas[$i];
            }
        }
        
        return view('facturas.listadoAbono')->with('clientes', json_encode($clientes))
                ->with('facturas', json_encode($facturasFinal));
    }
    
    
    public function createEdit(Request $request){
        $admin = new adminController();
        $datos = Empresa::on('contfpp')->find((int)Session::get('IdEmpresa'));
        //dd($request);die;
        
        //hago las operaciones en transaccion, trabajo con las tablas facturas y facturasdetalle
        //1º inserto o actualizo los datos de la tabla facturas por el IdFactura
        //2º si edito, borro los datos de la tabla facturasdetalle por el IdFactura (campo Borrado=0)
        //3º inserto los nuevos detalles con el IdFactura
        //4º compruebo si esta factura se genero de un presupuesto o pedido
        //5º si es asi, extraigo los datos del presupuesto y extraigo los datos de los pedidos que tengan este presupuesto 
        //   (ademas de este pedido, puede haber otros pedidos con este presupuesto) y los comparo
        //6º e indico en el campo de la tabla presupuesto.Pedido=P o T
        //7º repito los pasos 4, 5 y 6 con los pedidos
        
        \DB::connection(Session::get('conexionBBDD'))->beginTransaction(); //Comienza transaccion
        
        try{
            //1º
            //editar
            if(isset($request->IdFactura) && $request->IdFactura !== ""){
                //sino se edita este IdFactura
                $factura = Factura::on(Session::get('conexionBBDD'))->find($request->IdFactura);
                
                
                //2º
                $facturaDetalle = FacturaDetalle::on(Session::get('conexionBBDD'))
                                     ->where('IdFactura', '=', $request->IdFactura)
                                     ->where('Borrado', '=', '1')
                                     ->get();
                
                foreach ($facturaDetalle as $detalle) {
                    $detalle->Borrado = 0;
                    $detalle->save();
                }

                $ok = 'Se ha editado correctamente la factura.';
                $error = 'ERROR al edtar la factura.';
            }
            //nuevo
            else{
                //si es nuevo este valor viene vacio
                $factura = new Factura();
                $factura->setConnection(Session::get('conexionBBDD'));

                //indicamos el nuevo IdFactura
                $idFacturaNueva = Factura::on(Session::get('conexionBBDD'))
                                  ->max('IdFactura') + 1;
                $factura->IdFactura = $idFacturaNueva;
                $factura->Estado = 'Emitida';
                

                $ok = 'Se ha dado de alta correctamente la factura.';
                $error = 'ERROR al dar de alta la factura.';
            }
            
            //Continuo 1º (editar o nuevo), recojo los datos del formulario
            //NumFacura: formateo el numero que viene 
            $numFactura = $admin->desFormatearNumero($request->numFactura,$datos->TipoContador);
            $factura->NumFactura = $numFactura;
            $factura->IdCliente = (isset($request->idCliente)) ? $request->idCliente : '';
            $factura->IdPresupuesto = (isset($request->IdPresupuesto)) ? $request->IdPresupuesto : '';
            $factura->IdPedido = (isset($request->IdPedido)) ? $request->IdPedido : '';
            $factura->Referencia = (isset($request->Referencia)) ? $request->Referencia : '';
            $factura->FechaFactura = (isset($request->fechaFactura)) ? \Carbon\Carbon::createFromFormat('d/m/Y',$request->fechaFactura)->format('Y-m-d H:i:s') : '';
            $factura->FechaVtoFactura = (isset($request->FechaVtoFactura)) ? \Carbon\Carbon::createFromFormat('d/m/Y',$request->FechaVtoFactura)->format('Y-m-d H:i:s') : '';
            $factura->FormaPago = (isset($request->FormaPago)) ? $request->FormaPago : '';
            $factura->Retencion = (isset($request->Retencion)) ? $request->Retencion : '';
            $factura->Borrado = '1';
            $factura->BaseImponible = (isset($request->totalImporte)) ? $request->totalImporte : '';
            $factura->Cuota = (isset($request->totalCuota)) ? $request->totalCuota : '';
            $factura->total = (isset($request->Total)) ? $request->TotalNeto : '';
            $factura->CuotaRetencion = (isset($request->RetencionCuota)) ? $request->RetencionCuota : '';
            $factura->CC_Trans = (isset($request->CC_Trans)) ? $request->CC_Trans : '';
            $factura->esAbono = (isset($request->esAbono)) ? $request->esAbono : '';
            //guardo los cambios
            $factura->save();
            
            
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

                            //IdPresupuesto
                            $propIdPresupuesto = 'IdPresupuesto' . $num;
                            $valorIdPresupuesto = $request->$propIdPresupuesto;
                            if($valorIdPresupuesto === ''){
                                $valorIdPresupuesto = 0;
                            }

                            //NumLineaPresup
                            $propNumLineaPresup = 'NumLineaPresup' . $num;
                            $valorNumLineaPresup = $request->$propNumLineaPresup;
                            if($valorNumLineaPresup === ''){
                                $valorNumLineaPresup = 0;
                            }

                            //IdPedido
                            $propIdPedido = 'IdPedido' . $num;
                            $valorIdPedido = $request->$propIdPedido;
                            if($valorIdPedido === ''){
                                $valorIdPedido = 0;
                            }

                            //NumLineaPedido
                            $propNumLineaPedido = 'NumLineaPedido' . $num;
                            $valorNumLineaPedido = $request->$propNumLineaPedido;
                            if($valorNumLineaPedido === ''){
                                $valorNumLineaPedido = 0;
                            }

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
                            $facturaDetalleNueva[]=array(
                                "Cantidad"=>$valorCantidad, 
                                "Concepto"=>$valorConcepto,
                                "IdArticulo"=>$valorIdArticulo,
                                "IdPresupuesto"=>$valorIdPresupuesto,
                                "NumLineaPresup"=>$valorNumLineaPresup,
                                "IdPedido"=>$valorIdPedido,
                                "NumLineaPedido"=>$valorNumLineaPedido,
                                "Precio"=>$valorPrecio,
                                "Importe"=>$valorImporte,
                                "IVA"=>$valorIVA,
                                "Cuota"=>$valorCuota,
                            );
                        }
                    }
                }
            }
            //dd($facturaDetalleNueva);

            //por ultimo inserto estas lineas en la tabla presupuesotsDetalle
            for ($i = 0; $i < count($facturaDetalleNueva); $i++) {
                $nuevoDetalle = new FacturaDetalle();
                $nuevoDetalle->setConnection(Session::get('conexionBBDD'));
                $idNuevo = FacturaDetalle::on(Session::get('conexionBBDD'))
                                             ->max('IdFacturaDetalle') + 1;
                
                $nuevoDetalle->IdFacturaDetalle = $idNuevo;
                $nuevoDetalle->IdFactura = $factura->IdFactura;
                $nuevoDetalle->NumLineaFactura = (int)($i +1);//
                $nuevoDetalle->IdArticulo = (isset($facturaDetalleNueva[$i]['IdArticulo'])) ? $facturaDetalleNueva[$i]['IdArticulo'] : '';
                $nuevoDetalle->IdPresupuesto = (isset($facturaDetalleNueva[$i]['IdPresupuesto'])) ? $facturaDetalleNueva[$i]['IdPresupuesto'] : '';
                $nuevoDetalle->NumLineaPresup = (isset($facturaDetalleNueva[$i]['NumLineaPresup'])) ? $facturaDetalleNueva[$i]['NumLineaPresup'] : '';
                $nuevoDetalle->IdPedido = (isset($facturaDetalleNueva[$i]['IdPedido'])) ? $facturaDetalleNueva[$i]['IdPedido'] : '';
                $nuevoDetalle->NumLineaPedido = (isset($facturaDetalleNueva[$i]['NumLineaPedido'])) ? $facturaDetalleNueva[$i]['NumLineaPedido'] : '';
                $nuevoDetalle->DescripcionProducto = (isset($facturaDetalleNueva[$i]['Concepto'])) ? $facturaDetalleNueva[$i]['Concepto'] : '';
                $nuevoDetalle->TipoIVA = (isset($facturaDetalleNueva[$i]['IVA'])) ? $facturaDetalleNueva[$i]['IVA'] : '';
                $nuevoDetalle->Cantidad = (isset($facturaDetalleNueva[$i]['Cantidad'])) ? $facturaDetalleNueva[$i]['Cantidad'] : '';
                $nuevoDetalle->ImporteUnidad = (isset($facturaDetalleNueva[$i]['Precio'])) ? $facturaDetalleNueva[$i]['Precio'] : '';
                $nuevoDetalle->Importe = (isset($facturaDetalleNueva[$i]['Importe'])) ? $facturaDetalleNueva[$i]['Importe'] : '';
                $nuevoDetalle->CuotaIva = (isset($facturaDetalleNueva[$i]['Cuota'])) ? $facturaDetalleNueva[$i]['Cuota'] : '';

                $nuevoDetalle->save();
            }
            
            //4º
            //veo si exiten presupuesto a esta factura
            if($factura->IdPresupuesto !== ''){
                //busco las lineas del presupuesto (sumo los campos "Importe" y "CuotaIva")
                $presupuestoSumaImporte = PresupuestoDetalle::on(Session::get('conexionBBDD'))
                                            ->where("IdPresupuesto","=",(int)$factura->IdPresupuesto)
                                            ->where("Borrado","=",1)
                                            ->sum("Importe");
                $presupuestoSumaCuotaIva = PresupuestoDetalle::on(Session::get('conexionBBDD'))
                                            ->where("IdPresupuesto","=",(int)$factura->IdPresupuesto)
                                            ->where("Borrado","=",1)
                                            ->sum("CuotaIva");
                //busco las lineas de las facturas que tenga este presupuesto (sumo los campos "Importe" y "CuotaIva")
                $facturasSumaImporte = FacturaDetalle::on(Session::get('conexionBBDD'))
                                            ->where("IdPresupuesto","=",(int)$factura->IdPresupuesto)
                                            ->where("Borrado","=",1)
                                            ->sum("Importe");
                $facturasSumaCuotaIva = FacturaDetalle::on(Session::get('conexionBBDD'))
                                            ->where("IdPresupuesto","=",(int)$factura->IdPresupuesto)
                                            ->where("Borrado","=",1)
                                            ->sum("CuotaIva");
                
                
                //comparamos (se comparan los campos Importe y CuotaIva)
                //si sale igual o superior, es total (T) y si es entre 0 y el presupuesto es parcial (P)
                //BaseImponible
                $difBI = $presupuestoSumaImporte - $facturasSumaImporte;
                if($difBI <= 0){
                    $comparacionBI = 'T';
                }else
                if($difBI < $presupuestoSumaImporte && $difBI > 0){
                    $comparacionBI = 'P';
                }
                
                //CuotaIva
                $difC = $presupuestoSumaCuotaIva - $facturasSumaCuotaIva;
                if($difC <= 0){
                    $comparacionC = 'T';
                }else
                if($difC < $presupuestoSumaCuotaIva && $difC > 0){
                    $comparacionC = 'P';
                }
                
                //si todos los comparadores son NF, es NF, si son todos T, es T, para el resto es P 
                $comparacion = 'NF';
                if($comparacionBI === 'NF' && $comparacionC === 'NF'){
                    $comparacion = 'NF';
                }else
                if($comparacionBI === 'T' && $comparacionC === 'T'){
                    $comparacion = 'T';
                }else{
                    $comparacion = 'P';
                }

                //4º
                //buscamos el presupuesto (si hay IdPresupuesto != 0)
                if($factura->IdPresupuesto !== 0){
                    Presupuesto::on(Session::get('conexionBBDD'))
                                        ->where('IdPresupuesto', '=', $factura->IdPresupuesto)
                                        ->where('Borrado', '=', '1')
                                        ->update(['Facturada' => $comparacion]);
                }
                
                
//                
//                
//                
//                
//                
//                
//                //***************************
//                //5º
//                //extraigo el presupuesto
//                $presupuestoDetalle = PresupuestoDetalle::on(Session::get('conexionBBDD'))
//                                     ->where('IdPresupuesto', '=', $factura->IdPresupuesto)
//                                     ->where('Borrado', '=', '1')
//                                     ->get();
//                
//                //ahora extraigo todos los pedidos que esten relaccionadas con este presupuesto
//                $pedidosDetalle = PedidoDetalle::on(Session::get('conexionBBDD'))
//                                     ->where('IdPresupuesto', '=', $factura->IdPresupuesto)
//                                     ->where('Borrado', '=', '1')
//                                     ->get();
//                
//                //ahora extraigo todas las facturas que esten relaccionadas con este presupuesto
//                $facturasDetalle = FacturaDetalle::on(Session::get('conexionBBDD'))
//                                     ->where('IdPresupuesto', '=', $factura->IdPresupuesto)
//                                     ->where('Borrado', '=', '1')
//                                     ->get();
//                
//                
//                //hago la comparacion, mientras el resultado de la resta <=0 dicha comparacion este valor sera T (Total)
//                //en cuento un valor salga > 0, la suma de las facturas no son toda la factura, por lo que es P, y ya corto el resto de la comparacion
//                $comparacion = '';
//                foreach ($facturasDetalle as $linea) {
//                    for ($i = 0; $i < count($presupuestoDetalle); $i++) {
//                        if($presupuestoDetalle[$i]->NumLineaPresup === (int)$linea['NumLineaPresup']){
//                            //resto
//                            $presupuestoDetalle[$i]->Cantidad = $presupuestoDetalle[$i]->Cantidad - (float)$linea['Cantidad'];
//                            $presupuestoDetalle[$i]->Importe = $presupuestoDetalle[$i]->Importe - (float)$linea['Importe'];
//                            $comparacion = ($presupuestoDetalle[$i]->Importe <= 0) ? 'T' : 'P';
//                            $presupuestoDetalle[$i]->CuotaIva = round($presupuestoDetalle[$i]->Importe * (float)$linea['IVA'] / 100, 2);
//                            break;
//                        }
//                        if($comparacion === 'P'){
//                            break;
//                        }
//                    }
//                }
//                //hago lo mismo con los pedidos
//                foreach ($pedidosDetalle as $linea) {
//                    for ($i = 0; $i < count($presupuestoDetalle); $i++) {
//                        if($presupuestoDetalle[$i]->NumLineaPresup === (int)$linea['NumLineaPresup']){
//                            //resto
//                            $presupuestoDetalle[$i]->Cantidad = $presupuestoDetalle[$i]->Cantidad - (float)$linea['Cantidad'];
//                            $presupuestoDetalle[$i]->Importe = $presupuestoDetalle[$i]->Importe - (float)$linea['Importe'];
//                            $comparacion = ($presupuestoDetalle[$i]->Importe <= 0) ? 'T' : 'P';
//                            $presupuestoDetalle[$i]->CuotaIva = round($presupuestoDetalle[$i]->Importe * (float)$linea['IVA'] / 100, 2);
//                            break;
//                        }
//                        if($comparacion === 'P'){
//                            break;
//                        }
//                    }
//                }
//                
//                
//                //6º
//                //indico en el campo de la tabla presupuesto.Pedido=el valor de $comparacion
//                Presupuesto::on(Session::get('conexionBBDD'))
//                            ->where('IdPresupuesto', '=', $factura->IdPresupuesto)
//                            ->update(['Pedido' => $comparacion]);
//                
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
        return redirect('facturas/editar/'.$factura->IdFactura);
    }
    

    
    public function verPDF($idFactura,$accion, Request $request){
        //control de sesion
        $admin = new adminController();
        if (!$admin->getControl()) {
            return redirect('/')->with('login_errors', 'La sesión a expirado. Vuelva a logearse.');
        }

        
        //busco los datos
        $datos = Empresa::on('contfpp')->find((int)Session::get('IdEmpresa'));

        $factura = Factura::on(Session::get('conexionBBDD'))
                        ->find($idFactura);
        
        $cliente = Cliente::on(Session::get('conexionBBDD'))
                          ->where('borrado', '=', '1')
                          ->where('tipo', '=', 'C')
                          ->where('idCliente', '=', $factura->IdCliente)
                          ->get();

        $facturaDetalle = FacturaDetalle::on(Session::get('conexionBBDD'))
                          ->where('IdFactura', '=', $idFactura)
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
        $pdf->factura = json_decode($factura);
        $pdf->facturaDetalle = json_decode($facturaDetalle);
        //numero
        $numero = $admin->formatearNumero($pdf->factura->NumFactura,$pdf->datos->TipoContador);
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
        
        //aqui indico los datos de los cuadros superiores de fecha y si es periodica o no
        //numero
        if(isset($pdf->factura->esAbono) && $pdf->factura->esAbono !== ''){
            $numeroAbono = $admin->formatearNumero($pdf->factura->esAbono,$pdf->datos->TipoContador);
            $pdf->Cell(180, 4, utf8_decode('Abono de Factura Nº ' . $numeroAbono),0, 0, 'L');
        }
        
        $pdf->Ln();
        $pdf->Ln();

        $fecha = explode('/',date('d/m/Y',strtotime($pdf->factura->FechaFactura)));

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

        //Cuadro de la factura
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
        for ($i = 0;$i < count($pdf->facturaDetalle);$i++){
            //metemos las palabras que hay en el texto en un array
            $palabras=  explode(' ',utf8_decode($pdf->facturaDetalle[$i]->DescripcionProducto));
            //prepararmos un array con las lineas de texto rellenas de palabras que no sobrepasen XX caracteres
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
                    if($pdf->facturaDetalle[$i]->Cantidad === '0'){
                        $pdf->facturaDetalle[$i]->Cantidad = '';
                    }
                    $pdf->Cell($pdf->columCantidad+0.1, $altura, $admin->formateaNumeroContabilidad($pdf->facturaDetalle[$i]->Cantidad),'L',0,'R',$pdf->fill);
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
                    if($pdf->facturaDetalle[$i]->ImporteUnidad === '0'){
                        $pdf->facturaDetalle[$i]->ImporteUnidad = '';
                    }
                    $pdf->Cell($pdf->columPrecio, $altura, $admin->formateaNumeroContabilidad($pdf->facturaDetalle[$i]->ImporteUnidad),'L',0,'R',$pdf->fill);
                }else{
                    $pdf->Cell($pdf->columPrecio, $altura,'' ,'L',0,'R',$pdf->fill);
                }
                if($j==0){
                    $pdf->Cell($pdf->columImporte, $altura, $admin->formateaNumeroContabilidad($pdf->facturaDetalle[$i]->Importe),'L',0,'R',$pdf->fill);
                }else{
                    $pdf->Cell($pdf->columImporte, $altura, '','L',0,'R',$pdf->fill);
                }
                if($j==0){
                    $pdf->Cell($pdf->columIva, $altura, $pdf->facturaDetalle[$i]->TipoIVA." %",'L',0,'R',$pdf->fill);
                }else{
                    $pdf->Cell($pdf->columIva, $altura,'' ,'L',0,'R',$pdf->fill);
                }
                if($j==0){
                    $pdf->Cell($pdf->columCuota, $altura, $admin->formateaNumeroContabilidad($pdf->facturaDetalle[$i]->CuotaIva),'L',0,'R',$pdf->fill);
                }else{
                    $pdf->Cell($pdf->columCuota, $altura,'' ,'L',0,'R',$pdf->fill);
                }
                if($j==0){  
                    $pdf->Cell($pdf->columTotal-0.2, $altura, $admin->formateaNumeroContabilidad((float)$pdf->facturaDetalle[$i]->Importe + (float)$pdf->facturaDetalle[$i]->CuotaIva),'L',0,'R',$pdf->fill);
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
            $pdf->totalImporte = (float)$pdf->totalImporte + (float)$pdf->facturaDetalle[$i]->Importe;
            $pdf->totalCuota = (float)$pdf->totalCuota + (float)$pdf->facturaDetalle[$i]->CuotaIva;
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
            $file = "../public/pdf_files/Factura_".$pdf->datos->IdEmpresa.'-'.$pdf->factura->NumFactura.".pdf";
            $pdf->Output($file,"F");
            $pdf->Close();
            
            

            //envio del correo en si
            $to = $request->email;
            $Cc = $request->emailCC;
            
            //ESTE CAMPO FALLA MISTERIOSAMENTE
            //NO SE DEBE PONER EL CORREO AL QUE SE ENVIA, ES INCONGRUENTE 23/4/2016
            $from = $pdf->datos->email1;
            //$from = "soporte@aluminiosmarquez.esy.es";
            $subject = $pdf->datos->identificacion.'. Factura: '.$numero;

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
                            <title>'.$pdf->datos->identificacion.'. Factura: '.$numero.'</title>
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
            $mail->AltBody = 'Factura';
            //incluye el fichero adjunto
            $mail->addAttachment($file);

            $txtError = '';
            if($mail->send()){
                $txtError = 'La factura ha sido enviada correctamente.';
            }else{
                $txtError = 'La factura NO ha sido enviada.';
            }


            //redirecciono al factura
            return redirect('facturas/editar/'.$pdf->factura->IdFactura)->with('errors', json_encode($txtError));    
        }
    }

    
    public function duplicar($idFactura){
        //control de sesion
        $admin = new adminController();
        if (!$admin->getControl()) {
            return redirect('/')->with('login_errors', 'La sesión a expirado. Vuelva a logearse.');
        }
        
        //extraigo los datos de esta factura
        $factura = Factura::on(Session::get('conexionBBDD'))
                        ->find($idFactura);
        //lo clono
        $nueva_factura = $factura->replicate();
        $nueva_factura->setConnection(Session::get('conexionBBDD'));

        //indicamos la nueva IdFactura
        $idFacturaNueva = Factura::on(Session::get('conexionBBDD'))
                          ->max('IdFactura') + 1;
        $nueva_factura->IdFactura = $idFacturaNueva;
        $nueva_factura->Estado = 'Emitida';
        
        //saco un numero nuevo
        $datos = Empresa::on('contfpp')->find((int)Session::get('IdEmpresa'));
        $numeroNuevo = $admin->numeroNuevo('Factura',$datos->TipoContador);
        $numero = $admin->formatearNumero($numeroNuevo,$datos->TipoContador);
        
        $nueva_factura->NumFactura = $numeroNuevo;
        date_default_timezone_set('Europe/Madrid');
        $nueva_factura->FechaFactura = date('Y-m-d H:i:s');
        $nueva_factura->FechaVtoFactura = date('Y-m-d H:i:s');
        $nueva_factura->IdPresupuesto = '';
        $nueva_factura->IdPedido = '';
        
        
        //ahora busco las lineas de la factura
        $facturaDetalleNuevo = FacturaDetalle::on(Session::get('conexionBBDD'))
                          ->where('IdFactura', '=', $idFactura)
                          ->where('Borrado', '=', '1')
                          ->get();
        
        //ahora las operaciones que voy a hacer son por transaccion
        
        \DB::connection(Session::get('conexionBBDD'))->beginTransaction(); //Comienza transaccion
        try{
            //guardo la factura
            $nueva_factura->push();

            //ahora inserto estas lineas en la tabla facturaDetalle
            for ($i = 0; $i < count($facturaDetalleNuevo); $i++) {
                $nuevoDetalle = new FacturaDetalle();
                $nuevoDetalle->setConnection(Session::get('conexionBBDD'));
                $idNuevo = FacturaDetalle::on(Session::get('conexionBBDD'))
                                             ->max('IdFacturaDetalle') + 1;

                $nuevoDetalle->IdFacturaDetalle = $idNuevo;
                $nuevoDetalle->IdFactura = $nueva_factura->IdFactura;
                $nuevoDetalle->NumLineaFactura = (int)($i +1);
                $nuevoDetalle->IdArticulo = (isset($facturaDetalleNuevo[$i]->IdArticulo)) ? $facturaDetalleNuevo[$i]->IdArticulo : '';
                $nuevoDetalle->IdPresupuesto = (isset($facturaDetalleNuevo[$i]->IdPresupuesto)) ? $facturaDetalleNuevo[$i]->IdPresupuesto : '';
                $nuevoDetalle->NumLineaPresup = (isset($facturaDetalleNuevo[$i]->NumLineaPresup)) ? $facturaDetalleNuevo[$i]->NumLineaPresup : '';
                $nuevoDetalle->IdPedido = (isset($facturaDetalleNuevo[$i]->IdPedido)) ? $facturaDetalleNuevo[$i]->IdPedido : '';
                $nuevoDetalle->NumLineaPedido = (isset($facturaDetalleNuevo[$i]->NumLineaPedido)) ? $facturaDetalleNuevo[$i]->NumLineaPedido : '';
                $nuevoDetalle->DescripcionProducto = (isset($facturaDetalleNuevo[$i]->DescripcionProducto)) ? $facturaDetalleNuevo[$i]->DescripcionProducto : '';
                $nuevoDetalle->TipoIVA = (isset($facturaDetalleNuevo[$i]->TipoIVA)) ? $facturaDetalleNuevo[$i]->TipoIVA : '';
                $nuevoDetalle->Cantidad = (isset($facturaDetalleNuevo[$i]->Cantidad)) ? $facturaDetalleNuevo[$i]->Cantidad : '';
                $nuevoDetalle->ImporteUnidad = (isset($facturaDetalleNuevo[$i]->ImporteUnidad)) ? $facturaDetalleNuevo[$i]->ImporteUnidad : '';
                $nuevoDetalle->Importe = (isset($facturaDetalleNuevo[$i]->Importe)) ? $facturaDetalleNuevo[$i]->Importe : '';
                $nuevoDetalle->CuotaIva = (isset($facturaDetalleNuevo[$i]->CuotaIva)) ? $facturaDetalleNuevo[$i]->CuotaIva : '';

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
        

        //por ultimo voy a la nueva factura clonada
        return redirect('facturas/editar/'.$nueva_factura->IdFactura);
    }
    
    
    //NO    
    public function borrar($idFactura){
        //control de sesion
        $admin = new adminController();
        if (!$admin->getControl()) {
            return redirect('/')->with('login_errors', 'La sesión a expirado. Vuelva a logearse.');
        }
        
        $txt = '';
        
        \DB::connection(Session::get('conexionBBDD'))->beginTransaction(); //Comienza transaccion
        try{
            //se busca esta factura
            $factura = Factura::on(Session::get('conexionBBDD'))->find($idFactura);
            $factura->Borrado = 0;
            $factura->save();

            $facturaDetalle = FacturaDetalle::on(Session::get('conexionBBDD'))
                                 ->where('IdFactura', '=', $idFactura)
                                 ->where('Borrado', '=', '1')
                                 ->get();

            foreach ($facturaDetalle as $detalle) {
                $detalle->Borrado = 0;
                $detalle->save();
            }

            $txt = 'Se ha borrado correctamente la factura.';
        }
        catch(\Exception $e)
        {
          //failed logic here
           \DB::connection(Session::get('conexionBBDD'))->rollback();
           throw $e;
           $txt = 'ERROR al borrar la factura.';
        }

        \DB::connection(Session::get('conexionBBDD'))->commit();
        
        //por ultimo vuelvo al listado de facturas
        return redirect('facturas/mdb')->with('errors', json_encode($txt));
    }
    
    
    
    public function actualizarEstado(){
        $IdFactura = Input::get('IdFactura');
        $opcion = Input::get('opcion');

        Factura::on(Session::get('conexionBBDD'))
                   ->where('IdFactura','=',$IdFactura)
                   ->where('Borrado','=','1')
                   ->update(['Estado' => $opcion]);
        
        echo true;
    }
    
    public function prepararAbono($idFactura){
        //control de sesion
        $admin = new adminController();
        if (!$admin->getControl()) {
            return redirect('/')->with('login_errors', 'La sesión a expirado. Vuelva a logearse.');
        }
        
        
        //extraigo los datos de esta factura
        $factura = Factura::on(Session::get('conexionBBDD'))
                        ->find($idFactura);
        //lo clono
        $nueva_factura = $factura->replicate();
        $nueva_factura->setConnection(Session::get('conexionBBDD'));

        //indicamos la nueva IdFactura
        $idFacturaNueva = Factura::on(Session::get('conexionBBDD'))
                          ->max('IdFactura') + 1;
        $nueva_factura->IdFactura = $idFacturaNueva;
        $nueva_factura->Estado = 'Emitida';
        
        //saco un numero nuevo
        $datos = Empresa::on('contfpp')->find((int)Session::get('IdEmpresa'));
        $numeroNuevo = $admin->numeroNuevoAbono('Factura',$datos->TipoContador);
        $numero = $admin->formatearNumero($numeroNuevo,$datos->TipoContador);
        
        $nueva_factura->esAbono = $nueva_factura->NumFactura;//guardo el numero de la factura a la que se va a abonar
        $nueva_factura->NumFactura = $numeroNuevo;
        date_default_timezone_set('Europe/Madrid');
        $nueva_factura->FechaFactura = date('Y-m-d H:i:s');
        $nueva_factura->FechaVtoFactura = date('Y-m-d H:i:s');
        $nueva_factura->IdPresupuesto = '';
        $nueva_factura->IdPedido = '';
        
        //pongo en negativos los valores de los campos BaseImponible, Cuota, CuotaRetencion y total 
        ($nueva_factura->BaseImponible > 0) ? $nueva_factura->BaseImponible = - $nueva_factura->BaseImponible : '';
        ($nueva_factura->Cuota > 0) ? $nueva_factura->Cuota = - $nueva_factura->Cuota : '';
        ($nueva_factura->CuotaRetencion > 0) ? $nueva_factura->CuotaRetencion = - $nueva_factura->CuotaRetencion : '';
        ($nueva_factura->total > 0) ? $nueva_factura->total = - $nueva_factura->total : '';

        
        //ahora busco las lineas de la factura
        $facturaDetalleNuevo = FacturaDetalle::on(Session::get('conexionBBDD'))
                          ->where('IdFactura', '=', $idFactura)
                          ->where('Borrado', '=', '1')
                          ->get();
        
        //ahora las operaciones que voy a hacer son por transaccion
        
        \DB::connection(Session::get('conexionBBDD'))->beginTransaction(); //Comienza transaccion
        try{
            //guardo la factura
            $nueva_factura->push();

            //ahora inserto estas lineas en la tabla facturaDetalle con los valores de los campos ImporteUnidad, Importe y CuotaIva en negativos
            for ($i = 0; $i < count($facturaDetalleNuevo); $i++) {
                $nuevoDetalle = new FacturaDetalle();
                $nuevoDetalle->setConnection(Session::get('conexionBBDD'));
                $idNuevo = FacturaDetalle::on(Session::get('conexionBBDD'))
                                             ->max('IdFacturaDetalle') + 1;
                
                $ImporteUnidad = 0;
                if(isset($facturaDetalleNuevo[$i]->ImporteUnidad)){
                    if($facturaDetalleNuevo[$i]->ImporteUnidad > 0){
                        $ImporteUnidad = - $facturaDetalleNuevo[$i]->ImporteUnidad;
                    }else{
                        $ImporteUnidad = $facturaDetalleNuevo[$i]->ImporteUnidad;
                    }
                }
                $Importe = 0;
                if(isset($facturaDetalleNuevo[$i]->Importe)){
                    if($facturaDetalleNuevo[$i]->Importe > 0){
                        $Importe = - $facturaDetalleNuevo[$i]->Importe;
                    }else{
                        $Importe = $facturaDetalleNuevo[$i]->Importe;
                    }
                }
                $CuotaIva = 0;
                if(isset($facturaDetalleNuevo[$i]->CuotaIva)){
                    if($facturaDetalleNuevo[$i]->CuotaIva > 0){
                        $CuotaIva = - $facturaDetalleNuevo[$i]->CuotaIva;
                    }else{
                        $CuotaIva = $facturaDetalleNuevo[$i]->CuotaIva;
                    }
                }
                
                $nuevoDetalle->IdFacturaDetalle = $idNuevo;
                $nuevoDetalle->IdFactura = $nueva_factura->IdFactura;
                $nuevoDetalle->NumLineaFactura = (int)($i +1);
                $nuevoDetalle->IdArticulo = (isset($facturaDetalleNuevo[$i]->IdArticulo)) ? $facturaDetalleNuevo[$i]->IdArticulo : '';
                $nuevoDetalle->IdPresupuesto = (isset($facturaDetalleNuevo[$i]->IdPresupuesto)) ? $facturaDetalleNuevo[$i]->IdPresupuesto : '';
                $nuevoDetalle->NumLineaPresup = (isset($facturaDetalleNuevo[$i]->NumLineaPresup)) ? $facturaDetalleNuevo[$i]->NumLineaPresup : '';
                $nuevoDetalle->IdPedido = (isset($facturaDetalleNuevo[$i]->IdPedido)) ? $facturaDetalleNuevo[$i]->IdPedido : '';
                $nuevoDetalle->NumLineaPedido = (isset($facturaDetalleNuevo[$i]->NumLineaPedido)) ? $facturaDetalleNuevo[$i]->NumLineaPedido : '';
                $nuevoDetalle->DescripcionProducto = (isset($facturaDetalleNuevo[$i]->DescripcionProducto)) ? $facturaDetalleNuevo[$i]->DescripcionProducto : '';
                $nuevoDetalle->TipoIVA = (isset($facturaDetalleNuevo[$i]->TipoIVA)) ? $facturaDetalleNuevo[$i]->TipoIVA : '';
                $nuevoDetalle->Cantidad = (isset($facturaDetalleNuevo[$i]->Cantidad)) ? $facturaDetalleNuevo[$i]->Cantidad : '';
                $nuevoDetalle->ImporteUnidad = $ImporteUnidad;
                $nuevoDetalle->Importe = $Importe;
                $nuevoDetalle->CuotaIva = $CuotaIva;

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
        

        //por ultimo voy a la nueva factura abono
        return redirect('facturas/editar/'.$nueva_factura->IdFactura);
    }
}

//defino el objeto PDF
class PDF extends baseFpdf{

    public $datos;
    public $cliente;
    public $factura;
    public $facturaDetalle;
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
        $this->Cell(30,20,utf8_decode('FACTURA Nº ').utf8_decode($this->numero),0,0,'R');
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
        $Y = -70;
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
        $this->IRPFCuota = $this->totalImporte * $this->factura->Retencion / 100;
        $this->totalFinal = $this->totalImporte + $this->totalCuota - $this->IRPFCuota;
        if($this->factura->Retencion <> '0'){
            $this->Cell(145-0.2, $altura, utf8_decode('Retención %'),'L','L', 'R',true);
            $this->Cell(15, $altura, $this->factura->Retencion,0,'L', 'R',true);
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
    
        //forma de pago y validez factura
        $this->SetFillColor(232,232,232);
        $this->Cell(25, $altura, 'Forma de Pago:',0,'L', 'R');
        $this->Cell(35, $altura, utf8_decode($this->factura->FormaPago),0,'R', 'L',true);
        $this->Cell(40, $altura, utf8_decode('Vence el día:'),0,'L', 'R');
        $this->Cell(25, $altura, \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$this->factura->FechaVtoFactura)->format('d/m/Y'),0,'R', 'C',true);
        //$this->Cell(10, $altura, utf8_decode('días f.f.'),0,'L', 'L');
        $this->Ln();
        $this->Cell(25, $altura, '',0,'L', 'R');
        if($this->factura->FormaPago === 'Transferencia'){
            $this->Cell(35, $altura, utf8_decode($this->factura->CC_Trans),0,'R', 'L');
        }
        $this->Ln();
        
        
        
        
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

    //NO SE USA 16/5/2016
    function FechasYTipoFactura()
    {
        $this->SetFillColor(244,244,244);
        $this->SetDrawColor(200,200,200);

        // Datos 1º Cuadro: 1 linea
        $this->SetFont('Arial','',9);
        $this->Cell(40, 4, utf8_decode("Fecha Pedido: "),'LT', 0, 'R',true);
        $this->Cell(50, 4, \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$this->pedido->FechaPedido)->format('d/m/Y'),'TR', 0, 'L');
        $this->Cell(10, 4, ' ',0,0, 0);
        // Datos 2º Cuadro: 1 linea
        $this->SetFont('Arial','',9);
        $this->Cell(45, 4, utf8_decode("Tipo Factura: "),'LT', 0, 'R',true);
        $this->Cell(40, 4, utf8_decode($this->pedido->TipoFactura),'TR', 0, 'L');
        $this->Ln();
        
        // Datos 1º Cuadro: 2 linea
        $this->SetFont('Arial','',9);
        $this->Cell(40, 4, utf8_decode("Fecha Vencimiento: "),'L', 0, 'R',true);
        $this->Cell(50, 4, \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$this->pedido->FechaVtoPedido)->format('d/m/Y'),'R', 0, 'L');
        $this->Cell(10, 4, ' ',0,0, 0);
        // Datos 2º Cuadro: 2 linea
        $this->SetFont('Arial','',9);
        $this->Cell(45, 4, utf8_decode("Frecuencia: "),'L', 0, 'R',true);
        $this->Cell(40, 4, utf8_decode($this->pedido->FrecuenciaPeriodica) . '(Meses)','R', 0, 'L');
        $this->Ln();
        
        // Datos 1º Cuadro: 3 linea
        $this->SetFont('Arial','',9);
        $this->Cell(40, 4, utf8_decode("Forma de Pago: "),'LB', 0, 'R',true);
        $this->Cell(50, 4, utf8_decode($this->pedido->FormaPago),'BR', 0, 'L');
        $this->Cell(10, 4, ' ',0,0, 0);
        // Datos 2º Cuadro: 3 linea
        $this->SetFont('Arial','',9);
        $this->Cell(45, 4, utf8_decode("Fecha Próxima Factura: "),'LB', 0, 'R',true);
        if($this->pedido->TipoFactura === 'Periodica'){
            $this->Cell(40, 4, \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$this->pedido->FechaProximaFacturaPeriodica)->format('d/m/Y'),'BR', 0, 'L');
        }else{
            $this->Cell(40, 4, '','BR', 0, 'L');
        }
        $this->Ln();
    }

}