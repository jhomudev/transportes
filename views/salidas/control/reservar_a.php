<?php 
   require "../../conexion.php";
   $objConexion=new Conexion();
   if($_POST){
      date_default_timezone_set('America/Lima');
      $dni=$_POST["tx_dni"];
      $nombres=strtoupper($_POST["tx_nombres"]);
      $apellidos=strtoupper($_POST["tx_apellidos"]);
      $telefono=$_POST["tx_telefono"];
      $id_asiento=$_POST["tx_idAsiento"];
      $fecha_emi=date("Y-m-d");

      // obtencion de datos de salida. su precio para eltotal con igv
      $sql="SELECT s.monto FROM salidas s INNER JOIN vehiculos v ON s.id_vehiculo=v.id INNER JOIN asientos a ON v.cod=a.cod_vehiculo WHERE a.id=$id_asiento";
      $salida=$objConexion->consultarOne($sql);

      $igv=(18/100)*$salida["monto"];
      $total=$salida["monto"]+$igv;

      if(empty($dni) || empty($nombres) || empty($apellidos) || empty($telefono) || empty($id_asiento)){
         echo "vacio";
      }else{
         if(empty($_POST["tx_id_reserva"])){
            try{
               // crear reserva
               $sql_r="INSERT INTO reservas(asiento,dni,fecha_emi,total) VALUES ($id_asiento,$dni,'$fecha_emi',$total)";
               $objConexion->ejecutar($sql_r);
               //verificar si hay cliente con dni mismo, si lo hay no crear nuevo cliente
               $sql_verify="SELECT * FROM clientes WHERE dni=$dni";
               $cliente=$objConexion->consultarOne($sql_verify);
               if(!$cliente){
                  $sql_c="INSERT INTO clientes(dni,nombres,apellidos,telefono) VALUES ($dni,'$nombres','$apellidos',$telefono)";
                  $objConexion->ejecutar($sql_c);
               }
               // cambiar estado de asiento a ocupado
               $sql_a="UPDATE asientos SET isAvailable = 1 WHERE id=$id_asiento";
               $objConexion->ejecutar($sql_a);
      
               echo "ok";
      
            }catch(PDOException $e){
               echo "Error ".$e->getMessage();
            }
         }else{
            try{
               $id_reserva=$_POST["tx_id_reserva"];
               // obtener datos de la reserva que esta editanmdo, el dni para modificar datos delcliente
               $sql_r="SELECT * FROM reservas WHERE id=$id_reserva";
               $reserva=$objConexion->consultarOne($sql_r);
               //modificar datos del cliente
               $sql_c="UPDATE clientes SET dni=$dni,nombres='$nombres',apellidos='$apellidos',telefono=$telefono WHERE dni=".$reserva["dni"]."";
               $objConexion->consultarOne($sql_c);
               // modificar reserva
               $sql_r="UPDATE reservas SET asiento=$id_asiento,dni=$dni,fecha_emi='$fecha_emi' WHERE id=$id_reserva";
               $objConexion->ejecutar($sql_r);
               // modificar estado de asiento al nuevo elegido
               $sql_a_old="UPDATE asientos SET isAvailable=0 WHERE id=".$reserva["asiento"]."";
               $objConexion->ejecutar($sql_a_old);
               $sql_a_new="UPDATE asientos SET isAvailable=1 WHERE id=$id_asiento";
               $objConexion->ejecutar($sql_a_new);
               echo "ok_m";
            }catch(PDOException $e){
               echo "Error ".$e->getMessage();
            }
         }
      }    
   }
?>