<?php
    include "../conexion.php";
    $salida="";
    //$valor=;
    $sql="SELECT * from clientes";
    if(isset($_POST['consulta'])){
        $q=$_POST['consulta']; 
        $sql="SELECT * from clientes where nombres like '%".$q."%'  OR apellidos like '%".$q."%'";
    }
    $sql_res=$conexion->query($sql);
    if($sql_res -> num_rows > 0){
        while($row = $sql_res->fetch_assoc()){
            if($row['sexo'] =='F'){
                $sexo='FEMENINO';
            }
            else{
                $sexo='MASCULINO';
            }
            $salida.='
                <tr>
                <td>'.$row['dni'].'</td>
                <td>'.$row['nombres'].'</td>
                <td>'.$row['apellidos'].'</td>
                <td>'.$sexo.'</td>
                </tr>
            ';
        }
    }
    else{
        $salida.='
        <tr>
            <td colspan=4>
                <div class="alert alert-warning" role="alert">
                <i>No hay registros</i> que se asemejen a <strong>"'.$q.'"</strong>  
                </div> 
            </td>
        </tr>
        ';
    }

    echo $salida;
?>