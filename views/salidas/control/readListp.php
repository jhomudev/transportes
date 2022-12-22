<?php 
   require "../../conexion.php";
   $objConexion=new Conexion();

   if($_POST){
      $id_salida=$_POST["id"];
      $sql="SELECT cod,id from salidas WHERE id = $id_salida";
      $salida=$objConexion->consultarOne($sql);

      // datos del cliente usando join
      $sql_join="SELECT c.nombres,c.apellidos,r.id,r.asiento,r.dni,r.fecha_emi,r.total,a.n_asiento FROM reservas r 
      INNER JOIN asientos a ON r.asiento = a.id
      INNER JOIN clientes c ON c.dni=r.dni WHERE a.cod_salida = '".$salida["cod"]."' ORDER BY a.n_asiento ASC";
      $reservas=$objConexion->consultar($sql_join);
      if(!$reservas){
         echo '
            <tr>
               <td colspan="6">
                  <div class="empty">
                     <lord-icon
                        src="https://cdn.lordicon.com/nlzvfogq.json"
                        trigger="hover"
                        style="width:250px;height:250px">
                     </lord-icon>
                     <p>Aun no hay reservas en esta salida.</p>
                  </div>
               </td>
            </tr> 
         ';
      }else{
         foreach($reservas as $reserva){
?>
            <tr>
               <td><?php echo $reserva["dni"]; ?></td>
               <td><?php echo $reserva["nombres"]." ".$reserva["apellidos"]; ?></td>
               <td><?php echo $reserva["n_asiento"]; ?></td>
               <td><?php echo date("d-m-Y", strtotime($reserva["fecha_emi"])); ?></td>
               <td>S/ <?php echo $reserva["total"]; ?></td>
               <td>
                  <button class="modalInfo__buttonAction" style="--clr:#4f8dd5;" onclick="editR('<?php echo $reserva['id']; ?>');" id="btn_editReserva" title="Modificar reserva"><i class="uil uil-edit"></i></button>
                  <button class="modalInfo__buttonAction" style="--clr:#f7616d;" onclick="deleteR('<?php echo $reserva['id']; ?>');" id="btn_deleteReserva" title="Eliminar reserva"><i class="uil uil-trash-alt"></i></button>
                  <button class="modalInfo__buttonAction" style="--clr:#67e669;" onclick="boleta('<?php echo $reserva['id']; ?>','<?php echo $salida['id']; ?>');" id="btn_deleteReserva" title="Imprimir boleta"><i class="uil uil-bill"></i></button>
               </td>
            </tr>
<?php 
         }
      }
   }
?>