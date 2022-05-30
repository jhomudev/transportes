<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Salidas</title>
</head>
<body>
    <h3>SALIDAS</h3>
    <table class="table table-striped text-center">
        <thead>
            <tr>
                <th scope="col">ID SALIDA</th>
                <th scope="col">MONTO</th>
                <th scope="col">FECHA</th>
                <th scope="col">HORA</th>
                <th scope="col">ORIGEN</th>
                <th scope="col">DESTINO</th>
            </tr>
        </thead>
        <?php
            include 'conexion.php';
            $res="Select c.ids,c.mon,s.origen,s.destino,s.fecha,s.hora from control c, salidas s
            where c.ids=s.id_salida";
        	$vres = $conexion->query($res);
        	while ($row=$vres->fetch_array()){	  
                $ids = $row['ids']; 
                $mon = $row['mon']; 
                $fecha = $row['fecha']; 
                $hora = $row['hora']; 
                $origen = $row['origen']; 
                $destino = $row['destino']; 
        		echo '
                    <tr>
                        <td><a href="control.php?salida='.$ids.'">'.$ids.'</a></td>
                        <td>'.$mon.'</td>
                        <td>'.$fecha.'</td>
                        <td>'.$hora.'</td>
                        <td>'.$origen.'</td>
                        <td>'.$destino.'</td>
                    </tr>
                '; 		
            }	
        ?>
    </table>
</body>
</html>
