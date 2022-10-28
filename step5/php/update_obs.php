<?php
	require 'conexion.php';
	$stationUpdate=$_POST['station_id'];
	//$variableUpdate=$_POST['variable_id'];
	$dateUpdate=$_POST['observation_date'];
	$temperatureUpdate=$_POST['observed_value'];
	$statusUpdate=$_POST['status'];

	$query="UPDATE observations SET observed_value='$temperatureUpdate', status='$statusUpdate' WHERE observation_date='$dateUpdate' AND sensor_id='$stationUpdate'";

	$result=mysqli_query($conectar,$query);

    if(!$result){
        die("-1");
    }
?>