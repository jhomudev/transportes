<?php 
   require "./../conexion.php";
   $objConexion=new Conexion();

   if(isset($_POST)){
      $id=$_POST["id"];

      $sql_verify="SELECT * FROM reservas r INNER JOIN asientos a ON r.asiento=a.id  INNER JOIN salidas s ON s.cod=a.cod_salida WHERE s.id=$id";
      $reservas=$objConexion->consultar($sql_verify);
      if($reservas){
         echo "cannot";
      }else{
         try{
            $sql="DELETE FROM salidas WHERE id=$id";
            $objConexion->ejecutar($sql);
            echo "ok"; 
         }catch(PDOException $e){
            echo "Error ".$e->getMessage();
         }
      }
   }
?>