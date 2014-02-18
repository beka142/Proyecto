
<?php 
//$ruta = $_SERVER['argv'][1];

$ruta = $argv[1];

echo $ruta." \n";

$fp = fopen ( $ruta , "r" ); 

//$fp = fopen ( 'c:\bd.csv' , "r" ); 
 //var_dump($fp) ;

while (( $data = fgetcsv ( $fp ,1000, ";" )) !== false ) { // Mientras hay líneas que leer...
	echo "\n ---- \n";
	$i = 0; 
	foreach($data as $row) {

		echo "Campo $i: $row\n"; // Muestra todos los campos de la fila actual 
		$i++ ;

	}

	

} 
fclose ( $fp ); 
?>