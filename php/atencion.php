<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transportes</title>
    <link rel="stylesheet" href="../styles/style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">		
</head>
<body>
		
<?php 	
	include 'conexion.php';
	$cod=$_GET['id'];
	$sali=$_GET['id2'];
	$mon=$_GET['id3'];
	$asi=$_GET['id4'];
	$ocu=$_GET['id5'];
	
	if ($ocu=='ocupado') { 
		echo "
			<div class='alert alert-danger' role='alert'>
  				<i>Asiento reservado.</i> Este asiento ya tiene propietario.
			</div> 
			<hr>
		"; 
		$var_consulta= "select * from con_pasajero where asiento=$asi and id_salida=$sali";
    	$var_resultado = $conexion->query($var_consulta);
		while ($row=$var_resultado->fetch_array()){
			$dni = $row['dni'];
			$ast = $row['asiento'];
			$mon = $row['monto'];
			echo "
			  Número de Salida = "; echo $sali."<br>
			Asiento =" .$ast ."<br>
			DNI     =" .$dni ."<br>
			"; 
			$res2="Select * from clientes where dni ='$dni'";
			$vres2 = $conexion->query($res2);
			while ($row2=$vres2->fetch_array()){
			$nom = $row2['nombres']; $ape = $row2['apellidos']; 	
			echo "Nombre  =" .$nom. " " .$ape."<br> 			
			Monto   =" .$mon ."<hr>
			<a href='control.php?salida=$sali'>Salir </a>
			";			 			
			}
		} 
	}
	else { 
		echo '
			<div class="alert alert-success" role="alert">
				<i>Asiento Libre.</i> Puede reservarlo
	    	</div>
		';		
		$ast = $asi;		
 ?> 
		<form method="post" name="form2" id="form2" action="#">
			<div class="form-row">
				 <div class="form-group col-md-1">
				   <label for="codigo">Num. Salida</label>
				   <input type="text" class="form-control" name="s1" id="s1"
				   value='<?php echo $sali; ?>' readonly />
				 </div>	
				 <div class="form-group col-md-1">
				   <label for="codigo">Monto a Pagar</label>
				   <input type="text" class="form-control" name="s2" id="s2" 
				   value='<?php echo $mon; ?>' readonly />
				 </div>	
				 <div class="form-group col-md-1">
				   <label for="codigo">Asiento a reservar</label>
				   <input type="text" class="form-control" name="s3" id="s3" 
				   value='<?php echo $asi; ?>' readonly />
				 </div>					 		 		 
			</div>
			<div class="form-row">
				<div class="form-group col-md-2">
				   <label for="codigo">DNI</label>
				   <input type="text" class="form-control" name="t1" id="t1" maxlength="8" placeholder="DNI del Pasajero" required>
				 </div>	
				<div class="form-group col-md-3">
				   <label for="Precio">Nombres</label>
				   <input type="text" class="form-control" name="t2" id="t2" placeholder="Nombres del Pasajero" required>
				 </div>				
				 <div class="form-group col-md-3">
				   <label for="Cantidad">Apellidos</label>
				   <input type="text" class="form-control" name="t3" id="t3" placeholder="Apellidos del pasajero" required>
				 </div>
				 <div class="form-group col-md-3">
				   <label for="Cantidad">Sexo</label>
				   <select class="form-control" name="t4" id="t4" required>
					   <option value="" selected disabled>Seleccione el sexo</option>
					   <option value="M">Masculino</option>
					   <option value="F">Femenino</option>
				   </select>
				 </div>
			</div>
<hr>
			 <input  type="submit" value="GUARDAR " name="aceptar" class="btn btn-primary">
			 
			  <a href="control.php?salida=<?php echo $sali?>" class="btn btn-primary"> Cancelar </a>

			 <!--php edit-->
<?php 
	if(!empty($_POST['t2'])=="")
    {}
    else
	{
	include 'conexion.php' ;
	
	$num=strtotime('now');
	$nsal=$_POST['s1'];
	$asi =$_POST['s3'];
	$dni =$_POST['t1'];
	$nombres =$_POST['t2'];
	$apes =$_POST['t3'];
	$sexo =$_POST['t4'];
	$fec = date("y-m-d");
	$mon =$_POST['s2'];

	//insertar cliente si aun no existe
	$sql_prod ="SELECT * FROM clientes where dni=$dni";  
    $result_prod = $conexion -> query($sql_prod);
    if ($result_prod -> num_rows > 0) {
	}
	else{
		$consulta="insert into clientes values($dni,'$nombres','$apes','$sexo')";
		$resultado= $conexion -> query($consulta);	
	}
	//insertar la reserva en tabla con_pasajero
	$var_consulta="insert into con_pasajero (id_cod,id_salida,asiento,dni,fec_emi,monto) 
	values ('$num','$nsal','$asi','$dni','$fec','$mon')";
	$result= $conexion -> query($var_consulta);
	
	//actualizacion de asiento libre a ocupado
	$insert=("update control set c".$asi."=1 where ids=".$sali."");
	$registros=$conexion -> query($insert);				
	//regresar al menu de pasajeros
	echo "<meta http-equiv='refresh' content='0;URL=control.php?salida=$sali' target='_top'/>";
	}
?>	
<?php
}
?>
</form>
</body>
</html>




