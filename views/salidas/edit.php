<?php 
   if(isset($_POST)){
      $id=$_POST["id"];

      require "./../conexion.php";
      $objConexion=new Conexion();
      $sql="SELECT * FROM  salidas WHERE id=$id";
      $salida=$objConexion->consultarOne($sql);
      echo json_encode($salida); 
   }
?>