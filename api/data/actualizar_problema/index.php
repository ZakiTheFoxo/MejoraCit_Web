<?php
    /*
     *
     * Funcion que registra un usuario en la base de datos (nombre de usuario, correo, contraseña y celular)
     * @param $data array con los datos del usuario
     * @param $mysqli conexion a la base de datos
     * @return boolean
     *
    */
    function updateReport($data,$mysqli){
        if(!isset($data['estado'])) {
            $sql = "UPDATE reporte SET estatus = 'Resuelto' WHERE id = $data[id]";
        } else {
            if($data['estado'] == 0) {
                $sql = "UPDATE reporte SET estatus = 'No resuelto' WHERE id = $data[id]";
            } else {
                $sql = "UPDATE reporte SET estatus = 'Resuelto' WHERE id = $data[id]";
            }
        }
        $result = $mysqli->query($sql);
        preg_match_all('!\d+!', $mysqli->info, $m);
        
        // revisa si se hizo la consulta, luego revisa si existe el id que se mando
        if($result && $m[0][0]){
            return true;
        }else{
            return false;
        }
    }