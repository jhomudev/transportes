<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
      <link rel="shortcut icon" href="http://localhost/transportes/assets/img/logo.png" type="image/x-icon">
      <link rel="stylesheet" href="http://localhost/transportes/assets/css/salidas.css">
      <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <title>SystemTransport</title>
   </head>
   <body>
      <div class="container_all">
         <?php include "../menu.php";?>
         <div class="view">
            <h1 class="title">Gestión de Salidas</h1>
            <main class="main">         
               <form class="form" id="form_add" >
                  <h3 id="title_action">Agregar Salida</h3>
                  <div class="form__group">
                     <label for="codigo">Origen</label>
                     <input type="hidden" name="id_salida" id="id_salida"/>
                     <input
                        type="text"
                        class="form__control"
                        name="tx_origen"
                        id="origen" required
                     />
                  </div>
                  <div class="form__group">
                     <label for="codigo">Destino</label>
                     <input
                        type="text"
                        class="form__control"
                        name="tx_destino"
                        id="destino" required
                     />
                  </div>
                  <div class="form__group">
                     <label for="codigo">Fecha</label>
                     <input
                        type="date"
                        class="form__control"
                        name="tx_fecha"
                        id="fecha" required
                     />
                  </div>
                  <div class="form__group">
                     <label for="codigo">Hora</label>
                     <input
                        type="time"
                        class="form__control"
                        name="tx_hora"
                        id="hora" required
                     />
                  </div>
                  <div class="form__group">
                     <label for="codigo">Monto S/</label>
                     <input
                        type="text"
                        class="form__control"
                        name="tx_monto"
                        id="monto"
                        onkeypress="return soloPrecio(event);"
                        required
                     />
                  </div>
                  <input type="submit" value="Agregar" id="btnRegistrar" class="form__button" />
               </form>
               <div class="tableBox">
                  <table class="table">
                     <thead class="table__thead">
                        <tr>
                           <th scope="col">ORIGEN</th>
                           <th scope="col">DESTINO</th>
                           <th scope="col">FECHA</th>
                           <th scope="col">HORA</th>
                           <th scope="col">MONTO</th>
                           <th scope="col">OPCIONES</th>
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
