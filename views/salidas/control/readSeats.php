<?php 
   require "../../conexion.php";
   $objConexion=new Conexion();

   if($_POST){
      $id_salida=$_POST["id_salida"];
      $sql_s="SELECT * FROM salidas WHERE id=".$id_salida."";
      $salida=$objConexion->consultarOne($sql_s);
      
      // HALLAR EL TOTAL DE ASIENTOS
      $sql_tot="SELECT COUNT(*) FROM asientos a INNER JOIN vehiculos v ON a.cod_vehiculo=v.cod WHERE v.id=".$salida["id_vehiculo"]."";
      $objectAsientos=$objConexion->consultarOne($sql_tot);
      $mitadAsientos=$objectAsientos[0]/2;
      $condicion=$_POST["condicion"]=="left"?"<=".$mitadAsientos:">".$mitadAsientos;

      // obtener los asientos
      $sql="SELECT a.id,a.n_asiento,a.isAvailable FROM asientos a INNER JOIN vehiculos v ON a.cod_vehiculo=v.cod WHERE v.id=".$salida["id_vehiculo"]." AND a.n_asiento$condicion";
      $asientos=$objConexion->consultar($sql);
      foreach($asientos as $asiento){
         $imgSrc="http://localhost/transportes/assets/img/libre.png";
         if($asiento["isAvailable"]==1){
            $imgSrc="http://localhost/transportes/assets/img/ocupado.png";
         }
?>
         <div class="bus__asiento" onclick="getInfoSeat(<?php echo $asiento['id']; ?>)" style="--n:'N° <?php echo $asiento["n_asiento"]; ?>';">
            <img
               src="<?php echo $imgSrc; ?>"
               alt="asiento"
               class="bus__asientoImg"
            />
         </div>
      <?php
      }
   }
?>
