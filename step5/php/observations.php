<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>CRUD Client</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
	<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
		<div class="container-fluid">
			<a class="navbar-brand" href="../index.php">Exercise CRUD</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
    		</button>
    		<div class="collapse navbar-collapse" id="navbarCollapse">
      			<ul class="navbar-nav me-auto mb-2 mb-md-0">
        			<li class="nav-item">
          				<a class="nav-link active" aria-current="page" href="observations.php">Observations</a>
        			</li>
      			</ul>
    		</div>
  		</div>
	</nav>

	<main class="container">
  		<div class="bg-light p-5 rounded">
    		<h1>Observations</h1>
    		<p>These are the maximum temperature observations from existing weather stations</p>
    		<button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#exampleModal">
    			<span data-feather='plus-circle'></span>
  				Create record
			</button>
  		</div>
  		<table class="table w-100" id="tablaEstudiante" data-sort="table">
			<thead class="thead-dark">
				<tr>
					<th scope="col">Sensor</th>
					<th scope="col">Observation date</th>
					<th scope="col">Observed value</th>
					<th scope="col"></th>
				</tr>
			</thead>
			<tbody>
				<?php
					require 'conexion.php';

					$query="SELECT * FROM observations LIMIT 5";
					$bdResult = mysqli_query($conectar,$query);

					if ($bdResult->num_rows>0) {
						while($row= $bdResult->fetch_assoc()) {
								$cell = "<tr>".
								"<th scope='row'>".$row['sensor_id']."</th>".
      							"<td>".$row['observation_date']."</td>".
      							"<td>".$row['observed_value']." &ordm;C</td>".
      							"<td>".
      								"<div class='d-grid gap-2 d-md-block'>".
      									"<button class='btn btn-outline-secondary' type='button' data-bs-toggle='modal' data-bs-target='#exampleModal2'".
      						"onclick='assignData(".$row['sensor_id'].",".$row['observed_value'].")'>".
      										"<span data-feather='edit'></span>".
      									"</button>".
      									"<button class='btn btn-outline-danger' type='button' data-bs-toggle='modal' data-bs-target='#exampleModal3'>".
      										"<span data-feather='trash-2'></span>".
      									"</button>".
      								"</div>".
      							"</td>".
							"</tr>";
							echo $cell;
						}
					} else {
						echo "<tr><th scope='row'></th><td colspan='4'>No hay registros disponibles</td></tr>";
					}

				?>
			</tbody>
		</table>
	</main>

	<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  		<div class="modal-dialog">
    		<div class="modal-content">
      			<div class="modal-header">
        			<h1 class="modal-title fs-5" id="exampleModalLabel">Create new record</h1>
        			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      			</div>
      			<div class="modal-body">
        			<form class="row g-3">
  						<div class="col-md-6">
    						<label for="inputStation" class="form-label">Station</label>
    						<select class="form-select" aria-label="Default select example" id="inputStation">
  								<option selected>Open this select menu</option>
  								<?php
  									require 'conexion.php';
  									$sql="SELECT station_id, name FROM stations";
  									$bdResult = mysqli_query($conectar,$sql);
  									if ($bdResult->num_rows>0) {
										while($row= $bdResult->fetch_assoc()) {
											$option = "<option value=".$row['station_id'].">".$row['name']."</option>";
											echo $option;
										}
									} else {
										echo "<option selected>No hay registros disponibles</option>";
									}
  								?>
							</select>
  						</div>
  						<div class="col-md-6">
    						<label for="inputDate" class="form-label">Observation Date</label>
    						<input type="date" class="form-control" id="inputDate">
  						</div>
  						<div class="col-12">
    						<label for="inputTemperature" class="form-label">Observed Value</label>
    						<input type="text" class="form-control" id="inputTemperature">
  						</div>
  						<div class="col-12">
    						<label for="inputStatus" class="form-label">Status</label>
    						<select class="form-select" aria-label="Default select example" id="inputStatus">
  								<option selected>Open this select menu</option>
  								<option value="N">Not controlled</option>
  								<option value="A">Anomaly</option>
  								<option value="V">Valid</option>
							</select>
  						</div>
					</form>
      			</div>
      			<div class="modal-footer">
      				<div id="alertResult"></div>
        			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        			<button type="button" class="btn btn-primary" onclick="createRecord()">Create</button>
      			</div>
    		</div>
  		</div>
	</div>

	<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
  		<div class="modal-dialog">
    		<div class="modal-content">
      			<div class="modal-header">
        			<h1 class="modal-title fs-5" id="exampleModalLabel2">Update record</h1>
        			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      			</div>
      			<div class="modal-body">
        			<form class="row g-3">
  						<div class="col-md-6">
    						<label for="inputStationUpdate" class="form-label">Station</label>
    						<select class="form-select" aria-label="Default select example" id="inputStationUpdate" disabled>
  								<option selected>Open this select menu</option>
  								<?php
  									require 'conexion.php';
  									$sql="SELECT station_id, name FROM stations ";
  									$bdResult = mysqli_query($conectar,$sql);
  									if ($bdResult->num_rows>0) {
										while($row= $bdResult->fetch_assoc()) {
											$option = "<option value=".$row['station_id'].">".$row['name']."</option>";
											echo $option;
										}
									} else {
										echo "<option selected>No hay registros disponibles</option>";
									}
  								?>
							</select>
  						</div>
  						<div class="col-md-6">
    						<label for="inputDateUpdate" class="form-label">Observation Date</label>
    						<input type="date" class="form-control" id="inputDateUpdate" readonly>
  						</div>
  						<div class="col-12">
    						<label for="inputTemperatureUpdate" class="form-label">Observed Value</label>
    						<input type="text" class="form-control" id="inputTemperatureUpdate">
  						</div>
  						<div class="col-12">
    						<label for="inputStatusUpdate" class="form-label">Status</label>
    						<select class="form-select" aria-label="Default select example" id="inputStatusUpdate">
  								<option selected>Open this select menu</option>
  								<option value="N">Not controlled</option>
  								<option value="A">Anomaly</option>
  								<option value="V">Valid</option>
							</select>
  						</div>
					</form>
      			</div>
      			<div class="modal-footer">
        			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        			<button type="button" class="btn btn-primary" onclick="updateRecord()">Update</button>
      			</div>
    		</div>
  		</div>
	</div>

	<div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel3" aria-hidden="true">
  		<div class="modal-dialog">
    		<div class="modal-content">
      			<div class="modal-header">
        			<h1 class="modal-title fs-5" id="exampleModalLabel3">Delete record</h1>
        			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      			</div>
      			<div class="modal-body">
        			Delete record?
      			</div>
      			<div class="modal-footer">
        			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        			<button type="button" class="btn btn-danger" onclick="deleteRecord()">Delete</button>
      			</div>
    		</div>
  		</div>
	</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <!--Script para usar iconos-->
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
      	feather.replace()
    </script>
    <script src="../js/crud.js"></script>

</body>
</html>