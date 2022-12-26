<?php 
   if(isset($_POST)){
      require "./../conexion.php";
      $objConexion=new Conexion();

      $cod_v=$_POST["codV"];

      // verificar si el vehiculo tiene asignada una salida
      $sql_verify="SELECT * FROM vehiculos WHERE cod=$cod_v AND hasSalida=1";
      $vehiculo=$objConexion->consultarOne($sql_verify);
      if($vehiculo){
         echo "cannot";
      }else{
         $sql="SELECT * FROM vehiculos WHERE cod=$cod_v";
         $vehiculo=$objConexion->consultarOne($sql);
         echo json_encode($vehiculo);
      }
   }
?>