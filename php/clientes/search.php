<?php
    include_once "../conexion.php";
    $objConexion = new Conexion();
    $data="";
    $sql="SELECT * from clientes";
    if(isset($_POST['consulta'])){
        $q=$_POST['consulta']; 
        $sql="SELECT * from clientes where CONCAT(nombres,' ', apellidos) like '%".$q."%'";
    }
    $clientesObj=$objConexion->consultar($sql);
    if($clientesObj){
        foreach($clientesObj as $cliente){
            $sexo=$cliente['sexo']=="F" ? 'FEMENINO' : 'MASCULINO';
            $data.='
                <tr>
                <td>'.$cliente['dni'].'</td>
                <td>'.$cliente['nombres'].'</td>
                <td>'.$cliente['apellidos'].'</td>
                <td>'.$sexo.'</td>
                </tr>
            ';
        }
    }
    else{
        $data.='
        <tr>
            <td colspan=4>
                <div class="alert alert-warning" role="alert">
                <i>No hay registros</i> relacionados a <strong>"'.$q.'"</strong>  
                </div> 
            </td>
        </tr>
        ';
    }

    echo $data;
?>