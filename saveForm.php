<?php
$datos = $_POST['Form'];

if(!empty($datos['nombre'])&&!empty($datos['apellido'])&&!empty($datos['correo'])&&!empty($datos['telefono'])&&!empty($datos['cedula']))
{
	save();
	echo "Datos guardados exitosamente";
}
else{
	echo "Lo sentimos, se necesita que todas las casillas esten completas";
}


function save(){
	global $datos;
	date_default_timezone_set("America/Costa_Rica");
	$fecha = date("d").date("m").date("Y");
	$file = fopen("/Users/Betzy/Documents/".$fecha. ".csv","a");
	fwrite($file,$datos['nombre'].";".$datos['apellido'].";".$datos['correo'].";".$datos['telefono'].";".$datos['cedula']."\n");
	fclose($file);
}



?>
<script type="text/javascript"> 
if(confirm('Saved Succesfully, do you want to add another one?'))
{
	window.location.href = 'Form.html';
}
</script>