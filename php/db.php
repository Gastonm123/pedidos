<?php
include 'conexion.php';

$pedidos->createIndex(['nro' => 1], ["unique" => true]);

die;
?>

<?php
include 'conexion.php';

if (isset($_GET['action'])) {
    if ($_GET['action'] == 'crear') {
        $sql = 'CREATE TABLE IF NOT EXISTS pedidos (
            id INTEGER NOT NULL,
            estado VARCHAR(10) DEFAULT "prep",
            PRIMARY KEY (id)
        )';
    } else if ($_GET['action'] == 'eliminar') {
        $sql = 'DROP TABLE IF EXISTS pedidos'; 
    } else {
        echo 'Accion desconocida';
        die;
    }

    $result = $conn->query($sql);
    
    if (empty($result)) {
        echo 'Accion fallida';
        die;
    }

    if ($_GET['action'] == 'crear') {
        $sql = 'CREATE TABLE IF NOT EXISTS combos ( 
            id INTEGER NOT NULL AUTO_INCREMENT, 
            producto TEXT NOT NULL, 
            precio INTEGER NOT NULL, 
            PRIMARY KEY (id)
        )';
    } else if ($_GET['action'] == 'eliminar') {
        $sql = 'DROP TABLE IF EXISTS combos'; 
    }

    $result = $conn->query($sql);
    
    if (empty($result)) {
        echo 'Accion fallida';
        die;
    }

    if ($_GET['action'] == 'crear') {
        $sql = 'CREATE TABLE IF NOT EXISTS pedidos_combos (
            id_pedido INTEGER NOT NULL,
            id_combo INTEGER NOT NULL,
            PRIMARY KEY (id_pedido, id_combo)
        )';
    } else if ($_GET['action'] == 'eliminar') {
        $sql = 'DROP TABLE IF EXISTS pedidos_combos'; 
    }

    $result = $conn->query($sql);
    
    if (empty($result)) {
        echo 'Accion fallida';
        die;
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="/static/w3.css">
    </head>
    <body>
        <script>
            function gestionar_db(accion) {
                url = location.toString()
            
                if (url.indexOf("?") > 0) {
                    url = url.substring(0, url.indexOf("?"));
                }

                location.href = url + '?action=' + accion;
            }
        </script>

        <button onclick='gestionar_db("crear")' class="w3-btn w3-white">Crear</button>
        <button onclick='gestionar_db("eliminar")' class="w3-btn w3-red">Eliminar</button>
    
        <div class="w3-container w3-margin">
            Tablas creadas    
        </div>
        
        <div class="w3-table">
            <?php
                // mostrar las bases de datos existentes
                $sql = 'SHOW TABLES';

                $result = $conn->query($sql);

                if (isset($result)) {
                    while($row = $result->fetch_row()) {
                        echo '<div>' . $row[0] . '</div>';
                    }
                }
            ?>
        </div>
    </body>
</html>