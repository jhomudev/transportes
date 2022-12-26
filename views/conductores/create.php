<?php 
   if(isset($_POST)){
      $dni=$_POST["tx_dni"];
      $nombres=strtoupper($_POST["tx_nombres"]);
      $apellidos=strtoupper($_POST["tx_apellidos"]);
      $licencia=$_POST["tx_licencia"];
      $telefono=$_POST["tx_telefono"];
      $estado=$_POST["tx_estado"];
      require "./../conexion.php";
      $objConexion=new Conexion();

      if(strlen($dni)!=8 || empty($nombres) || empty($apellidos) || empty($licencia) || strlen($telefono)!=9 || empty($estado)){
         echo 'vacio';
      }else{
         try{
            if(empty($_POST["id_conductor"])){
               // creacion de conductor
               $sql="INSERT INTO conductores (dni,nombres,apellidos,licencia,telefono,estado,hasSalida) VALUES($dni,'$nombres','$apellidos','$licencia',$telefono,$estado,0)";
               $objConexion->ejecutar($sql);
               echo "ok";
            }else{
               //!FALTA VALIDAR QUE EL CONDUCTOR NO ESTE YA EN UN SALIDA  
               $id_conductor=$_POST["id_conductor"];
               $sql="UPDATE conductores SET dni=$dni, nombres='$nombres',apellidos='$apellidos', licencia='$licencia', estado=$estado, hasSalida=0 WHERE id=$id_conductor";
               $objConexion->ejecutar($sql);
               echo 'modificado';
            }           
         }catch(PDOException $e){
            echo "Error: ".$e->getMessage();
         }
      }     
   }
?>