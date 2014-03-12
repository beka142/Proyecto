<?php
// Carga un archivo XML
$confi = new SimpleXMLElement('/Users/Betzy/Sites/Proyecto/ReadCSV/configuracion.xml', null, true);
$server= $confi->Conexion->Servidor;
$usuario= $confi->Conexion->Usuario;
$contraseña= $confi->Conexion->Password;
$baseDeDatos= $confi->Conexion->DB;

$CuentaDe = $confi->Email->De;
$ContraseñaCorreo = $confi->Email->Password;
$ServidorSMTP = $confi->Email->Servidor;
$CuentaPara = $confi->Email->Para;

//cho $server;
//echo $usuario;
//echo $contraseña;
//echo $baseDeDatos;
//echo $CuentaDe;
//echo $ContraseñaCorreo;
//echo $ServidorSMTP;
//echo $CuentaPara;
//die;

$contEstudents = 0;

date_default_timezone_set("America/Costa_Rica");
$fecha = date("d").date("m").date("Y");
$fecha = "/Users/Betzy/Documents/".$fecha. ".csv";
echo $fecha;


echo "\n";
$fila = "";
$celdas = "";
$first_line = true;
$columns_name = array();
if (($gestor = fopen($fecha, "r")) !== FALSE) {
    while (($datos = fgetcsv($gestor, 1000, ";")) !== FALSE) { //examina la línea que lee para tratar campos en formato CSV y devuelve una matriz que contiene el campo leído.

        $numero = count($datos);
        //echo "Fila $fila: \n";
        //$fila++;
        foreach ($datos as $row) {
            $fila .= "'".$row."'".",";

        }
        $fila = substr($fila, 0, -1);

        $conect = mysql_connect($server, $usuario, $contraseña)
        or die('No se pudo conectar: ' . mysql_error());
        mysql_select_db($baseDeDatos) or die('No se pudo seleccionar la base de datos');

        // Realizar una consulta MySQL
        echo $celdas."\n";
        echo $fila."\n";
        $centencia = 'INSERT INTO estudiantes ('.'Nombre'.','.'Apellido'.','.'correo'.','.'Telefono'.','.'cedula'.') VALUES ('.$fila.');';
        echo $centencia."\n";

        $contEstudents = $contEstudents + 1;

        $result = mysql_query($centencia) or die('Consulta fallida: ' . mysql_error());
        // Cerrar la conexión
        mysql_close($conect);
        //echo $centencia;
        $fila = "";

    }
    fclose($gestor); //Se cierra la conexión
    //Incluimos las clases necesarias para enviar el correo
    include("/Users/Betzy/Sites/Proyecto/ReadCSV/Email/class.phpmailer.php"); 
    include("/Users/Betzy/Sites/Proyecto/ReadCSV/Email/class.smtp.php"); 
    $mail = new PHPMailer(); 
    $mail->IsSMTP(); 
    $mail->SMTPAuth = true; 
    $mail->SMTPSecure = "ssl"; 
    $mail->Host = $ServidorSMTP; 
    $mail->Port = 465; 
    $mail->Username = "betzykarinachiroldesleon@gmail.com"; 
    $mail->Password = $ContraseñaCorreo;

    $mail->From = $CuentaDe; 
    $mail->FromName = "Aministrador"; 
    $mail->Subject = "Registro de estudiantes del día"; 
    $mail->AltBody = "Este es un mensaje"; 
    $mail->MsgHTML("<b>El numero de estudiantes registrados el dia de hoy fue: ".$contEstudents." </b>"); 
    $mail->AddAttachment(""); 
    $mail->AddAttachment(""); 
    $mail->AddAddress($CuentaPara, "Gerente"); 
    $mail->IsHTML(true); 
    if(!$mail->Send()) { 
    echo "Error: " . $mail->ErrorInfo; 
    } else { 
    echo "Mensaje enviado correctamente"; 
     }
    echo "\n";
}
?>