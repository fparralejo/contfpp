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

use App\Http\Controllers\adminController;


class clientesController extends Controller {

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
        
        $clientes = Cliente::on(Session::get('conexionBBDD'))
                          ->where('borrado', '=', '1')
                          ->get();
        

        return view('clientes.main')->with('clientes', $clientes);
    }

    public function clienteShow()
    {
        $cliente = Cliente::on(Session::get('conexionBBDD'))->find(Input::get('idCliente'));

        //cambio el formato de la fecha
        $cliente->fechaAlta = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$cliente->fechaAlta)->format('d/m/Y');

        //devuelvo la respuesta al send
        echo json_encode($cliente);
    }
    
    public function createEdit(Request $request){
        //echo "he llegado";die;

        //si es nuevo este valor viene vacio
        if($request->idCliente === ""){
            $cliente = new Cliente();
            $cliente->setConnection(Session::get('conexionBBDD'));
            $cliente->fechaAlta = date('Y-m-d H:i:s');
            
            
            //SELECT lngIdPregunta FROM tbconsulta_pregunta ORDER BY lngIdPregunta DESC LIMIT 0,1
            
            //indicamos el nuevo idCliente
            $idClienteNuevo = Cliente::on(Session::get('conexionBBDD'))
                              ->max('idCliente') + 1;
            $cliente->idCliente = $idClienteNuevo;
        
            $ok = 'Se ha dado de alta correctamente el cliente.';
            $error = 'ERROR al dar de alta el cliente.';
        }
        //sino se edita este idCliente
        else{
            $cliente = Cliente::on(Session::get('conexionBBDD'))->find($request->idCliente);
            
            $ok = 'Se ha editado correctamente el cliente.';
            $error = 'ERROR al edtar el cliente.';
        }

        $cliente->nombre = $request->nombre;
        $cliente->apellidos = $request->apellidos;
        $cliente->telefono = $request->telefono;
        $cliente->email = $request->email;
        $cliente->notas = $request->notas;
        $cliente->nombreEmpresa = $request->nombreEmpresa;
        $cliente->CIF = $request->cifnif;
        $cliente->direccion = $request->direccion;
        $cliente->municipio = $request->municipio;
        $cliente->CP = $request->CP;
        $cliente->provincia = $request->provincia;
        $cliente->forma_pago_habitual = $request->forma_pago_habitual;
        $cliente->borrado = 1;

        //var_dump($cliente);die;

        $txt = '';
        if($cliente->save()){
            $txt = $ok;
        }else{
            $txt = $error;
        }
        return redirect('clientes')->with('errors', $txt);
    }
    

    public function clienteDelete(){
        $cliente = Cliente::on(Session::get('conexionBBDD'))->find(Input::get('idCliente'));
        
        $cliente->borrado = 0;

        if($cliente->save()){
            echo "Cliente ". Input::get('idCliente') ." borrado correctamente.";
        }else{
            echo "Cliente ". Input::get('idCliente') ." NO ha sido borrado.";
        }
    }

    
    
    
    //NO
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
