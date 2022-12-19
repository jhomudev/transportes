<?php 
   require "../../conexion.php";
   $objConexion=new Conexion();

   if($_POST){
      $id_reserva=$_POST["id"];
      try{
         // obtener  los datos dereserva, el asiento para ponerlo como disponible
         $sql="SELECT * FROM reservas WHERE id=$id_reserva";
         $reserva=$objConexion->consultarOne($sql);
         // cambiar estado de asiento a disponible
         $sql_a="UPDATE asientos SET isAvailable = 0 WHERE id=".$reserva["asiento"]."";
         $objConexion->ejecutar($sql_a);
         // Eliminando reserva
         $sql_r="DELETE FROM reservas WHERE id=$id_reserva";
         $objConexion->ejecutar($sql_r);
         echo "ok";
      }catch(PDOException $e ){
         echo "Error: ".$e->getMessage();
      }
   }
?>