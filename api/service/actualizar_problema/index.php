<?php
	/* Variables */
	$debug		=	true;
	
	/* Archivos base */
	include '../../helper/helper.php';
	include '../../data/actualizar_problema/index.php';

	/* Cuerpo del API */
	if($method=='POST'){
	}

	if($method=='GET'){
	}	

	if($method=='PUT'){
        if(isset($data)){
            // Actualiza el problema dado (en caso de que se mande el estado, se coloca ese, por default se resuelve el problema)
            // 0 = no resuelto, 1 = resuelto
            if(updateReport($data,$mysqli)){
                $result["status"] = 200;
                echo json_encode($result);
                die();
            } else {
                echo '{"status":502,"message":"Error al actualizar estado del problema"}';
                die();
            }
        }
	}	
	
	if($method=='DELETE'){
	}
?>