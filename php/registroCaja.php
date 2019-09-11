<?php
include "conexion.php";

if (isset($_GET['pedido'])) {
    $pedido = (int)$_GET['pedido'];

    try {
        $result = $pedidos->insertOne(["nro" => $pedido, "estado" => "prep"]);
    } catch(Exception $e) {
        echo 'Entrada duplicada';
        die;
    }

    if ($result->getInsertedCount() != 0) {
        echo 'Pedido realizado';
        die;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <script src="/static/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="/static/w3.css">
    <link rel="stylesheet" href="/static/all.min.css">
</head>

<body>
    <script>
        function mandar_pedido() {
            var descripcion = $('#nro');

            var data = {
                'pedido' : descripcion.val()
            };

            descripcion.val('');
            console.log(data);

            $.get(
                '/php/registroCaja.php',
                data,
                function (data, a, b) {
                    alert(data);
                }
            );
        }
    </script>

    <article class="w3-margin w3-card-4 w3-white" style="width:50%">
        <div class="w3-container w3-green">
            <h3>Registro</h3>
        </div>

        <div class="w3-container w3-padding">
            <h4>Complete los siguientes campos para registrar el pedido</h4>

            Nro. orden: <br> <input class="w3-input" type="number" id="nro"><br>

            <div class="w3-container w3-padding" style="display:flex; justify-content: center">
                <button onclick="mandar_pedido()" class="w3-btn w3-teal">
                    Finalizar Orden
                </button>
            </div>
        </div>
    </article>
</body>

</html>