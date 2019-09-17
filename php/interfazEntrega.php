<?php
include 'utils.php';

if (isset($_GET['pedido'])) {
	$pedido = $_GET['pedido'];	
	escribir($pedido['nro'], $pedido['estado']);
	echo 'Exito!!';
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
			function PedidoListo(nro) {
				Pedido(nro, 'listo');
			}


			function PedidoEntregado(nro) {
				Pedido(nro, 'entregado');
			}
	
            function Pedido(nro, estado) {
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
            var template_pedido = "\
            <dl>\
                <dt class=\"w3-margin w3-card-4 w3-white\">\
                    <h3 class=\"w3-text-grey\" align=\"center\">Pedido {0}</h3>\
                    <?php
                    if ($_GET['view'] == 'interno') {
                        echo "<div class='w3-container w3-padding' style='display:flex; justify-content: center'> \
                            <button style='display:inline-block !important' onclick='PedidoListo({0})' class='w3-btn w3-teal'>Listo</button> \
                            <button style='display:inline-block !important' onclick='PedidoEntregado({0})' class='w3-btn w3-teal'>Entregado</button> \
                        </div>";
                    }
                    ?>
                </dt>\
            </dl>";
            
            function agregar_data (data, object) {                
                while (object.firstChild) {
                    object.removeChild(object.firstChild);
                }

                data.forEach(pedido => {
                    var node = document.createElement("div");
                    node.innerHTML = template_pedido.format(pedido);
                
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
