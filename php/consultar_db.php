<?php
include 'conexion.php';

if (empty($_POST['table']) || empty($_POST['condition'])) {
    echo 'Error desconocido';
    die;
}

$table = $_POST['table'];
$condition = $_POST['condition'];

$sql = 'SELECT * FROM ' . $table . ' WHERE ' . $condition;

$result = $conn->query($sql);

if (empty($result)) {
    echo 'Error desconocido';
    die;
}

$data = [];
while ($row = $result->fetch_row()) {
    $data[] = $row;
}

header('Content-Type: application/json');
echo json_encode($data); 