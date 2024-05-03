<?php
	/* Variables */
	$debug		=	true;
	
	/* Archivos base */
	include '../../helper/helper.php';
	include '../../data/register/index.php';

	/* Cuerpo del API */
	if($method=='POST'){

	}
    
	if($method=='GET'){
    }	
    
	if($method=='PUT'){
	}	
	
	if($method=='DELETE'){
        // Modifica el usuario
        if(deleteUser($data,$mysqli)){
            $result["status"] = 200;
            echo json_encode($result);
            die();
        } else {
            echo '{"status":502,"description":"Error al eliminar la informacion usuario"}';
            die();
        }
	}
?>