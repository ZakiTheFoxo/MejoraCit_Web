<?php	
	if(isset($debug)){
		if($debug==true){
			ini_set('display_errors', 1);
			ini_set('display_startup_errors', 1);
			error_reporting(E_ALL);
		}
	}
	
	include "db.php";
	
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	
	$method = $_SERVER['REQUEST_METHOD'];
	if(is_null($method)){
		unset($method);
		http_response_code(200);
		echo '{"status":500,"error":"Error de métodos"}';
		exit();
	}
	
	$data = json_decode(file_get_contents('php://input'), true);
	if(is_null($data))unset($data);