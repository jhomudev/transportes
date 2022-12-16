<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transportes</title>
    <link rel="stylesheet" href="../../styles/style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">		
</head>
<body>
<?php
    include "../conexion.php";
    $objConexion=new Conexion();

    $id_reserva=$_GET['id_reserva'];
    $sql_res="SELECT * FROM reservas WHERE id_cod=$id_reserva";
    $reserva = $objConexion->consultarOne($sql_res);
    $id_salida=$reserva["id_salida"];
    $n_asiento=$reserva["asiento"];

    //eliminar reservación
    $sql="DELETE FROM reservas WHERE id_cod=$id_reserva";
    //editar estado de asiento a disponible
    $sql_edit="UPDATE asientos SET estado='DISPONIBLE' WHERE id_salida=$id_salida AND n_asiento=$n_asiento";
    try{
        $deleteReserva=$objConexion->ejecutar($sql);
        $updateAsiento=$objConexion->ejecutar($sql_edit);
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