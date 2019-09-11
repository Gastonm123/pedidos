<?php
include 'conexion.php';

$pedidos->createIndex(['nro' => 1], ["unique" => true]);

die;
?>