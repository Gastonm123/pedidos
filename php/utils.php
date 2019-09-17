<?php

function leer() {
	$myfile = fopen("data.json", "r") or die("Unable to open file!");
	$contenido = fread($myfile,filesize("data.json"));
	fclose($myfile);

	return json_decode($contenido);
}

function escribir($nro, $estado) {
	// si ya existe el nro, actualizarlo
	$contenido = leer();
	$contenido->$nro = $estado;
	$myfile = fopen("data.json", "w") or die("Unable to open file!");
	$contenido = fwrite($myfile,json_encode($contenido));
	fclose($myfile);
}
