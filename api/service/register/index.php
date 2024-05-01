<?php
	/* Variables */
	$debug		=	true;
	
	/* Archivos base */
	include '../../helper/helper.php';
	include '../../data/register/index.php';

	/* Cuerpo del API */
	if($method=='POST'){
        if(isset($data)){
            // Valida que no exista el usuario, si existe regresa un error
            if(!validateNonExistingUsername($data,$mysqli)){
                echo '{"status":501,"message":"Usuario ya registrado"}';
                die();
            }

            // Valida que no exista el correo, si existe regresa un error
            if(!validateNonExistingEmail($data,$mysqli)){
                echo '{"status":501,"message":"Correo ya registrado"}';
                die();
            }

            // Valida que no exista el celular, si existe regresa un error
            if(!validateNonExistingCelular($data,$mysqli)){
                echo '{"status":501,"message":"Celular ya registrado"}';
                die();
            }

            // Registra el usuario
            if(registerUser($data,$mysqli)){
                $result["status"] = 200;
                echo json_encode($result);
                die();
            } else {
                echo '{"status":502,"message":"Error al registrar usuario"}';
                die();
            }
        }
	}

	if($method=='GET'){
	}	

	if($method=='PUT'){
	}	
	
	if($method=='DELETE'){
	}
?>