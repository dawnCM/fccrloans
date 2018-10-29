
var callback_obj = {};



function callbackPrimaryPhone(json){
	$("#PrimaryPhone").removeClass("verror");
	vfields[callback_obj.PrimaryPhone] = true;	
}

function callbackWorkPhone(json){
	
	var obj = json;
	if(obj.status == "success"){
		$("#WorkPhone").removeClass("verror");
		vfields[callback_obj.WorkPhone] = true;	
	}else{
		$("#WorkPhone").addClass("verror");
		vfields[callback_obj.WorkPhone] = false;	
	}
	
}



function callbackBankName(json){
	var obj = json;
	if(obj.status == "success"){
		var bankname = obj.data.BankRouting.name;
		bankname = bankname.replace('&','And').replace('\'','');
		$("#BankRoutingNumber").removeClass("verror");
		$("#BankName").val(bankname);
		vfields[callback_obj.BankName] = true;	
	}else{
		$("#BankRoutingNumber").addClass("verror");
		vfields[callback_obj.BankName] = false;
		$("#BankName").val("");	
	}
	
}

//onchange call
function callbackBankName2(json){
	var obj = json;
	if(obj.status == "success"){
		var bankname = obj.data.BankRouting.name;
		bankname = bankname.replace('&','And').replace('\'','');
		$("#BankRoutingNumber").removeClass("verror");
		$("#BankName").val(bankname);
	}else{
		$("#BankRoutingNumber").addClass("verror");
		$("#BankName").val("");	
	}
	
}




function callbackHolidays(json){
	var obj = json;
	
	if(obj.status == "success"){
		obj.data.every(function(e){
			var date = e.Holiday.hdate;
			var breakup = date.split("-");
			
			holiday_array.push(breakup[1]+"/"+breakup[2]+"/"+breakup[0]);
			
		});
	}
	
	$('.date3 input').datepicker({
		startView: 0,
	    minViewMode: 0,
	    autoclose: true,
	    orientation: "auto",
	    startDate: "+1d",
	    endDate: "+34d",
	    daysOfWeekDisabled: "0,6",
	    datesDisabled: holiday_array
	});

	
}



function callbackZip(json){
	var obj = json;
	if(obj.status == "success"){
		var state = obj.data.StateZip.state;
		var city = obj.data.StateZip.city;
		
		$("#State").val(state);
		$("#City").val(city);
	}
	
}

function callbackZip2(json){
	var obj = json;
	if(obj.status == "success"){
		var state = obj.data.StateZip.state;
		
		if(state != $("#State").val()){
			$("#State").addClass("verror");
			vfields[callback_obj.Zip2] = false;	
		}else{
			$("#State").removeClass("verror");
			vfields[callback_obj.Zip2] = true;
		}
		
	}
	
}


function callbackZip3(json){
	var obj = json;
	if(obj.status == "success"){
		var state = obj.data.StateZip.state;
		
		if(state != $("#EmployerState").val()){
			$("#EmployerState").addClass("verror");
			vfields[callback_obj.Zip3] = false;	
		}else{
			$("#EmployerState").removeClass("verror");
			vfields[callback_obj.Zip3] = true;
		}
		
	}
	
}







