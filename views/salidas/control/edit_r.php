<?php 
   require "../../conexion.php";
   $objConexion=new Conexion();

   if($_POST){
      $id_reserva=$_POST["id"];
      // obtener los datos de la reserva a editar
      $sql_join="SELECT r.total,r.dni,r.asiento,c.nombres,c.apellidos,c.telefono FROM reservas r INNER JOIN clientes c ON r.dni = c.dni WHERE r.id=$id_reserva";
      $reserva=$objConexion->consultarOne($sql_join);    
      // obtener el numero de asiento
      $sql_as="SELECT * FROM asientos WHERE id=".$reserva["asiento"]."";
      $asiento=$objConexion->consultarOne($sql_as);
   }
?>
<form onsubmit="submitForm(event)" class="modaliInfo__form" id="modaliInfo__form">
   <h3>Modificar reserva</h3>
   <div class="form__group">
      <label for="dni">DNI</label>
      <input
         type="hidden"
         class="form__control"
         name="tx_id_reserva"
         value="<?php echo $id_reserva; ?>"
         id="id_reserva"
      />
      <input
         type="text"
         class="form__control"
         name="tx_dni"
         id="dni"
         value="<?php echo $reserva["dni"];?>"
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
         value="<?php echo $reserva["nombres"];?>"
      />
   </div>
   <div class="form__group">
      <label for="apellidos">Apellidos</label>
      <input
         type="text"
         class="form__control"
         name="tx_apellidos"
         id="apellidos"
         value="<?php echo $reserva["apellidos"];?>"
      />
   </div>
   <div class="form__group">
      <label for="telefono">Teléfono</label>
      <input
         type="text"
         class="form__control"
         name="tx_telefono"
         id="telefono"
         value="<?php echo $reserva["telefono"];?>"
         minlength="9"
         maxlength="9"
         onkeypress="if (!soloNumeros(event))event.preventDefault();"
      />
   </div>
   <div class="form__group">
      <label for="asiento">Asiento</label>
      <select class="form__control" name="tx_idAsiento" id="asiento" required>
         <option value="<?php echo $reserva["asiento"]; ?>" selected><?php echo $asiento["n_asiento"] ?>*</option>
         <?php 
            $sql_as="SELECT * FROM asientos WHERE id<>".$reserva["asiento"]." AND cod_salida=".$asiento['cod_salida']." AND isAvailable=0";
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
         value="S/ <?php echo $reserva["total"] ?>"
         disabled
      />
   </div>
   <input type="submit" class="form__button" id="btnReservar" value="Actualizar"/>
</form>