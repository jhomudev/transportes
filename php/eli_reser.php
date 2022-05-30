<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transportes</title>
    <link rel="stylesheet" href="../styles/style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">		
</head>
<body>
<?php
    include "conexion.php";
    $id_asiento=$_GET['id'];
    $salida=$_GET['salida'];
    $n_asiento=$_GET['n_asiento'];

    //eliminar resrevación
    $sql="DELETE FROM con_pasajero WHERE id_salida=$salida AND asiento=$n_asiento";
    $res=$conexion->query($sql);
    //editar estado de asiento a disponible
    $sql_edit="UPDATE asientos SET estado='DISPONIBLE' WHERE id_salida=$salida AND n_asiento=$n_asiento";
    $res_edit=$conexion->query($sql_edit); 
    try{
        echo'   
            <div class="alert alert-success" role="alert">
            <i>Listo.</i> La reservación se eliminó. Actualize la página.
            </div> 
        ';

    }
    catch(Exception $e){
        echo'   
        <div class="alert alert-danger" role="alert">
        <i>Ocurrió un error.</i> Aun no se eliminó la reservación.
        </div> 
        ';
    }
?>
</body>
</html>