<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Http\Controllers\adminController;
use Illuminate\Support\Facades\Session;
//use Illuminate\Http\Request;


/**
 * Simulo la clase Session
 */
//class Session{
//
//    private $datos = array(
//        "usuario"=>"paco",
//        "IdEmpresa"=>2,
//        "conexionBBDD"=>"contfpp_empresa2",
//    );
//    
//    public function get($opcion) {
//        return $datos[$opcion];
//    }
//
//    public function has($opcion){
//        return true;
//    }
//    
//}



/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-05-27 at 06:59:41.
 */
class adminControllerTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var adminController
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new adminController;
        //$this->session(['usuario' => 'paco']);
        //Session:: set('usuario', 'paco');
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }


//    /**
//     * @covers App\Http\Controllers\adminController::main
//     * @todo   Implement testMain().
//     */
//    public function testMain() {
//        // Remove the following lines when you implement this test.
//        $this->markTestIncomplete(
//                'This test has not been implemented yet.'
//        );
//    }
//
//    /**
//     * @covers App\Http\Controllers\adminController::login
//     * @todo   Implement testLogin().
//     */
//    public function testLogin() {
//        // Remove the following lines when you implement this test.
//        $this->markTestIncomplete(
//                'This test has not been implemented yet.'
//        );
//    }
//
//    /**
//     * @covers App\Http\Controllers\adminController::logout
//     * @todo   Implement testLogout().
//     */
//    public function testLogout() {
//        // Remove the following lines when you implement this test.
//        $this->markTestIncomplete(
//                'This test has not been implemented yet.'
//        );
//    }
//
//    /**
//     * @covers App\Http\Controllers\adminController::getControl
//     * @todo   Implement testGetControl().
//     */
//    public function testGetControl() {
//        // Remove the following lines when you implement this test.
//        $this->markTestIncomplete(
//                'This test has not been implemented yet.'
//        );
//    }

    /**
     * @covers App\Http\Controllers\adminController::formatearNumero
     * @todo   Implement testFormatearNumero_2_TipoContador1().
     */
    public function testFormatearNumero_2_TipoContador1() {
        $numero = $this->object->formatearNumero('2', 1);
        $this->assertEquals($numero, '2');
    }

    /**
     * @covers App\Http\Controllers\adminController::formatearNumero
     * @todo   Implement testFormatearNumero_A3_TipoContador1().
     */
    public function testFormatearNumero_A3_TipoContador1() {
        $numero = $this->object->formatearNumero('A3', 1);
        $this->assertEquals($numero, 'A3');
    }

    
    
    /**
     * @covers App\Http\Controllers\adminController::formatearNumero
     * @todo   Implement testFormatearNumero_20162_TipoContador2().
     */
    public function testFormatearNumero_20162_TipoContador2() {
        $numero = $this->object->formatearNumero('20162', 2);
        $this->assertEquals($numero, '2');
    }

    /**
     * @covers App\Http\Controllers\adminController::formatearNumero
     * @todo   Implement testFormatearNumero_2016A22_TipoContador2().
     */
    public function testFormatearNumero_2016A22_TipoContador2() {
        $numero = $this->object->formatearNumero('2016A22', 2);
        $this->assertEquals($numero, 'A22');
    }

    /**
     * @covers App\Http\Controllers\adminController::formatearNumero
     * @todo   Implement testFormatearNumero_2016F13_TipoContador2().
     */
    public function testFormatearNumero_2016F13_TipoContador2() {
        $numero = $this->object->formatearNumero('2016F13', 2);
        $this->assertEquals($numero, 'F13');
    }

    
    /**
     * @covers App\Http\Controllers\adminController::formatearNumero
     * @todo   Implement testFormatearNumero_20161_TipoContador3().
     */
    public function testFormatearNumero_20161_TipoContador3() {
        $numero = $this->object->formatearNumero('20161', 3);
        $this->assertEquals($numero, '1/2016');
    }

    /**
     * @covers App\Http\Controllers\adminController::formatearNumero
     * @todo   Implement testFormatearNumero_2016A104_TipoContador3().
     */
    public function testFormatearNumero_2016A104_TipoContador3() {
        $numero = $this->object->formatearNumero('2016A104', 3);
        $this->assertEquals($numero, 'A104/2016');
    }

    /**
     * @covers App\Http\Controllers\adminController::formatearNumero
     * @todo   Implement testFormatearNumero_2016A1_TipoContador3().
     */
    public function testFormatearNumero_201677_TipoContador4() {
        $numero = $this->object->formatearNumero('201677', 4);
        $this->assertEquals($numero, '2016/77');
    }

    /**
     * @covers App\Http\Controllers\adminController::formatearNumero
     * @todo   Implement testFormatearNumero_2016A1_TipoContador3().
     */
    public function testFormatearNumero_2016D19_TipoContador4() {
        $numero = $this->object->formatearNumero('2016D19', 4);
        $this->assertEquals($numero, '2016/D19');
    }

    
    
    /**
     * @covers App\Http\Controllers\adminController::formatearNumeroOrdenar
     * @todo   Implement testFormatearNumeroOrdenar_13_TipoContador1().
     */
    public function testFormatearNumeroOrdenar_13_TipoContador1() {
        $numero = $this->object->formatearNumeroOrdenar('13', 1);
        $texto = "<!-- " . $numero . " -->";
        $this->assertEquals($texto, '<!-- 13 -->');
    }

    /**
     * @covers App\Http\Controllers\adminController::formatearNumeroOrdenar
     * @todo   Implement testFormatearNumeroOrdenar_A13_TipoContador1().
     */
    public function testFormatearNumeroOrdenar_A13_TipoContador1() {
        $numero = $this->object->formatearNumeroOrdenar('A13', 1);
        $texto = "<!-- " . $numero . " -->";
        $this->assertEquals($texto, '<!-- A13 -->');
    }

    /**
     * @covers App\Http\Controllers\adminController::formatearNumeroOrdenar
     * @todo   Implement testFormatearNumeroOrdenar_201621_TipoContador2().
     */
    public function testFormatearNumeroOrdenar_201621_TipoContador2() {
        $numero = $this->object->formatearNumeroOrdenar('201621', 2);
        $texto = "<!-- " . $numero . " -->";
        $this->assertEquals($texto, '<!-- 0000000021 -->');
    }

    /**
     * @covers App\Http\Controllers\adminController::formatearNumeroOrdenar
     * @todo   Implement testFormatearNumeroOrdenar_2016F212_TipoContador2().
     */
    public function testFormatearNumeroOrdenar_2016F212_TipoContador2() {
        $numero = $this->object->formatearNumeroOrdenar('2016F212', 2);
        $texto = "<!-- " . $numero . " -->";
        $this->assertEquals($texto, '<!-- 000000F212 -->');
    }
    
    
    /**
     * @covers App\Http\Controllers\adminController::formatearNumeroOrdenar
     * @todo   Implement testFormatearNumeroOrdenar_2016443_TipoContador3().
     */
    public function testFormatearNumeroOrdenar_2016443_TipoContador3() {
        $numero = $this->object->formatearNumeroOrdenar('2016443', 3);
        $texto = "<!-- " . $numero . " -->";
        $this->assertEquals($texto, '<!-- 20160000000443 -->');
    }

    /**
     * @covers App\Http\Controllers\adminController::formatearNumeroOrdenar
     * @todo   Implement testFormatearNumeroOrdenar_2015A96_TipoContador3().
     */
    public function testFormatearNumeroOrdenar_2015A96_TipoContador3() {
        $numero = $this->object->formatearNumeroOrdenar('2015A96', 3);
        $texto = "<!-- " . $numero . " -->";
        $this->assertEquals($texto, '<!-- 20150000000A96 -->');
    }
    
    
    /**
     * @covers App\Http\Controllers\adminController::formatearNumeroOrdenar
     * @todo   Implement testFormatearNumeroOrdenar_33_TipoContador3().
     */
    public function testFormatearNumeroOrdenar_33_TipoContador3() {
        $numero = $this->object->formatearNumeroOrdenar('33', 3);
        $texto = "<!-- " . $numero . " -->";
        $this->assertEquals($texto, '<!-- 330000000000 -->');
    }
    
    /**
     * @covers App\Http\Controllers\adminController::formatearNumeroOrdenar
     * @todo   Implement testFormatearNumeroOrdenar_AGHFRTY_TipoContador3().
     */
    public function testFormatearNumeroOrdenar_AGHFRTY_TipoContador3() {
        $numero = $this->object->formatearNumeroOrdenar('AGHFRTY', 3);
        $texto = "<!-- " . $numero . " -->";
        $this->assertEquals($texto, '<!-- AGHF0000000RTY -->');
    }
    
    
    
    /**
     * @covers App\Http\Controllers\adminController::numeroNuevo
     * @todo   Implement testNumeroNuevo().
     */
    public function testNumeroNuevo() {
        //rellena los datos del request del logeo
//        $Sesion = new Session();
////        //Session::put('nombre_apellidos', $empleado[0]->nombre . ' ' . $empleado[0]->apellidos);
////        //Session::put('empresa', $empresa[0]->identificacion);//BORRAR
//        \Session::put('IdEmpresa', 2);
//        \Session::put('conexionBBDD', 'contfpp_empresa2');
        
        //$request = new Request();
        
        //session()->put('conexionBBDD', 'contfpp_empresa2');
        
        $numero = $this->object->numeroNuevo('Presupuesto', 1);
        echo $numero;
        //$this->assertEquals($texto, '<!-- AGHF0000000RTY -->');
    }

    
    
    
//    /**
//     * @covers App\Http\Controllers\adminController::numeroNuevoAbono
//     * @todo   Implement testNumeroNuevoAbono().
//     */
//    public function testNumeroNuevoAbono() {
//        // Remove the following lines when you implement this test.
//        $this->markTestIncomplete(
//                'This test has not been implemented yet.'
//        );
//    }
//
//    /**
//     * @covers App\Http\Controllers\adminController::desFormatearNumero
//     * @todo   Implement testDesFormatearNumero().
//     */
//    public function testDesFormatearNumero() {
//        // Remove the following lines when you implement this test.
//        $this->markTestIncomplete(
//                'This test has not been implemented yet.'
//        );
//    }
//
//    /**
//     * @covers App\Http\Controllers\adminController::formateaNumeroContabilidad
//     * @todo   Implement testFormateaNumeroContabilidad().
//     */
//    public function testFormateaNumeroContabilidad() {
//        // Remove the following lines when you implement this test.
//        $this->markTestIncomplete(
//                'This test has not been implemented yet.'
//        );
//    }
//
//    /**
//     * @covers App\Http\Controllers\adminController::editarCampoNumero
//     * @todo   Implement testEditarCampoNumero().
//     */
//    public function testEditarCampoNumero() {
//        // Remove the following lines when you implement this test.
//        $this->markTestIncomplete(
//                'This test has not been implemented yet.'
//        );
//    }

}
