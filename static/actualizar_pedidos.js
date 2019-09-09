$(function() {
    function agregar_data(data, pos) {
        var tag = $('.orders-wrapper')[pos];
        while (tag.firstChild) {
            tag.removeChild(tag.firstChild);
        }
    
        data.forEach(pedido => {
            var node = document.createElement("div");
            node.className = 'orders w3-text-gray';
            node.innerHTML = pedido['id'];

            if (pos == 1) {
                node.style.fontSize = '24px';
            }
        
            $('.orders-wrapper')[pos].appendChild(node);
        });
    }
    
    function actualizar() {
        $.get(
            '/php/obtenerPedidos.php', 
            {},
            function (data, a, b) {
                agregar_data(data['prep'],0);
                agregar_data(data['listo'],1);
        });
    
        window.setTimeout(actualizar, 2000);
    }
    
    actualizar();
});