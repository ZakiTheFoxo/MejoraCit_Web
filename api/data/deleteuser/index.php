<?php
    /*
     *
     * Funcion que registra un usuario en la base de datos (nombre de usuario, correo, contraseña y celular)
     * @param $data array con los datos del usuario
     * @param $mysqli conexion a la base de datos
     * @return boolean
     *
    */
    function deleteUser($data,$mysqli){
        $username = $data['username'];
        $sql = "UPDATE usuarios SET correo = '{$data['correo']}', password = '{$data['password']}', celular = '{$data['celular']}' WHERE username = '$username'";
        $result = $mysqli->query($sql);
        if($result){
            return true;
        }else{
            return false;
        }
    }