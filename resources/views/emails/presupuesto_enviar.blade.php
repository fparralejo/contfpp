<?php
require '../resources/views/emails/phpmailer/PHPMailerAutoload.php';


$to = "fparralejo1970@yahoo.es";
//$Cc = $_POST['emailCC'];
$from = "fparralejo@hotmail.com";
$subject = 'Anonadado ';

//$ejercicio=substr($datosPresupuesto['NumFacturaBBDD'],0,4);
//$numero=substr($datosPresupuesto['NumFacturaBBDD'],4,4);
////$file="../facturasEnviadas/Factura_".$_SESSION['idEmp'].'-'.$ejercicio.'-'.$numero.".pdf";
//$file="../facturasEnviadas/Factura_".$_SESSION['idEmp'].'-'.$datosPresupuesto['NumFacturaBBDD'].".pdf";

$mail = new PHPMailer();
//Correo desde donde se envía (from)
$mail->setFrom($from, '');
//Correo de envío (to)
$mail->addAddress($to, '');
$mail->addBCC($from);
        
//if($Cc<>''){
//    $mail->addAddress($Cc, '');
//}
$mail->CharSet = "UTF-8";
$mail->Subject = $subject;

$html='<!DOCTYPE html>
        <html>
            <head>
                <title>Factura</title>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width">
            </head>
            <body>
                <div>Estimado Cliente: <br/>
                        Adjuntamos nuestra factura indicada en el encabezamiento, esperando sea de su conformidad.
                        Para cualquier aclaración, puede contactar con nosotros, por los medios habituales.<br/>
                        Saludos
                </div><br/><br/>
                <i>Prueba</i><br/><br/>
                <b>BBBBBB</b><br/>    
            </body>
        </html>';

//Lee un HTML message body desde un fichero externo,
//convierte HTML un plain-text básico 
$mail->msgHTML($html);
//Reemplaza al texto plano del body
$mail->AltBody = 'Factura';
//incluye el fichero adjunto
//$mail->addAttachment($file);

if ($mail->send()) {
    echo 'ok mkey ';
} else {
    echo 'Mierda ';
}

//ESTOY CON LA REDIRECCION 23/4/2016
//header('Location: ../public/presupuestos/mdb');


echo 'Enviado';
