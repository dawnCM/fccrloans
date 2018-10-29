var vfields;
var clicked = false;
var popped = false;
var anchorClicked = false;
var submit_process = 0;


//Listens for the ajax queue to completely finish.
$(document).bind('formValidateAjaxStop', function(e){
	submit_form();
});

//Call this function after a half second delay to allow time for the ajax calls to set
function submit_form(){
	additionalValidations();
	for (var i in vfields) {
		var invalid = false;
		if (!vfields[i]) {
			invalid = true;
			break;
		}
	}
	if (!invalid) {
		submitProcess();
		//Function submitProcess when submit_process = 2 is the ajax post.  This function is called by light box						
	}else{
		clicked=false;
	}
}

//function submitProcess(variable, value){
function submitProcess(){
	var data = $("#form1").serializeArray();
	$.ajax({
	    url: "php/sendData.php",
	    type: "post",
	    dataType: 'json',
	    data: data,
	    crossDomain: true,
	    success: function(res){

	    	var status = res.status;
	    	var redirect = decodeURIComponent(res.redirect);
	    	var total_sold = decodeURIComponent(res.total_sold);
			/*
			var status = 'Success';
	    	var redirect = "";
	    	var total_sold = 0;*/

	    	if(status == 'Success'){
				if(redirect !='' &&  total_sold != 0){
					
					window.location.replace(redirect);
				
				}else if(redirect =='' && total_sold == 0){
					
					jQuery('#tab7').show();
					$('html,body').scrollTop(0);
					jQuery('.name').text(jQuery('#FirstName').val());
					jQuery('#formdata').hide();
					
				
				}else{
					$(location).attr('href','pg5.php');	
				}
			} else {
				//Break page
	    		$(location).attr('href','pg5.php');	
			}
	    	
	    	/*if(status == 'success'){
	    		if(redirect != ''){
	    			$(location).attr('href', redirect);	
	    		}else{
	    			//Break page
	    			$(location).attr('href','pg5.php');	
	    		}
	    	}else{
	    		alert('error - Did you use an unique email?  Did you clear your cookies?');
	    	}*/
	    },
	    error:function(){
	    	alert('bad');
	    }
	});
	
}



function in_array(array, item){
	if(array instanceof Array){
        for(var i=0; i<array.length; i++){
            if(array[i]==item){
            	console.log('in array - '+item);
                return true;
            }
        }
        return false;
	}else{
		return false;
	}
	
}

$(document).ready(function(){
	$("#errmsg").hide();
	jQuery("#PrimaryPhone").mask("(999) 999-9999");
	jQuery("#SecondaryPhone").mask("(999) 999-9999");
	jQuery("#PhoneTCPA").mask("(999) 999-9999");
	//jQuery("#CoPrimaryPhone").mask("(999) 999-9999");
	jQuery("#WorkPhone").mask("(999) 999-9999");
	//jQuery("#CoWorkPhone").mask("(999) 999-9999");
	jQuery("#Ssn").mask("999-99-9999");
	//jQuery("#CoSsn").mask("999-99-9999");	

	// disable enter key
	$("#form1").keypress(function(e){
		if (e.which == 13) {
		   var tagName = e.target.tagName.toLowerCase();
		   if (tagName !== "textarea") {
			   return false;
		   }
		}
	});
	
	$('#FirstName').keyfilter(/[a-zA-Z\s-\.]/);
	$('#LastName').keyfilter(/[a-zA-Z\s-\.]/);
	$('#Address1').keyfilter(/[a-zA-Z0-9#\-\s\.\,]/);
	$('#Address2').keyfilter(/[a-zA-Z0-9#\-\s\.\,]/);
	$('#City').keyfilter(/[a-zA-Z\-\.\s]/);
	$('#Zip').keyfilter(/[0-9]/);
	
	$('#EmployerName').keyfilter(/[a-zA-Z0-9#_\-\s\.\,]/);
	$('#EmployerAddress').keyfilter(/[a-zA-Z0-9#\-\s\.\,]/);
	$('#EmployerCity').keyfilter(/[a-zA-Z\-\.\s]/);
	$('#EmployerZip').keyfilter(/[0-9]/);
	$('#MonthlyNetIncome').keyfilter(/[0-9]/);
	
	$('#BankAccountNumber').keyfilter(/[0-9]/);
	$('#BankRoutingNumber').keyfilter(/[0-9]/);
	$('#RentMortgage').keyfilter(/[0-9]/);
		
	var currencyRgx = /^[0-9]{1,5}?$/;
	var loanamtRgx = /(100|300|500|1000|1500|2500|3500|4500|5500|6500|7500|8500|9500|10000|11500|12500|13500|14500|15000|16500|17500|18500|19500|20500|21500|22500|23500|24500|25500|26500|27500|28500|29500)/;
	var loanpurpRgx = /(debt|home|major|auto|other|medical)/;
	
	var flnameRgx = /^([a-zA-Z\s-'\.]{1,50})$/;
	var dlnRgx = /^[0-9a-zA-Z\s-*]{1,17}?$/;
	var dlsRgx = /(AK|AL|AR|AZ|CA|CO|CT|DC|DE|FL|GA|HI|IA|ID|IL|IN|KS|KY|LA|MA|MD|ME|MI|MN|MO|MS|MT|NC|ND|NE|NH|NJ|NM|NV|NY|OH|OK|OR|PA|RI|SC|SD|TN|TX|UT|VA|VT|WA|WI|WV|WY)/;
	var emailRgx = /^[\w-]+(\.[\w-]+)*@([a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*?\.[a-zA-Z]{2,6}|(\d{1,3}\.){3}\d{1,3})(:\d{4})?$/;
	var resTypeRgx = /(Own With Mortgage|Own Without Mortgage|free|Rent)/;
	var add1Rgx = /^([a-zA-Z0-9\s-'\.\,]{1,50})$/;
	var add2Rgx = /^([a-zA-Z0-9\s-'\.\,]{0,50})$/;
	var cityRgx = /^([a-zA-Z\s-\.']{1,50})$/;
	var stateRgx = /(AK|AL|AR|AZ|CA|CO|CT|DC|DE|FL|GA|HI|IA|ID|IL|IN|KS|KY|LA|MA|MD|ME|MI|MN|MO|MS|MT|NC|ND|NE|NH|NJ|NM|NV|NY|OH|OK|OR|PA|RI|SC|SD|TN|TX|UT|VA|VT|WA|WI|WV|WY)/;
	var zipRgx = /^[0-9]{5}?$/;
	var phoneTypeRgx = /(Home|Mobile|Other)/;
	
	var incomesrcRgx = /(self_employed|employed|pension|disability|unemployed_with_income|unemployed|welfare)/;
	var nameRgx = /^([a-zA-Z0-9\s-'\.\,#_]{1,50})$/;
	var payfreqRgx = /(weekly|bi-weekly|semi-monthly|monthly)/;
	var truefalseRgx = /(true|false)/;
	
	var bankaccttypeRgx = /(checking|savings|none)/;
	var banktimeRgx = /(9|12|24|36|48|60|72|84|96|108)/;
	var abaRgx = /^([0-9]{9})$/;
	var bankacctRgx = /^[0-9]{4,17}$/;
	var dateRgx = /^((0[1-9])|(1[0-2]))\/(\d{4})$/;
	var ssnRgx = /^([0-9]{9})$/;
	var ynRgx = /(Yes|No)/;
	var phoneareapreRgx = /^[0-9]{3}$/;
	var phoneexchRgx = /^[0-9]{4}$/;
	var phoneRgx = /^[0-9]{10}$/;
	var birthdateRgx = /^(0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])[- /.](19|20)\d\d+$/;
	
	//Your Loan Section ********************************************************************************************************	
	$("#LoanAmount").change(function () {

		var e = document.getElementById("LoanAmount");
		var selectedloanamount = e.options[e.selectedIndex].value;
		$("#LoanAmount1").val(selectedloanamount);

		if (!$("#LoanAmount").val().match(currencyRgx)) {
			$("#LoanAmount").addClass("verror");
		} else {
			$("#LoanAmount").removeClass("verror");
		}
	});

	$("#second_loan" ).click(function() {
		/*var data2 = $("#form2").serializeArray();*/

		var es = document.getElementById("LoanAmountSecond");
		var selectedsecondloanamount = es.options[es.selectedIndex].value;
		$("#LoanAmount2").val(selectedsecondloanamount);
		$("#LoanAmount").val(selectedsecondloanamount);
		
		/*var selectedsecondloanamount =( "#LoanAmountSecond" ).val();
		$("#LoanAmount2").val(selectedsecondloanamount);*/

		//submitProcess(data2[0].name, data2[0].value);
		submitProcess();
	});

	// End Your Loan Section ******************************************************************************************************	
			
	//Verify Your Idenity *********************************************************************************************************
	
		
		$("#FirstName").change(function () {
			if (!$("#FirstName").val().match(flnameRgx)) {
				$("#FirstName").addClass("verror");
			} else {
				$("#FirstName").removeClass("verror");
			}
		});
	
		$("#LastName").change(function () {
			if (!$("#LastName").val().match(flnameRgx)) {
				$("#LastName").addClass("verror");
			} else {
				$("#LastName").removeClass("verror");
			}
		});
		
		$("#DriversLicenseNumber").change(function () {
			if (!$("#DriversLicenseNumber").val().match(dlnRgx)) {
				$("#DriversLicenseNumber").addClass("verror");
			} else {
				$("#DriversLicenseNumber").removeClass("verror");
			}
		});
	
		$("#DriversLicenseState").change(function () {
			if (!$("#DriversLicenseState").val().match(dlsRgx)) {
				$("#DriversLicenseState").addClass("verror");
			} else {
				$("#DriversLicenseState").removeClass("verror");
			}
		});
		
		$("#Email").change(function () {
			if (!$("#Email").val().match(emailRgx)) {
				$("#Email").addClass("verror");
			} else {
				$("#Email").removeClass("verror");
			}
		});
		
		$("#ResidenceType").change(function () {
			if (!$("#ResidenceType").val().match(resTypeRgx)) {
				$("#ResidenceType").addClass("verror");
			} else {
				$("#ResidenceType").removeClass("verror");
			
			}
		});
		
		
		$("#Address1").change(function () {
			if (!$("#Address1").val().match(add1Rgx)) {
				$("#Address1").addClass("verror");
			} else {
				$("#Address1").removeClass("verror");
			}
		});
	
		$("#Address2").change(function () {
			if (!$("#Address2").val().match(add2Rgx)) {
				$("#Address2").addClass("verror");
			} else {
				$("#Address2").removeClass("verror");
			}
		});
	
		$("#City").change(function () {
			if (!$("#City").val().match(cityRgx)) {
				$("#City").addClass("verror");
			} else {
				$("#City").removeClass("verror");
			}
		});
	
		$("#State").change(function () {
	
			if (!$("#State").val().match(stateRgx)) {
				$("#State").addClass("verror");
			} else {
				$("#State").removeClass("verror");
			}
		});
	
		$("#Zip").change(function () {
			if (!$("#Zip").val().match(zipRgx)) {
				$("#Zip").addClass("verror");
			} else {
				$("#Zip").removeClass('verror');
			}
		});
		
		$("#RentMortgage").change(function () {
			if (!$("#RentMortgage").val().match(currencyRgx)) {
				$("#RentMortgage").addClass("verror");
			} else {
				$("#RentMortgage").removeClass("verror");
			}
		});
		
		$("#PhoneType").change(function () {
			if (!$("#PhoneType").val().match(phoneTypeRgx)) {
				$("#PhoneType").addClass("verror");
			} else {
				$("#PhoneType").removeClass("verror");
			}
		});	
		
		$("#Military").change(function () {
			if (!$("#Military").val().match(truefalseRgx)) {
				$("#Military").addClass("verror");
			} else {
				$("#Military").removeClass("verror");
			}
		});
		
	
	// End Verify Your Idenity *******************************************************************************************
	
	
	//Employment Incformation Section ************************************************************************************	
		$("#EmployeeType").change(function () {
			if (!$("#EmployeeType").val().match(incomesrcRgx)) {
				$("#EmployeeType").addClass("verror");
			} else {
				$("#EmployeeType").removeClass("verror");
			}
		});	
	
		$("#EmployerName").change(function () {
			if (!$("#EmployerName").val().match(nameRgx)) {
				$("#EmployerName").addClass("verror");
			} else {
				$("#EmployerName").removeClass("verror");
			}
		});
		
		$("#EmployerAddress").change(function () {
			if (!$("#EmployerAddress").val().match(add1Rgx)) {
				$("#EmployerAddress").addClass("verror");
			} else {
				$("#EmployerAddress").removeClass("verror");
			}
		});
	
		
		$("#EmployerCity").change(function () {
			if (!$("#EmployerCity").val().match(cityRgx)) {
				$("#EmployerCity").addClass("verror");
			} else {
				$("#EmployerCity").removeClass("verror");
			}
		});
	
		$("#EmployerState").change(function () {
			if (!$("#EmployerState").val().match(stateRgx)) {
				$("#EmployerState").addClass("verror");
			} else {
				$("#EmployerState").removeClass("verror");
			}
		});
	
		
		$("#EmployerZip").change(function () {
			if (!$("#EmployerZip").val().match(zipRgx)) {
				$("#EmployerZip").addClass("verror");
			} else {
				$("#EmployerZip").removeClass('verror');
			}
		});
		
		$("#PayFrequency").change(function () {
			$("#Paydate1").val("")
			if (!$("#PayFrequency").val().match(payfreqRgx)) {
				$("#PayFrequency").addClass("verror");
			} else {
				$("#PayFrequency").removeClass("verror");
			}
		});
		
		$("#MonthlyNetIncome").change(function () {
			if (!$("#MonthlyNetIncome").val().match(currencyRgx)) {
				$("#MonthlyNetIncome").addClass("verror");
			} else {
				$("#MonthlyNetIncome").removeClass("verror");
			}
		});
		
		
		
		$("#DirectDeposit").change(function () {
	
			if (!$("#DirectDeposit").val().match(truefalseRgx)) {
				$("#DirectDeposit").addClass("verror");
			} else {
				$("#DirectDeposit").removeClass("verror");
			}
		});
		

	// Bank Information Section ******************************************************************************************

	$("#BankRoutingNumber").change(function () {
		$.ajax({
	        url: 'https://service.leadstudio.com/getBankInfobyABA/'+$("#BankRoutingNumber").val()+'/callbackBankName2',
	        jsonpCallback: 'callbackBankName2',
	        dataType: 'jsonp',
		    crossDomain: true
		});
	});

	$("#BankAccountNumber").change(function () {
		if (!$("#BankAccountNumber").val().match(bankacctRgx)) {
			$("#BankAccountNumber").addClass("verror");
		} else {
			$("#BankAccountNumber").removeClass("verror");
		}
	});
	
	$("#BankAccountType").change(function () {

		if (!$("#BankAccountType").val().match(bankaccttypeRgx)) {
			$("#BankAccountType").addClass("verror");
		} else {
			$("#BankAccountType").removeClass("verror");
		}
	});
	
	$("#BankTime").change(function () {

		if (!$("#BankTime").val().match(banktimeRgx)) {
			$("#BankTime").addClass("verror");
		} else {
			$("#BankTime").removeClass("verror");
		}
	});
		
// End Bank Information Section **************************************************************************************


	//Verify Your Idenity
	$("#FirstName").val(f_firstName);	
	$("#LastName").val(f_lastName);
	$("#DateOfBirth").val(f_dateOfBirth);
	$("#DriversLicenseNumber").val(f_driversLicenseNumber);
	$("#DriversLicenseState option[value="+ f_driversLicenseState +"]").attr('selected', 'selected');
	$("#Email").val(f_email);
	//$("#ResidenceType option[value="+ f_residenceType +"]").attr('selected', 'selected');
	$("#ResidentSinceDate").val(f_residenceDate);
	$("#Address1").val(f_address1);
	$("#Address2").val(f_address2);
	$("#City").val(f_city);
	//$("#State option[value="+ f_state +"]").attr('selected', 'selected');
	$("#Zip").val(f_zip);
	$("#RentMortgage").val(f_rentMortgage);
	$("#PrimaryPhone").val(f_primaryPhone);
	$("#PhoneTCPA").val(f_phoneTCPA);
	$("#SecondaryPhone").val(f_secondaryPhone);
	
	//Employment Information
	$("#EmployeeType option[value="+ f_incomeSource +"]").attr('selected', 'selected');
	$("#EmployerName").val(f_employerName);
	$("#EmployerAddress").val(f_employerAddress);
	$("#EmployerCity").val(f_employerCity);
	$("#EmployerZip").val(f_employerZip);
	$("#EmployerState option[value="+ f_employerState +"]").attr('selected', 'selected');
	$("#WorkPhone").val(f_workPhone);
	$("#EmploymentTime").val(f_employmentTime);
	//$("#MonthlyNetIncome").val(f_monthlyNetIncome);
	$("#PayFrequency option[value="+ f_payFrequency +"]").attr('selected', 'selected');
	$("#Paydate1").val(f_paydate1);
	$("#DirectDeposit option[value="+ f_directDeposit +"]").attr('selected', 'selected');
	
	$("#next").click(function() {
		if(clicked == true){
			return;
		} else {
			clicked = true;
		}
		//clear array
		vfields = [];


		
		//create an ajaxmanager object
		var ajaxManager = $.manageAjax.create('formValidate', { 
			queue: true, 
			cacheResponse: false
			
		});
	
		if (!$("#LoanAmount").val().match(currencyRgx)) {
			$("#LoanAmount").addClass("verror");
			vfields[0] = false;
		}else{
			$("#LoanAmount").removeClass("verror");
			vfields[0] = true;	
		}
		
		if (!$("#MonthlyNetIncome").val().match(currencyRgx) || $("#MonthlyNetIncome").val() == 0) {
			$("#MonthlyNetIncome").addClass("verror");
			vfields[2] = false;
		} else {
			$("#MonthlyNetIncome").removeClass("verror");
			vfields[2] = true;
		}
				
		if (!$("#FirstName").val().match(flnameRgx)) {
			$("#FirstName").addClass("verror");
			vfields[5] = false;
		} else {
			$("#FirstName").removeClass("verror");
			vfields[5] = true;
		}
		
		if (!$("#LastName").val().match(flnameRgx)) {
			$("#LastName").addClass("verror");
			vfields[6] = false;
		} else {
			$("#LastName").removeClass("verror");
			vfields[6] = true;
		}
		
		if (!$("#DateOfBirth").val().match(birthdateRgx)) {
			$("#DateOfBirth").addClass("verror");
			vfields[7] = false;
		} else {
			$("#DateOfBirth").removeClass("verror");
			$( "#DateOfBirth" ).trigger( "change" );
			vfields[7] = true;
		}
		
		
		if (!$("#Ssn").val().match(ssnRgx)) {
			$("#Ssn").addClass("verror");
			vfields[8] = false;
		} else {
			$("#Ssn").removeClass("verror");
			vfields[8] = true;
		}
		
		if (!$("#DriversLicenseNumber").val().match(dlnRgx)) {
			$("#DriversLicenseNumber").addClass("verror");
			vfields[9] = false;
		} else {
			$("#DriversLicenseNumber").removeClass("verror");
			vfields[9] = true;
		}

		if (!$("#DriversLicenseState").val().match(dlsRgx)) {
			$("#DriversLicenseState").addClass("verror");
			vfields[10] = false;
		} else {
			$("#DriversLicenseState").removeClass("verror");
			vfields[10] = true;
		}
		
		if (!$("#Email").val().match(emailRgx)) {
			$("#Email").addClass("verror");
			vfields[11] = false;
		} else {
			
			$("#Email").removeClass("verror");
			vfields[11] = true;
					
		}	
		
		if (!$("#ResidenceType").val().match(resTypeRgx)) {
			$("#ResidenceType").addClass("verror");
			vfields[12] = false;
		} else {
			$("#ResidenceType").removeClass("verror");
			vfields[12] = true;
		}

		if (!$("#Address1").val().match(add1Rgx)) {
			$("#Address1").addClass("verror");
			vfields[14] = false;
		} else {
			$("#Address1").removeClass("verror");
			vfields[14] = true;
		}

		if (!$("#Address2").val().match(add2Rgx)) {
			$("#Address2").addClass("verror");
			vfields[15] = false;
		} else {
			$("#Address2").removeClass("verror");
			vfields[15] = true;
		}

		if (!$("#City").val().match(cityRgx)) {
			$("#City").addClass("verror");
			vfields[16] = false;
		} else {
			$("#City").removeClass("verror");
			vfields[16] = true;
		}
		
		if (!$("#RentMortgage").val().match(currencyRgx)) {
			$("#RentMortgage").addClass("verror");
			vfields[19] = false;
		} else {
			$("#RentMortgage").removeClass("verror");
			vfields[19] = true;
		}

		if(jQuery('#PrimaryPhone').val() != ''){
			$('#SecondaryPhone').attr('data-parsley-required', 'false');

			var phone = $("#PrimaryPhone").val().replace(/\D/g, '');
			var phone3 = phone.substr(6,4);
	    	var phone2 = phone.substr(3,3);
	    	var phone1 = phone.substr(0,3);
	    	
	    	if (!phone1.match(phoneareapreRgx)) {
				$("#PrimaryPhone").addClass("verror");
				vfields[20] = false;
			} else {
				$("#PrimaryPhone").removeClass("verror");
				vfields[20] = true;
			}    	
	    	
	    	if (!phone2.match(phoneareapreRgx)) {
				$("#HomePhonePrefix").addClass("verror");
				vfields[21] = false;
			} else {
				if (phone1.match(phoneareapreRgx)) {
					
					//I need to access object in callback functions so I can set vfields correctly.  Value must be the same as vfield index
					callback_obj.PrimaryPhone = 21;
					//Add to queue
					ajaxManager.add({ 
						url: 'https://service.leadstudio.com/npaNpxCheck/'+phone1+'/'+phone2+'/callbackPrimaryPhone',
						type: 'GET',
						dataType: 'jsonp',
						jsonpCallback : 'callbackPrimaryPhone'
					});
				
				} else {
					$("#PrimaryPhone").addClass('verror');
					vfields[21] = false;
				}
			}
	    	
	    	
	    	if (!phone3.match(phoneexchRgx)) {
				$("#PrimaryPhone").addClass("verror");
				vfields[23] = false;
			} else {
				$("#PrimaryPhone").removeClass("verror");
				vfields[23] = true;

			}

		}
		else if(jQuery('#SecondaryPhone').val() != ''){
			var phone = $("#SecondaryPhone").val().replace(/\D/g, '');
			var phone3 = phone.substr(6,4);
	    	var phone2 = phone.substr(3,3);
	    	var phone1 = phone.substr(0,3);
	    	
	    	if (!phone1.match(phoneareapreRgx)) {
				$("#SecondaryPhone").addClass("verror");
				vfields[20] = false;
			} else {
				$("#SecondaryPhone").removeClass("verror");
				vfields[20] = true;
			}    	
	    	
	    	if (!phone2.match(phoneareapreRgx)) {
				$("#HomePhonePrefix").addClass("verror");
				vfields[21] = false;
			} else {
				if (phone1.match(phoneareapreRgx)) {
					
					//I need to access object in callback functions so I can set vfields correctly.  Value must be the same as vfield index
					callback_obj.SecondaryPhone = 21;
					//Add to queue
					ajaxManager.add({ 
						url: 'https://service.leadstudio.com/npaNpxCheck/'+phone1+'/'+phone2+'/callbackPrimaryPhone',
						type: 'GET',
						dataType: 'jsonp',
						jsonpCallback : 'callbackPrimaryPhone'
					});
				
				} else {
					$("#SecondaryPhone").addClass('verror');
					vfields[21] = false;
				}
			}
	    	
	    	
	    	if (!phone3.match(phoneexchRgx)) {
				$("#SecondaryPhone").addClass("verror");
				vfields[23] = false;
			} else {
				$("#SecondaryPhone").removeClass("verror");
				vfields[23] = true;

			}
			$('#PrimaryPhone').attr('data-parsley-required', 'false');
		}
		else if(jQuery('#PrimaryPhone').val() == '' && jQuery('#SecondaryPhone').val() == ''){
			$('#PrimaryPhone').attr('data-parsley-required', 'true');
			$('#SecondaryPhone').attr('data-parsley-required', 'true');
			vfields[20]= false;
			vfields[21]= false;
			vfields[23]= false;
			$("#PrimaryPhone").addClass("verror");
			$("#SecondaryPhone").addClass("verror");
		}

		if (!$("#EmployeeType").val().match(incomesrcRgx)) {
			$("#EmployeeType").addClass("verror");
			vfields[26] = false;
		} else {
			$("#EmployeeType").removeClass("verror");
			vfields[26] = true;
		}
		
		if (!$("#EmployerName").val().match(nameRgx)) {
			$("#EmployerName").addClass("verror");
			vfields[27] = false;
		} else {
			$("#EmployerName").removeClass("verror");
			vfields[27] = true;
		}
		
		if (!$("#EmployerAddress").val().match(add1Rgx)) {
			$("#EmployerAddress").addClass("verror");
			vfields[28] = false;
		} else {
			$("#EmployerAddress").removeClass("verror");
			vfields[28] = true;
		}
		
		if (!$("#EmployerCity").val().match(cityRgx)) {
			$("#EmployerCity").addClass("verror");
			vfields[29] = false;
		} else {
			$("#EmployerCity").removeClass("verror");
			vfields[29] = true;
		}
		
		
		if (!$("#EmployerZip").val().match(zipRgx)) {
			$("#EmployerZip").addClass("verror");
			vfields[31] = false;
		} else {
			$("#EmployerZip").removeClass('verror');
			vfields[31] = true;
		}
		
		var wphone = $("#WorkPhone").val().replace(/\D/g, '');
		var wphone3 = wphone.substr(6,4);
    	var wphone2 = wphone.substr(3,3);
    	var wphone1 = wphone.substr(0,3);
    	
		if (!wphone1.match(phoneareapreRgx)) {
			$("#WorkPhone").addClass("verror");
			vfields[32] = false;
		} else {
			$("#WorkPhone").removeClass("verror");
			vfields[32] = true;
		}

		if (!wphone2.match(phoneareapreRgx)) {
			$("#WorkPhone").addClass("verror");
			vfields[33] = false;
		} else {
			if (wphone1.match(phoneareapreRgx)) {
			
			
				if(wphone1 != 800 && wphone1 != 888){
					callback_obj.WorkPhone = 33;
					//Add to queue
					ajaxManager.add({ 
						url: 'https://service.leadstudio.com/npaNpxCheck/'+wphone1+'/'+wphone2+'/callbackWorkPhone',
						type: 'GET',
						dataType: 'jsonp',
						jsonpCallback : 'callbackWorkPhone'
					});
					
		
		
				}else{
					$("#WorkPhone").removeClass('verror');
					vfields[34] = true;		
				}
			
		
			} else {
				$("#WorkPhone").addClass('verror');
				vfields[32] = false;
			}
		}

		if (!wphone3.match(phoneexchRgx)) {
			$("#WorkPhone").addClass("verror");
			vfields[35] = false;
		} else {
			$("#WorkPhone").removeClass("verror");
			vfields[35] = true;

		}
		
		
		if (!$("#PayFrequency").val().match(payfreqRgx)) {
			$("#PayFrequency").addClass("verror");
			vfields[37] = false;
		} else {
			$("#PayFrequency").removeClass("verror");
			vfields[37] = true;
		}
				
		if(!checkPaydate1()){
			$("#Paydate1").addClass("verror");
			vfields[38] = false;
		} else {
			$("#Paydate1").removeClass("verror");
			vfields[38] = true;	
		}
	   
		if (!$("#MonthlyNetIncome").val().match(currencyRgx) || $("#MonthlyNetIncome").val() == 0) {
			$("#MonthlyNetIncome").addClass("verror");
			vfields[39] = false;
		} else {
			$("#MonthlyNetIncome").removeClass("verror");
			vfields[39] = true;
		}
		
		if (!$("#DirectDeposit").val().match(truefalseRgx)) {
			$("#DirectDeposit").addClass("verror");
			vfields[40] = false;
		} else {
			$("#DirectDeposit").removeClass("verror");
			vfields[40] = true;
		}		
	
		if (!$("#BankAccountType").val().match(bankaccttypeRgx)) {
			$("#BankAccountType").addClass("verror");
			vfields[59] = false;
		} else {
			$("#BankAccountType").removeClass("verror");
			vfields[59] = true;			
		}
		
		if ($("#BankRoutingNumber").val().match(abaRgx)) {
			
			callback_obj.BankName = 60;
			var routing = $("#BankRoutingNumber").val();
			//Add to queue
			ajaxManager.add({ 
				url: 'https://service.leadstudio.com/getBankInfobyABA/'+routing+'/callbackBankName',
				type: 'GET',
				dataType: 'jsonp',
				jsonpCallback : 'callbackBankName'
			});
			
		} else {
			$("#BankRoutingNumber").addClass('verror');
			$("#BankRoutingNumber").val("");
			vfields[60] = false;
		}

		if (!$("#BankAccountNumber").val().match(bankacctRgx)) {
			$("#BankAccountNumber").addClass("verror");
			vfields[61] = false;
		} else {
			$("#BankAccountNumber").removeClass("verror");
			vfields[61] = true;
		}
				
		if (!$("#BankTime").val().match(banktimeRgx)) {
			$("#BankTime").addClass("verror");
			vfields[62] = false;
		} else {
			$("#BankTime").removeClass("verror");
			vfields[62] = true;
		}
		
		
		if (!$("#AgreeConsent").attr('checked')) {
			$("#AgreeConsentCB").addClass("cberror");
			vfields[63] = false;
		} else {
			$("#AgreeConsentCB").removeClass("cberror");
			vfields[63] = true;
		}
		
		if(jQuery('#PrimaryPhone').val() != ''){
			
			if (!$("#PrimaryPhone").val().match(phoneRgx)) {
				$("#PrimaryPhone").addClass("verror");
				//vfields[66] = false;
			} else {
				$("#PrimaryPhone").removeClass("vberror");
				vfields[66] = true;
			}

		}
		// if(jQuery('#PhoneTCPA').val() != ''){
		// 	if (!$("#PhoneTCPA").val().match(phoneRgx)) {
		// 		$("#PhoneTCPA").addClass("verror");
		// 			vfields[67] = false;
		// 	} else {
		// 		$("#PhoneTCPA").removeClass("vberror");
		// 		vfields[67] = true;
		// 	}

		// }
		
		
		// if($("#Zip").val() != ""){
		// 	callback_obj.Zip2 = 69;
		// 	//Add to queue
		// 	alert("<?php echo $zip ?>");
		// 	ajaxManager.add({
		// 		url: 'https://service.leadstudio.com/getCityStatebyZip/'+$("#Zip").val()+'/callbackZip2',
		// 		jsonpCallback: 'callbackZip2',
		// 		dataType: 'jsonp',
		// 		crossDomain: true
		// 	});
		// }	
		
		if($("#EmployerZip").val() != ""){
			callback_obj.Zip3 = 70;
			//Add to queue
			ajaxManager.add({
				url: 'https://service.leadstudio.com/getCityStatebyZip/'+$("#EmployerZip").val()+'/callbackZip3',
				jsonpCallback: 'callbackZip3',
				dataType: 'jsonp',
				crossDomain: true
			});
		}				
		
		for (var i in vfields) {
			var invalid = false;
			if (!vfields[i]) {
				invalid = true;
				break;
			}
		}

		if (invalid) {
			clicked = false;
			$("#errmsg").show();
		} else {
			submit_form();
		}
		
		/*if(ajaxManager.inProgress == 0){
			
			submit_form();

		}*/		

	});	

});

//These fuctions are to run after the ajax queue is finished
function additionalValidations(){
	
	if($("#WorkPhone").val() == $("#PrimaryPhone").val()){
		$("#PrimaryPhone").addClass("verror");
		$("#WorkPhone").addClass("verror");
		vfields[71] = false;	
	}else{
		$("#PrimaryPhone").removeClass("verror");
		$("#WorkPhone").removeClass("verror");
		vfields[71] = true;		
	}
}