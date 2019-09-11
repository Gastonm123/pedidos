<?php

function ultimo_id($collection, $busqueda) {
    return $collection->find([], ["sort" => [$busqueda => -1], "limit" => 1]);
}

require dirname(__FILE__).'/../vendor/autoload.php';

use MongoDB\Client;

$conn = new Client('mongodb://localhost:27017');
$pedido = $conn->test->pedido;

// $pedido->insertOne(["nro" => 1, "estado" => "prep"]);

$result = $pedido->updateOne(["nro" => 1], ["\$set" => ["estado" => "asd"]]);

echo $result->getModifiedCount();

die;

$resultado = $pedido->find(["estado" => "prep"]);

foreach ($resultado as $row) {
    echo "{$row['nro']} en estado {$row['estado']}<br>";
}

echo "<br style='margin-top:20px'>";
$resultado = ultimo_id($pedido, 'nro');
foreach ($resultado as $row) {
    echo "{$row['nro']} en estado {$row['estado']}<br>";
}