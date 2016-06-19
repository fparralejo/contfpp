<?php 
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use Input;
use Illuminate\Http\Request;


use App\Empresa;
use App\Articulo;
use App\Cliente;
use App\Empleado;
use App\Factura;
use App\FacturaDetalle;
use App\Pedido;
use App\PedidoDetalle;
use App\Presupuesto;
use App\PresupuestoDetalle;
use App\Usuario;

use App\Http\Controllers\adminController;


class bbddController extends Controller {

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

        
    public function main(){
        //control de sesion
        $admin = new adminController();
        if (!$admin->getControl()) {
            return redirect('/')->with('login_errors', 'La sesión a expirado. Vuelva a logearse.');
        }
        //hacemos una copia de las tablas en un fichero
        
        //las copias estan en la carpeta "public/backup"
        //leo las de esta empresa y las presento en el listado
        $directorio = '../public/backup';
        $ficheros  = scandir($directorio);
        
        $txtError = "";
        if(Session::has('errors')){
            $txtError = Session::get('errors');
        }
        
        //ahora preparo el array del listado de los backup's guardados
        $datos = '';
        //dd($ficheros);
        for ($i = 0; $i < count($ficheros); $i++){
            if($ficheros[$i] === '.' || $ficheros[$i] === '..'){
            }else{
                //ahora descompongo el nombre del fichero para ver los datos
                $explodeFichero = explode(".", $ficheros[$i]);
                $explodeFichero = explode("-", $explodeFichero[0]);
                //el nombre del fichero es de esta forma (BBDD_2_2016-06-19-18-54-13)
                //en la posicion 1 esta el numero de empresa, 
                //si coincide con el nuestro lo incluimos en el array final
                if((int)$explodeFichero[1] === (int)Session::get('IdEmpresa')){
                    $dato['fecha'] = $explodeFichero[4] . '/' . $explodeFichero[3] . '/' . $explodeFichero[2] . ' ' . $explodeFichero[5] . ':' . $explodeFichero[6] . ':' . $explodeFichero[7];
                    $dato['fichero'] = $ficheros[$i];
                    $datos[] = $dato;
                }
            }
        }

        //var_dump($datos);die;
        return view('bbdd.main')->with('ficheros', ($datos))->with('errors', $txtError);
    }
        
    
    public function backup(Request $request){
        \Log::info('Laravel: info ');
        \Log::emergency('Laravel: emergency ');
        \Log::alert('Laravel: alert ');
        \Log::critical('Laravel: critical ');
        \Log::error('Laravel: error ');
        \Log::warning('Laravel: warning ');
        \Log::notice('Laravel: notice ');
        \Log::debug('Laravel: debug ');
        //dd($request);
        //vemos con que opcion venimos
        if($request->opcion === "guardar"){
            //se procede a hacer una copia de seguridad de la BBDD
            //las tablas son:
            //articulos
            //clientes
            //empleados
            //facturas
            //facturasdetalle
            //pedidos
            //pedidosdetalle
            //presupuestos
            //presupuestosdetalle
            //usuarios

            //generamos el nombre del fichero
            $fecha = \Carbon\Carbon::createFromFormat('Y-m-d-H-i-s',date('Y-m-d-H-i-s'))->format('Y-m-d-H-i-s');
            $nombre = "../public/backup/BBDD-" . Session::get('IdEmpresa') . "-" . $fecha . ".json";
            $datos = '';

            //articulos
            $articulos = Articulo::on(Session::get('conexionBBDD'))->get();
            $datos['Articulos'] = $articulos->toArray(); 

            //clientes
            $clientes = Cliente::on(Session::get('conexionBBDD'))->get();
            $datos['Clientes'] = $clientes->toArray(); 

            //empleados
            $empleados = Empleado::on(Session::get('conexionBBDD'))->get();
            $datos['Empleados'] = $empleados->toArray(); 

            //facturas
            $facturas = Factura::on(Session::get('conexionBBDD'))->get();
            $datos['Facturas'] = $facturas->toArray(); 

            //facturasdetalle
            $facturasDetalle = FacturaDetalle::on(Session::get('conexionBBDD'))->get();
            $datos['FacturasDetalle'] = $facturasDetalle->toArray(); 

            //pedidos
            $pedidos = Pedido::on(Session::get('conexionBBDD'))->get();
            $datos['Pedidos'] = $pedidos->toArray(); 

            //pedidosdetalle
            $pedidosDetalle = PedidoDetalle::on(Session::get('conexionBBDD'))->get();
            $datos['PedidosDetalle'] = $pedidosDetalle->toArray(); 

            //presupuestos
            $presupuestos = Presupuesto::on(Session::get('conexionBBDD'))->get();
            $datos['Presupuestos'] = $presupuestos->toArray(); 

            //presupuestosdetalle
            $presupuestosDetalle = PresupuestoDetalle::on(Session::get('conexionBBDD'))->get();
            $datos['PresupuestosDetalle'] = $presupuestosDetalle->toArray(); 

            //usuarios
            $usuarios = Usuario::on(Session::get('conexionBBDD'))->get();
            $datos['Usuarios'] = $usuarios->toArray(); 


            $fh = fopen($nombre, 'w');
            fwrite($fh, json_encode($datos,JSON_UNESCAPED_UNICODE));
            fclose($fh);

            $txtError = "Se ha guardado correctamente una copia de la base de datos";
        }else if($request->opcion === "importar"){
            //vamos a importar el fichero json a la base de datos
            $data = file_get_contents("../public/backup/" . $request->fichero);
            $datos = json_decode($data, true);
            
            //primero borro los datos de la tabla y despues inserto los datos nuevos
            //articulos
            Articulo::on(Session::get('conexionBBDD'))->truncate();
            foreach ($datos['Articulos'] as $articulo){
                $obj = new Articulo();
                $obj->setConnection(Session::get('conexionBBDD'));
                $obj->IdArticulo = $articulo['IdArticulo'];
                $obj->Referencia = $articulo['Referencia'];
                $obj->Descripcion = $articulo['Descripcion'];
                $obj->Precio = $articulo['Precio'];
                $obj->tipoIVA = $articulo['tipoIVA'];
                $obj->Borrado = $articulo['Borrado'];
                $obj->fecha = $articulo['fecha'];
                $obj->save();
            }
            
            //clientes
            Cliente::on(Session::get('conexionBBDD'))->truncate();
            foreach ($datos['Clientes'] as $cliente){
                $obj = new Cliente();
                $obj->setConnection(Session::get('conexionBBDD'));
                $obj->idCliente = $cliente['idCliente'];
                $obj->nombre = $cliente['nombre'];
                $obj->apellidos = $cliente['apellidos'];
                $obj->telefono = $cliente['telefono'];
                $obj->email = $cliente['email'];
                $obj->notas = $cliente['notas'];
                $obj->nombreEmpresa = $cliente['nombreEmpresa'];
                $obj->CIF = $cliente['CIF'];
                $obj->direccion = $cliente['direccion'];
                $obj->municipio = $cliente['municipio'];
                $obj->CP = $cliente['CP'];
                $obj->provincia = $cliente['provincia'];
                $obj->forma_pago_habitual = $cliente['forma_pago_habitual'];
                $obj->borrado = $cliente['borrado'];
                $obj->fechaAlta = $cliente['fechaAlta'];
                $obj->tipo = $cliente['tipo'];
                $obj->save();
            }
            
            //empleados
            Empleado::on(Session::get('conexionBBDD'))->truncate();
            foreach ($datos['Empleados'] as $empleado){
                $obj = new Empleado();
                $obj->setConnection(Session::get('conexionBBDD'));
                $obj->IdEmpleado = $empleado['IdEmpleado'];
                $obj->IdEmpresa = $empleado['IdEmpresa'];
                $obj->nombre = $empleado['nombre'];
                $obj->apellidos = $empleado['apellidos'];
                $obj->correo = $empleado['correo'];
                $obj->telefono = $empleado['telefono'];
                $obj->movil = $empleado['movil'];
                $obj->borrado = $empleado['borrado'];
                $obj->fechaStatus = $empleado['fechaStatus'];
                $obj->IdEmpleadoStatus = $empleado['IdEmpleadoStatus'];
                $obj->save();
            }

            //facturas
            Factura::on(Session::get('conexionBBDD'))->truncate();
            foreach ($datos['Facturas'] as $factura){
                $obj = new Factura();
                $obj->setConnection(Session::get('conexionBBDD'));
                $obj->IdFactura = $factura['IdFactura'];
                $obj->NumFactura = $factura['NumFactura'];
                $obj->IdCliente = $factura['IdCliente'];
                $obj->IdPresupuesto = $factura['IdPresupuesto'];
                $obj->IdPedido = $factura['IdPedido'];
                $obj->FechaFactura = $factura['FechaFactura'];
                $obj->FechaVtoFactura = $factura['FechaVtoFactura'];
                $obj->FormaPago = $factura['FormaPago'];
                $obj->Estado = $factura['Estado'];
                $obj->Retencion = $factura['Retencion'];
                $obj->Borrado = $factura['Borrado'];
                $obj->BaseImponible = $factura['BaseImponible'];
                $obj->Cuota = $factura['Cuota'];
                $obj->CuotaRetencion = $factura['CuotaRetencion'];
                $obj->total = $factura['total'];
                $obj->asiento = $factura['asiento'];
                $obj->Referencia = $factura['Referencia'];
                $obj->CC_Trans = $factura['CC_Trans'];
                $obj->esAbono = $factura['esAbono'];
                $obj->save();
            }

            //facturasdetalle
            FacturaDetalle::on(Session::get('conexionBBDD'))->truncate();
            foreach ($datos['FacturasDetalle'] as $facturaDetalle){
                $obj = new FacturaDetalle();
                $obj->setConnection(Session::get('conexionBBDD'));
                $obj->IdFacturaDetalle = $facturaDetalle['IdFacturaDetalle'];
                $obj->IdFactura = $facturaDetalle['IdFactura'];
                $obj->NumLineaFactura = $facturaDetalle['NumLineaFactura'];
                $obj->IdPedido = $facturaDetalle['IdPedido'];
                $obj->NumLineaPedido = $facturaDetalle['NumLineaPedido'];
                $obj->IdPresupuesto = $facturaDetalle['IdPresupuesto'];
                $obj->NumLineaPresup = $facturaDetalle['NumLineaPresup'];
                $obj->IdArticulo = $facturaDetalle['IdArticulo'];
                $obj->DescripcionProducto = $facturaDetalle['DescripcionProducto'];
                $obj->TipoIVA = $facturaDetalle['TipoIVA'];
                $obj->Cantidad = $facturaDetalle['Cantidad'];
                $obj->ImporteUnidad = $facturaDetalle['ImporteUnidad'];
                $obj->Importe = $facturaDetalle['Importe'];
                $obj->CuotaIva = $facturaDetalle['CuotaIva'];
                $obj->Borrado = $facturaDetalle['Borrado'];
                $obj->save();
            }

            //pedidos
            Pedido::on(Session::get('conexionBBDD'))->truncate();
            foreach ($datos['Pedidos'] as $pedido){
                $obj = new Pedido();
                $obj->setConnection(Session::get('conexionBBDD'));
                $obj->IdPedido = $pedido['IdPedido'];
                $obj->NumPedido = $pedido['NumPedido'];
                $obj->IdCliente = $pedido['IdCliente'];
                $obj->IdPresupuesto = $pedido['IdPresupuesto'];
                $obj->FechaPedido = $pedido['FechaPedido'];
                $obj->FechaVtoPedido = $pedido['FechaVtoPedido'];
                $obj->FormaPago = $pedido['FormaPago'];
                $obj->Estado = $pedido['Estado'];
                $obj->Retencion = $pedido['Retencion'];
                $obj->Borrado = $pedido['Borrado'];
                $obj->TipoFactura = $pedido['TipoFactura'];
                $obj->FrecuenciaPeriodica = $pedido['FrecuenciaPeriodica'];
                $obj->FechaProximaFacturaPeriodica = $pedido['FechaProximaFacturaPeriodica'];
                $obj->BaseImponible = $pedido['BaseImponible'];
                $obj->Cuota = $pedido['Cuota'];
                $obj->CuotaRetencion = $pedido['CuotaRetencion'];
                $obj->total = $pedido['total'];
                $obj->Facturada = $pedido['Facturada'];
                $obj->save();
            }

            //pedidosdetalle
            PedidoDetalle::on(Session::get('conexionBBDD'))->truncate();
            foreach ($datos['PedidosDetalle'] as $pedidoDetalle){
                $obj = new PedidoDetalle();
                $obj->setConnection(Session::get('conexionBBDD'));
                $obj->IdPedidoDetalle = $pedidoDetalle['IdPedidoDetalle'];
                $obj->IdPedido = $pedidoDetalle['IdPedido'];
                $obj->NumLineaPedido = $pedidoDetalle['NumLineaPedido'];
                $obj->IdPresupuesto = $pedidoDetalle['IdPresupuesto'];
                $obj->NumLineaPresup = $pedidoDetalle['NumLineaPresup'];
                $obj->IdArticulo = $pedidoDetalle['IdArticulo'];
                $obj->DescripcionProducto = $pedidoDetalle['DescripcionProducto'];
                $obj->TipoIVA = $pedidoDetalle['TipoIVA'];
                $obj->Cantidad = $pedidoDetalle['Cantidad'];
                $obj->ImporteUnidad = $pedidoDetalle['ImporteUnidad'];
                $obj->Importe = $pedidoDetalle['Importe'];
                $obj->CuotaIva = $pedidoDetalle['CuotaIva'];
                $obj->Borrado = $pedidoDetalle['Borrado'];
                $obj->save();
            }

            
            //presupuestos
            Presupuesto::on(Session::get('conexionBBDD'))->truncate();
            foreach ($datos['Presupuestos'] as $presupuesto){
                $obj = new Presupuesto();
                $obj->setConnection(Session::get('conexionBBDD'));
                $obj->IdPresupuesto = $presupuesto['IdPresupuesto'];
                $obj->NumPresupuesto = $presupuesto['NumPresupuesto'];
                $obj->IdCliente = $presupuesto['IdCliente'];
                $obj->FechaPresupuesto = $presupuesto['FechaPresupuesto'];
                $obj->FechaVtoPresupuesto = $presupuesto['FechaVtoPresupuesto'];
                $obj->FormaPago = $presupuesto['FormaPago'];
                $obj->FechaFinalizacion = $presupuesto['FechaFinalizacion'];
                $obj->Estado = $presupuesto['Estado'];
                $obj->Retencion = $presupuesto['Retencion'];
                $obj->Proforma = $presupuesto['Proforma'];
                $obj->Borrado = $presupuesto['Borrado'];
                $obj->BaseImponible = $presupuesto['BaseImponible'];
                $obj->Cuota = $presupuesto['Cuota'];
                $obj->CuotaRetencion = $presupuesto['CuotaRetencion'];
                $obj->total = $presupuesto['total'];
                $obj->Facturada = $presupuesto['Facturada'];
                $obj->Pedido = $presupuesto['Pedido'];
                $obj->save();
            }
            
            //presupuestosdetalle
            PresupuestoDetalle::on(Session::get('conexionBBDD'))->truncate();
            foreach ($datos['PresupuestosDetalle'] as $presupuestoDetalle){
                $obj = new PresupuestoDetalle();
                $obj->setConnection(Session::get('conexionBBDD'));
                $obj->IdPresupDetalle = $presupuestoDetalle['IdPresupDetalle'];
                $obj->IdPresupuesto = $presupuestoDetalle['IdPresupuesto'];
                $obj->NumLineaPresup = $presupuestoDetalle['NumLineaPresup'];
                $obj->IdArticulo = $presupuestoDetalle['IdArticulo'];
                $obj->DescripcionProducto = $presupuestoDetalle['DescripcionProducto'];
                $obj->TipoIVA = $presupuestoDetalle['TipoIVA'];
                $obj->Cantidad = $presupuestoDetalle['Cantidad'];
                $obj->ImporteUnidad = $presupuestoDetalle['ImporteUnidad'];
                $obj->Importe = $presupuestoDetalle['Importe'];
                $obj->CuotaIva = $presupuestoDetalle['CuotaIva'];
                $obj->Borrado = $presupuestoDetalle['Borrado'];
                $obj->save();
            }

            //usuarios
            Usuario::on(Session::get('conexionBBDD'))->truncate();
            foreach ($datos['Usuarios'] as $usuario){
                $obj = new Usuario();
                $obj->setConnection(Session::get('conexionBBDD'));
                $obj->usuario = $usuario['usuario'];
                $obj->password = $usuario['password'];
                $obj->IdEmpleado = $usuario['IdEmpleado'];
                $obj->borrado = $usuario['borrado'];
                $obj->fechaStatus = $usuario['fechaStatus'];
                $obj->IdEmpleadoStatus = $usuario['IdEmpleadoStatus'];
                $obj->save();
            }

            
            $txtError = "Se ha importado correctamente la base de datos";
        }
        
        
        return redirect('bbdd/backup')->with('errors', json_encode($txtError));    
    }
    
        
    
    
    

    //NO VALE BORRAR    
    public function articuloShow()
    {
        $articulo = Articulo::on(Session::get('conexionBBDD'))->find(Input::get('IdArticulo'));

        //devuelvo la respuesta al send
        echo json_encode($articulo);
    }
    
    public function createEdit(Request $request){
        //dd($request->IdArticulo);die;
        
        if(isset($request->IdArticulo) && $request->IdArticulo !== ""){
            //sino se edita este Articulo
            $articulo = Articulo::on(Session::get('conexionBBDD'))->find($request->IdArticulo);
            
            $ok = 'Se ha editado correctamente el artículo.';
            $error = 'ERROR al edtar el artículo.';
        }
        else{
            //si es nuevo este valor viene vacio
            $articulo = new Articulo();
            $articulo->setConnection(Session::get('conexionBBDD'));
            $articulo->fecha = date('Y-m-d H:i:s');
            
            //indicamos el nuevo IdArticulo
            $idArticuloNuevo = Articulo::on(Session::get('conexionBBDD'))
                              ->max('IdArticulo') + 1;
            $articulo->IdArticulo = $idArticuloNuevo;
        
            $ok = 'Se ha dado de alta correctamente el artículo.';
            $error = 'ERROR al dar de alta el artículo.';
        }
            
        $articulo->Referencia = (isset($request->Referencia)) ? $request->Referencia : '';
        $articulo->Descripcion = (isset($request->Descripcion)) ? $request->Descripcion : '';
        $articulo->Precio = (isset($request->Precio)) ? $request->Precio : '';
        $articulo->tipoIVA = (isset($request->tipoIVA)) ? $request->tipoIVA : '';
        $articulo->borrado = 1;

        //dd($articulo);die;

        $txt = '';
        if($articulo->save()){
            $txt = $ok;
        }else{
            $txt = $error;
        }
        
        //echo json_encode($txt);
        return redirect('articulos')->with('errors', json_encode($txt));
    }
    

    public function articuloDelete(){
        $articulo = Articulo::on(Session::get('conexionBBDD'))->find(Input::get('IdArticulo'));
        
        $articulo->borrado = 0;
        
        if($articulo->save()){
            echo json_encode("Articulo " . Input::get('IdArticulo') ." borrado correctamente.");
        }else{
            echo json_encode("Articulo " . Input::get('IdArticulo') ." NO ha sido borrado.");
        }
    }


    
}
