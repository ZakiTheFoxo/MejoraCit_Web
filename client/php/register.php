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

    /********** Validaciones *************/
    if ($_SERVER['REQUEST_METHOD'] != 'POST') { echo '{"status":405,"description":"Method not allowed"}'; exit(); }
    if(!isset($_POST['username'])){ echo '{"status":501,"description":"Data missing - username"}'; exit(); }
    if(!isset($_POST['correo'])){ echo '{"status":501,"description":"Data missing - correo"}'; exit(); }
    if(!isset($_POST['password'])){ echo '{"status":501,"description":"Data missing - password"}'; exit(); }

    if(isset($_POST['celular'])){
        if(!is_numeric($_POST['celular'])) { echo '{"status":501,"description":"Invalid phone - Not numeric"}'; exit(); }
        if(strlen($_POST['celular']) != 10) { echo '{"status":501,"description":"Invalid phone - Must be 10"}'; exit(); }
    } else { 
        $_POST['celular'] = ""; 
    }

    if(!filter_var($_POST['correo'], FILTER_VALIDATE_EMAIL)) { echo '{"status":501,"description":"Invalid email"}'; exit(); }

    /********** Encriptacion *****************/
    $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

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
    $post	=	$_POST;
    $metodo	=	"POST";
    $response = json_decode(curl($url,$post,$metodo));
    echo json_encode($response);
?>
