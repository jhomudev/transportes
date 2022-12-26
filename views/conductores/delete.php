<?php 
   require "./../conexion.php";
   $objConexion=new Conexion();

   if(isset($_POST)){
      $id=$_POST["idC"];

      // validar si el conductor ya esta en una salida
      $sql_verify="SELECT * FROM conductores WHERE id=$id AND hasSalida=1";
      $conductor=$objConexion->consultarOne($sql_verify);
      if($conductor){
         echo "cannot";
      }else{
         try{
            $sql_c="DELETE FROM conductores WHERE id=$id";
            $objConexion->ejecutar($sql_c);
            echo "ok"; 
         }catch(PDOException $e){
            echo "Error ".$e->getMessage();
         }
      }
   }
?>