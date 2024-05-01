<?php
/* Variables */
$debug = true;

/* Base files */
include '../../helper/helper.php';
include '../../data/mainpage/index.php';

/* API body */
if ($method == 'POST') {
    $result = getReports($data,$mysqli);
    if($result != false){
        $result["status"]	= 200; 
        echo json_encode($result);
        die();
    }else{
        echo '{"status":502,"message":"No se encontraro un problema con ese ID"}';
        die();
    }

}
?>