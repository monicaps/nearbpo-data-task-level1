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

function assignData(id,temp) {
	$("#inputStationUpdate").val(id);
	$("#inputDateUpdate").val();
	$("#inputTemperatureUpdate").val(temp);
	$("#inputStatusUpdate").val();
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

function deleteRecord(){
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
        url:'delete_obs.php',
        method:'POST',
        data:{'station_id':station,'observation_date':date},
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

