<?php 
   require "./../conexion.php";
   $objConexion=new Conexion();

   if(isset($_POST)){
      $cod_v=$_POST["codV"];

      $sql_verify="SELECT * FROM vehiculos WHERE cod=$cod_v AND hasSalida=1";
      $vehiculo=$objConexion->consultarOne($sql_verify);
      if($vehiculo){
         echo "cannot";
      }else{
         try{
            $sql_v="DELETE FROM vehiculos WHERE cod=$cod_v";
            $objConexion->ejecutar($sql_v);

            $sql_a="DELETE FROM asientos WHERE cod_vehiculo=$cod_v";
            $objConexion->ejecutar($sql_a);
            echo "ok"; 
         }catch(PDOException $e){
            echo "Error ".$e->getMessage();
         }
      }
   }
?>