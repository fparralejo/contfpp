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
use App\TipoContador;
use App\Presupuesto;


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
            Session::put('empresa', $empresa[0]->identificacion);//BORRAR
            Session::put('IdEmpresa', $empresa[0]->IdEmpresa);
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

    //tools
    public function formatearNumero($numero,$TipoContador){
        //decido que tipo de contador es
        //genero el nombre de la funcion poniendo "forNum".$TipoContador, que es un numero 
        $txtFuncion = "forNum".$TipoContador;
        //la llamada la hago asi
        return $this->$txtFuncion($numero);
    }

    //Libre, solo debes comprobar que no se repita
    private function forNum1($numero){
        //el numero viene 201600001, las 4 primeras cifras son el año, las quito y quito los 0 que haya delante
        $respuesta = substr($numero,4);
        $respuesta = $this->quitarCerosDelante($respuesta);
        return $respuesta;
    }
    
    //Simple, numeracion seguida
    private function forNum2($numero){
        //el numero viene 201600001, las 4 primeras cifras son el año, las quito y quito los 0 que haya delante
        $respuesta = substr($numero,4);
        $respuesta = $this->quitarCerosDelante($respuesta);
        return $respuesta;
    }
    
    //Compuesto Número/Año
    private function forNum3($numero){
        //el numero viene 201600001, las 4 primeras cifras son el año, lo cojo como ejercicio y quito los 0 que haya delante
        $ejercicio = substr($numero,0,4);
        $num = substr($numero,4);
        $num = $this->quitarCerosDelante($num);
        return $num.'/'.$ejercicio;
    }
    
    //Compuesto Año/Número
    private function forNum4($numero){
        //el numero viene 201600001, las 4 primeras cifras son el año, lo cojo como ejercicio y quito los 0 que haya delante
        $ejercicio = substr($numero,0,4);
        $num = substr($numero,4);
        $num = $this->quitarCerosDelante($num);
        return $ejercicio.'/'.$num;
    }
    
    private function quitarCerosDelante($numero){
        while(substr($numero,0,1) === '0'){
            $numero = substr($numero,1);
        }
        return $numero;
    }
    
    public function numeroNuevo($tipoDoc,$TipoContador){
        //SOLO ESTA IMPLEMENTADO PRESUPUESTOS
        
        //extraigo el listado de los presupuestos
        $listadoNumeros = Presupuesto::on(Session::get('conexionBBDD'))
                        ->where('Borrado', '=', '1')
                        ->select('NumPresupuesto')
                        ->get();
        
        //ahora recorro este array y busco el mas alto
        $numMasAlto = 0;
        for ($i = 0; $i < count($listadoNumeros); $i++) {
            if((int)$listadoNumeros[$i]->NumPresupuesto > (int)$numMasAlto){
                $numMasAlto = $listadoNumeros[$i]->NumPresupuesto;
            }
        }

        $ejercicio = substr($numMasAlto,0,4);
        $num = substr($numMasAlto,4);
        //ahora segun el $TipoContador, ejecuto la funcion para aumentar la numeracion un numero
        $txtFuncion = "nuevoNumero".$TipoContador;
        
        return $this->$txtFuncion($ejercicio,$num);
    }
    
    private function nuevoNumero1($ejercicio,$num){
        //sumo 1 al $num
        $num = (int)$num + 1;
        return $ejercicio.$num;
    }
    
    private function nuevoNumero2($ejercicio,$num){
        //sumo 1 al $num
        $num = (int)$num + 1;
        return $ejercicio.$num;
    }
    
    private function nuevoNumero3($ejercicio,$num){
        //veo si el ejercicio coincide con el año actual
        if($ejercicio === date('Y')){
            //sumo 1 al $num
            $num = (int)$num + 1;
            $resultado = $ejercicio.$num;
        }else{
            //es distinto año, comienzo numeracion de este año
            $resultado = date('Y').'00001';
        }
        
        return $resultado;
    }
    
    private function nuevoNumero4($ejercicio,$num){
        //veo si el ejercicio coincide con el año actual
        if($ejercicio === date('Y')){
            //sumo 1 al $num
            $num = (int)$num + 1;
            $resultado = $ejercicio.$num;
        }else{
            //es distinto año, comienzo numeracion de este año
            $resultado = date('Y').'1';
        }
        
        return $resultado;
    }
}
