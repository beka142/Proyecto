<?php
$datos = $_POST['Survery'];

if(!empty($datos['nombre'])&&!empty($datos['apellido'])&&!empty($datos['correo'])&&!empty($datos['telefono'])&&!empty($datos['cedula']))
{
	save();
	echo "Datos guardados exitosamente";
}
else{
	echo "Lo sentimos, se necesita se necesita que todas las casillas esten completas";
}


function save(){
	date_default_timezone_set("America/Costa_Rica");
	$fecha = date("d").date("m").date("Y");
	$file = fopen($fecha. ".cscv","a");
	fwrite($file,$datos['nombre'].";".,$datos['apellido'].";".$datos['correo'].";".$datos['telefono'].";".$datos['cedula']."\n");
	fclose($file);
}
//<form action="apgform1.7.php" method="post" onsubmit="return confirm('submit?');">
//<input type="text" name="employee[last_name]"/>


?>
<script type=\"text/javascript\"> 
if(confirm('Saved Succesfully, do you want to add another one?'))
{
	window.location.href = 'Survery.html';
}
</script>