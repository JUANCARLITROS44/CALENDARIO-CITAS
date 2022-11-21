<?php
session_start();

//Fichero de conexion con l base de datos
include_once("db.php");

$titulo 	= filter_input(INPUT_POST, 'titulo');
$vehiculo  	= filter_input(INPUT_POST, 'vehiculo');
$reparacion = filter_input(INPUT_POST, 'reparacion');
$horas  	= filter_input(INPUT_POST, 'horas');
$inicio 	= filter_input(INPUT_POST, 'inicio');
$fin    	= filter_input(INPUT_POST, 'fin');


if(!empty($titulo) && !empty($horas) && !empty($vehiculo) && !empty($reparacion) && !empty($inicio) && !empty($fin)){
	//Convertir la fecha y la hora del formato
	$data = explode(" ", $inicio);
	list($date, $hora) = $data;
	$data_barra = array_reverse(explode("/", $date));
	$data_barra = implode("-", $data_barra);
	$inicio_barra = $data_barra . " " . $hora;
	
	$data = explode(" ", $fin);
	list($date, $hora) = $data;
	$data_barra = array_reverse(explode("/", $date));
	$data_barra = implode("-", $data_barra);
	$fin_barra = $data_barra . " " . $hora;
	
	$consulta_eventos = "INSERT INTO mis_eventos (titulo, vehiculo, reparacion, horas, inicio, fin) VALUES ('$titulo', '$vehiculo', '$reparacion', '$horas', '$inicio_barra', '$fin_barra')";
	$resultado_eventos = mysqli_query($conexion, $consulta_eventos);
	
	//Comprobar si guardó en la base de datos a través de "mysqli_insert_id" el cual comprueba si existe el ID del último dato insertado
	if(mysqli_insert_id($conexion)){
		$_SESSION['mensaje'] = "<div class='alert alert-success' role='alert'>El evento registrado con éxito<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
		header("Location: index.php");
	}else{
		$_SESSION['mensaje'] = "<div class='alert alert-danger' role='alert'>Error al registrar el evento<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
		header("Location: index.php");
	}
	
}else{
	$_SESSION['mensaje'] = "<div class='alert alert-danger' role='alert'>Error al registrar el evento <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
	header("Location: index.php");
}