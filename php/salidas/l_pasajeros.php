<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/a8527aea5d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../styles/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Pasajeros</title>
    <style>
        *{
            box-sizing: border-box;
            transition: all 0.3s;
        }
        a{
            position: relative;
        }
        .btn.btn-outline-danger:before{
            content:'';
            width: 0;
            height: 0;
            padding: 3px 5px;
            position: absolute;
            top: -25px;
            left: 0;
            border-radius: 3px;
        }
        .btn.btn-outline-danger:hover::before{
            content:'Eliminar';
            width: 90px;
            height: auto;
            padding: 3px 5px;
            position: absolute;
            top: -25px;
            left: -100%;
            background: white;
            border: 1px solid red;
            border-radius: 3px;
            color:red;
            z-index: 100;
        }
        .btn.btn-outline-primary:before{
            content:'';
            width: 0;
            height: 0;
            padding: 3px 5px;
            position: absolute;
            top: -25px;
            left: 0;
            border-radius: 3px;
        }
        .btn.btn-outline-primary:hover::before{
            content:'Editar';
            width: 90px;
            height: auto;
            padding: 3px 5px;
            position: absolute;
            top: -25px;
            left: -100%;
            background: white;
            border: 1px solid blue;
            border-radius: 3px;
            color:blue;
            z-index: 100;
        }
        .btn.btn-outline-success:before{
            content:'';
            width: 0;
            height: 0;
            padding: 3px 5px;
            position: absolute;
            top: -25px;
            left: 0;
            border-radius: 3px;
        }
        .btn.btn-outline-success:hover::before{
            content:'Boleta';
            width: 90px;
            height: auto;
            padding: 3px 5px;
            position: absolute;
            top: -25px;
            left: -100%;
            background: white;
            border: 1px solid green;
            border-radius: 3px;
            color:green;
            z-index: 100;
        }
    </style>
</head>
<body>
    <h3>Pasajeros</h3>
    <table class="table table-striped text-center">
        <thead>
            <tr>
            <th>DNI CLIENTE</th>
            <th>NOMBRES Y APELLIDOS</th>
            <th>ASIENTO</th>
            <th>OPCIONES</th>
            </tr>
        </thead>        
        <?php
            include '../conexion.php';
            $salida=$_GET['salida'];
            $res="Select p.dni,p.asiento,c.nombres,c.apellidos from 
            con_pasajero p inner join clientes c on c.dni = p.dni
            where id_salida=$salida";
        	$vres = $conexion->query($res);
            if ($vres -> num_rows > 0) {
        	    while ($row=$vres->fetch_array()){	  
                    $dni = $row['dni']; 
                    $asiento = $row['asiento']; 
                    $nombres = $row['nombres'].' '.$row['apellidos']; 
        	    	echo '
                        <tr>
                            <td>'.$dni.'</td>
                            <td>'.$nombres.'</td>
                            <td>'.$asiento.'</td>
                            <td>
                                <a class="btn btn-outline-danger" href="eli_reser.php?id=&salida='.$salida.'&n_asiento='.$asiento.'" ><i class="fa-solid fa-trash"></i></a>
                                <a class="btn btn-outline-primary" href="edit_reser.php?dni='.$dni.'&salida='.$salida.'&n_asiento='.$asiento.'"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a class="btn btn-outline-success" target="_blank" href="boleta.php?dni='.$dni.'&salida='.$salida.'&n_asiento='.$asiento.'"><i class="fa-solid fa-ticket"></i></a>
                            </td>
                        </tr>
                    '; 		
                }	
            }
            else{
                echo "
                    <tr>
                        <td colspan='4'>
                            <div class='alert alert-warning' role='alert'>
                            <i>Aún no hay reservas. Todos los asientos estan libres.</i>
                            </div> 
                        </td>
                    </tr>
                "; 	
            }
        ?>
    </table>
</body>
</html>
