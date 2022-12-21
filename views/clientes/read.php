<?php 
   if(isset($_POST)){
      require "./../conexion.php";
      $objConexion=new Conexion();

      $data="";

      if($_POST['keywords']==""){
         $sql="SELECT * FROM clientes";
         $clientes=$objConexion->consultar($sql);
         if(!$clientes){
            $data.='
               <tr>
                  <td colspan="4">
                     <div class="empty">
                        <lord-icon
                           src="https://cdn.lordicon.com/nlzvfogq.json"
                           trigger="hover"
                           style="width:250px;height:250px">
                        </lord-icon>
                        <p>Aun no hay clientes o pasajeros registrados.</p>
                     </div>
                  </td>
               </tr> 
            ';
         }else{
            foreach($clientes as $cliente){
               $data.='
               <tr>
                  <td>'.$cliente["dni"].'</td>
                  <td>'.$cliente["nombres"].'</td>
                  <td>'.$cliente["apellidos"].'</td>
                  <td>'.$cliente["telefono"].'</td>
               </tr> 
               ';
            }
         }
      }
      else if(($_POST['keywords']!=="")){
         $keywords=$_POST["keywords"];
         $sql="SELECT * FROM clientes WHERE CONCAT(nombres,' ', apellidos) LIKE '%$keywords%' OR dni LIKE '%$keywords%'";
         $clientes=$objConexion->consultar($sql);
         if(!$clientes){
            $data.='
               <tr>
                  <td colspan="4">
                     <div class="empty">
                        <lord-icon
                           src="https://cdn.lordicon.com/nlzvfogq.json"
                           trigger="hover"
                           style="width:250px;height:250px">
                        </lord-icon>
                        <p>No hay registros relacionados a <strong>'.$keywords.'</strong></p>
                     </div>
                  </td>
               </tr> 
            ';
         }else{
            foreach($clientes as $cliente){
               $data.='
               <tr>
                  <td>'.$cliente["dni"].'</td>
                  <td>'.$cliente["nombres"].'</td>
                  <td>'.$cliente["apellidos"].'</td>
                  <td>'.$cliente["telefono"].'</td>
               </tr> 
               ';
            }
         }
      }
      echo $data;   
   }
?>