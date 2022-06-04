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
            padding: 20px;
            border-radius:5px;
        }
        .nav{
            position: relative;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 10px;
            padding: 10px 20px;
            border-radius:5px;
            background: #EAF2EC;
            color:white;
            background: #2C2E2D;
        }
        .nav input{
            width: 20em;
            padding: 5px 10px;
            border-radius:3px;
            border: none;
        }
        .nav input:focus{
            outline: none;
        }
        table{
            position: relative;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="see-clientes">
        <nav class="nav">
            <h3>Clientes</h3>
            <input type="text" id="tx_cliente" placeholder="Escriba el nombre del cliente que busca">
        </nav> 
        <table class="table table-striped text-center" id="tabla">
            <thead class="table-dark">
                    <th>DNI</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Sexo</th>
            </thead>
            <tbody id="body-table"></tbody>
        </table>
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
    </script>
</body>
</html>