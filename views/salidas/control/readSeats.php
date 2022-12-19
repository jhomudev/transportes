<?php 
   require "../../conexion.php";
   $objConexion=new Conexion();

   if($_POST){
      $id_salida=$_POST["id_salida"];
      $condicion=$_POST["condicion"];
      $sql_s="SELECT * FROM salidas WHERE id=".$id_salida."";
      $salida=$objConexion->consultarOne($sql_s);


      $sql="SELECT * FROM asientos WHERE cod_salida=".$salida["cod"]." AND n_asiento".$condicion."";
      $asientos=$objConexion->consultar($sql);
      foreach($asientos as $asiento){
         $imgSrc="http://localhost/transportes/assets/img/libre.png";
         if($asiento["isAvailable"]==1){
            $imgSrc="http://localhost/transportes/assets/img/ocupado.png";
         }
?>
         <div class="bus__asiento asiento__right" onclick="getInfoSeat(<?php echo $asiento['id']; ?>)" style="--n:'N° <?php echo $asiento["n_asiento"]; ?>';">
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
