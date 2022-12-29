<?php 
   session_start();
   if(empty($_SESSION['username'])){
      header("Location:http://localhost/transportes/login.php");
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="shortcut icon" href="http://localhost/transportes/assets/img/logo.png" type="image/x-icon">
   <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
   <title>SystemTransport</title>
</head>
<body>
   <div class="container_all">
      <?php
         include_once"views/menu.php"
      ?>
   </div>
   <script src="http://localhost/transportes/assets/js/app.js"></script>
</body>
</html>
