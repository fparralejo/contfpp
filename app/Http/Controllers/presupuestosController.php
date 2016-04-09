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
        

        return view('presupuestos.ver')->with('clientes', json_encode($clientes))->with('datos', json_encode($datos));
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
        
        //var_dump($presupuesto);die;

        return view('presupuestos.ver')->with('presupuesto', json_encode($presupuesto))->with('clientes', json_encode($clientes))->with('datos', json_encode($datos));
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
    public function createEdit(Request $request){
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
