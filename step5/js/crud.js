function createRecord() {
	var station=$("#inputStation").val();
	var variable="tmax";
	var date=$("#inputDate").val();
	var temperature=$("#inputTemperature").val();
	var status=$("#inputStatus").val();

	console.log(station);
	console.log(date);
	console.log(temperature);
	console.log(status);

	$.ajax({
        url:'create_obs.php',
        method:'POST',
        data:{'station_id':station,'variable_id':variable,'observation_date':date,'observed_value':temperature,'status':status},
        success:function(response){
        	if (response != '-1') {
        		var alert = document.getElementById('alertResult');
        		alert.setAttribute("role","alert");
        		alert.setAttribute("class","alert alert-success");
        		var text=document.createTextNode("Query was successfully");
        		alert.appendChild(text);
        	}else{
        		var alert = document.getElementById('alertResult');
        		alert.setAttribute("role","alert");
        		alert.setAttribute("class","alert alert-danger");
        		var text=document.createTextNode("Query was failed");
        		alert.appendChild(text);
        	}
        },
        error:function(){
            console.log("Ha sucedido un error, revisale al código.!");
        }
    });
}

function assignData(band,obs) {
	if (band==1) {
		$("#inputStationUpdate").val(obs['sensor_id']);
		var dateInputUpdate=document.getElementById('inputDateUpdate');
		dateInputUpdate.setAttribute("value",obs['observation_date']);
		$("#inputTemperatureUpdate").val(obs['observed_value']);
		$("#inputStatusUpdate").val(obs['status']);
	}else{
		$("#inputStationDelete").val(obs['sensor_id']);
		var dateInputUpdate=document.getElementById('inputDateDelete');
		dateInputUpdate.setAttribute("value",obs['observation_date']);
		$("#inputTemperatureDelete").val(obs['observed_value']);
		$("#inputStatusDelete").val(obs['status']);
	}
}

function updateRecord(){
	var station=$("#inputStationUpdate").val();
	var date=$("#inputDateUpdate").val();
	var temperature=$("#inputTemperatureUpdate").val();
	var status=$("#inputStatusUpdate").val();

	console.log(station);
	console.log(date);
	console.log(temperature);
	console.log(status);

	$.ajax({
        url:'update_obs.php',
        method:'POST',
        data:{'station_id':station,'observation_date':date,'observed_value':temperature,'status':status},
        success:function(response){
        	if (response != '-1') {
        		var alert = document.getElementById('alertResultUpdate');
        		alert.setAttribute("role","alert");
        		alert.setAttribute("class","alert alert-success");
        		var text=document.createTextNode("Query was successfully");
        		alert.appendChild(text);
        	}else{
        		var alert = document.getElementById('alertResultUpdate');
        		alert.setAttribute("role","alert");
        		alert.setAttribute("class","alert alert-danger");
        		var text=document.createTextNode("Query was failed");
        		alert.appendChild(text);
        	}
        },
        error:function(){
            console.log("Ha sucedido un error, revisale al código.!");
        }
    });
}

function deleteRecord(){
	var station=$("#inputStationDelete").val();
	var date=$("#inputDateDelete").val();

	console.log(station);
	console.log(date);

	$.ajax({
        url:'delete_obs.php',
        method:'POST',
        data:{'station_id':station,'observation_date':date},
        success:function(response){
        	if (response != '-1') {
        		window.location.reload()
        	}else{
        		var alert = document.getElementById('alertResultDelete');
        		alert.setAttribute("role","alert");
        		alert.setAttribute("class","alert alert-danger");
        		var text=document.createTextNode("Query was failed");
        		alert.appendChild(text);
        	}
        },
        error:function(){
            console.log("Ha sucedido un error, revisale al código.!");
        }
    });
}

function readYear(){
	$.ajax({
        url:'read_obs.php',
        method:'GET',
        data:{'agno':window.localStorage.getItem('agno'),'station_id':window.localStorage.getItem('station')},
        success:function(response){
        	console.log(response);
        	var dataJSON=JSON.parse(response);
        	for(var i=0; i<dataJSON.length; i++){
        		var sensorID=document.createTextNode(dataJSON[i].sensor_id);
        		var observationDate=document.createTextNode(dataJSON[i].observation_date);
        		var observedValue=document.createTextNode(dataJSON[i].observed_value);
        		var statusObs;
        		if (dataJSON[i].status == '') {
        			statusObs=document.createTextNode("NULL");
        		} else {
        			statusObs=document.createTextNode(dataJSON[i].status);
        		}
        		var updateText=document.createTextNode("Update");
        		var deleteText=document.createTextNode("Delete");

        		var iconUpdate = document.createElement('span');
        		iconUpdate.setAttribute('data-feather','edit');
        		var iconDelete = document.createElement('span');
        		iconDelete.setAttribute('data-feather','trash-2');

        		var tr = document.createElement('tr');
        		var th = document.createElement('th');
        		th.setAttribute('scope','row');
        		var tdDate = document.createElement('td');
        		var tdValue = document.createElement('td');
        		var tdStatus = document.createElement('td');
        		var tdButtons = document.createElement('td');
        		var div= document.createElement('div');
        		div.setAttribute('class','d-grid gap-2 d-md-block');
        		var buttonUpdate= document.createElement('button');
        		buttonUpdate.setAttribute('class','btn btn-outline-secondary');
        		buttonUpdate.setAttribute('type','button');
        		buttonUpdate.setAttribute('data-bs-toggle','modal');
        		buttonUpdate.setAttribute('data-bs-target','#exampleModal2');
        		buttonUpdate.setAttribute('onclick',"assignData(1,"+JSON.stringify(dataJSON[i])+")");
        		var buttonDelete= document.createElement('button');
        		buttonDelete.setAttribute('class','btn btn-outline-danger');
        		buttonDelete.setAttribute('type','button');
        		buttonDelete.setAttribute('data-bs-toggle','modal');
        		buttonDelete.setAttribute('data-bs-target','#exampleModal3');
        		buttonDelete.setAttribute('onclick',"assignData(2,"+JSON.stringify(dataJSON[i])+")");

        		buttonUpdate.appendChild(iconUpdate);
        		buttonDelete.appendChild(iconDelete);
        		buttonUpdate.appendChild(updateText);
        		buttonDelete.appendChild(deleteText);

        		th.appendChild(sensorID);
        		tdDate.appendChild(observationDate);
        		tdValue.appendChild(observedValue);
        		tdStatus.appendChild(statusObs);
        		tdButtons.appendChild(div);
        		div.appendChild(buttonUpdate);
        		div.appendChild(buttonDelete);

        		tr.appendChild(th);
        		tr.appendChild(tdDate);
        		tr.appendChild(tdValue);
        		tr.appendChild(tdStatus);
        		tr.appendChild(tdButtons);

        		document.getElementById('bodyTable').appendChild(tr);
        	}
        },
        error:function(){
            console.log("Ha sucedido un error, revisale al código.!");
        }
    });
}
