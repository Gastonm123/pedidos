<?php
require 'conexion.php';

$condiciones = ['prep', 'listo', 'retirado'];
$response = [];

foreach ($condiciones as $condicion) {
    $result = $pedidos->find(['estado' => $condicion]);
    
    if (!isset($result)) {
        echo 'Error desconocido';
        die;
    }
    
    $data = [];
    foreach ($result as $row) {
        $data[] = $row;
    }

    $response[$condicion] = $data;
}

header('Content-Type: application/json');
echo json_encode($response); 