<?php
	require 'conexion.php';

	$station=$_POST['station_id'];
	$variable=$_POST['variable_id'];
	$date=$_POST['observation_date'];
	$temperature=$_POST['observed_value'];
	$status=$_POST['status'];

	$query="INSERT INTO `observations` (`sensor_id`,`variable_id`, `observation_date`, `observed_value`, `status`) VALUES ('$station','$variable', '$date','$temperature','$status')";

	$result=mysqli_query($conectar,$query);

    if(!$result){
        die("-1");
    }
?>