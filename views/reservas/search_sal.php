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
            include_once"../conexion.php";
            $id_salida=$_GET["salida"];
            $objConexion=new Conexion();
            $data="";
            //$valor=;
            $sql="SELECT c.nombres,c.apellidos,c.dni,r.id_salida,r.asiento,r.fec_emi,r.monto from reservas r inner join clientes c on r.dni = c.dni where r.id_salida=$id_salida";
            $salidasObj=$objConexion->consultar($ql);
            if($salidasObj){
                foreach($salidasObj as $salida){
                    $data.='
                        <tr>
                        <td>'.$salida['id_salida'].'</td>
                        <td>'.$salida['asiento'].'</td>
                        <td>'.$salida['dni'].'</td>
                        <td>'.$salida['nombres'].' '.$salida['apellidos'].'</td>
                        <td>'.$salida['fec_emi'].'</td>
                        <td> S/'.$salida['monto'].'</td>
                        </tr>
                    ';
                }
            }
            else{
                $data.='
                <tr>
                    <td colspan=6>
                        <div class="alert alert-warning" role="alert">
                        <i>No hay reservas</i> a la salida <strong>"'.$id_salida.'"</strong>  
                        </div> 
                    </td>
                </tr>
                ';
            }
        
            echo $data;
        ?>
        </tbody>
    </table>
</body>
</html>
