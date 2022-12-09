<?php 
    include'../conexion.php';
    $objConexion=new Conexion();

    $id_reserva=$_GET["id_reserva"];
    $var_consulta= "SELECT * FROM reservas WHERE id_cod=$id_reserva";
    $pasajero = $objConexion->consultarOne($var_consulta);
    $dni =$pasajero['dni'];
    $n_asiento =$pasajero['asiento'];
    $id_salida =$pasajero['id_salida'];
    
    //datos del pasajero
    $var_consulta= "SELECT * FROM clientes WHERE dni=$dni";
    $pasajero = $objConexion->consultarOne($var_consulta);
    $nombres =$pasajero['nombres'];
    $apellidos =$pasajero['apellidos'];
    $sexo =$pasajero['sexo'];
    
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transportes</title>
	<script src="https://kit.fontawesome.com/a8527aea5d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../styles/style.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
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
    <form method="post" name="form2" id="form2" action="#">
		<div class="form-row">
			<div class="mb-3">
			    <label for="codigo">Num. Salida</label>
			    <input type="text" class="form-control" name="s1" id="s1"
			    value='<?php echo $id_salida; ?>' readonly />
			 </div>	
			<div class="mb-3">
			    <label for="codigo">Asiento a reservar</label>
                <select class="form-control"  name="tx_asiento" id="s3" required>
                    <option value="" selected disabled>Solo se muestran los asientos disponibles</option>
                    <option value="<?php echo $n_asiento; ?>">Asiento N° <?php echo $n_asiento; ?> (Asiento elegido)</option>
                    <?php
                        //? todos los asientos disponibles de la salida
                        $var= "SELECT * FROM asientos WHERE estado='DISPONIBLE' AND id_salida=$id_salida";
                        $asientos = $objConexion->consultar($var);
                        foreach ($asientos as $asiento){
                            $asiento_dispo =$asiento['n_asiento'];
                            echo'
                                <option value="'.$asiento_dispo.'">Asiento N°'.$asiento_dispo.'</option>
                            ';
                        }
                    ?>
                </select>
			</div>					 		 		 
		</div>
		<div class="form-row">
			<div class="mb-3">
			   <label for="codigo">DNI</label>
			   <input type="text" class="form-control" name="tx_dni" value='<?php echo $dni; ?>' onkeypress="valide(event);" maxlength="8" placeholder="DNI del Pasajero" required>
			</div>	
			<div class="mb-3">
			   <label for="Precio">Nombres</label>
			   <input type="text" class="form-control" name="tx_nombres" value='<?php echo $nombres; ?>' onkeyup="javascript:this.value=this.value.toUpperCase();" placeholder="Nombres del Pasajero" required>
			 </div>				
			 <div class="mb-3">
			   <label for="Cantidad">Apellidos</label>
			   <input type="text" class="form-control" name="tx_apellidos" value='<?php echo $apellidos; ?>' onkeyup="javascript:this.value=this.value.toUpperCase();" placeholder="Apellidos del pasajero" required>
			 </div>
			 <div class="mb-3">
			   <label for="Cantidad">Sexo</label>
			   <select class="form-control" name="tx_sexo" required>
               <?php 
                    if($sexo=='M'){
                        echo'
                            <option value="" selected disabled>Seleccione el sexo</option>
                            <option value="M" selected="true">Masculino</option>
                            <option value="F">Femenino</option>
                        ';
                    }
                    else{
                        echo'
                        <option value="" selected disabled>Seleccione el sexo</option>
                        <option value="M">Masculino</option>
                        <option value="F" selected="true">Femenino</option>
                        ';
                    }
               ?>   
			   </select>
			 </div>
		</div>
		<hr>
		<input type="submit" value="GUARDAR " name="aceptar" class="btn btn-primary">
        <a href="l_pasajeros.php?salida=<?php echo $id_salida; ?>" class="btn btn-danger">Cancelar</a>
        <br><br>
        <?php 
            if(!empty($_POST['tx_nombres'])){
                $dni_n=$_POST['tx_dni'];
                $nombres_n=$_POST['tx_nombres'];
                $apellidos_n=$_POST['tx_apellidos'];
                $sexo_n=$_POST['tx_sexo'];
                $asiento_n=$_POST['tx_asiento'];
                //actualizando datos del pasajero
                $sql= "UPDATE clientes SET dni=$dni_n,nombres='$nombres_n',apellidos='$apellidos_n',sexo='$sexo_n' WHERE dni=$dni";
                //actualizando estado de asiento antiguo a disponible
                $sql_asi= "UPDATE asientos SET estado='DISPONIBLE' WHERE id_salida=$id_salida AND n_asiento=$n_asiento";
                //actualizando datos de la reserva en la tabla con_pasajero
                $sql_conp= "UPDATE reservas SET asiento=$asiento_n,dni=$dni_n WHERE id_salida=$id_salida AND asiento=$n_asiento";
                //actualizando el estado del nuevo asiento a ocupado
                $sql_ocu= "UPDATE asientos SET estado='OCUPADO' WHERE id_salida=$id_salida AND n_asiento=$asiento_n";
                try{
                    // ejecucion de los sql
                    $objConexion->ejecutar($sql);
                    $objConexion->ejecutar($sql_asi);
                    $objConexion->ejecutar($sql_ocu);
                    $objConexion->ejecutar($sql_conp);
                    echo'   
                        <div class="alert alert-success" role="alert">
                        <i>Listo.</i> Los datos se actualizaron correctamente. Actualize la página.
                        </div> 
                    ';
                }
                catch(Exception $e){
                    echo'   
                        <div class="alert alert-danger" role="alert">
                        <i>Error.</i> Alparecer ocurrió un error.
                        </div> 
                    ';
                }
                
            }
        ?>
    </form>
    <script src="../../js/script.js"></script>
</body>
</html>