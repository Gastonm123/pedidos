$(function() {
    function agregar_data(data, pos) {
        var tag = $('.orders-wrapper')[pos];
        while (tag.firstChild) {
            tag.removeChild(tag.firstChild);
        }
    
        data.forEach(pedido => {
            var node = document.createElement("div");
            node.className = 'orders w3-text-gray';
            node.innerHTML = pedido[0];

            if (pos == 1) {
                node.style.fontSize = '24px';
            }
        
            $('.orders-wrapper')[pos].appendChild(node);
        });
    }
    
    function actualizar() {
        var data = {
            'table': 'pedidos', 
            'condition': 'estado=\'prep\''
        }
        $.post("/php/consultar_db.php", data,
            function (data, textStatus, jqXHR) {
                agregar_data(data, 0);
            }
        );
    
    
        var data = {
            'table': 'pedidos', 
            'condition': 'estado=\'listo\''
        }
        $.post("/php/consultar_db.php", data,
            function (data, textStatus, jqXHR) {
                agregar_data(data, 1);
            },
            "json"
        );
    
        window.setTimeout(actualizar, 2000);
    }
    
    actualizar();
});