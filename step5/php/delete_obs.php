<?php
	require 'conexion.php';
	$date = $row['date'];
	$sensor = 1;

	$sql = "DELETE FROM observations where observation_date= $date" AND sensor_id=$sensor;
	$result=mysqli_query($conectar,$sql);

    if(!$result){
        die("-1");
    }
?>