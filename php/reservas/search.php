<?php
    include "../conexion.php";
    $salida="";
    //$valor=;
    $sql="SELECT c.nombres,c.apellidos,c.dni,r.id_salida,r.asiento,r.fec_emi,r.monto from con_pasajero r inner join clientes c on r.dni = c.dni";
    if(isset($_POST['consulta'])){
        $q=$_POST['consulta']; 
        $sql="SELECT c.nombres,c.apellidos,c.dni,r.id_salida,r.asiento,r.fec_emi,r.monto from con_pasajero r inner join clientes c on r.dni = c.dni where CONCAT(c.nombres,' ', c.apellidos) like '%".$q."%' or r.id_salida like '%".$q."%'";
    }
    $sql_res=$conexion->query($sql);
    if($sql_res -> num_rows > 0){
        while($row = $sql_res->fetch_assoc()){
            $salida.='
                <tr>
                <td>'.$row['id_salida'].'</td>
                <td>'.$row['asiento'].'</td>
                <td>'.$row['dni'].'</td>
                <td class="text-left">'.$row['nombres'].' '.$row['apellidos'].'</td>
                <td>'.$row['fec_emi'].'</td>
                <td>S/ '.$row['monto'].'</td>
                </tr>
            ';
        }
    }
    else{
        $salida.='
        <tr>
            <td colspan=6>
                <div class="alert alert-warning" role="alert">
                <i>No hay registros</i> que se asemejen a <strong>"'.$q.'"</strong>  
                </div> 
            </td>
        </tr>
        ';
    }

    echo $salida;
?>
