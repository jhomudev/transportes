<?php 
   if(isset($_POST)){
      $origen=$_POST["tx_origen"];
      $destino=$_POST["tx_destino"];
      $fecha=$_POST["tx_fecha"];
      $hora=$_POST["tx_hora"];
      $monto=$_POST["tx_monto"];
      
      require "./../conexion.php";
      $objConexion=new Conexion();
      $sql="INSERT INTO salidas (origen,destino,fecha,hora,monto) VALUES('$origen','$destino','$fecha','$hora',$monto)";
      $objConexion->ejecutar($sql);
      echo "ok";
      
   }
?>