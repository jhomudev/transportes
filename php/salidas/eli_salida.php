<?php
    ob_start();
    include "../conexion.php";
    $salida=$_GET['salida'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/a8527aea5d.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../../styles/style.css">
    <title>Document</title>
    <style>
        body{
            height: 100vh;
            background: transparent !important;
            display:grid;
            place-items: center;
        }
		@media screen and (max-width: 715px) {
            *{
                font-size:10px;
            }
			body{
                padding: 20px 20px;
            }
        }
	
    </style>
</head>
<body>
    <?php
        //comprobar si la salida tiene reservas 
        $sql_com="SELECT * FROM con_pasajero where id_salida=$salida";
        $sql_com_res=$conexion->query($sql_com);
        if($sql_com_res -> num_rows > 0){
            echo'
            <div class="alert alert-warning" role="alert">
                <i class="fa-solid fa-triangle-exclamation"></i> Esta salida tiene '.$sql_com_res -> num_rows.' reservas, por lo cual no puede eliminarla.</strong>  
            </div> 
            <meta http-equiv="refresh" content="2;URL=salidas.php">
            ';
        }
        else{
            //eliminar salida
            $sql="DELETE FROM salidas WHERE id_salida=$salida";
            $res=$conexion->query($sql);
            //eliminar asientos de la salida
            $sql_asi="DELETE FROM asientos WHERE id_salida=$salida";
            $res_asi=$conexion->query($sql_asi);
            //eliminar reservas de la salida
            $sql_reser="DELETE FROM con_pasajero WHERE id_salida=$salida";
            $res_reser=$conexion->query($sql_reser);
            try{
                header("Location:salidas.php");
                //echo "<meta http-equiv='refresh' content='1;URL=salidas.php>";
            }
            catch(Exception $e){
                echo'Error';
            }  
        }
    ?>  
</body>
</html>
<?php
    ob_end_flush();
?> 