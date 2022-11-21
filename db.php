<?php
$hostname = "localhost";
$usuariodb = "root";
$contrasenadb = "";
$dbname = "php_evento";
	
// Generar conexion con el servidor MySQl
$conexion = mysqli_connect($hostname, $usuariodb, $contrasenadb, $dbname);


	//conexion a la BD 
	$mensajeExc;
	$error = false;
	$host = "localhost";
	$db =   "php_evento";
	$user = "root";
	$pass = "";
	$dsn = "mysql:host=$host; dbname=$db; charset=utf8mb4";

	try {
		$conexiona = new PDO($dsn, $user, $pass);
		$conexiona->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $exc) {
		$mensajeExc = $exc->getMessage();
		$error = true;
	}
	//boton volver
	function pintarBotonVolver(){
		echo "<a href='listadoClientes.php' class='btn btn-info mb-2 mt-2'>Volver</a>"; 
	}

	function cerrar(&$con){
		$con = null;
	}
	
	function cerrarTodo(&$con, &$st){
		$st = null;
		$con = null;
	}