<?php 
   if(isset($_POST)){
      $id=$_POST["id"];

      require "./../conexion.php";
      $objConexion=new Conexion();

      // verificar si la salida tiene reservas o no
      $sql_verify="SELECT * FROM reservas r 
      INNER JOIN asientos a ON r.asiento=a.id  
      INNER JOIN vehiculos v ON v.cod=a.cod_vehiculo 
      INNER JOIN salidas s ON s.id_vehiculo=v.id 
      WHERE s.id=$id";
      $reservas=$objConexion->consultar($sql_verify);
      if($reservas){
         echo "cannot";
      }else{
         $sql="SELECT s.id AS idS,s.origen,s.destino,s.fecha,s.hora,s.monto,c.id AS idC,c.nombres,c.apellidos,c.licencia,v.id AS idV,v.n_placa,v.total_asientos FROM salidas s INNER JOIN conductores c ON c.id=s.id_conductor INNER JOIN vehiculos v ON v.id=s.id_vehiculo WHERE s.id=$id";
         $salida=$objConexion->consultarOne($sql);
         echo json_encode($salida); 
         // print_r($salida);
      }

   }
?>