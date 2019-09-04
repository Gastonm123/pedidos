<?php
// pantalla con pedidos en preparacion y pedidos para retirar
$pedidos_listos = [9,10];
$pedidos_pendientes = [5,6,7,8];
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Pedidos</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
        <link rel="stylesheet" href="/static/w3.css">
        <link rel="stylesheet" href="/static/all.min.css">
        <link rel="stylesheet" href="/static/fontawesome.min.css">
        <link rel="stylesheet" href="/static/pedidos.css">
    </head>
    <body>
        <div class="order-container">
            <div style="flex-grow: 4; margin-top: 10px">
                <div class="column-title w3-gray">
                    En preparacion
                </div>
                <ul class="orders-wrapper">
                    <?php
                    foreach ($pedidos_pendientes as $pedido) {
                        echo '
                        <li class="orders">
                            '.$pedido.'
                        </li>
                        ';
                    }
                    ?>
                </ul>
            </div>
            <div style="flex-grow: 3; margin-top: 10px">
                <div class="column-title w3-green">
                    Listos para retirar
                </div>
                <ul class="orders-wrapper" style="font-size: 18px">
                    <?php
                    foreach ($pedidos_listos as $pedido) {
                        echo '
                        <li class="orders">
                            '.$pedido.'
                        </li>
                        ';
                    }
                    ?>
                </ul>
            </div>
            <div style="flex-grow:3" class="w3-container placeholder">
                <div style="flex-grow:2">
                </div>
                <div style="flex-grow:2" class="placeholder-content">
                    <span style="font-style: italic; width:30%">
                        Estamos preparando tu pedido
                    </span>
                </div>
                <div style="flex-grow:3">
                </div>
                <div style="flex-grow:3" class="placeholder-content">
                    <i class="fa fa-smile fa-7x"></i>
                </div>
            </div>
        </div>
    </body>
</html>