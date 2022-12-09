<?php
    include_once "../conexion.php";
    $objConexion = new Conexion();
    $data="";
    $sql="SELECT c.nombres,c.apellidos,c.dni,r.id_salida,r.asiento,r.fec_emi,r.monto from reservas r inner join clientes c on r.dni = c.dni";
    if(isset($_POST['consulta'])){
        $q=$_POST['consulta']; 
        $sql="SELECT c.nombres,c.apellidos,c.dni,r.id_salida,r.asiento,r.fec_emi,r.monto from reservas r inner join clientes c on r.dni = c.dni where CONCAT(c.nombres,' ', c.apellidos) like '%".$q."%' or r.id_salida like '%".$q."%'";
    }
    $salidaObj=$objConexion->consultar($sql);
    if($salidaObj){
        foreach($salidaObj as $salida){
            $data.='
                <tr>
                <td>'.$salida['id_salida'].'</td>
                <td>'.$salida['asiento'].'</td>
                <td>'.$salida['dni'].'</td>
                <td class="text-left">'.$salida['nombres'].' '.$salida['apellidos'].'</td>
                <td>'.$salida['fec_emi'].'</td>
                <td>S/ '.$salida['monto'].'</td>
                </tr>
            ';
        }
    }
    else{
        $data.='
        <tr>
            <td colspan=6>
                <div class="alert alert-warning" role="alert">
                <i>No hay registros</i> relacionados a <strong>"'.$q.'"</strong>  
                </div> 
            </td>
        </tr>
        ';
    }

    echo $data;
?>
