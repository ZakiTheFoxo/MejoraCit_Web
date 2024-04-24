<?php
    /********** Mostrar errores ************/
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    /********** Librerías *****************/
    include 'functions.php';

    /********** Configuración *************/
    session_start();
    header('Content-Type: application/json; charset=utf-8');

    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    /********** Validaciones *************/
    if ($_SERVER['REQUEST_METHOD'] != 'POST') { echo '{"status":405,"description":"Method not allowed"}'; exit(); }
    if(!isset($data['username'])){ echo '{"status":501,"description":"Data missing - username"}'; exit(); }
    if(!isset($data['correo'])){ echo '{"status":501,"description":"Data missing - correo"}'; exit(); }
    if(!isset($data['password'])){ echo '{"status":501,"description":"Data missing - password"}'; exit(); }

    if(isset($data['celular'])){
        if(!is_numeric($data['celular'])) { echo '{"status":501,"description":"Invalid phone - Not numeric"}'; exit(); }
        if(strlen($data['celular']) != 10) { echo '{"status":501,"description":"Invalid phone - Must be 10"}'; exit(); }
    } else { 
        $data['celular'] = ""; 
    }

    if(!filter_var($data['correo'], FILTER_VALIDATE_EMAIL)) { echo '{"status":501,"description":"Invalid email"}'; exit(); }

    /********** Encriptacion *****************/
    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

    /***************** JWT **************/
    $date   		= new DateTimeImmutable();
    $expire_at     	= $date->modify('+1 minutes')->getTimestamp();      
    $domainName 	= "lumacad.com.mx";
    $key		   	= "register";                                          
    $request_data = [
        'iat'  		=> $date->getTimestamp(),        
        'iss'  		=> $domainName,                  
        'nbf'  		=> $date->getTimestamp(),        
        'exp'  		=> $expire_at,                      
        'key' 		=> $key                
    ];
    $url	=	'https://lumacad.com.mx/mejoracit/mejoracit_web/api/service/register/';
    // $url	=	'http://localhost/mejoracit_web/api/service/register/';
    $post	=	$data;
    $metodo	=	"POST";
    $response = json_decode(curl($url,$post,$metodo));
    echo json_encode($response);
?>
