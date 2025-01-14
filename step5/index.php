<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>CRUD Client</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
		<div class="container-fluid">
			<a class="navbar-brand" href="index.php">Exercise CRUD</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
    		</button>
    		<div class="collapse navbar-collapse" id="navbarCollapse">
      			<ul class="navbar-nav me-auto mb-2 mb-md-0">
        			<!--<li class="nav-item">
          				<a class="nav-link active" aria-current="page" href="#">Observations</a>
        			</li>-->
      			</ul>
    		</div>
  		</div>
	</nav>

	<main class="container">
  		<div class="bg-light p-5 rounded">
    		<h1>Welcome to web application</h1>
  		</div>
  		<table class="table w-100" id="tablaEstudiante" data-sort="table">
			<thead class="thead-dark">
				<tr>
					<th scope="col">#</th>
					<th scope="col">Name</th>
					<th scope="col">Latitude</th>
					<th scope="col">Longitude</th>
					<th scope="col">Elevation</th>
					<th scope="col">Years</th>
				</tr>
			</thead>
			<tbody>
				<?php
					require './php/conexion.php';

					$query="SELECT * FROM stations";
					$bdResult = mysqli_query($conectar,$query);

					if ($bdResult->num_rows>0) {
						while($row= $bdResult->fetch_assoc()) {
							$station=$row['station_id'];
							$queryYears="SELECT DISTINCT YEAR(o.observation_date) AS agno FROM observations AS o INNER JOIN stations AS s ON o.sensor_id=s.station_id WHERE s.station_id='$station'";

							$bdResultYears = mysqli_query($conectar,$queryYears);

							echo $cell = "<tr>".
									"<th scope='row'>".$row['station_id']."</th>".
									"<td>".$row['name']."</td>".
      								"<td>".$row['latitude']."</td>".
      								"<td>".$row['longitude']."</td>".
      								"<td>".$row['elevation']."</td>".
      								"<td>".
      									"<div class='btn-group' role='group' aria-label='Basic example'>";
											while($rowYear= $bdResultYears->fetch_assoc()){
  												echo $buttons="<a href='php/observations.php' class='btn btn-outline-info' onclick='assignYear(".$rowYear['agno'].",".$row['station_id'].")'>".$rowYear['agno']."</a>";
											}
							echo $footer=	"</div>".
      								"</td>".
								"</tr>";
						}
					} else {
						echo "<tr><th scope='row'></th><td colspan='4'>No hay registros disponibles</td></tr>";
					}
				?>
			</tbody>
		</table>
	</main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="js/assigns.js"></script>

</body>
</html>