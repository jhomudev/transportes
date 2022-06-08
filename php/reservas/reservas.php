<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="../../styles/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/a8527aea5d.js" crossorigin="anonymous"></script>
    <title>Document</title>
    <style>
        .see-clientes{
            position: relative;
            width: 98%;
            padding: 20px 40px;
            border-radius:5px;
            text-align:center;
        }
        .nav{
            position: relative;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 10px;
            padding: 10px 20px;
            border-radius:5px;
            color:white;
            background: #2C2E2D;
        }
        .nav input{
            width: 15em;
            padding: 5px 10px;
            border-radius:3px;
            border: none;
        }
        .nav input:focus{
            outline: none;
        }
        .nav ul{
            position: relative;
            margin-top: 15px;
            display:flex;
            gap:15px;
            list-style:none;
            align-items: center;
            justify-content: center;
            padding: 0;
        }
        a{
            text-decoration: none;
            font-weight: 600;
            color:white;
        }
        a:hover{
            color:cyan;
        }
        .nav li{
            cursor:pointer;
        }
        table{
            position: relative;
            margin-top: 20px;
        }
        iframe{
            width: 100%;
            height: 500px;
            display:none;
        }
        /* .text-left{
            text-align: left !important;
        } */
    </style>
</head>
<body>
    <div class="see-clientes">
        <h1>Gestión de reservas</h1>
        <nav class="nav">
            <ul>
                <li onclick="search();">TODAS</li>
                <?php
                    include'../conexion.php';
                    $sql="SELECT * from salidas";
                    $sql_res=$conexion->query($sql);
                    while ($row=$sql_res->fetch_array()){
                        $id=$row['id_salida'];
                ?>
                        <li onclick="search('<?php echo $id;?>');"><?php echo $id;?></li>                      
                <?php
                    }
                ?>
            </ul>
            <input type="text" id="tx_cliente" placeholder="Buscar reserva por cliente">
        </nav> 
        <table class="table table-striped text-center" id="tabla">
            <thead class="table-dark">
                    <th>Salida</th>
                    <th>Asiento</th>
                    <th>DNI</th>
                    <th>Cliente</th>
                    <th>Fecha de Emisión</th>
                    <th>Monto</th>
            </thead>
            <tbody id="body-table"></tbody>
        </table>
        <iframe src="" name="iframe-table" id="iframe-table" frameborder="0"></iframe>   
           
    </div>
    <script>
        $(search());
        function search(consulta) {
            $.ajax({
                type: "POST",
                url: "search.php",
                dataType: "html",
                data: {consulta: consulta},
                success: function (r) {
                    $("#body-table").html(r);
                    
                }
            });
        }

        $(document).on('keyup', '#tx_cliente', function(){
            var valor=$(this).val();
            if (valor ==""){
                search();
            }
            else{
                search(valor);
            }
        })

        function show_iframe(){
            document.querySelector('#tabla').style.display='none';
            document.querySelector('#iframe-table').style.display='block';
            document.querySelector('#tx_cliente').disabled=true;
        }
    </script>
</body>
</html>