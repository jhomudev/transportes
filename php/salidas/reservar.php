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
</head>
<body>		
<?php 	
	include '../conexion.php';
	$salida=$_GET['salida'];
	$estado=$_GET["estado"];	
	$id_asiento=$_GET["id"];
	$n_asiento=$_GET["asiento"];
	$var_consulta= "select * from salidas where id_salida=$salida";
    $var_resultado = $conexion->query($var_consulta);
	while ($row=$var_resultado->fetch_array()){	
		$monto = $row['monto'];
	}
	
	if ($estado=='OCUPADO') { 
		echo '
			<div class="alert alert-warning" role="alert">
  				<i>Asiento reservado.</i> Este asiento ya tiene propietario.
			</div> 
			<hr>
			<table class="table table-bordered text-center">
		'; 
		$var_consulta= "select cp.dni,c.nombres,c.apellidos from con_pasajero cp
		INNER JOIN clientes c ON cp.dni=c.dni
		where asiento=$n_asiento and id_salida=$salida";
    	$var_resultado = $conexion->query($var_consulta);
		while ($row=$var_resultado->fetch_array()){
			$dni = $row['dni'];
			$nombres = $row['nombres'];
			$apellidos = $row['apellidos'];
			echo'
				<tr>
					<td class="bg-info text-light">N° Salida</td><td>'.$salida.'</td>
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
					<td class="bg-info text-light">Monto a Pagar</td><td>'.$monto.'</td>
				</tr>
			</table>
			&nbsp;&nbsp;<a class="btn btn-danger" href="eli_reser.php?id='.$id_asiento.'&salida='.$salida.'&n_asiento='.$n_asiento.'"><i class="fa-solid fa-trash-can"></i> Eliminar</a>
			<a class="btn btn-info" href="edit_salida.php?dni='.$dni.'&salida='.$salida.'&n_asiento='.$n_asiento.'"><i class="fa-solid fa-pen-to-square"></i> Editar</a>
			<a class="btn btn-success" target="_blank" href="boleta.php?dni='.$dni.'&salida='.$salida.'&n_asiento='.$n_asiento.'"><i class="fa-solid fa-ticket"></i> Imprimir boleta</a>
			';
		} 
	}
	else { 
		echo '
			<div class="alert alert-success" role="alert">
				<i>Asiento Libre.</i> Puede reservarlo
	    	</div>
		';				
?> 
		<form method="post" name="form2" id="form2" action="#">
			<div class="form-row">
				 <div class="mb-3">
				   <label for="codigo">Num. Salida</label>
				   <input type="text" class="form-control" name="s1" id="s1"
				   value='<?php echo $salida; ?>' readonly />
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
				if(!empty($_POST['tx_nombres'])=="")
    			{}
    			else
				{
					$id_cod=strtotime('now');
					$dni=$_POST['tx_dni'];
					$nombres=$_POST['tx_nombres'];
					$apellidos=$_POST['tx_apellidos'];
					$sexo=$_POST['tx_sexo'];
					$fecha= date("y-m-d");
					//insertar cliente si aun no existe
					$sql_prod ="SELECT * FROM clientes where dni=$dni";  
    				$result_prod = $conexion -> query($sql_prod);
    				if ($result_prod -> num_rows > 0) {
					}
					else{
						$consulta="insert into clientes values($dni,'$nombres','$apellidos','$sexo')";
						$resultado= $conexion -> query($consulta);	
					}
					//insertar la reserva en tabla con_pasajero
					$var_consulta="insert into con_pasajero(id_cod,id_salida,asiento,dni,fec_emi,monto) 
					values ('$id_cod','$salida','$n_asiento','$dni','$fecha','$monto')";
					$result= $conexion -> query($var_consulta);

					//actualizacion de asiento libre a ocupado
					$insert=("update asientos set estado='OCUPADO' where id=$id_asiento");
					if($registros=$conexion -> query($insert))	{
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