

<?php 

$conexion = new mysqli('localhost', 'root', '', 'bdtrans');
$conexion->set_charset("utf8");

if (!$conexion) { 
    die('<strong>No pudo conectarse:</strong> ' . mysql_error()); 
}else{ 
    // La siguiente linea no es necesaria, simplemente la pondremos ahora para poder observar que la conexión ha sido realizada 
    //echo 'Conectado  satisfactoriamente al servidor <br />'; 
} 
 
?>
