<?php 
   session_start();
   if(empty($_SESSION['username'])){
      header("Location:http://localhost/transportes/login.php");
   }
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
      <link rel="shortcut icon" href="http://localhost/transportes/assets/img/logo.png" type="image/x-icon">
      <link rel="stylesheet" href="http://localhost/transportes/assets/css/vehiculos.css">
      <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <title>SystemTransport</title>
   </head>
   <body>
      <div class="container_all">
         <?php include "../menu.php";?>
         <div class="view">
            <h1 class="title">Gestión de vehículos</h1>
            <main class="main">         
               <form class="form" id="form_add" >
                  <h3 id="title_action">Agregar Vehículo</h3>
                  <div class="form__group">
                     <label for="placa">Placa de auto</label>
                     <input type="hidden" name="id_vehiculo" id="id_vehiculo"/>
                     <input
                        type="text"
                        class="form__control"
                        name="tx_placa"
                        id="placa"
                        maxlength="7"
                        minlength="7"
                        placeholder="XXX-XXX" required
                     />
                  </div>
                  <div class="form__group">
                     <label for="vin">VIN del auto</label>
                     <input
                        type="text"
                        class="form__control"
                        name="tx_vin"
                        id="vin"
                        maxlength="17"
                        minlength="17"
                        placeholder="1HGBH41JXMN109186"
                        required
                     />
                  </div>
                  <div class="form__group">
                     <label for="marca">Marca</label>
                     <input
                        type="text"
                        class="form__control"
                        name="tx_marca"
                        id="marca"
                        placeholder="Toyota, Nissan, etc."
                        required
                     />
                  </div>
                  <div class="form__group">
                     <label for="categoria">Categoria de vehículo</label>
                     <select name="tx_categoria" id="categoria" class="form__control">
                        <option disabled selected>Elija la categoría</option>
                        <option value="M2">M2</option>
                        <option value="M3">M3</option>
                     </select>
                  </div>
                  <div class="form__group">
                     <label for="asientos">Total de asientos</label>
                     <input
                        type="number"
                        class="form__control"
                        name="tx_asientos"
                        id="asientos"
                        onkeypress="return soloNumeros(event);"
                        disabled required
                     />
                  </div>
                  <div class="form__group">
                     <label for="estado">Estado</label>
                     <select name="tx_estado" id="estado" class="form__control">
                        <option disabled selected>Seleccione un estado</option>
                        <option value="1">ACTIVO</option>
                        <option value="2">INACTIVO</option>
                     </select>
                  </div>
                  <input type="submit" value="Agregar" id="btnRegistrar" class="form__button" />
               </form>
               <div class="tableBox">
                  <table class="table">
                     <thead class="table__thead">
                        <tr>
                           <th scope="col">Placa</th>
                           <th scope="col">VIN del auto</th>
                           <th scope="col">Marca</th>
                           <th scope="col">Categoría</th>
                           <th scope="col">Asientos</th>
                           <th scope="col">Estado</th>
                           <th scope="col">Acciones</th>
                        </tr>
                     </thead>
                     <tbody class="table__tbody" id="table_list">
                     </tbody>
                  </table>
               </div>
            </main>
         </div>
      </div>
      <script src="http://localhost/transportes/assets/js/app.js"></script>
      <script src="script.js"></script>
   </body>
</html>