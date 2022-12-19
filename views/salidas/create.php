<?php 
   if(isset($_POST)){
      $origen=$_POST["tx_origen"];
      $destino=$_POST["tx_destino"];
      $fecha=$_POST["tx_fecha"];
      $hora=$_POST["tx_hora"];
      $monto=$_POST["tx_monto"];
      $cod_timestamp=strtotime(date('Y-m-d H:i:s'));
      require "./../conexion.php";
      $objConexion=new Conexion();

      if(empty($origen) || empty($destino) || empty($fecha) || empty($hora) || empty($monto)){
         echo 'vacio';
      }else{
         if(empty($_POST["id_salida"])){
            // creacion de salida
            $sql="INSERT INTO salidas (origen,destino,fecha,hora,monto,cod) VALUES('$origen','$destino','$fecha','$hora',$monto,'$cod_timestamp')";
            $objConexion->ejecutar($sql);
            // creacion de los 36 asientos dela salida
            for($i=1;$i<=36;$i++){
               $sql_asi="INSERT INTO asientos(cod_salida,n_asiento,isAvailable) VALUES('$cod_timestamp',$i,0)";
               $objConexion->ejecutar($sql_asi);
            }
            echo "ok";
         }else{
            $id_salida=$_POST["id_salida"];
            $sql="UPDATE salidas SET origen='$origen', destino='$destino', fecha='$fecha', hora='$hora', monto=$monto  WHERE id=$id_salida";
            $objConexion->ejecutar($sql);
            echo 'modificado';
         }
      }     
   }
?>