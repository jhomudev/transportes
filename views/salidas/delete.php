<?php 
   require "./../conexion.php";
   $objConexion=new Conexion();

   if(isset($_POST)){
      $id=$_POST["id"];

      // verificar si la salida tiene reservas o no
      $sql_verify="SELECT * FROM reservas r 
      INNER JOIN asientos a ON r.asiento=a.id  
      INNER JOIN vehiculos v ON v.cod=a.cod_vehiculo 
      INNER JOIN salidas s ON s.id_vehiculo=v.id 
      WHERE s.id=$id";
      $reservas=$objConexion->consultar($sql_verify);
      if($reservas){
         echo "cannot";
      }else{
         try{
            $sql_s="SELECT * FROM salidas WHERE id=$id";
            $salida=$objConexion->consultarOne($sql_s);

            $sql="DELETE FROM salidas WHERE id=$id";
            $objConexion->ejecutar($sql);
            // poner como libre el conductor dela salida eliminada
            $sql_u_c="UPDATE conductores SET hasSalida=0 WHERE id=".$salida["id_conductor"]."";
            $objConexion->ejecutar($sql_u_c);
            // poner como libre el vehiculo cde la salida eliminada
            $sql_u_v="UPDATE vehiculos SET hasSalida=0 WHERE id=".$salida["id_vehiculo"]."";
            $objConexion->ejecutar($sql_u_v);
            echo "ok"; 
         }catch(PDOException $e){
            echo "Error ".$e->getMessage();
         }
      }
   }
?>