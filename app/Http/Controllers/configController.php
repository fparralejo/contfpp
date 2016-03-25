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

use App\Http\Controllers\adminController;


class configController extends Controller {

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

        $datos = Empresa::on('contfpp')
                          ->where('identificacion', '=', Session::get('empresa'))
                          ->get();
        
        return view('datos.main')->with('datos', json_encode($datos));
    }

    public function login(Request $request) {
        //ahora busco en la tabla usuarios
        $empresa = Empresa::on('contfpp')
                          ->where('Nombre', '=', $request->empresa)
                          ->where('Password', '=', $request->passEmpresa)
                          ->get();

        //sino encuentra empresa salimos con el error
        if (count($empresa) === 0) {
            return redirect('/')->with('login_errors', 'Datos incorrectos.');
        }        
        
        //ahora busco en la tabla usuarios
        $usuario = Usuario::on($empresa[0]->conexionBBDD)
                          ->where('usuario', '=', $request->usuario)
                          ->where('password', '=', $request->passUsuario)
                          ->get();
        
        //var_dump($usuario[0]->usuario);die;

        if (count($usuario) > 0) {
            //extraigo nombre y apellidos del usuario
            $empleado = Empleado::on($empresa[0]->conexionBBDD)
                                ->where('IdEmpleado', '=',$usuario[0]->IdEmpleado)
                                ->get();
            
            //guardo las vbles de sesion para navegar por la app
            Session::put('usuario', $usuario[0]->usuario);
            Session::put('nombre_apellidos', $empleado[0]->nombre . ' ' . $empleado[0]->apellidos);
            Session::put('empresa', $empresa[0]->identificacion);
            Session::put('conexionBBDD', $empresa[0]->conexionBBDD);
            

            return redirect('main');
        } else {
            return redirect('/')->with('login_errors', 'Datos incorrectos2.');
        }
    }

    public function logout() {
        Session::flush();
        return redirect('/');
    }

    
}
