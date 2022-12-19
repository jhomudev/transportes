<?php 
   require "../../conexion.php";
   $objConexion=new Conexion();
   if($_GET){
      $id_salida=$_GET["id"];
      $sql="SELECT * FROM salidas WHERE id=$id_salida";
      $salida=$objConexion->consultarOne($sql);
   }
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <link
         rel="stylesheet"
         href="https://unicons.iconscout.com/release/v4.0.0/css/line.css"
      />
      <link
         rel="shortcut icon"
         href="http://localhost/transportes/assets/img/logo.png"
         type="image/x-icon"
      />
      <link rel="stylesheet" href="http://localhost/transportes/assets/css/control.css">
      <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <title>SystemTransport</title>
   </head>
   <body>
      <div class="container_all">
         <?php include "../../menu.php";?> 
         <div class="view">
            <a href="../" class="back"><i class="uil uil-arrow-left"></i></a>
            <h1 class="title">Control de salida</h1>
            <hr />
            <main class="main">
               <div class="tableBox">
                  <table class="table">
                     <thead class="table__thead">
                        <tr>
                           <th>ORIGEN</th>
                           <th>DESTINO</th>
                           <th>FECHA</th>
                           <th>HORA</th>
                           <th>MONTO</th>
                        </tr>
                     </thead>
                     <tbody class="table__tbody">
                        <tr>
                           <td><?php echo $salida["origen"]; ?></td>
                           <td><?php echo $salida["destino"]; ?></td>
                           <td><?php echo $salida["fecha"]; ?></td>
                           <td><?php echo $salida["hora"]; ?></td>
                           <td>S/ <?php echo $salida["monto"]; ?></td>
                        </tr>
                     </tbody>
                  </table>
               </div>
               <hr />
               <div class="content">
                  <div class="bus" id="bus">
                     <div class="bus__left" id="bus__left">
                        <!-- response asientos-->
                     </div>
                     <div class="bus__right" id="bus__right">
                        <!-- response asientos-->
                     </div>
                  </div>
                  <div class="modalInfo hidden" id="modalInfo">
                     <div class="modalInfo__Box">
                        <button class="modalInfo__back" id="modalInfo__back">
                           <i class="uil uil-arrow-to-right"></i>
                        </button>
                        <div class="modalInfo__info" id="modalInfo__info">
                        <div class="alert alert_libre">Este asiento está disponible</div>
                           <!-- response -->
                        </div>
                     </div>
                  </div>
                  <button class="btnshowList" id="btnshowList">Lista de pasajeros</button>
                  <div class="pasajerosBox hidden" id="pasajerosBox">
                     <button class="pasajeros__btnBack" id="pasajeros__btnBack"><i class="uil uil-multiply"></i></button>
                     <h3>Lista de pasajeros</h3>
                     <div class="pasejeros__tableBox">
                        <table class="pasajeros__table">
                           <thead class="pasajeros__table__thead">
                              <tr>
                                 <th>DNI</th>
                                 <th>Pasajero</th>
                                 <th>Asiento</th>
                              </tr>
                           </thead>
                           <tbody class="pasajeros__table__tbody">
                              <tr>
                                 <td>71749122</td>
                                 <td>jhonan muñoz</td>
                                 <td>6</td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </main>
         </div>
      </div>
      <script src="http://localhost/transportes/assets/js/app.js"></script>
      <script src="script.js"></script>
   </body>
</html>
