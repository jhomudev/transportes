<?php
    ob_start();
    include "../conexion.php";
    $salida=$_GET['salida'];
    //eliminar salida
    $sql="DELETE FROM salidas WHERE id_salida=$salida";
    $res=$conexion->query($sql);
    //eliminar asientos de la salida
    $sql_asi="DELETE FROM asientos WHERE id_salida=$salida";
    $res_asi=$conexion->query($sql_asi);
    //eliminar reservas de la salida
    $sql_reser="DELETE FROM con_pasajero WHERE id_salida=$salida";
    $res_reser=$conexion->query($sql_reser);
    try{
        header("Location:salidas.php");
        //echo "<meta http-equiv='refresh' content='1;URL=salidas.php>";
    }
    catch(Exception $e){
        echo'Error';
    }  
    ob_end_flush();
?>