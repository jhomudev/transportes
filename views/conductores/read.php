<?php 
   if(isset($_POST)){
      require "./../conexion.php";
      $objConexion=new Conexion();

      $sql="SELECT * FROM conductores";
      $conductores=$objConexion->consultar($sql);
      $data="";
      foreach($conductores as $conductor){
         $estado=$conductor["estado"]==1?"ACTIVO":"INACTIVO";
         $data.='
         <tr>
            <td>'.$conductor["dni"].'</td>
            <td>'.$conductor["nombres"].' '.$conductor["apellidos"].'</td>
            <td>'.$conductor["licencia"].'</td>
            <td>'.$conductor["telefono"].'</td>
            <td>'.$estado.'</td>
            <td>
               <button class="table_btn" style="--clr:#4f8dd5;" onclick="editC('.$conductor["id"].')"  title="Editar"><i class="uil uil-edit"></i></button>
               <button class="table_btn" style="--clr:#f7616d;" onclick="deleteC('.$conductor["id"].')" title="Eliminar"><i class="uil uil-trash-alt"></i></button>
            </td>
         </tr> 
         ';
      }
      echo $data;   
   }
?>