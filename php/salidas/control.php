<?php
    include_once '../conexion.php';
	$id_salida=$_GET["salida"];
    $objConexion=new Conexion();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/a8527aea5d.js" crossorigin="anonymous"></script>
    <title>Transportes</title>
    <link rel="stylesheet" href="../../styles/control.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <!-- Body -->
    <main>
        <h2>Control de Pasajeros</h2>
		<h3>Salida <?php echo $id_salida; ?></h3><hr>
        <table class="table table-bordered text-center">
            <thead class="table-dark">
                <th>Origen</th>
                <th>Destino</th>
                <th>Fecha</th>
                <th>Hora</th>
            </thead>
        <?php
            $sql="SELECT * FROM salidas WHERE id_salida=$id_salida";
            $salida=$objConexion->consultarOne($sql);
            echo'
                <tbody>
                    <tr>
                        <td>'.$salida["origen"].'</td>
                        <td>'.$salida["destino"].'</td>
                        <td>'.$salida["fecha"].'</td>
                        <td>'.$salida["hora"].'</td>
                    </tr>
                </tbody>
            '
        ?>
        </table>
		<a class="btn btn-outline-info" target="iframe-pasajeros" href="l_pasajeros.php?salida=<?php echo $id_salida; ?>" onclick="mostrar_pas();">Lista de pasajeros</a>&nbsp;&nbsp;&nbsp;&nbsp;
        <a class="btn btn-outline-primary" href="control.php?salida=<?php echo $id_salida; ?>">Actualizar</a>&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="salidas.php" class="btn btn-outline-secondary">Atras</a><hr>
        <div id="autobus">
            <div class="right site">
                <?php
                    $sql= "SELECT * FROM asientos WHERE id_salida=$id_salida AND n_asiento<=18";
                    $asientosObj=$objConexion->consultar($sql);
                    foreach($asientosObj as $asiento){
                        $id =$asiento['id'];
                        $n_asiento =$asiento['n_asiento'];
                        $estado =$asiento['estado'];
                        if($estado =='DISPONIBLE'){
                            $img_route='../../ima/lib.jpg';
                        }
                        elseif($estado =='OCUPADO'){
                            $img_route='../../ima/ocu.jpg';
                        }
                ?>
                        <a href="reservar.php?id=<?php echo $id; ?>&asiento=<?php echo $n_asiento; ?>&salida=<?php echo $id_salida; ?>&estado=<?php echo $estado;?>" onclick="mostrar_res();" class="asiento" target="iframe" style="--number:'A.N°<?php echo $n_asiento; ?>'"><img src="<?php echo $img_route; ?>"></a>
                <?php
                    }
                ?>
                
            </div>
            <div class="left site">
                <?php
                    $sql= "SELECT * FROM asientos WHERE id_salida=$id_salida AND n_asiento>18";
                    $asientosObj=$objConexion->consultar($sql);
                    foreach($asientosObj as $asiento){
                        $id =$asiento['id'];
                        $n_asiento =$asiento['n_asiento'];
                        $estado =$asiento['estado'];
                        if($estado =='DISPONIBLE'){
                            $img_route='../../ima/lib.jpg';
                        }
                        elseif($estado =='OCUPADO'){
                            $img_route='../../ima/ocu.jpg';
                        }
                ?>
                        <a href="reservar.php?id=<?php echo $id; ?>&asiento=<?php echo $n_asiento; ?>&salida=<?php echo $id_salida; ?>&estado=<?php echo $estado;?>" onclick="mostrar_res();" class="asiento" target="iframe" style="--number:'A.N°<?php echo $n_asiento; ?>'"><img src="<?php echo $img_route; ?>"></a>
                <?php
                    }
                ?>
            </div>
            	
        </div>
        <div class="iframeBox" id="iframe_res">
            <div class="btn-cerrar res" onclick="cerrar_res();"><i class="fa-solid fa-arrow-right"></i></div>
            <iframe src="" name="iframe" frameborder="0"></iframe>
        </div>        
        <div class="iframeBox" id="iframe_pasajeros">
            <div class="btn-cerrar pas" onclick="mostrar_pas();"><i class="fa-solid fa-xmark"></i></div>
            <iframe src="" name="iframe-pasajeros" frameborder="0"></iframe>
        </div>
    </main>
    <script src="../../js/script.js"></script>
</body>
</html>
