<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <table class="table table-striped text-center" id="tabla">
        <thead class="table-dark">
                <th>Salida</th>
                <th>Asiento</th>
                <th>DNI</th>
                <th>Cliente</th>
                <th>Fecha de Emisión</th>
                <th>Monto S/</th>
        </thead>
        <tbody id="body-table">
        <?php
            include "../conexion.php";
            $id_salida=$_GET["salida"];
            $salida="";
            //$valor=;
            $sql="SELECT c.nombres,c.apellidos,c.dni,r.id_salida,r.asiento,r.fec_emi,r.monto from con_pasajero r inner join clientes c on r.dni = c.dni where r.id_salida=$id_salida";
            $sql_res=$conexion->query($sql);
            if($sql_res -> num_rows > 0){
                while($row = $sql_res->fetch_assoc()){
                    $salida.='
                        <tr>
                        <td>'.$row['id_salida'].'</td>
                        <td>'.$row['asiento'].'</td>
                        <td>'.$row['dni'].'</td>
                        <td>'.$row['nombres'].' '.$row['apellidos'].'</td>
                        <td>'.$row['fec_emi'].'</td>
                        <td> S/'.$row['monto'].'</td>
                        </tr>
                    ';
                }
            }
            else{
                $salida.='
                <tr>
                    <td colspan=6>
                        <div class="alert alert-warning" role="alert">
                        <i>No hay reservas</i> a la salida <strong>"'.$id_salida.'"</strong>  
                        </div> 
                    </td>
                </tr>
                ';
            }
        
            echo $salida;
        ?>
        </tbody>
    </table>
</body>
</html>
