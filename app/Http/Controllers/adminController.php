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


class adminController extends Controller {

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
        if (!$this->getControl()) {
            return redirect('/')->with('login_errors', 'La sesión a expirado. Vuelva a logearse.');
        }

        return view('main');
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

    public function getControl() {
        //controlamos si estaamos en sesion por las distintas paginas de la app
        //controlamos las vbles sesion 'nombre', 'id'
        if (Session::has('usuario') && Session::has('conexionBBDD')) {
            //chequeamos que estos valores del usuario
            $existeUsuario = Usuario::on(Session::get('conexionBBDD'))->where('usuario', '=', Session::get('usuario'))->get();
            
            if (count($existeUsuario) > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    
    //SIN MIRAR
    public function opcion_perfiles($opcion,$idPerfilUsuario) {
        $opcion_perfiles = OpcionPerfiles::all();
        
        $encontrado = 'NO';
        foreach ($opcion_perfiles as $opcion_perfil){
            if($opcion_perfil->opcion === $opcion){
                $perfiles = explode(',',$opcion_perfil->perfiles);
                if(is_array($perfiles)){
                    if(in_array($idPerfilUsuario,$perfiles)){
                        $encontrado = 'SI';
                    }else{
                        $encontrado = 'NO';
                    }
                }else{
                    $encontrado = 'NO';
                }
                break;
            }
        }
        
        if($encontrado === 'NO'){
            return false;
        }else{
            return true;
        }
    }
    
}
