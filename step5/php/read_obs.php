<?php
	require 'conexion.php';
	$agno=$_GET['agno'];
	$station=$_GET['station_id'];

	$query="SELECT * FROM observations WHERE YEAR(observation_date)='$agno' AND sensor_id=$station";
	$bdResult = mysqli_query($conectar,$query);

	$dataResult = array();

    while($row = $bdResult->fetch_assoc()) {
        $date=date_create($row['observation_date']);
		$data['sensor_id']=$row['sensor_id'];
		$data['observation_date']=date_format($date,"Y-m-d");
		$data['observed_value']=$row['observed_value'];
		$data['status']=$row['status'];
		$dataResult[]=$data;
    }

    echo json_encode($dataResult);
?>