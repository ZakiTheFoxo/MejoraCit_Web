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
    /* 
     * @param id : number; id del evento
     * @param estado : number (opcional); 0 = No resuelto, 1 = Resuelto (default)
    */
    // if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] != 2) { echo '{"status":403,"message":"User not allowed"}'; exit(); }

    if ($_SERVER['REQUEST_METHOD'] != 'PUT') { echo '{"status":405,"message":"Method not allowed"}'; exit(); }
    if(!isset($data['id'])){ echo '{"status":501,"message":"Data missing - id"}'; exit(); }
    if(isset($data['estado'])){ 
        if($data['estado'] != 0 && $data['estado'] != 1) {
            echo '{"status":501,"message":"Estado value can only be 0 or 1"}'; exit();
        }
    }

    /***************** JWT **************/
    $date   		= new DateTimeImmutable();
    $expire_at     	= $date->modify('+1 minutes')->getTimestamp();      
    $domainName 	= "lumacad.com.mx";
    $key		   	= "update";                                          
    $request_data = [
        'iat'  		=> $date->getTimestamp(),        
        'iss'  		=> $domainName,                  
        'nbf'  		=> $date->getTimestamp(),        
        'exp'  		=> $expire_at,                      
        'key' 		=> $key                
    ];
    $url	=	'https://lumacad.com.mx/mejoracit/mejoracit_web/api/service/actualizar_problema/';
    // $url	=	'http://localhost/mejoracit_web/api/service/actualizar_problema/';
    $post	=	$data;
    $metodo	=	"PUT";
    $response = json_decode(curl($url,$post,$metodo));
    echo json_encode($response);
?>
