<?php 
   require "../../conexion.php";
   $objConexion=new Conexion();

   if($_POST){
      $id=$_POST["id"];
      // datos del cliente usando join
      $sql_join="SELECT r.id,r.dni,r.asiento,r.fecha_emi,c.nombres,c.apellidos,c.telefono FROM reservas r INNER JOIN clientes c ON r.dni = c.dni WHERE r.asiento=$id";
      $reserva=$objConexion->consultarOne($sql_join);

      $sql="SELECT * FROM asientos WHERE id=$id";
      $asiento=$objConexion->consultarOne($sql);
      
      $sql_salida="SELECT * FROM salidas WHERE cod=".$asiento['cod_salida']."";
      $salida=$objConexion->consultarOne($sql_salida);

      if($asiento["isAvailable"]==0){
?>
         <div class="alert alert_libre">Asiento disponible</div>
         <form onsubmit="submitForm(event)" class="modaliInfo__form" id="modaliInfo__form">
            <h3>Reservar asiento</h3>
            <div class="form__group">
               <label for="dni">DNI</label>
               <input
                  type="text"
                  class="form__control"
                  name="tx_dni"
                  id="dni"
                  minlength="8"
                  maxlength="8"
                  onkeypress="if (!soloNumeros(event)) event.preventDefault();"
               />
            </div>
            <div class="form__group">
               <label for="nombres">Nombres</label>
               <input
                  type="text"
                  class="form__control"
                  name="tx_nombres"
                  id="nombres"
               />
            </div>
            <div class="form__group">
               <label for="apellidos">Apellidos</label>
               <input
                  type="text"
                  class="form__control"
                  name="tx_apellidos"
                  id="apellidos"
               />
            </div>
            <div class="form__group">
               <label for="telefono">Teléfono</label>
               <input
                  type="text"
                  class="form__control"
                  name="tx_telefono"
                  id="telefono"
                  minlength="9"
                  maxlength="9"
                  onkeypress="if (!soloNumeros(event))event.preventDefault();"
               />
            </div>
            <div class="form__group">
               <label for="asiento">Asiento</label>
               <input
                  type="hidden"
                  class="form__control"
                  name="tx_idAsiento"
                  id="id_asiento"
                  value="<?php echo $asiento["id"] ?>"
               />
               <select class="form__control" name="tx_asiento" id="asiento" required disabled>
                  <option value="<?php echo $asiento["id"]; ?>" selected><?php echo $asiento["n_asiento"] ?>*</option>
                  <?php 
                     $sql_as="SELECT * FROM asientos WHERE id<>$id AND cod_salida=".$asiento['cod_salida']."";
                     $asientos=$objConexion->consultar($sql_as);
                     foreach ($asientos as $as){
                  ?>
                        <option value="<?php echo $as["id"]; ?>"><?php echo $as["n_asiento"] ?></option>
                  <?php 
                     }
                  ?>
               </select>
            </div>
            <div class="form__group">
               <label for="monto">Monto a pagar</label>
               <input
                  type="text"
                  class="form__control"
                  name="tx_monto"
                  id="monto"
                  value="S/ <?php echo $salida["monto"] ?>"
                  disabled
               />
            </div>
            <input type="submit" class="form__button" id="btnReservar" value="Reservar"/>
         </form>
<?php 
      }
      else{
?>
         <div class="alert alert_ocupado">Asiento ocupado</div>
         <table class="modalInfo__table">
            <caption class="modalInfo__tableCaption">Datos de la reserva</caption>
            <tbody>
               <tr>
                  <th>DNI</th>
                  <td><?php echo $reserva["dni"]; ?></td>
               </tr>
               <tr>
                  <th>Cliente</th>
                  <td><?php echo $reserva["nombres"].' '.$reserva["apellidos"]; ?></td>
               </tr>
               <tr>
                  <th>Teléfono</th>
                  <td><?php echo $reserva["telefono"]; ?></td>
               </tr>
               <tr>
                  <th>N° Asiento</th>
                  <td><?php echo $asiento["n_asiento"]; ?></td>
               </tr>
               <tr>
                  <th>Monto</th>
                  <td>S/ <?php echo $salida["monto"]; ?></td>
               </tr>
            </tbody>
         </table>
         <div class="modalInfo__buttons">
            <button class="modalInfo__buttonAction" style="--clr:#4f8dd5;" onclick="editR('<?php echo $reserva['id']; ?>');" id="btn_editReserva">Editar reserva</button>
            <button class="modalInfo__buttonAction" style="--clr:#f7616d;" onclick="deleteR('<?php echo $reserva['id']; ?>');" id="btn_deleteReserva">Eliminar reserva</button>
            <a href="" class="modalInfo__buttonAction" style="--clr:#67e669;">Imprimir boleta</a>
         </div>
<?php 
      }
   }
?>
<!--  -->