<?php 
   ob_start();
   session_start();
   if(empty($_SESSION['username'])){
      header("Location:http://localhost/transportes/login.php");
   }

   require "../../conexion.php";
   $objConexion=new Conexion();

   if($_GET){
      $id_salida=$_GET["idS"];
      $sql="SELECT s.id,s.id_vehiculo,s.origen,s.destino,s.fecha,s.hora,s.monto,c.nombres,c.apellidos,c.telefono from salidas s INNER JOIN conductores c ON s.id_conductor=c.id  WHERE s.id = $id_salida";
      $salida=$objConexion->consultarOne($sql);

      // datos del cliente usando join
      $sql_join="SELECT c.nombres,c.apellidos,r.id,r.asiento,r.dni,r.fecha_emi,r.total,a.n_asiento FROM reservas r 
      INNER JOIN asientos a ON r.asiento = a.id
      INNER JOIN clientes c ON c.dni=r.dni
      INNER JOIN vehiculos v ON v.cod=a.cod_vehiculo WHERE v.id = '".$salida["id_vehiculo"]."' ORDER BY a.n_asiento ASC";
      $pasajeros=$objConexion->consultar($sql_join);
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Lista de pasajeros</title>
   <style>
      *{
         margin: 0;
         padding: 0;
         box-sizing: border-box;
         text-align: center;
         font-family: Helvetica, Arial, sans-serif;
      }
      body{
         padding: 40px;
      }
      table{
         width: 100%;
         border-collapse: collapse;
         border: 1px solid #000;
         margin: 10px 0;
         text-transform:uppercase;
      }
      thead,th{
         background: #090432;
         color:white;
      }
      td,th{
         padding: 5px 0;
         border: 1px solid #090432;
         font-size:xx-small;
      }
   </style>
</head>
<body>
   <h1>Salida</h1>
   <hr>
   <table>
      <thead>
         <tr>
            <th>Origen</th>
            <th>Destino</th>
            <th>Fecha</th>
            <th>hora</th>
            <th>Monto</th>
         </tr>
      </thead>
      <tbody>
         <tr>
            <td><?php echo $salida["origen"]; ?></td>
            <td><?php echo $salida["destino"]; ?></td>
            <td><?php echo date("d-m-Y",strtotime($salida["fecha"])); ?></td>
            <td><?php echo $salida["hora"]; ?></td>
            <td>S/ <?php echo ($salida["monto"]*0.18)+$salida["monto"]; ?></td>
         </tr>
         <tr>
            <th>CONDUCTOR</th>
            <td colspan=2><?php echo $salida["nombres"]." ".$salida["apellidos"]; ?></td>
            <th>N° TELÉFONO</th>
            <td><?php echo $salida["telefono"]; ?></td>
         </tr>
      </tbody>
   </table>
   <hr>
   <h2>Lista de pasajeros</h2>
   <table>
      <thead>
         <tr>
            <th>Asiento</th>
            <th>DNI</th>
            <th>Nombres y Apellidos</th>
            <th>fecha de emisión</th>
         </tr>
      </thead>
      <tbody>
         <?php 
               foreach ($pasajeros as $pasajero){
         ?>
               <tr>
                  <td><?php echo $pasajero["n_asiento"]; ?></td>
                  <td><?php echo $pasajero["dni"]; ?></td>
                  <td><?php echo $pasajero["nombres"]." ".$pasajero["apellidos"]; ?></td>
                  <td><?php echo $pasajero["fecha_emi"]; ?></td>
               </tr>
         <?php 
            }
         ?>
      </tbody>
   </table>
</body>
</html>
<?php
   $html=ob_get_clean();
   //echo $html;

   require_once 'dompdf/autoload.inc.php';
   use Dompdf\Dompdf;
   
   $dompdf=new Dompdf();

   $options=$dompdf->getOptions();
   $options->set(array('isRemoteEnabled'=>true));
   $dompdf->setOptions($options);

   $dompdf->loadHtml($html);

   $dompdf->setPaper('A4');

   $dompdf->render();

   $dompdf->stream("recibo_.pdf",array("Attachment"=>false));

   ob_end_flush();
?>