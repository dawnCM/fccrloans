

function checkPaydate1(validate){
	var m1 = moment($('#Paydate1').val(),'MM/DD/YYYY');
		
	if($('#Paydate1').val() == ""){
		if(validate)$('#PayFrequency').addClass("verror");
		$('#Paydate2').val("");
		return false;	
	}else{
		if(validate)$('#PayFrequency').removeClass("verror");
		
		if($('#PayFrequency').val() == "weekly"){
			m1.add(7, 'days');
			
		}else if($('#PayFrequency').val() == "monthly"){
			m1.add(30, 'days');
			
		}else if($('#PayFrequency').val() == "bi-weekly"){
			m1.add(14, 'days');
			
		}else if($('#PayFrequency').val() == "semi-monthly"){
			m1.add(15, 'days');
			
		}
		
		var format = m1.format("MM")+"/"+m1.format("DD")+"/"+m1.format("YYYY");
		//check holiday
		//if(in_array(holiday_array, format)){
			//if(m1.day() == 5){//Friday so set at Thursday
				
			//}
		//}
		
		//Check weekends on paydate2
		if(m1.day() == 0){ //Sunday set to monday
			m1.add(1, 'd');	
		}
		
		if(m1.day() == 6){ //Saturday set to Friday
			m1.subtract(1, 'd');	
		}
		
		
		$('#Paydate2').val(m1.format("MM")+"/"+m1.format("DD")+"/"+m1.format("YYYY"));
		return true;
	
	}
}


$(document).ready(function(){

	$('.date input').datepicker({
	    startView: 2,
	    autoclose: true,
	    orientation: "auto",
	    startDate: "-80y",
	    endDate: "-18y"
	});

	$('.date2 input').datepicker({
		startView: 2,
	    minViewMode: 1,
	    autoclose: true,
	    orientation: "auto",
	    endDate: "-1d",
	    startDate: "-10y"
	});
	
	

	
	if(jQuery('#PrimaryPhone').val() != ''){
		$('#PrimaryPhone').on('change',function(e){
			var $this = $(this),
			phone = $this.val().replace(/\D/g, '');
			if (phone.length == 10) {
				$('#PrimaryPhone').removeClass('verror');
		        var phone3 = phone.substr(6,4);
		        var phone2 = phone.substr(3,3);
		        var phone1 = phone.substr(0,3);
		        
		        $('#PrimaryPhone').val(phone1+phone2+phone3);
		        
	        
		    } else {
		    	$('#PrimaryPhone').addClass('verror');
		    };
			console.log('Phone 1: '+phone1);
			console.log('Phone 2: '+phone2);
			console.log('Phone 3: '+phone3);
		});
	}
	
	$('#CoPrimaryPhone').on('change',function(e){
		var $this = $(this),
		phone = $this.val().replace(/\D/g, '');
		if (phone.length == 10) {
			$('#CoPrimaryPhone').removeClass('verror');
	        var phone3 = phone.substr(6,4);
	        var phone2 = phone.substr(3,3);
	        var phone1 = phone.substr(0,3);
	        
	        $('#CoPrimaryPhone').val(phone1+phone2+phone3);
	        
        
	    } else {
	    	$('#CoPrimaryPhone').addClass('verror');
	    };
		
	});
	
	$('#WorkPhone').on('change',function(e){
		var $this = $(this),
		phone = $this.val().replace(/\D/g, '');
		if (phone.length == 10) {
			$('#WorkPhone').removeClass('verror');
			
	        var phone3 = phone.substr(6,4);
	        var phone2 = phone.substr(3,3);
	        var phone1 = phone.substr(0,3);
	        
	        $('#WorkPhone').val(phone1+phone2+phone3);
	        
	    } else {
	    	$('#WorkPhone').addClass('verror');
	    };
		
	});
	
	$('#CoWorkPhone').on('change',function(e){
		var $this = $(this),
		phone = $this.val().replace(/\D/g, '');
		if (phone.length == 10) {
			$('#CoWorkPhone').removeClass('verror');
			
	        var phone3 = phone.substr(6,4);
	        var phone2 = phone.substr(3,3);
	        var phone1 = phone.substr(0,3);
	        
	        $('#CoWorkPhone').val(phone1+phone2+phone3);
	        
	    } else {
	    	$('#CoWorkPhone').addClass('verror');
	    };
		
	});
	
	
	$('#Ssn').on('change',function(e){
		var $this = $(this);
		var ssn = $this.val().replace(/\D/g, '');
		if (ssn.length == 9) {
			$("#Ssn").removeClass("verror");
			$("#Ssn").val(ssn);
	        var ssn3 = ssn.substr(5,4);
	        var ssn2 = ssn.substr(3,2);
	        var ssn1 = ssn.substr(0,3);
	    } else {
	        $("#Ssn").addClass("verror !important");
	    };
		console.log('SSN 1: '+ssn1);
		console.log('SSN 2: '+ssn2);
		console.log('SSN 3: '+ssn3);
	});

	$('#CoSsn').on('change',function(e){
		var $this = $(this);
		var ssn = $this.val().replace(/\D/g, '');
		if (ssn.length == 9) {
			$("#CoSsn").removeClass("verror");
			$("#CoSsn").val(ssn);
	        var ssn3 = ssn.substr(5,4);
	        var ssn2 = ssn.substr(3,2);
	        var ssn1 = ssn.substr(0,3);
	    } else {
	        $("#CoSsn").addClass("verror !important");
	    };
		console.log('SSN 1: '+ssn1);
		console.log('SSN 2: '+ssn2);
		console.log('SSN 3: '+ssn3);
	});

	/*$('#ResidentSinceDate').on('change',function(e){
		var m1 = moment($('#ResidentSinceDate').val(),'MM/YYYY');
		var m2 = moment(moment(),'MM/YYYY');
		var mydiff1 = moment(m2,'MM/YYYY').diff(moment(m1,'MM/YYYY'), 'months', true);

		var mydiff2 = parseInt(Math.floor(moment(m2,'MM/YYYY').diff(moment(m1,'MM/YYYY'), 'years', true)));
		var reduced = parseInt((mydiff1-(mydiff2*12)));
		$('#mid_resulty').html(mydiff2+' Years');
		$('#mid_resultm').html(reduced+' Months');
		
		
		
		$('#ResidenceTimeYear').val(mydiff2);
		$('#ResidenceTimeMonth').val(reduced);
		$('#ResidentSinceDate').val(m1.format("MM")+"/"+m1.format("YYYY"));
		$('#ResidenceTotalMonths').val(parseInt(mydiff1));
		
	});*/
	
/*	$('#EmploymentTime').on('change',function(e){
		var m1 = moment($('#EmploymentTime').val(),'MM/YYYY');
		var m2 = moment(moment(),'MM/YYYY');
		
		var mydiff1 = moment(m2,'MM/YYYY').diff(moment(m1,'MM/YYYY'), 'months', true);

		var mydiff2 = parseInt(Math.floor(moment(m2,'MM/YYYY').diff(moment(m1,'MM/YYYY'), 'years', true)));
		var reduced = parseInt((mydiff1-(mydiff2*12)));
		$('#mid_resulty').html(mydiff2+' Years');
		$('#mid_resultm').html(reduced+' Months');
		
		$('#EmploymentTimeYear').val(mydiff2);
		$('#EmploymentTimeMonth').val(reduced);
		$('#EmploymentTime').val(m1.format("MM")+"/"+m1.format("YYYY"));
		$('#EmploymentTotalMonths').val(parseInt(mydiff1));
				
		
	});	
	
	
	$('#CoEmploymentTime').on('change',function(e){
		var m1 = moment($('#CoEmploymentTime').val(),'MM/YYYY');
		var m2 = moment(moment(),'MM/YYYY');
		
		var mydiff1 = moment(m2,'MM/YYYY').diff(moment(m1,'MM/YYYY'), 'months', true);

		var mydiff2 = parseInt(Math.floor(moment(m2,'MM/YYYY').diff(moment(m1,'MM/YYYY'), 'years', true)));
		var reduced = parseInt((mydiff1-(mydiff2*12)));
		$('#mid_resulty').html(mydiff2+' Years');
		$('#mid_resultm').html(reduced+' Months');
		
		$('#CoEmploymentTimeYear').val(mydiff2);
		$('#CoEmploymentTimeMonth').val(reduced);
		$('#CoEmploymentTime').val(m1.format("MM")+"/"+m1.format("YYYY"));
		$('#CoEmploymentTotalMonths').val(parseInt(mydiff1));
				
		
	});	
	*/
	
	$('#DateOfBirth').on('change',function(e){
		var m1 = moment($('#DateOfBirth').val(),'MM/DD/YYYY');
		var m2 = moment(moment(),'MM/DD/YYYY');
		
		var years = parseInt(Math.floor(moment(m2,'MM/DD/YYYY').diff(moment(m1,'MM/DD/YYYY'), 'years', true)));;
		
		if(years < 18){
			$("#DateOfBirth").addClass("verror");
			
		}else{
			$("#DateOfBirth").removeClass("verror");
			$('#DateOfBirthMonth').val(m1.format("MM"));
			$('#DateOfBirthDay').val(m1.format("DD"));
			$('#DateOfBirthYear').val(m1.format("YYYY"));
			$('#DateOfBirth').val(m1.format("MM")+"/"+m1.format("DD")+"/"+m1.format("YYYY"));
			$('#Age').val(years);
		}
		
		
	});	
	
	$('#CoDateOfBirth').on('change',function(e){
		var m1 = moment($('#CoDateOfBirth').val(),'MM/DD/YYYY');
		var m2 = moment(moment(),'MM/DD/YYYY');
		
		var years = parseInt(Math.floor(moment(m2,'MM/DD/YYYY').diff(moment(m1,'MM/DD/YYYY'), 'years', true)));;
		
		if(years < 18){
			$("#CoDateOfBirth").addClass("verror");
			
		}else{
			$("#CoDateOfBirth").removeClass("verror");
			$('#CoDateOfBirthMonth').val(m1.format("MM"));
			$('#CoDateOfBirthDay').val(m1.format("DD"));
			$('#CoDateOfBirthYear').val(m1.format("YYYY"));
			$('#CoDateOfBirth').val(m1.format("MM")+"/"+m1.format("DD")+"/"+m1.format("YYYY"));
		}
		
		
	});	
	
	
	$('#Paydate1').on('change',function(e){
		
		checkPaydate1(true);
	});										
	
});
