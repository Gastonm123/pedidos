<?php
include 'utils.php';

$response = [
	"prep" => [],
	"listo" => [],
	"entregado" => []
];
$pedidos = leer();

foreach ($pedidos as $id => $estado) {
	$response[$estado][] = (int)$id;
}

header('Content-Type: application/json');
echo json_encode($response); 
