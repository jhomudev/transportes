<?php 
   if(isset($_POST)){
      $id=$_POST["id"];

      require "./../conexion.php";
      $objConexion=new Conexion();
      $sql="DELETE FROM salidas WHERE id=$id";
      $objConexion->ejecutar($sql);
      echo "ok"; 
   }
?>