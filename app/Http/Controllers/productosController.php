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
use App\Producto;

use App\Http\Controllers\adminController;


class productosController extends Controller {

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
        
        $productos = Producto::on(Session::get('conexionBBDD'))
                          ->where('borrado', '=', '1')
                          ->get();
        

        return view('productos.main')->with('productos', json_encode($productos));
    }

    public function productoShow()
    {
        $producto = Producto::on(Session::get('conexionBBDD'))->find(Input::get('IdProducto'));

        //devuelvo la respuesta al send
        echo json_encode($producto);
    }
    
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
