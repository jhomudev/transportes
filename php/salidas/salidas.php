<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/a8527aea5d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../styles/style.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Salidas</title>
    <style>
        body{
            display:flex;
            flex-direction:column;
            align-items: center;
            padding: 60px 30px;
        }
        .container-general{
            position: relative;
            display:flex;
            align-items: center;
            gap:50px;
            width: 100%;
            padding: 10px 20px;
        }
        input[type="submit"]{
            width: 88%;
        }
        .content-form{
            height: auto;
            overflow: hidden;
            width: 590px;
            border-radius:5px;
            display:flex;
            flex-wrap:wrap;
            justify-content: center;
            align-items: center;
            border: 3px solid #F0EFEF;
            transition:all 0.5s;
            padding: 20px 15px;

        }
        .content-form form{
            width: 98%;
            height: auto;
            display:flex;
            flex-wrap:wrap; 
            justify-content: center;
            align-items: center;
            gap:10px;
        }
        form .mb-3{
            width: 21em;
            margin-bottom:0 !important;
        }
        th{
            padding: 15px !important;
        }
        .container-iframe{
            position: fixed;
            width: 100%;
            height: 100vh;
            top: 0;
            left: 0;
            background: rgba(0,0,0,0.3);
            display:none;
            place-items:center;
        }
        .container-iframe.active{
            display:grid;
            place-items:center;
        }
        .container-iframe iframe{
            position: absolute;
            width: 455px;
            height: 615px;
            background: rgba(255, 255,255,0.9);
            border-radius: 5px;
            padding: 15px 20px;
            border:1px solid #44DB6C;
        }
        @media screen and (max-width:1516px){
            .container-general{
                flex-direction:column;
            }
            form .mb-3{
                width: 10em;
            }
            
        }
        @media screen and (max-width: 715px) {
            *{
                font-size:10px;
            }
            .content-form{
                width:98% ;
            }
            .container-iframe iframe{
                width: auto;
                height: 450px;
            }
        }
    </style>
</head>
<body>
    <h1>Gestión de Salidas</h1><br>
    <div class="container-general">
        <div class="content-form">
            <h3>Agregar Salidas</h3>
            <form action="salidas.php" method="post" id="form-add">
                <div class="mb-3">
                    <label for="codigo">Id. Salida</label>
                    <input type="text" class="form-control" name="tx_salida" maxlength="4" minlength="4" onkeypress="valide(event)" required/>
                </div>	
                <div class="mb-3">
                    <label for="codigo">Origen</label>
                    <input type="text" class="form-control" name="tx_origen" onkeyup="javascript:this.value=this.value.toUpperCase();" required/>
                </div>	
                <div class="mb-3">
                    <label for="codigo">Destino</label>
                    <input type="text" class="form-control" name="tx_destino" onkeyup="javascript:this.value=this.value.toUpperCase();" required/>
                </div>	
                <div class="mb-3">
                    <label for="codigo">Fecha</label>
                    <input type="date" class="form-control" name="tx_fecha" required/>
                </div>	
                <div class="mb-3">
                    <label for="codigo">Hora</label>
                    <input type="time" class="form-control" name="tx_hora" required/>
                </div>	
                <div class="mb-3">
                    <label for="codigo">Monto S/</label>
                    <input type="text" class="form-control" name="tx_monto" id="s3" onkeypress="valide(event)" required />
                </div>	
                <input type="submit" value="Agregar" class="btn btn-primary">
                <br><br>
                <?php
                    include "../conexion.php";
                    if(!empty($_POST['tx_salida'])=="")
                    {}
                    else
                    {
                        $salida=$_POST["tx_salida"];
                        $origen=$_POST["tx_origen"];
                        $destino=$_POST["tx_destino"];
                        $fecha=$_POST["tx_fecha"];
                        $hora=$_POST["tx_hora"];
                        $monto=$_POST["tx_monto"];
                        //insertar salida
                        $sql="INSERT INTO salidas VALUES($salida,'$fecha','$hora','$origen','$destino',$monto)";
                        $sql_re=$conexion->query($sql);
                        //creando asientos de la salida
                        $i=1;
                        while($i<=36){
                            $sql="INSERT INTO asientos(id_salida,n_asiento,estado) VALUES($salida,'$i','DISPONIBLE')";
                            $sql_re=$conexion->query($sql);
                            $i++;
                        }  
                        try{
                            echo'
                            <div class="alert alert-success" role="alert">
                            <i>Listo.</i> Los datos se insertaron correctamente.
                            </div> 
                            ';
                        }
                        catch (Exception $e){
                            echo'
                            <div class="alert alert-danger" role="alert">
                            <i>Error.</i> Los datos se no se insertaron.
                            </div> 
                            ';
                        } 
                    }  
                ?>
            </form>
        </div>
        <table class="table table-striped text-center">
            <thead class="table-dark">
                <tr>
                    <th scope="col">ID SALIDA</th>
                    <th scope="col">MONTO</th>
                    <th scope="col">FECHA</th>
                    <th scope="col">HORA</th>
                    <th scope="col">ORIGEN</th>
                    <th scope="col">DESTINO</th>
                    <th scope="col">OPCIONES</th>
                </tr>
            </thead>
            <?php
                $res="Select * from salidas";
            	$vres = $conexion->query($res);
            	while ($row=$vres->fetch_array()){	  
                    $ids = $row['id_salida']; 
                    $mon = $row['monto']; 
                    $fecha = $row['fecha']; 
                    $hora = $row['hora']; 
                    $origen = $row['origen']; 
                    $destino = $row['destino']; 
            		echo '
                        <tr>
                            <td><a href="control.php?salida='.$ids.'">'.$ids.'</a></td>
                            <td>S/ '.$mon.'</td>
                            <td>'.$fecha.'</td>
                            <td>'.$hora.'</td>
                            <td>'.$origen.'</td>
                            <td>'.$destino.'</td>
                            <td>
                                <a href="eli_salida.php?salida='.$ids.'" class="btn btn-danger" title="Eliminar salida"><i class="fa-solid fa-trash"></i></a>
                                <a target="iframe-edit" onclick="mostrar_iframe();" href="edit_salida.php?salida='.$ids.'" class="btn btn-primary" title="Editar salida"><i class="fa-solid fa-pen-to-square"></i></a>
                            </td>
                        </tr>
                    '; 		
                }	
            ?>
        </table>
    </div>
    
    <div class="container-iframe">
        <iframe src="" name="iframe-edit" frameborder="0"></iframe>
    </div>
    <script>
        function valide(event){
            if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;
        }
        //archivo salidas.php script para aparecer el form de agregar 
        /* const btn_add=document.querySelector("#btn-add");
        let form=document.querySelector("#form-add");
        function show(){
            form.classList.toggle('active');
        }
        btn_add.onclick=show; */
        //funcion parav aparecer iframe de editar salida 
        const btn_show_iframe_edit=document.querySelector(".btn-cerrar");
        let iframe_edit=document.querySelector(".container-iframe");
        function mostrar_iframe(){
            setTimeout(() => {
                iframe_edit.classList.toggle('active');
            },100);
        }
        iframe_edit.onclick=mostrar_iframe;
    </script>
</body>
</html>
