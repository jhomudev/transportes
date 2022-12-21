<?php 
   if(isset($_POST)){
      require "./../conexion.php";
      $objConexion=new Conexion();
      $sql="SELECT * FROM salidas ORDER BY fecha ASC";
      $salidas=$objConexion->consultar($sql);
      $data="";
      date_default_timezone_set('America/Lima');
      $fechaNow=date("Y-m-d");
      foreach($salidas as $salida){
         if($fechaNow>$salida["fecha"]) $estadoS=["paso","Salida pasada"];
         else if($fechaNow==$salida["fecha"]) $estadoS=["en_curso","Salida en curso hoy"];
         else $estadoS=["pendiente","Salida pendiente"];

         $data.='
         <tr state="'.$estadoS[0].'" title="'.$estadoS[1].'">
            <td>'.$salida["origen"].'</td>
            <td>'.$salida["destino"].'</td>
            <td>'.date("d-m-Y", strtotime($salida["fecha"])).'</td>
            <td>'.$salida["hora"].'</td>
            <td>S/ '.$salida["monto"].'</td>
            <td>
               <button class="table_btn" style="--clr:#67e669;" onclick="control('.$salida["id"].')" title="Administrar"><i class="uil uil-user-check"></i></button>
               <button class="table_btn" style="--clr:#4f8dd5;" onclick="editar('.$salida["id"].')"  title="Editar"><i class="uil uil-edit"></i></button>
               <button class="table_btn" style="--clr:#f7616d;" onclick="eliminar('.$salida["id"].')" title="Eliminar"><i class="uil uil-trash-alt"></i></button>
            </td>
         </tr> 
         ';
      }
      echo $data;   
   }
?>