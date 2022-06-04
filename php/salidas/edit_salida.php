<?php
    ob_start();
    include "../conexion.php";
    $salida=$_GET['salida'];
    $res="Select * from salidas where id_salida=$salida";
    $vres = $conexion->query($res);
    while ($row=$vres->fetch_array()){	  
        $ids = $row['id_salida']; 
        $mon = $row['monto']; 
        $fecha = $row['fecha']; 
        $hora = $row['hora']; 
        $origen = $row['origen']; 
        $destino = $row['destino']; 
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../../styles/style.css">
    <title>Document</title>
    <style>
        body{
            background: transparent !important;
        }
    </style>
</head>
<body>
    <h3>Editar Salida</h3>
    <form action="#" method="post" id="form-add">
        <div class="mb-3">
		    <label for="codigo">Id. Salida</label>
		    <input type="text" class="form-control" readonly name="tx_salida" value="<?php echo $salida;?>" maxlength="4" minlength="4" onkeypress="valide(event)" required/>
		</div>	
		<div class="mb-3">
		    <label for="codigo">Origen</label>
		    <input type="text" class="form-control" name="tx_origen" value="<?php echo $origen;?>" onkeyup="javascript:this.value=this.value.toUpperCase();" required/>
		</div>	
		<div class="mb-3">
		    <label for="codigo">Destino</label>
		    <input type="text" class="form-control" name="tx_destino" value="<?php echo $destino;?>" onkeyup="javascript:this.value=this.value.toUpperCase();" required/>
		</div>	
		<div class="mb-3">
		    <label for="codigo">Fecha</label>
		    <input type="date" class="form-control" name="tx_fecha" value="<?php echo $fecha;?>" required/>
		</div>	
		<div class="mb-3">
		    <label for="codigo">Hora</label>
		    <input type="time" class="form-control" name="tx_hora" value="<?php echo $hora;?>" required/>
		</div>	
		<div class="mb-3">
		    <label for="codigo">Monto S/</label>
		    <input type="text" class="form-control" name="tx_monto" value="<?php echo $mon;?>" onkeypress="valide(event)" required />
		</div>	
        <?php
            if(!empty($_POST['tx_salida'])=="")
            {}
            else
            {
                $salida_n=$_POST["tx_salida"];
                $origen_n=$_POST["tx_origen"];
                $destino_n=$_POST["tx_destino"];
                $fecha_n=$_POST["tx_fecha"];
                $hora_n=$_POST["tx_hora"];
                $monto_n=$_POST["tx_monto"];
                //insertar salida
                $sql="UPDATE salidas SET id_salida=$salida_n, origen='$origen_n', destino='$destino_n', fecha='$fecha_n', hora='$hora_n', monto=$monto_n WHERE id_salida=$salida";
                $sql_re=$conexion->query($sql);            
                
                try{
                    echo'
                    <div class="alert alert-success" role="alert">
                    <i>Listo.</i> Los datos se modificaron correctamente. Actualize la página.
                    </div> 
                    ';
                }
                catch (Exception $e){
                    echo'
                    <div class="alert alert-danger" role="alert">
                    <i>Error.</i> Los datos se no se modificaron.
                    </div> 
                    ';
                }  
            }  
        ?>
        <input type="submit" value="Confirmar" class="btn btn-primary">
    </form>
</body>
</html>