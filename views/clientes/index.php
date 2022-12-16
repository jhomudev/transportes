<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
      <link rel="shortcut icon" href="http://localhost/transportes/assets/img/logo.png" type="image/x-icon">
      <link rel="stylesheet" href="http://localhost/transportes/assets/css/clientes.css">
      <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script src="https://cdn.lordicon.com/fudrjiwc.js"></script>
      <title>SystemTransport</title>
   </head>
   <body>
      <div class="container_all">
         <?php include "../menu.php";?>
         <div class="view">
            <h1 class="title">Lista de Clientes</h1>
            <main class="main">
               <form class="search" id="formSearch">
                  <input type="search" class="search__control" id="keywords" placeholder="Buscar...";>
                  <i class="uil uil-search"></i>
               </form>         
               <div class="tableBox">
                  <table class="table">
                     <thead class="table__thead">
                        <tr>
                           <th scope="col">DNI</th>
                           <th scope="col">NOMBRES</th>
                           <th scope="col">APELLIDOS</th>
                           <th scope="col">SEXO</th>
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
      <script src="./script.js"></script>
   </body>
</html>
