<?php
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

        $conect = mysql_connect('127.0.0.1', 'root', '')
        or die('No se pudo conectar: ' . mysql_error());
        mysql_select_db('Proyecto1') or die('No se pudo seleccionar la base de datos');

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
    include("/Users/Betzy/Sites/Proyecto/ReadCSV/Email/class.phpmailer.php"); 
    include("/Users/Betzy/Sites/Proyecto/ReadCSV/Email/class.smtp.php"); 
    $mail = new PHPMailer(); 
    $mail->IsSMTP(); 
    $mail->SMTPAuth = true; 
    $mail->SMTPSecure = "ssl"; 
    $mail->Host = "smtp.gmail.com"; 
    $mail->Port = 465; 
    $mail->Username = "betzykarinachiroldesleon@gmail.com"; 
    $mail->Password = "beka2710442";

    $mail->From = "betzykarinachiroldesleon@gmail.com"; 
    $mail->FromName = "Aministrador"; 
    $mail->Subject = "Registro de estudiantes del día"; 
    $mail->AltBody = "Este es un mensaje"; 
    $mail->MsgHTML("<b>El numero de estudiantes registrados el dia de hoy fue: ".$contEstudents." </b>"); 
    $mail->AddAttachment(""); 
    $mail->AddAttachment(""); 
    $mail->AddAddress("beka142@hotmail.com", "Gerente"); 
    $mail->IsHTML(true); 
    if(!$mail->Send()) { 
    echo "Error: " . $mail->ErrorInfo; 
    } else { 
    echo "Mensaje enviado correctamente"; 
     }
    echo "\n";
}
?>