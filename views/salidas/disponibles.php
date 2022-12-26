<?php 
if(isset($_POST)){
   require "./../conexion.php";
   $objConexion=new Conexion();
   $entidad=$_POST["entity"];
   $tabla=($entidad=="conductor")?"conductores":"vehiculos";

   $sql_e="SELECT * FROM $tabla WHERE estado=1 and hasSalida=0";
   $entities=$objConexion->consultar($sql_e);
   switch($entidad){
      case "conductor":
         if(!$entities){
            echo '<option value="" selected>No hay conductores disponibles</option>';
         }else{
            echo '
               <option value="" selected>Asigne un conductor</option>
            ';
            foreach($entities as $entity){
               echo '
               <option value="'.$entity["id"].'">'.$entity["nombres"].' '.$entity["apellidos"].'-'.$entity["licencia"].'</option>
               ';
            }
         }
      break;
      case "vehiculo":
         if(!$entities){
            echo '<option value="" selected>No hay '.$tabla.' disponibles</option>';
         }else{
            echo '
               <option value="" selected>Asigne un '.$entidad.'</option>
            ';
            foreach($entities as $entity){
               echo '
               <option value="'.$entity["id"].'">'.$entity["n_placa"].'- '.$entity["total_asientos"].' asientos</option>
               ';
            }
         }
      break;
   }
}
?>