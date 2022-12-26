<?php 
   if(isset($_POST)){
      require "./../conexion.php";
      $objConexion=new Conexion();
      $sql="SELECT * FROM vehiculos";
      $vehiculos=$objConexion->consultar($sql);
      $data="";
      foreach($vehiculos as $vehiculo){
         $estado=$vehiculo["estado"]== 1 ?"ACTIVO": "INACTIVO";
         $data.='
         <tr>
            <td>'.$vehiculo["n_placa"].'</td>
            <td>'.$vehiculo["n_vin"].'</td>
            <td>'.$vehiculo["marca"].'</td>
            <td>'.$vehiculo["categoria"].'</td>
            <td>'.$vehiculo["total_asientos"].'</td>
            <td>'.$estado.'</td>
            <td>
               <button class="table_btn" style="--clr:#4f8dd5;" onclick="editV('.$vehiculo["cod"].')"  title="Editar"><i class="uil uil-edit"></i></button>
               <button class="table_btn" style="--clr:#f7616d;" onclick="deleteV('.$vehiculo["cod"].')" title="Eliminar"><i class="uil uil-trash-alt"></i></button>
            </td>
         </tr> 
         ';
      }
      echo $data;   
   }
?>