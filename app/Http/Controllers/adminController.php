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
use App\Pedido;
use App\Factura;


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

        $empresa = Empresa::on('contfpp')->find((int)Session::get('IdEmpresa'));
        
        return view('main')->with('empresa', $empresa);
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
        
        //por si no existe la BBDD creada
        try{
            
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
                return redirect('/')->with('login_errors', 'Datos incorrectos.');
            }
        
        } catch (PDOException $ex) {//NO CAPTURA NADA PERO BUENO, ES ERROR DE QUE NO EXISTA LA BBDD 8/5/2016
            return redirect('/')->with('login_errors', 'Datos incorrectos.');
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

    //Libre, solo debes comprobar que no se repita **SIN HACER
    private function forNum1($numero){
        $respuesta = $numero;
//        $respuesta = $this->quitarCerosDelante($respuesta);
        return $respuesta;
    }
    
    //Simple, numeracion seguida
    private function forNum2($numero){
        //el numero viene 20161, las 4 primeras cifras son el año, el resto es el numero
        $respuesta = substr($numero,4);
        $respuesta = $this->quitarCerosDelante($respuesta);
        return $respuesta;
    }
    
    //Compuesto Número/Año
    private function forNum3($numero){
        //el numero viene 20161, las 4 primeras cifras son el año, el resto es el numero
        $ejercicio = substr($numero,0,4);
        $num = substr($numero,4);
        $num = $this->quitarCerosDelante($num);
        return $num.'/'.$ejercicio;
    }
    
    //Compuesto Año/Número
    private function forNum4($numero){
        //el numero viene 20161, las 4 primeras cifras son el año, el resto es el numero
        $ejercicio = substr($numero,0,4);
        $num = substr($numero,4);
        $num = $this->quitarCerosDelante($num);
        return $ejercicio.'/'.$num;
    }
    
    public function formatearNumeroOrdenar($numero,$TipoContador){
        //decido que tipo de contador es
        //genero el nombre de la funcion poniendo "forNum".$TipoContador, que es un numero 
        $txtFuncion = "forNum".$TipoContador."Ordenar";
        //la llamada la hago asi
        return $this->$txtFuncion($numero);
    }

    //Libre, solo debes comprobar que no se repita **SIN HACER
    private function forNum1Ordenar($numero){
        $respuesta = $numero;
//        $respuesta = $this->quitarCerosDelante($respuesta);
        return $respuesta;
    }
    
    //Simple, numeracion seguida
    private function forNum2Ordenar($numero){
        //el numero viene 20161, las 4 primeras cifras son el año, pongo el resto de 0 delante hasta que la cifra tenga 10 digitos
        $respuesta = substr($numero,4);
        $respuesta = $this->ponerCerosDelante10digitos($respuesta);
        return $respuesta;
    }
    
    //Compuesto Número/Año
    private function forNum3Ordenar($numero){
        //el numero viene 20161, las 4 primeras cifras son el año, pongo el resto de 0 delante hasta que la cifra tenga 10 digitos
        $ejercicio = substr($numero,0,4);
        $respuesta = substr($numero,4);
        $respuesta = $ejercicio.$this->ponerCerosDelante10digitos($respuesta);
        return $respuesta;
    }
    
    //Compuesto Año/Número
    private function forNum4Ordenar($numero){
        //el numero viene 20161, las 4 primeras cifras son el año, pongo el resto de 0 delante hasta que la cifra tenga 10 digitos
        $ejercicio = substr($numero,0,4);
        $respuesta = substr($numero,4);
        $respuesta = $ejercicio.$this->ponerCerosDelante10digitos($respuesta);
        return $respuesta;
    }
    
    
    private function quitarCerosDelante($numero){
        while(substr($numero,0,1) === '0'){
            $numero = substr($numero,1);
        }
        return $numero;
    }
    
    private function ponerCerosDelante10digitos($numero){
        while(strlen($numero) < 10){
            $numero = '0' . $numero;
        }
        return $numero;
    }
    
    public function numeroNuevo($tipoDoc,$TipoContador){
        $numMasAlto = 0;
        if($tipoDoc === 'Presupuesto'){
            //extraigo el listado de los presupuestos
            $listadoNumeros = Presupuesto::on(Session::get('conexionBBDD'))
                            ->where('Borrado', '=', '1')
                            ->select('NumPresupuesto')
                            ->get();

            //ahora recorro este array y busco el mas alto
            for ($i = 0; $i < count($listadoNumeros); $i++) {
                if((int)$listadoNumeros[$i]->NumPresupuesto > (int)$numMasAlto){
                    $numMasAlto = $listadoNumeros[$i]->NumPresupuesto;
                }
            }
        }else
        if($tipoDoc === 'Pedido'){
            //extraigo el listado de los pedidos
            $listadoNumeros = Pedido::on(Session::get('conexionBBDD'))
                            ->where('Borrado', '=', '1')
                            ->select('NumPedido')
                            ->get();

            for ($i = 0; $i < count($listadoNumeros); $i++) {
                if((int)$listadoNumeros[$i]->NumPedido > (int)$numMasAlto){
                    $numMasAlto = $listadoNumeros[$i]->NumPedido;
                }
            }
        }else
        if($tipoDoc === 'Factura'){
            //extraigo el listado de las facturas
            $listadoNumeros = Factura::on(Session::get('conexionBBDD'))
                            ->where('Borrado', '=', '1')
                            ->select('NumFactura')
                            ->get();

            for ($i = 0; $i < count($listadoNumeros); $i++) {
                if((int)$listadoNumeros[$i]->NumFactura > (int)$numMasAlto){
                    $numMasAlto = $listadoNumeros[$i]->NumFactura;
                }
            }
        }
        //dd($numMasAlto);
        
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
        $resultado = date('Y').$num;
        return $resultado;
    }
    
    private function nuevoNumero3($ejercicio,$num){
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
    
    
    public function numeroNuevoAbono($tipoDoc,$TipoContador){
        $numMasAlto = 0;
        
        $datos = Empresa::on('contfpp')->find((int)Session::get('IdEmpresa'));
        $prefijo = $datos->PrefijoFactRectificativas;
        
        if($tipoDoc === 'Factura'){
            //extraigo el listado de las facturas de abono actuales
            $listadoNumeros = Factura::on(Session::get('conexionBBDD'))
                            ->where('Borrado', '=', '1')
                            ->select('NumFactura')
                            ->get();

            if(count($listadoNumeros) > 0){
                for ($i = 0; $i < count($listadoNumeros); $i++) {
                    //quito el ejercico (4 primeras cifras)
                    $ejercicio = substr($listadoNumeros[$i]->NumFactura,0,4);
                    $resto = substr($listadoNumeros[$i]->NumFactura,4);
                    //veo si tiene el prefijo
                    if(strpos($resto,$prefijo) === false){
                        //no tiene prefijo
                    }else{
                        //si tiene, se lo quito 
                        $numero = str_replace($prefijo, "", $resto);
                        //comparo si es el numero mas alto que $numMasAlto
                        if((int)$numero > (int)$numMasAlto){
                            $numMasAlto = $numero;
                        }
                    }
                }
            }else{
                $ejercicio = date('Y');
            }
        }
        
        //ahora segun el $TipoContador, ejecuto la funcion para aumentar la numeracion un numero
        $txtFuncion = "nuevoNumero".$TipoContador;
        
        $numeroGenerado = $this->$txtFuncion($ejercicio,$numMasAlto);
        
        //ahora añado el prefijo, quito el ejercico, añado el prefijo y lo vuelvo a incluir
        $ejercicio = substr($numeroGenerado,0,4);
        $resto = substr($numeroGenerado,4);
        
        return $ejercicio.$prefijo.$resto;
    }
    
    
    public function desFormatearNumero($numero,$TipoContador){
        //decido que tipo de contador es
        //genero el nombre de la funcion poniendo "forNum".$TipoContador, que es un numero 
        $txtFuncion = "desForNum".$TipoContador;
        //la llamada la hago asi
        return $this->$txtFuncion($numero);
    }

    //Libre, solo debes comprobar que no se repita **SIN HACER
    private function desForNum1($numero){
        $respuesta = $numero;
//        $respuesta = $this->quitarCerosDelante($respuesta);
        return $respuesta;
    }
    
    //Simple, numeracion seguida
    private function desForNum2($numero){
        //el numero viene 1, las 4 primeras cifras son el año, las quito
        $respuesta = date('Y') . $numero;
//        $respuesta = $this->quitarCerosDelante($respuesta);
        return $respuesta;
    }
    
    //Compuesto Número/Año
    private function desForNum3($numero){
        //el numero viene 1/2016,divido el numero y lo uno primero el año y despues el numero
        $divido = explode('/',$numero);
        $num = $divido[1] . $divido[0];
        return $num;
    }
    
    //Compuesto Año/Número
    private function desForNum4($numero){
        //el numero viene 2016/1 ,divido el numero y lo uno primero el año y despues el numero
        $divido = explode('/',$numero);
        $num = $divido[0] . $divido[1];
        return $num;
    }
    
    //formatear valores numericos con puntos de miles y comas para decimales
    public function formateaNumeroContabilidad($valor) {
        if(!is_numeric($valor)){
            return '';
        }else{
            return number_format($valor,2,",",".");
        }
    }
    
    public function editarCampoNumero($TipoContador) {
        //extraigo eld dato
        $editar = TipoContador::on('contfpp')        
                               ->where('idContador', '=', $TipoContador)
                               ->select('editar')
                               ->get();
        
        return $editar;
    }
    
}
