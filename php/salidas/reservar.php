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
		@media screen and (max-width: 393px) {
            *{
                font-size:10px;
            }
        }
		@media screen and (max-width: 715px) {
			body{
                padding: 20px 20px;
            }
        }
	</style>
</head>
<body>		
<?php 	
	include_once '../conexion.php';
	$objConexion=new conexion();

	$id_salida=$_GET['salida'];
	$estado=$_GET["estado"];	
	$id_asiento=$_GET["id"];
	$n_asiento=$_GET["asiento"];
	
	$sql= "SELECT * FROM salidas WHERE id_salida=$id_salida";
   $salida=$objConexion->consultarOne($sql);
	$monto=$salida['monto'];
	
	if ($estado=='OCUPADO') { 
		$var_consulta= "SELECT r.id_cod,r.dni,r.monto,c.nombres,c.apellidos FROM reservas r
		INNER JOIN clientes c ON r.dni=c.dni
		WHERE r.asiento=$n_asiento AND r.id_salida=$id_salida";
    	$reserva=$objConexion->consultarOne($var_consulta);
		// TABLA CONLOS DATOS DE LA RESERVA
		$dni = $reserva['dni'];
		$nombres = $reserva['nombres'];
		$apellidos = $reserva['apellidos'];
		$id_reserva = $reserva['id_cod'];
		echo '
			<div class="alert alert-warning" role="alert">
				<i>Asiento reservado.</i> Este asiento ya tiene propietario.
			</div> 
			<hr>
			<table class="table table-bordered text-center">
				<tr>
					<td class="bg-info text-light">N° Salida</td><td>'.$id_salida.'</td>
				</tr>
				<tr>
					<td class="bg-info text-light">N° Asiento</td><td>'.$n_asiento.'</td>
				</tr>
				<tr>
					<td class="bg-info text-light">DNI Cliente</td><td>'.$dni.'</td>
				</tr>
				<tr>
					<td class="bg-info text-light">Nombres y Apellidos</td><td>'.$nombres.' '.$apellidos.'</td>
				</tr>
				<tr>
					<td class="bg-info text-light">Monto a Pagar</td><td>S/ '.$monto.'</td>
				</tr>
			</table>
			&nbsp;&nbsp;<a class="btn btn-danger" href="eli_reser.php?id_reserva='.$id_reserva.'"><i class="fa-solid fa-trash-can"></i> Eliminar</a>
			<a class="btn btn-info" href="edit_reser.php?id_reserva='.$id_reserva.'"><i class="fa-solid fa-pen-to-square"></i> Editar</a>
			<a class="btn btn-success" target="_blank" href="boleta.php?id_reserva='.$id_reserva.'"><i class="fa-solid fa-ticket"></i> Boleta</a>
		';
		
	}
	else { 			
?> 
		<div class="alert alert-success" role="alert">
			<i>Asiento Libre.</i> Puede reservarlo
		</div>
		<form method="post" name="form2" id="form2" action="#">
			<div class="form-row">
				 <div class="mb-3">
				   <label for="codigo">Num. Salida</label>
				   <input type="text" class="form-control" name="s1" id="s1"
				   value='<?php echo $id_salida; ?>' readonly />
				 </div>	
				 <div class="mb-3">
				   <label for="codigo">Monto a Pagar</label>
				   <input type="text" class="form-control" name="s2" id="s2" 
				   value='<?php echo $monto; ?>' readonly />
				 </div>	
				 <div class="mb-3">
				   <label for="codigo">Asiento a reservar</label>
				   <input type="text" class="form-control" name="s3" id="s3" 
				   value='<?php echo $n_asiento; ?>' readonly />
				 </div>					 		 		 
			</div>
			<div class="form-row">
				<div class="mb-3">
				   <label for="codigo">DNI</label>
				   <input type="text" class="form-control" name="tx_dni" onkeypress="valide(event);" maxlength="8" placeholder="DNI del Pasajero" required>
				 </div>	
				<div class="mb-3">
				   <label for="Precio">Nombres</label>
				   <input type="text" class="form-control" name="tx_nombres" onkeyup="javascript:this.value=this.value.toUpperCase();" placeholder="Nombres del Pasajero" required>
				 </div>				
				 <div class="mb-3">
				   <label for="Cantidad">Apellidos</label>
				   <input type="text" class="form-control" name="tx_apellidos" onkeyup="javascript:this.value=this.value.toUpperCase();" placeholder="Apellidos del pasajero" required>
				 </div>
				 <div class="mb-3">
				   <label for="Cantidad">Sexo</label>
				   <select class="form-control" name="tx_sexo" required>
					   <option value="" selected disabled>Seleccione el sexo</option>
					   <option value="M">Masculino</option>
					   <option value="F">Femenino</option>
				   </select>
				 </div>
			</div>
			<hr>
			<input  type="submit" value="GUARDAR " name="aceptar" class="btn btn-primary">
			<br><br>
			<?php 
				if(!empty($_POST['tx_nombres']))
				{
					$id_cod=strtotime('now');
					$dni=$_POST['tx_dni'];
					$nombres=$_POST['tx_nombres'];
					$apellidos=$_POST['tx_apellidos'];
					$sexo=$_POST['tx_sexo'];
					$fecha= date("y-m-d");
					//insertar cliente si aun no existe
					$sql_prod ="SELECT * FROM clientes WHERE dni=$dni";  
    				$cliente=$objConexion->consultarOne($sql_prod);
    				if (!$cliente) {
						$consulta="INSERT INTO clientes VALUES($dni,'$nombres','$apellidos','$sexo')";
						$objConexion -> ejecutar($consulta);	
					}
					//insertar la reserva en tabla con_pasajero
					$var_consulta="INSERT INTO reservas(id_cod,id_salida,asiento,dni,fec_emi,monto) 
					VALUES ('$id_cod','$id_salida','$n_asiento','$dni','$fecha','$monto')";
					$objConexion -> ejecutar($var_consulta);

					//actualizacion de asiento libre a ocupado
					$sql_insert=("UPDATE asientos SET estado='OCUPADO' WHERE id=$id_asiento");
					if($objConexion -> ejecutar($sql_insert))	{
						echo'
							<div class="alert alert-success" role="alert">
							<i>Asiento reservado correctamente. Actualize la página.</i>
				  			</div> 
						';
					}	
					else{
						echo'
							<div class="alert alert-danger" role="alert">
							<i>Al parecer ocurrió un error.</i>
				  			</div> 
						';
					}	

				}
			}
			?>	
		</form>
		<script src="../../js/script.js"></script>
</body>
</html>