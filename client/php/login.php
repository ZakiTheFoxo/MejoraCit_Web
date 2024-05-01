<?php
    include '../../api/helper/helper.php';

    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if (isset($data['username']) && isset($data['password'])) {
            $username = $mysqli->real_escape_string($data['username']);

            $query = "SELECT * FROM usuarios WHERE username=?";
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param('s', $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if($result->num_rows){
                $usuario = $result->fetch_assoc();
                if(password_verify($data['password'], $usuario['password'])){
                    session_start();
                    $_SESSION['correo'] = $usuario['correo'];
                    $_SESSION['username'] = $usuario['username'];
                    $_SESSION['celular'] = $usuario['celular'];
                    $_SESSION['login'] = true;


                    echo json_encode(array("status" => 200, "message"=>"Usuario autenticado","data" => $usuario));
                }else{
                    echo '{"status":500,"message":"Contraseña incorrecta"}';
                }
            }else{
                echo '{"status":500,"message":"El usuario no existe"}';
            }
        } else {
            echo '{"status":400,"message":"Debes ingresar todos los datos"}';
        }
    }else{
        echo '{"status":400,"message":"Metodo no valido"}';
    }
?>
