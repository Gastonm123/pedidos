<?php
include 'conexion.php';

if (isset($_GET['action'])) {
    if ($_GET['action'] == 'crear') {
        $sql = 'CREATE TABLE IF NOT EXISTS pedidos (
            id INTEGER NOT NULL,
            descripcion TEXT,
            estado VARCHAR(10),
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
        var_dump($result);
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