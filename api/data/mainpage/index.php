<?php 
    /*
    * Function to retrieve reports based on specific criteria
    * @param $data array with the search criteria
    * @param $mysqli database connection
    * @return array|bool
    */
    function getReports($data, $mysqli)
    {
        $sql = "SELECT * FROM reporte WHERE ID =".$data["id"];
        $result = $mysqli->query($sql);
    
        if (empty($result)) {
            return false;
        } else {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
    }
?>