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
    if(!isset($data['id'])){ echo '{"status":501,"description":"Data missing - username"}'; exit(); }

    /***************** JWT **************/
    $date   		= new DateTimeImmutable();
    $expire_at     	= $date->modify('+1 minutes')->getTimestamp();      
    $domainName 	= "lumacad.com.mx";
    $key		   	= "deleteuser";                                          
    $request_data = [
        'iat'  		=> $date->getTimestamp(),        
        'iss'  		=> $domainName,                  
        'nbf'  		=> $date->getTimestamp(),        
        'exp'  		=> $expire_at,                      
        'key' 		=> $key                
    ];
    $url	=	'https://lumacad.com.mx/mejoracit/mejoracit_web/api/service/deleteuser/';
    // $url	=	'http://localhost/mejoracit_web/api/service/deleteuser/';
    $post	=	$data;
    $metodo	=	"DELETE";
    $response = json_decode(curl($url,$post,$metodo));
    echo json_encode($response);
?>
