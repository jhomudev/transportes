<?php 
   if(isset($_POST)){
      $id=$_POST["idC"];

      require "./../conexion.php";
      $objConexion=new Conexion();

      // validar si el conductor ya esta en una salida
      $sql_verify="SELECT * FROM conductores WHERE id=$id AND hasSalida=1";
      $conductor=$objConexion->consultarOne($sql_verify);
      if($conductor){
         echo "cannot";
      }else{
         $sql="SELECT * FROM  conductores WHERE id=$id";
         $salida=$objConexion->consultarOne($sql);
         echo json_encode($salida); 
      }
   }
?>