<?php
include 'conexion.php';

$condiciones = ['pend', 'prep', 'listo', 'retirado'];
$response = [];

foreach ($condiciones as $condicion) {
    $sql = 'SELECT * FROM pedidos WHERE estado=\''.$condicion.'\'';
    
    $result = $conn->query($sql);
    
    if (empty($result)) {
        echo 'Error desconocido';
        die;
    }
    
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    $response[$condicion] = $data;
}

header('Content-Type: application/json');
echo json_encode($response); 