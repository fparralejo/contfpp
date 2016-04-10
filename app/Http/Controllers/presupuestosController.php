<?php 
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use Input;
use Illuminate\Http\Request;


use App\Empresa;
use App\Usuario;
use App\Empleado;
use App\Cliente;
use App\Presupuesto;
use App\PresupuestoDetalle;

use App\Http\Controllers\adminController;


class presupuestosController extends Controller {

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
        
        $numeroNuevo = $admin->numeroNuevo('Presupuesto',$datos->TipoContador);
        
        $numero = $admin->formatearNumero($numeroNuevo,$datos->TipoContador);
        //var_dump($numero);die;

        return view('presupuestos.ver')->with('presupuesto', json_encode(''))->with('clientes', json_encode($clientes))
                                       ->with('datos', json_encode($datos))->with('presupuestoDetalle', json_encode(''))
                                       ->with('numero', json_encode($numero));
    }
        
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
                
        //var_dump($presupuestoDetalle[0]->Cantidad);die;

        return view('presupuestos.ver')->with('presupuesto', json_encode($presupuesto))->with('clientes', json_encode($clientes))
                                       ->with('datos', json_encode($datos))->with('presupuestoDetalle', json_encode($presupuestoDetalle))
                                       ->with('numero', json_encode($numero));
    }
        
    public function listar(){
        //control de sesion
        $admin = new adminController();
        if (!$admin->getControl()) {
            return redirect('/')->with('login_errors', 'La sesión a expirado. Vuelva a logearse.');
        }
        
        $presupuestos = Presupuesto::on(Session::get('conexionBBDD'))
                        ->where('Borrado', '=', '1')
                        ->get();
        
        $clientes = Cliente::on(Session::get('conexionBBDD'))
                          ->where('borrado', '=', '1')
                          ->where('tipo', '=', 'C')
                          ->get();
        

        return view('presupuestos.listado')->with('presupuestos', json_encode($presupuestos))->with('clientes', json_encode($clientes));
    }
       
    
    public function createEdit(Request $request){
        dd($request);die;
        
        //hago las operaciones en transaccion, trabajo con las tablas presupuestos y presupuestosdetalle
        //1º inserto o actualizo los datos de la tabla presupuesots por el IdPresupuesto
        //2º si edito, borro los datos de la tabla presupuestosdetalle por el IdPresupuesto
        //3º inserto los nuevos detalles con el IdPresupuesto
        
        DB::beginTransaction(); //Comienza transaccion
        
        try{
            //1º
            if(isset($request->IdPresupuesto) && $request->IdPresupuesto !== ""){
                //sino se edita este IdPresupuesto
                $presupuesto = Presupuesto::on(Session::get('conexionBBDD'))->find($request->IdPresupuesto);
                
                $presupuesto->NumPresupuesto = (isset($request->NumPresupuesto)) ? $request->NumPresupuesto : '';
                $presupuesto->FechaPresupuesto = (isset($request->fechaPresup)) ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$request->fechaPresup)->format('Y-m-d H:i:s') : '';
                $presupuesto->FechaVtoPresupuesto = (isset($request->FechaVtoPresupuesto)) ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$request->FechaVtoPresupuesto)->format('Y-m-d H:i:s') : '';
                $presupuesto->FormaPago = (isset($request->FormaPago)) ? $request->FormaPago : '';
                $presupuesto->Estado = 'Emitida';
                $presupuesto->Retencion = (isset($request->Retencion)) ? $request->Retencion : '';
                $presupuesto->Proforma = (isset($request->Proforma)) ? $request->Proforma : '';
                $presupuesto->Borrado = '1';
                $presupuesto->BaseImponible = (isset($request->totalImporte)) ? $request->totalImporte : '';
                $presupuesto->Cuota = (isset($request->totalImporte)) ? $request->totalCuota : '';
                $presupuesto->total = (isset($request->totalImporte)) ? $request->total : '';
                //guardo los cambios
                $presupuesto->save();
                
                //2º
                $presupuestoDetalle = PresupuestoDetalle::on(Session::get('conexionBBDD'))
                                     ->where('IdPresupuesto', '=', $request->IdPresupuesto)
                                     ->where('Borrado', '=', '1')
                                     ->get();
                
                

                $ok = 'Se ha editado correctamente el presupuesto.';
                $error = 'ERROR al edtar el presupuesto.';
            }
            else{
                //si es nuevo este valor viene vacio
                $presupuesto = new Presupuesto();
                $presupuesto->setConnection(Session::get('conexionBBDD'));

                //indicamos el nuevo idCliente
                $idClienteNuevo = Cliente::on(Session::get('conexionBBDD'))
                                  ->max('idCliente') + 1;
                $cliente->idCliente = $idClienteNuevo;

                if($request->tipoOpc === 'C'){
                    $ok = 'Se ha dado de alta correctamente el proveedor.';
                    $error = 'ERROR al dar de alta el proveedor.';
                }else{
                    $ok = 'Se ha dado de alta correctamente el proveedor.';
                    $error = 'ERROR al dar de alta el proveedor.';
                }
            }

            $cliente->tipo = (isset($request->tipoOpc)) ? $request->tipoOpc : '';
            $cliente->nombre = (isset($request->nombre)) ? $request->nombre : '';
            $cliente->apellidos = (isset($request->apellidos)) ? $request->apellidos : '';
            $cliente->telefono = (isset($request->telefono)) ? $request->telefono : '';
            $cliente->email = (isset($request->email)) ? $request->email : '';
            $cliente->notas = (isset($request->notas)) ? $request->notas : '';
            $cliente->nombreEmpresa = (isset($request->nombreEmpresa)) ? $request->nombreEmpresa : '';
            $cliente->CIF = (isset($request->cifnif)) ? $request->cifnif : '';
            $cliente->direccion = (isset($request->direccion)) ? $request->direccion : '';
            $cliente->municipio = (isset($request->municipio)) ? $request->municipio : '';
            $cliente->CP = (isset($request->CP)) ? $request->CP : '';
            $cliente->provincia = (isset($request->provincia)) ? $request->provincia : '';
            $cliente->forma_pago_habitual = (isset($request->forma_pago_habitual)) ? $request->forma_pago_habitual : '' ;
            $cliente->borrado = 1;

            //var_dump($cliente);die;

            $txt = '';
            if($cliente->save()){
                $txt = $ok;
            }else{
                $txt = $error;
            }

            //echo json_encode($txt);
            if($cliente->tipo === 'C'){
                return redirect('clientes')->with('errors', json_encode($txt))->with('tipo', json_encode('C'));
            }else{
                return redirect('proveedores')->with('errors', json_encode($txt))->with('tipo', json_encode('P'));
            }
        
        }
        catch(\Exception $e)
        {
          //failed logic here
           DB::rollback();
           throw $e;
           echo "falla";die;
        }

        DB::commit();
    }
    

    
    //NO
    public function main(){
        //control de sesion
        $admin = new adminController();
        if (!$admin->getControl()) {
            return redirect('/')->with('login_errors', 'La sesión a expirado. Vuelva a logearse.');
        }
        
        $productos = Producto::on(Session::get('conexionBBDD'))
                          ->where('borrado', '=', '1')
                          ->get();
        

        return view('productos.main')->with('productos', json_encode($productos));
    }

    //NO
    public function productoShow()
    {
        $producto = Producto::on(Session::get('conexionBBDD'))->find(Input::get('IdProducto'));

        //devuelvo la respuesta al send
        echo json_encode($producto);
    }
    
    //NO
    public function createEditNO(Request $request){
        //dd($request->cifnif);die;
        
        if(isset($request->IdProducto) && $request->IdProducto !== ""){
            //sino se edita este IdProducto
            $producto = Producto::on(Session::get('conexionBBDD'))->find($request->IdProducto);
            
            $ok = 'Se ha editado correctamente el producto.';
            $error = 'ERROR al edtar el producto.';
        }
        else{
            //si es nuevo este valor viene vacio
            $producto = new Producto();
            $producto->setConnection(Session::get('conexionBBDD'));
            $producto->fecha = date('Y-m-d H:i:s');
            
            //indicamos el nuevo IdProducto
            $idProductoNuevo = Producto::on(Session::get('conexionBBDD'))
                              ->max('IdProducto') + 1;
            $producto->IdProducto = $idProductoNuevo;
        
            $ok = 'Se ha dado de alta correctamente el producto.';
            $error = 'ERROR al dar de alta el producto.';
        }
            
        $producto->Referencia = (isset($request->Referencia)) ? $request->Referencia : '';
        $producto->Descripcion = (isset($request->Descripcion)) ? $request->Descripcion : '';
        $producto->Precio = (isset($request->Precio)) ? $request->Precio : '';
        $producto->tipoIVA = (isset($request->tipoIVA)) ? $request->tipoIVA : '';
        $producto->borrado = 1;

        //var_dump($cliente);die;

        $txt = '';
        if($producto->save()){
            $txt = $ok;
        }else{
            $txt = $error;
        }
        
        //echo json_encode($txt);
        return redirect('productos')->with('errors', json_encode($txt));
    }
    

    //NO
    public function productoDelete(){
        $producto = Producto::on(Session::get('conexionBBDD'))->find(Input::get('IdProducto'));
        
        $producto->borrado = 0;
        
        if($producto->save()){
            echo json_encode("Producto " . Input::get('IdProducto') ." borrado correctamente.");
        }else{
            echo json_encode("Producto " . Input::get('IdProducto') ." NO ha sido borrado.");
        }
    }


    
}
