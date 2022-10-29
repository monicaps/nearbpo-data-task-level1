<?php
	require 'conexion.php';
	$station=$_POST['station_id'];
	$date=$_POST['observation_date'];

	$sql = "DELETE FROM observations where observation_date='$date' AND sensor_id='$station'";
	$result=mysqli_query($conectar,$sql);

    if(!$result){
        die("-1");
    }
?>