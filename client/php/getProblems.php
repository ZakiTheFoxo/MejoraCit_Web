<?php
    include '../../api/helper/helper.php';

    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($data['search'])) {
            $query = "SELECT * FROM reporte WHERE categoria LIKE '%$data[search]%' OR descripcion LIKE '%$data[search]%'";
            $stmt = $mysqli->prepare($query);
            $stmt->execute();
            $result = $stmt->get_result();
    
            if($result->num_rows){
                $problemas = array();
                while($row = $result->fetch_assoc()) {
                    $problemas[] = $row;
                }
                echo json_encode(array("status" => 200, "message"=>"Exito","data" => $problemas));
            }else{
                echo '{"status":500,"message":"No hay informacion"}';
            }
        }
        else {
            $query = "SELECT * FROM reporte";
            $stmt = $mysqli->prepare($query);
            $stmt->execute();
            $result = $stmt->get_result();
    
            if($result->num_rows){
                $problemas = array();
                while($row = $result->fetch_assoc()) {
                    $problemas[] = $row;
                }
                echo json_encode(array("status" => 200, "message"=>"Exito","data" => $problemas));
            }else{
                echo '{"status":500,"message":"No hay informacion"}';
            }
        }
    }else{
        echo '{"status":400,"message":"Metodo no valido"}';
    }
?>
