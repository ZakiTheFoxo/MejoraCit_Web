<?php
	$mysqli = new mysqli("localhost","lumacadc_mejoracit_usuario","M3j0r4c1t.TSP","lumacadc_mejoracit");

	if ($mysqli -> connect_errno) {
		echo '{"status":500,"error":"Failed to connect to MySQL: '. $mysqli -> connect_error.'"}';
		exit();
	}