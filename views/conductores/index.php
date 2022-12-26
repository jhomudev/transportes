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
      <link rel="stylesheet" href="http://localhost/transportes/assets/css/conductores.css">
      <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <title>SystemTransport</title>
   </head>
   <body>
      <div class="container_all">
         <?php include "../menu.php";?>
         <div class="view">
            <h1 class="title">Gestión de Conductores</h1>
            <main class="main">         
               <form class="form" id="form_add" >
                  <h3 id="title_action">Agregar conductor</h3>
                  <div class="form__group">
                     <label for="dni">DNI</label>
                     <input type="hidden" name="id_conductor" id="id_conductor"/>
                     <input
                        type="text"
                        class="form__control"
                        name="tx_dni"
                        maxlength="8"
                        minlength="8"
                        onkeypress="return soloNumeros(event);"
                        id="dni" required
                     />
                  </div>
                  <div class="form__group">
                     <label for="nombres">Nombres</label>
                     <input
                        type="text"
                        class="form__control"
                        name="tx_nombres"
                        id="nombres" required
                     />
                  </div>
                  <div class="form__group">
                     <label for="apellidos">Apellidos</label>
                     <input
                        type="text"
                        class="form__control"
                        name="tx_apellidos"
                        id="apellidos" required
                     />
                  </div>
                  <div class="form__group">
                     <label for="licencia">Licencia</label>
                     <select name="tx_licencia" id="licencia" class="form__control">
                        <option disabled selected>Elija la licencia </option>
                        <option value="A-IIb">A-IIb</option>
                        <option value="A-IIIb">A-IIIb</option>
                        <option value="A-IIIa">A-IIIa</option>
                     </select>
                  </div>
                  <div class="form__group">
                     <label for="telefono">Teléfono</label>
                     <input
                        type="text"
                        class="form__control"
                        name="tx_telefono"
                        id="telefono"
                        maxlength="9"
                        minlength="9"
                        onkeypress="return soloNumeros(event);" required
                     />
                  </div>
                  <div class="form__group">
                     <label for="estado">Estado</label>
                     <select name="tx_estado" id="estado" class="form__control" required>
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
                           <th scope="col">DNI</th>
                           <th scope="col">Nombres y apellidos</th>
                           <th scope="col">Licencia</th>
                           <th scope="col">Teléfono</th>
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