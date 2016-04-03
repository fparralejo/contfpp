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
                          ->where('tipo', '=', 'C')
                          ->get();
        

        return view('clientes.main')->with('clientes', json_encode($clientes))->with('tipo', json_encode('C'));
    }

    public function mainProveedores(){
        //control de sesion
        $admin = new adminController();
        if (!$admin->getControl()) {
            return redirect('/')->with('login_errors', 'La sesión a expirado. Vuelva a logearse.');
        }
        
        $clientes = Cliente::on(Session::get('conexionBBDD'))
                          ->where('borrado', '=', '1')
                          ->where('tipo', '=', 'P')
                          ->get();
        

        return view('clientes.main')->with('clientes', json_encode($clientes))->with('tipo', json_encode('P'));
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
        //dd($request->cifnif);die;
        
        if(isset($request->idCliente) && $request->idCliente !== ""){
            //sino se edita este idCliente
            $cliente = Cliente::on(Session::get('conexionBBDD'))->find($request->idCliente);
            
            if($request->tipoOpc === 'C'){
                $ok = 'Se ha editado correctamente el cliente.';
                $error = 'ERROR al edtar el cliente.';
            }else{
                $ok = 'Se ha editado correctamente el proveedor.';
                $error = 'ERROR al edtar el proveedor.';
            }
        }
        else{
        //si es nuevo este valor viene vacio
            $cliente = new Cliente();
            $cliente->setConnection(Session::get('conexionBBDD'));
            $cliente->fechaAlta = date('Y-m-d H:i:s');
            
            //indicamos el nuevo idCliente
            $idClienteNuevo = Cliente::on(Session::get('conexionBBDD'))
                              ->max('idCliente') + 1;
            $cliente->idCliente = $idClienteNuevo;
        
            if($request->tipoOpc === 'C'){
                $ok = 'Se ha dado de alta correctamente el cliente.';
                $error = 'ERROR al dar de alta el cliente.';
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
    

    public function clienteDelete(){
        $cliente = Cliente::on(Session::get('conexionBBDD'))->find(Input::get('idCliente'));
        
        $cliente->borrado = 0;
        
        if($cliente->tipo === 'C'){
            $tipo = "Cliente";
        }else{
            $tipo = "Proveedor";
        }

        if($cliente->save()){
            echo json_encode($tipo . " " . Input::get('idCliente') ." borrado correctamente.");
        }else{
            echo json_encode($tipo . " " . Input::get('idCliente') ." NO ha sido borrado.");
        }
    }


    
}
