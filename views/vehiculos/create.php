<?php 
   if(isset($_POST)){
      $placa=strtoupper($_POST["tx_placa"]);
      $vin=strtoupper($_POST["tx_vin"]);
      $marca=strtoupper($_POST["tx_marca"]);
      $categoria=strtoupper($_POST["tx_categoria"]);
      $tot_asientos=$_POST["tx_asientos"];
      $estado=$_POST["tx_estado"];
      date_default_timezone_set('America/Lima');
      $cod_timestamp=strtotime(date('Y-m-d H:i:s'));

      require "./../conexion.php";
      $objConexion=new Conexion();

      if(strlen($placa)!=7 || strlen($vin)!=17 || empty($marca) || empty($categoria) || empty($tot_asientos) || empty($estado)){
         echo 'vacio';
      }else{
         //! FALTA VALIDAR QUE EL VEHICULO NO ESTE EN SALIDA CON RESERVAS
         if(empty($_POST["id_vehiculo"])){
            try{
               // creacion de vehiculo
               $sql="INSERT INTO vehiculos(n_placa,n_vin,marca,categoria,total_asientos,estado,hasSalida,cod) VALUES('$placa','$vin','$marca','$categoria',$tot_asientos,$estado,0,$cod_timestamp)";
               $objConexion->ejecutar($sql);
               // creacion de los 36 asientos dela salida
               for($i=1;$i<=$tot_asientos;$i++){
                  $sql_asi="INSERT INTO asientos(cod_vehiculo,n_asiento,isAvailable) VALUES('$cod_timestamp',$i,0)";
                  $objConexion->ejecutar($sql_asi);
               }
               echo "ok";
            }catch(PDOException $e){
               echo "Error: ".$e->getMessage();
            }
         }else{
            try{
               $id_vehiculo=$_POST["id_vehiculo"];
               // obtner el cod_vehiculo del vehiculo a editar
               $sql_v="SELECT * FROM vehiculos WHERE id=$id_vehiculo";
               $vehiculo=$objConexion->consultarOne($sql_v);

               // eliminacion de los asientos q tenia elvehiculo
               $sql_a_del="DELETE FROM asientos WHERE cod_vehiculo=".$vehiculo["cod"]."";
               $objConexion->ejecutar($sql_a_del);

               // actualizacion de datos
               $sql="UPDATE vehiculos SET n_placa='$placa', n_vin='$vin', marca='$marca', categoria='$categoria', total_asientos=$tot_asientos, estado=$estado,hasSalida=0,cod=$cod_timestamp  WHERE id=$id_vehiculo";
               $objConexion->ejecutar($sql);

               // recreación de asientos para el vehiculo
               for($i=1;$i<=$tot_asientos;$i++){
                  $sql_asi="INSERT INTO asientos(cod_vehiculo,n_asiento,isAvailable) VALUES($cod_timestamp,$i,0)";
                  $objConexion->ejecutar($sql_asi);
               }

               echo 'modificado';
            }catch(PDOException $e){
               echo "Error: ".$e->getMessage();
            }
         }
      }     
   }
?>