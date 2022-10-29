<?php
	require 'conexion.php';
	$stationUpdate=$_POST['station_id'];
	$dateUpdate=$_POST['observation_date'];
	$temperatureUpdate=$_POST['observed_value'];
	$statusUpdate=$_POST['status'];

	if (is_null($statusUpdate)) {
		$query="UPDATE observations SET observed_value='$temperatureUpdate' WHERE observation_date='$dateUpdate' AND sensor_id='$stationUpdate'";
	}else{
		$query="UPDATE observations SET observed_value='$temperatureUpdate', status='$statusUpdate' WHERE observation_date='$dateUpdate' AND sensor_id='$stationUpdate'";
	}

	$result=mysqli_query($conectar,$query);

    if(!$result){
        die("-1");
    }
?>