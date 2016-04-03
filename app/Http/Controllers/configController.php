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

        $datos = Empresa::on('contfpp')->find((int)Session::get('IdEmpresa'));
        
        $TipoContador = TipoContador::on('contfpp')->get();
        
        //dd($datos);
        
        return view('datos.main')->with('datos', json_encode($datos))->with('TipoContador', json_encode($TipoContador));
    }
    
    
    public function buscar_fileLogo(){
        
        //cojemos el parametro del fichero
        $file = Input::get('file');
        
        //extraigo la extension
        $fichero = explode ("\\",$file);
        $ext = explode('.',$fichero[count($fichero)-1]);
        $ext = $ext[1];

        $response['estado'] = 'OK';
        $response['msj'] = '';
        
        //si no es JPG y PNG devuelvo el error
        $JPG_text = 'OK';
        $PNG_text = 'OK';
        if(strtoupper($ext)<>'PNG'){
            $PNG_text = "NO";
        }
        if($PNG_text === 'NO'){
            $response['estado'] = 'ERROR';
            $response['msj'] = "<b class='fileError'>&nbsp;&nbsp;&nbsp;NO es imagen PNG</b>";
        }

        //creamos la URL donde se guarda
        $root = getenv('DOCUMENT_ROOT');
        $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $uri = explode('/',$uri);
        $url = $root.'/'.$uri[1].'/public/images';

        //reviso si existe este fichero en la carpeta images
        $directorio = opendir($url);
        while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
        {
            if (!is_dir($archivo))//verificamos si es o no un directorio
            {
                if(strtoupper($archivo) === strtoupper($fichero[count($fichero)-1])){
                    $response['estado'] = 'ERROR';
                    $response['msj'] = "<b class='fileError'>&nbsp;&nbsp;&nbsp;Este fichero EXISTE.</b>";
                }
            }
        }


        //devuelvo la respuesta 
        echo json_encode($response);
    }
    
    
    public function editDatos(Request $request){
        //control de sesion
        $admin = new adminController();
        if (!$admin->getControl()) {
            return redirect('/')->with('login_errors', 'La sesión a expirado. Vuelva a logearse.');
        }
        
        //subimos la imgan del logo
        //obtenemos el campo file definido en el formulario
        $file = $request->file('doc');
        
        if($file !== null){
            //obtenemos el nombre del archivo
            $nombre = $file->getClientOriginalName();

            //indicamos que queremos guardar un nuevo archivo en el disco local
            \Storage::disk('local')->put($nombre,  \File::get($file));
        }
        
        
        
        //dd($request);die;

        $datos = Empresa::on('contfpp')->find((int)Session::get('IdEmpresa'));

        $ok = 'Se ha editado correctamente los datos nuestros.';
        $error = 'ERROR al editar los datos nuestros.';

        
        //actualizo los datos
        $datos->identificacion = (isset($request->identificacion)) ? $request->identificacion : '';
        $datos->CIF = (isset($request->CIF)) ? $request->CIF : '';
        $datos->direccion = (isset($request->direccion)) ? $request->direccion : '';
        $datos->municipio = (isset($request->municipio)) ? $request->municipio : '';
        $datos->provincia = (isset($request->provincia)) ? $request->provincia : '';
        $datos->CP = (isset($request->CP)) ? $request->CP : '';
        $datos->telefono = (isset($request->telefono)) ? $request->telefono : '';
        $datos->email1 = (isset($request->email1)) ? $request->email1 : '';
        $datos->email2 = (isset($request->email2)) ? $request->email2 : '';
        $datos->TipoContador = (isset($request->TipoContador)) ? $request->TipoContador : '';
        $datos->Logo = (isset($nombre)) ? $nombre : '';
        $datos->TextoPie = (isset($request->TextoPie)) ? $request->TextoPie : '';
        $datos->productos = (isset($request->productos)) ? $request->productos : '';
        
        $txt = '';
        if($datos->save()){
            $txt = $ok;
        }else{
            $txt = $error;
        }
        
        
        $TipoContador = TipoContador::on('contfpp')->get();
        
        //dd($datos[0]->identificacion);die;
        
        return view('datos.main')->with('datos', json_encode($datos))->with('TipoContador', json_encode($TipoContador))
                                 ->with('errors', json_encode($txt));
    }
    
    
    
    
    

//    public function login(Request $request) {
//        echo "se usa login";die;
//        //ahora busco en la tabla usuarios
//        $empresa = Empresa::on('contfpp')
//                          ->where('Nombre', '=', $request->empresa)
//                          ->where('Password', '=', $request->passEmpresa)
//                          ->get();
//
//        //sino encuentra empresa salimos con el error
//        if (count($empresa) === 0) {
//            return redirect('/')->with('login_errors', 'Datos incorrectos.');
//        }        
//        
//        //ahora busco en la tabla usuarios
//        $usuario = Usuario::on($empresa[0]->conexionBBDD)
//                          ->where('usuario', '=', $request->usuario)
//                          ->where('password', '=', $request->passUsuario)
//                          ->get();
//        
//        //var_dump($usuario[0]->usuario);die;
//
//        if (count($usuario) > 0) {
//            //extraigo nombre y apellidos del usuario
//            $empleado = Empleado::on($empresa[0]->conexionBBDD)
//                                ->where('IdEmpleado', '=',$usuario[0]->IdEmpleado)
//                                ->get();
//            
//            //guardo las vbles de sesion para navegar por la app
//            Session::put('usuario', $usuario[0]->usuario);
//            Session::put('nombre_apellidos', $empleado[0]->nombre . ' ' . $empleado[0]->apellidos);
//            Session::put('IdEmpresa', $empresa[0]->IdEmpresa);
//            Session::put('conexionBBDD', $empresa[0]->conexionBBDD);
//            
//            //dd($empresa[0]->IdEmpresa);die;
//            
//            return redirect('main');
//        } else {
//            return redirect('/')->with('login_errors', 'Datos incorrectos2.');
//        }
//    }

    
    
    
    
//    public function logout() {
//        Session::flush();
//        return redirect('/');
//    }

    
}
