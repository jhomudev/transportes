<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="shortcut icon" href="http://localhost/transportes/assets/img/logo.png" type="image/x-icon">
   <link rel="stylesheet" href="http://localhost/transportes/assets/css/menu.css" />
   <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
   <title>SystemTransport</title>
</head>
<body>
   <div class="container_all">
      <?php
         include_once"views/menu.php"
      ?>
   </div>
   <script>
      // funcion ocultar barra menu en panel de admin
      const btn = document.querySelector(".menu__iconBar");
      let menu = document.querySelector(".menu");
      let opcion_title = document.querySelectorAll(".menu__linkText");
      function hide() {
         //poniendo la clase
         menu.classList.toggle("hide");
         // btn.classList.toggle("center");
         opcion_title.forEach((item) => item.classList.toggle("hide"));
      }
      btn.addEventListener("click", hide);
   </script>
</body>
</html>
