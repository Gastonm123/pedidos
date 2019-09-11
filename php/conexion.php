<?php
require_once __DIR__.'/../vendor/autoload.php';

use MongoDB\Client;

$conn = new Client('mongodb://localhost:27017');

$pedidos = $conn->app->pedidos;

?>