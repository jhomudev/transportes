
<?php 

// $conexion = new mysqli('localhost', 'root', '', 'bdtrans');
// $conexion->set_charset("utf8");

// if (!$conexion) { 
//     die('<strong>No pudo conectarse:</strong> ' . mysql_error()); 
// }else{ 
//     // La siguiente linea no es necesaria, simplemente la pondremos ahora para poder observar que la conexión ha sido realizada 
//     //echo 'Conectado  satisfactoriamente al servidor <br />'; 
// } 
 

    class conexion{
        private $server="localhost";
        private $user="root";
        private $db="bdtrans";
        private $password="";
        private $conexion;

        public function __construct(){
            try{
                $this->conexion=new PDO("mysql:host=$this->server;dbname=$this->db",$this->user,$this->password);
                $this->conexion->setAttribute(\PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $e){
                return "Falla de conexion".$e;
            }
        }
        

        public function ejecutar($sql) {
            $this->conexion->exec($sql);
            return $this->conexion->lastinsertid();
        }

        public function consultar($sql){
            $sentencia=$this->conexion->prepare($sql);
            $sentencia->execute();
            return $sentencia->fetchAll();
        }

        public function consultarOne($sql){
            $sentencia=$this->conexion->prepare($sql);
            $sentencia->execute();
            return $sentencia->fetch();
        }
    }
?>
