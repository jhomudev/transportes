<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transportes</title>
    <link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<?php
		$id_salida=$_GET["salida"];	
	?>
    <!-- Body -->
    <main>
        <h2>Control de Pasajeros</h2>
		<h3>Salida <?php echo $id_salida?></h3><hr>
		<a href="l_pasajeros.php?salida=<?php echo $id_salida; ?>">Lista de pasajeros</a>
        <div id="carta">
            <table class="table table-bordered">
                <tbody>
<?php
include 'conexion.php';
    $var_consulta= "select * from control where ids=$id_salida";
    $var_resultado = $conexion->query($var_consulta);
	while ($row=$var_resultado->fetch_array())	
{
	$cod =$row['cod'];
	$ids =$row['ids'];
	$mon =$row['mon'];
	$c1 = $row['c1'];
	$c2 = $row['c2'];
	$c3 = $row['c3'];
	$c4 = $row['c4'];
	$c5 = $row['c5'];
	$c6 = $row['c6'];
	$ocu='ocupado';
	$libre='libre';
	
	echo "<tr>";		
	echo "<td valign='middle' align='center'>";	
	if ($c1==1) { echo "<a href='atencion.php?id=$cod&id2=$ids&id3=$mon&id4=1&id5=$ocu'> 
						<img src='../ima/ocu.jpg'> </a>";} 
		   else { echo "<a href='atencion.php?id=$cod&id2=$ids&id3=$mon&id4=1&id5=$libre'> 
						<img src='../ima/lib.jpg'> </a>";}  
	echo"</td>";
	echo "<td valign='middle' align='center'>";	
	if ($c2==1) { echo "<a href='atencion.php?id=$cod&id2=$ids&id3=$mon&id4=2&id5=$ocu'> 
						<img src='../ima/ocu.jpg'> </a>";} 
	       else { echo "<a href='atencion.php?id=$cod&id2=$ids&id3=$mon&id4=2&id5=$libre''> 
						<img src='../ima/lib.jpg'> </a>";}
	echo"</td>";
 	echo "<td valign='middle' align='center'>";	
	if ($c3==1) { echo "<a href='atencion.php?id=$cod&id2=$ids&id3=$mon&id4=3&id5=$ocu'> 
						<img src='../ima/ocu.jpg'> </a>";} 
		   else { echo "<a href='atencion.php?id=$cod&id2=$ids&id3=$mon&id4=3&id5=$libre'> 
						<img src='../ima/lib.jpg'> </a>";}
	echo"</td>";	
	echo "</tr> ";  

	echo "<tr>";		
	echo "<td valign='middle' align='center'>";	
	if ($c4==1) { echo "<a href='atencion.php?id=4&id2=$ids&id3=$mon&id4=4&id5=$ocu'> <img src='../ima/ocu.jpg'> </a>";} 
		   else { echo "<a href='atencion.php?id=4&id2=$ids&id3=$mon&id4=4&id5=$libre'> <img src='../ima/lib.jpg'> </a>";}  
	echo"</td>";
	echo "<td valign='middle' align='center'>";	
	if ($c5==1) { echo "<a href='atencion.php?id=5&id2=$ids&id3=$mon&id4=5&id5=$ocu'> <img src='../ima/ocu.jpg'> </a>";} 
	       else { echo "<a href='atencion.php?id=5&id2=$ids&id3=$mon&id4=5&id5=$libre'> <img src='../ima/lib.jpg'> </a>";}
	echo"</td>";
	echo "<td valign='middle' align='center'>";	
	if ($c6==1) { echo "<a href='atencion.php?id=6&id2=$ids&id3=$mon&id4=6&id5=$ocu'> <img src='../ima/ocu.jpg'> </a>";} 
		   else { echo "<a href='atencion.php?id=6&id2=$ids&id3=$mon&id4=6&id5=$libre'> <img src='../ima/lib.jpg'> </a>";}
	echo"</td>";	
	echo "</tr> "; 

	
	
}
?>
                </tbody>
            </table>
			<a href="salidas.php">Atras</a>
        </div>
    </main>
</body>
</html>




