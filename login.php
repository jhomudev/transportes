<?php 
   session_start();
   if(isset($_SESSION['username'])){
      header("Location:./");
   }

   require "./views/conexion.php";
   $objConexion=new Conexion();
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="./assets/css/login.css">
   <link rel="shortcut icon" href="http://localhost/transportes/assets/img/logo.png" type="image/x-icon">
   <title>SystemTransport | Login</title>
</head>
<body>
   <div class="container_all">
      <div class="formBox">
         <h3 class="title">Inicio de sesión</h3>
         <form action="login.php" method="post" class="form">
            <div class="form__control">
               <input type="text" name="tx_username" class="form__input" id="username" placeholder=" " value="<?php echo isset($_POST["tx_username"])? $_POST["tx_username"]:"" ;?>" required>
               <label for="username" class="form__label">Usuario</label>
            </div>
            <div class="form__control">
               <input type="password" name="tx_password" class="form__input" id="password" placeholder=" " value="<?php echo isset($_POST["tx_password"])? $_POST["tx_password"]:"" ;?>" required>
               <label for="password" class="form__label">Contraseña</label>
            </div>
            <?php 
               if($_POST){
                  $username=$_POST["tx_username"];
                  $password=$_POST["tx_password"];

                  $sql="SELECT * FROM usuarios WHERE username='$username'";
                  $user=$objConexion->consultarOne($sql);

                  if($user){
                     if($user["password"]==$password){
                        // entra
                        session_start();
                        $_SESSION['username']=$username;
                        $_SESSION['username']=$password;
                        $_SESSION['fullname']=$user["nombres_apes"];
                        header("Location:./");
                     }else{
                        echo '
                           <div class="form__aviso">*.Contraseña incorrecta</div>
                        ';
                     }
                  }else{
                     echo '
                        <div class="form__aviso">*.Usuario inválido</div>
                     ';
                  }
               }
            ?>
            <input type="submit" class="form__submit" value="Iniciar sesión">
         </form>
      </div>
   </div>
</body>
</html>