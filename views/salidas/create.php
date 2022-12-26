<?php 
   if(isset($_POST)){
      // date_default_timezone_set('America/Lima');
      // $cod_timestamp=strtotime(date('Y-m-d H:i:s'));
      $origen=strtoupper($_POST["tx_origen"]);
      $destino=strtoupper($_POST["tx_destino"]);
      $fecha=$_POST["tx_fecha"];
      $hora=$_POST["tx_hora"];
      $monto=$_POST["tx_monto"];
      $vehiculo=$_POST["tx_vehiculo"];
      $conductor=$_POST["tx_conductor"];
      require "./../conexion.php";
      $objConexion=new Conexion();

      if(empty($origen) || empty($destino) || empty($fecha) || empty($hora) || empty($monto) || empty($conductor) || empty($vehiculo) ){
         echo 'vacio';
      }else{
         try{
            if(empty($_POST["id_salida"])){
               // creacion de salida
               $sql="INSERT INTO salidas (origen,destino,fecha,hora,monto,id_conductor,id_vehiculo) VALUES('$origen','$destino','$fecha','$hora',$monto,$conductor,$vehiculo)";
               $objConexion->ejecutar($sql);
               // modificando datos del vehiculo a ocupado
               $sql_v="UPDATE vehiculos SET hasSalida=1 WHERE id=$vehiculo";
               $objConexion->ejecutar($sql_v);
               // modificando datos del conductor a ocupado
               $sql_v="UPDATE conductores SET hasSalida=1 WHERE id=$conductor";
               $objConexion->ejecutar($sql_v);
               echo "ok";
            }else{
               $id_salida=$_POST["id_salida"];
               $sql_s="SELECT * FROM salidas WHERE id=$id_salida";
               $salida=$objConexion->consultarOne($sql_s);
               // poner como libre el vehiculo cambiado
               $sql_u_v="UPDATE vehiculos SET hasSalida=0 WHERE id=".$salida["id_vehiculo"]."";
               $objConexion->ejecutar($sql_u_v);
               // poner como libre el conductor cambiado
               $sql_u_c="UPDATE conductores SET hasSalida=0 WHERE id=".$salida["id_conductor"]."";
               $objConexion->ejecutar($sql_u_c);
               // modificando datos del conductor nuevo elegido a ocupado
               $sql_u_cn="UPDATE conductores SET hasSalida=1 WHERE id=$conductor";
               $objConexion->ejecutar($sql_u_cn);
               // modificando datos del vehiculo nuevo elegido a ocupado
               $sql_u_vm="UPDATE vehiculos SET hasSalida=1 WHERE id=$vehiculo";
               $objConexion->ejecutar($sql_u_vm);
               // actualizar datos de la salida
               $sql="UPDATE salidas SET origen='$origen', destino='$destino', fecha='$fecha', hora='$hora', monto=$monto, id_conductor=$conductor, id_vehiculo=$vehiculo  WHERE id=$id_salida";
               $objConexion->ejecutar($sql);
               echo 'modificado';
            }
         }catch(PDOException $e){
            echo "Error ".$e->getMessage();
         }
      }     
   }
?>