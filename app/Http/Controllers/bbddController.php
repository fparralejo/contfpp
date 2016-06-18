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
use App\Articulo;

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
        
        return view('bbdd.main')->with('ficheros', json_encode($ficheros));
    }
        
    
    public function backup(Request $request){
        //se procede a hacer una copia de seguridad de la BBDD
        //las tablas son:
        
        
        
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
