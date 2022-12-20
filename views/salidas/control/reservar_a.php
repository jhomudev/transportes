<?php 
   require "../../conexion.php";
   $objConexion=new Conexion();
   if($_POST){
      $dni=$_POST["tx_dni"];
      $nombres=$_POST["tx_nombres"];
      $apellidos=$_POST["tx_apellidos"];
      $telefono=$_POST["tx_telefono"];
      $id_asiento=$_POST["tx_idAsiento"];
      $fecha_emi=date("Y-m-d");

      // obtencion de datos de salida. su precio para eltotal con igv
      $sql="SELECT s.monto FROM salidas s INNER JOIN asientos a ON s.cod=a.cod_salida WHERE a.id=$id_asiento";
      $salida=$objConexion->consultarOne($sql);

      $igv=(18/100)*$salida["monto"];
      $total=$salida["monto"]+$igv;

      if(empty($dni) || empty($nombres) || empty($apellidos) || empty($telefono) || empty($id_asiento)){
         echo "vacio";
      }else{
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
      }    
   }
?>