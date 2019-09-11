<?php
require 'conexion.php';

if (isset($_GET['pedido'])) {
    $estado = $_GET['pedido']['estado'];
    $id = (int)$_GET['pedido']['nro'];

    $result = $pedidos->updateOne(["nro" => $id], ["\$set" => ['estado' => $estado]]);

    $response = '';
    if ($result->getModifiedCount() == 0) {
        $response = array('error'=>'Error en la base de datos');
    }

    header('Content-Type: application/json');
    echo json_encode($response);
    die;
}
?>
<!DOCTYPE html>
<html>

    <head>
        <link rel="stylesheet" href="/css/document.css"/>
        <link rel="stylesheet" href="/css/RegistroCaja.css"/>
        <link rel="stylesheet" href="/css/nav.css"/>
        <link rel="stylesheet" href="/css/sesion.css"/>
        <link rel="stylesheet" href="/css/w3.css"/>
        <script src="/static/jquery-3.3.1.min.js"></script>
        <script src="/static/utils.js"></script>
    </head>

    <body>
        <script>
            function PedidoListo(nro, estado) {
                var data = {
                    'pedido' : {
                        'nro': nro,
                        'estado': estado
                    }
                };

                $.get(
                    '/php/interfazEntrega.php',
                    data,
                    function (data, a, b) {
                        if (data['error']) {
                            alert(data['error']);
                        }
                    }   
                );
            }
        </script>
        
        <header>
        </header>
        
        <div style="display: flex; flex-direction:row; width:100%">
            <div style="flex-grow:1; display:flex; flex-direction: column; align-items:center">
                <h3>En preparacion</h3>
                <div id="pedidos-en-prep"></div>
            </div>
            <div style="flex-grow:1; display:flex; flex-direction: column; align-items:center">
                <h3>Listos</h3>
                <div id="pedidos-listos"></div>
            </div>
        </div>

        <script>
            var template_pedido = "<dl><dt class=\"w3-margin w3-card-4 w3-white\"><h3 class=\"w3-text-grey\" align=\"center\">Pedido {0}</h3><div class=\"w3-container w3-padding\" style=\"display:flex; justify-content: center\"><button style='display:inline-block !important' onclick=\"PedidoListo({0}, 'listo')\" class=\"w3-btn w3-teal\">Listo</button><button style='display:inline-block !important' onclick=\"PedidoListo({0}, 'entregado')\" class=\"w3-btn w3-teal\">Entregado</button></div></dt></dl>";

            function agregar_data (data, object) {                
                while (object.firstChild) {
                    object.removeChild(object.firstChild);
                }

                data.forEach(pedido => {
                    var node = document.createElement("div");
                    node.innerHTML = template_pedido.format(pedido['nro']);
                
                    object.appendChild(node);
                });
            }

            function actualizar() {
                $.get('/php/obtenerPedidos.php',
                    {},
                    function(data, a, b){
                        if (data['error']) {
                            alert(data['error']);
                        } else {
                            agregar_data(data['prep'], document.getElementById('pedidos-en-prep'));
                            agregar_data(data['listo'], document.getElementById('pedidos-listos'));
                        }
                    }
                )

                window.setTimeout(actualizar, 1000);
            }

            actualizar();
        </script>
        
    </body>

</html>
