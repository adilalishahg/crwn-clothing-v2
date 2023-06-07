{ include file = headerinner.tpl}

<script src="//maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyBBE53xDKH93kCWSWREyehlzH8N_t2R2lw"></script>

{literal} 

<script language="JavaScript" type="text/javascript" src="suggest.js"></script> 

<script type="text/javascript">

$(document).ready(function() {

	$("#search").validate();

	$("#returnpickupUSS").mask("29:59");

	$("#apptimeUSS").mask("29:59:59");

	$("#dobUSS").mask("99/99/9999");

	$("#phnumUSS").mask("(454) 654-6546");

	});	

function deleteRec(id)

		{ var ok;

		ok=confirm("Are you sure you want to delete this record");

		if (ok)

		{ $.post("delete.php", {id: id}, function(data)

			{ });

			$('#tr'+id).hide();

			//location.reload();

			 //location.href="reqdetails.php?delId="+id;

		return true;}else{			

			return false;}

}

function stchange(val,req)

{

  if (val != ''){		

 	location.href="reqdetails.php?st="+val+"&req="+req;

	return true;}else{

			return false;

		}			

	}	

function ChangeStatus(val,st){

var ans= 1;

if(st == '3'){

     jPrompt('Specify the reason for disapproving:', '', ' Medical Transportation', function(r) {

	  if(typeof(r) == "undefined"){

	    Ask();

	  }else{

	  if(r == '' || r == null){ jAlert('You must Specify a reason for disapproving'); return false; }	  	  else{

	    ans = r;  	

        AjaxSend(val,st,ans); }

	  }

	});

}

if(st == '2'){

   AjaxSend(val,st,ans);

  }

}	

function removeTr(val){

  $('#tr'+val).remove();

}

function Ask(){

    jPrompt('Specify the reason for disapproving:', '', ' Medical Transportation', function(r) {

	  if(typeof(r) == "undefined"){

	  jAlert('You must Specify a reason for disapproving'); 	  

	    Ask();

	  }else{

	  return r; }

	});

}	

function AjaxSend(val,st,ans){

   $.post("hosprequests.php", {queryString: ""+val, sta:""+st, rea: ""+ans}, function(data){

  if(data.length > 0) {   

        if(st == '3'){	

          if(data == 'Success'){

            //var url = window.location;

            //location.href= url;

           removeTr(val); return false;

          }else{

            //var url = window.location;

            //location.href= url;

            removeTr(val); return false;

          }	

		}

		else if(st == '2'){ 

          if(data == 'Success'){

           //var url = window.location;

           //location.href= url;

            removeTr(val); return false;

          }else{

           //var url = window.location;

           //location.href= url;

            removeTr(val); return false;

          }		

		} 

        else{

		return false;	

		} 		

      }

	 });

}



</script> 

{/literal}

{literal} 

<script type="text/javascript">

$(document).ready(function(){	

$("#dob1").datepicker( {yearRange:'-120:00'} );

$("#dob1").mask("9999-99-99");

$("#appdate").mask("9999-99-99");

$('#adduser').validate();

});

function test(){

if($('#sameadd').attr('checked')){	

var v=$('#autocomplete').val();

var z=$('#psuiteroom').val();

var x=$('#picklocation').val();

var y=$('#pickup_instruction').val();

    $('#autocomplete3').val(v);

	$('#bsuiteroom').val(z);

    $('#backtolocation').val(x);

	$('#backto_instruction').val(y);

 } 

	else { 

	$('#autocomplete3').val('');

	$('#bsuiteroom').val('');

    $('#backtolocation').val('');

	$('#backto_instruction').val('');

 }}

$(document).ready(function (){

$('#org_apptime').mask('29:59');

$('#three_pickup').mask('29:59');

$('#four_pickup').mask('29:59');

$('#five_pickup').mask('29:59');

var v=$('#puchoice').val();

if(v =='Time'){ 

	$('#rpTime').show();	

    }

});

function tValid(val,idv){

  var i = val.substr(0,1);

  var j = val.substr(1,1);

   if(i == '2'){

     if(j > 3){ $('#'+idv).val(''); return false; }else{ return true; }

    }

}

function chTrip(val){

//$('#waitopt').attr('checked', false);

   	if(val == 'One Way'){

	$('#hideno').hide();

	$("#showno").hide();

	//$('#returnpickup').attr("disabled",true);

	$('#puchoice').removeAttr("class");

	//$('#backto').removeAttr("class");	

	$('#returnpickup').removeAttr("class");	

	$('#rpu').removeAttr("class");			

	$('#rpu').hide();	

	//$('#trBackTo').hide();	

	$('#rpTime').hide();	

	$('#trBackTo3').hide();	

	$('#trBackTo4').hide();	

	//$('#backto').hide();	

	//To hide

  	$('#b0').hide();

	$('#b1').hide();	

	$('#b2').hide();

	$('#b3').hide();

	$('#b4').hide();

	$('#b5').hide();

	$('#three0').hide();

	$('#three1').hide();

	$("#three2").hide();

	$('#three3').hide();

	$("#three4").hide();

	$('#three5').hide();

	$("#three6").hide();

	$("#three7").hide();

	$('#five0').hide();

	$('#five1').hide();

	$("#five2").hide();

	$('#five3').hide();

	$("#five4").hide();

	$('#five5').hide();

	$("#five6").hide();

	$("#five7").hide();

	$('#four0').hide();

	$('#four1').hide();

	$("#four2").hide();

	$('#four3').hide();

	$("#four4").hide();

	$('#four5').hide();

	$("#four6").hide();

	$("#four7").hide();	

	//Remove required attributes

	$('#backto').removeClass('required');

	$('#backtocity').removeClass('required');

	$('#backtostate').removeClass('required');

	$('#backtozip').removeClass('required');

	$('#five_pickup').removeClass('required');

	$('#am_pm5').removeClass('required');

	$('#five_address').removeClass('required');

	$('#five_city').removeClass('required');

	$('#five_state').removeClass('required');

	$('#five_zip').removeClass('required');

	$('#four_pickup').removeClass('required');

	$('#am_pm4').removeClass('required');

	$('#four_address').removeClass('required');

	$('#four_city').removeClass('required');

	$('#four_state').removeClass('required');

	$('#four_zip').removeClass('required');

	$('#three_pickup').removeClass('required');

	$('#am_pm3').removeClass('required');

	$('#three_address').removeClass('required');

	$('#three_city').removeClass('required');

	$('#three_state').removeClass('required');

	$('#three_zip').removeClass('required');

    return true;

    }

    else  if(val == 'Round Trip'){

    var pu=$('#puchoice').val();

	if(pu=='Will Call'){

	$('#returnpickup').removeAttr("class");	

	$('#rpTime').hide();	

    $('#rpu').show();	

 	}else{

	    $('#rpu').show();	

		$('#rpTime').show();	

	}

	$('#b0').show();

	$('#b1').show();	

	$('#b2').show();

	$('#b3').show();

	$('#b4').show();

	$('#b5').show();

	//To hide

	$('#three0').hide();

	$('#three1').hide();

	$("#three2").hide();

	$('#three3').hide();

	$("#three4").hide();

	$('#three5').hide();

	$("#three6").hide();

	$("#three7").hide();

	

	$('#five0').hide();

	$('#five1').hide();

	$("#five2").hide();

	$('#five3').hide();

	$("#five4").hide();

	$('#five5').hide();

	$("#five6").hide();

	$("#five7").hide();

	

	$('#four0').hide();

	$('#four1').hide();

	$("#four2").hide();

	$('#four3').hide();

	$("#four4").hide();

	$('#four5').hide();

	$("#four6").hide();

	$("#four7").hide();	

	//Add required attributes to second destination 

	$('#backto').addClass('required');

	$('#backtocity').addClass('required');

	$('#backtostate').addClass('required');

	$('#backtozip').addClass('required');

	//Remove required attributes 	

	$('#five_pickup').removeClass('required');

	$('#am_pm5').removeClass('required');

	$('#five_address').removeClass('required');

	$('#five_city').removeClass('required');

	$('#five_state').removeClass('required');

	$('#five_zip').removeClass('required');

	

	$('#four_pickup').removeClass('required');

	$('#am_pm4').removeClass('required');

	$('#four_address').removeClass('required');

	$('#four_city').removeClass('required');

	$('#four_state').removeClass('required');

	$('#four_zip').removeClass('required');

	

	$('#three_pickup').removeClass('required');

	$('#am_pm3').removeClass('required');

	$('#three_address').removeClass('required');

	$('#three_city').removeClass('required');

	$('#three_state').removeClass('required');

	$('#three_zip').removeClass('required');

				  

	 return true;

    }

	else if(val == 'Three Way'){

	//To show feilds

	$('#three0').show();

	$('#three1').show();

	$("#three2").show();

	$('#three3').show();

	$("#three4").show();

	$('#three5').show();

	$("#three6").show();

	$("#three7").show();

	

	$('#rpu').show();

	$('#b0').show();

	$('#b1').show();

	$('#b2').show();

	$('#b3').show();

	$('#b4').show();

	$('#b5').show();

	

	//Add required attributes 

	$('#backto').addClass('required');

	$('#backtocity').addClass('required');

	$('#backtostate').addClass('required');

	$('#backtozip').addClass('required');

	

	$('#three_pickup').addClass('required');

	$('#am_pm3').addClass('required');

	$('#three_address').addClass('required');

	$('#three_city').addClass('required');

	$('#three_state').addClass('required');

	$('#three_zip').addClass('required');

	//hide four and five attributes

	$('#five0').hide();

	$('#five1').hide();

	$("#five2").hide();

	$('#five3').hide();

	$("#five4").hide();

	$('#five5').hide();

	$("#five6").hide();

	$("#five7").hide();

	

	$('#four0').hide();

	$('#four1').hide();

	$("#four2").hide();

	$('#four3').hide();

	$("#four4").hide();

	$('#four5').hide();

	$("#four6").hide();

	$("#four7").hide();

	//remove required of four and five

	$('#five_pickup').removeClass('required');

	$('#am_pm5').removeClass('required');

	$('#five_address').removeClass('required');

	$('#five_city').removeClass('required');

	$('#five_state').removeClass('required');

	$('#five_zip').removeClass('required');

	

	$('#four_pickup').removeClass('required');

	$('#am_pm4').removeClass('required');

	$('#four_address').removeClass('required');

	$('#four_city').removeClass('required');

	$('#four_state').removeClass('required');

	$('#four_zip').removeClass('required');

	

	return true;

    } 

	else if(val == 'Four Way'){

//To show feilds

	$('#four0').show();

	$('#four1').show();

	$("#four2").show();

	$('#four3').show();

	$("#four4").show();

	$('#four5').show();

	$("#four6").show();

	$("#four7").show();

	

	$('#three0').show();

	$('#three1').show();

	$("#three2").show();

	$('#three3').show();

	$("#three4").show();

	$('#three5').show();

	$("#three6").show();

	$("#three7").show();

	

	$('#rpu').show();

	$('#b0').show();

	$('#b1').show();

	$('#b2').show();

	$('#b3').show();

	$('#b4').show();	

	//Add required attributes 	

	$('#backto').addClass('required');

	$('#backtocity').addClass('required');

	$('#backtostate').addClass('required');

	$('#backtozip').addClass('required');

	

	$('#four_pickup').addClass('required');

	$('#am_pm4').addClass('required');

	$('#four_address').addClass('required');

	$('#four_city').addClass('required');

	$('#four_state').addClass('required');

	$('#four_zip').addClass('required');

	

	$('#three_pickup').addClass('required');

	$('#am_pm3').addClass('required');

	$('#three_address').addClass('required');

	$('#three_city').addClass('required');

	$('#three_state').addClass('required');

	$('#three_zip').addClass('required');

	//hide four attributes

	$('#five0').hide();

	$('#five1').hide();

	$("#five2").hide();

	$('#five3').hide();

	$("#five4").hide();

	$('#five5').hide();

	$("#five6").hide()

	$("#five7").hide();

	//remove required of five

	$('#five_pickup').removeClass('required');

	$('#am_pm5').removeClass('required');

	$('#five_address').removeClass('required');

	$('#five_city').removeClass('required');

	$('#five_state').removeClass('required');

	$('#five_zip').removeClass('required');

	

    return true;

    } 

	else if(val == 'Five Way'){

//To show feilds		

	$('#five0').show();

	$('#five1').show();

	$("#five2").show();

	$('#five3').show();

	$("#five4").show();

	$('#five5').show();

	$("#five6").show();

	$("#five7").show();

	

	$('#four0').show();

	$('#four1').show();

	$("#four2").show();

	$('#four3').show();

	$("#four4").show();

	$('#four5').show();

	$("#four6").show();

	$("#four7").show();

	

	$('#three0').show();

	$('#three1').show();

	$("#three2").show();

	$('#three3').show();

	$("#three4").show();

	$('#three5').show();

	$("#three6").show();

	$("#three7").show();

	

	$('#rpu').show();

	$('#b0').show();

	$('#b1').show();

	$('#b2').show();

	$('#b3').show();

	$('#b4').show();

	//Add required attributes 	

	$('#backto').addClass('required');

	$('#backtocity').addClass('required');

	$('#backtostate').addClass('required');

	$('#backtozip').addClass('required');

	

	$('#five_pickup').addClass('required');

	$('#am_pm5').addClass('required');

	$('#five_address').addClass('required');

	$('#five_city').addClass('required');

	$('#five_state').addClass('required');

	$('#five_zip').addClass('required');

	

	$('#four_pickup').addClass('required');

	$('#am_pm4').addClass('required');

	$('#four_address').addClass('required');

	$('#four_city').addClass('required');

	$('#four_state').addClass('required');

	$('#four_zip').addClass('required');

	

	$('#three_pickup').addClass('required');

	$('#am_pm3').addClass('required');

	$('#three_address').addClass('required');

	$('#three_city').addClass('required');

	$('#three_state').addClass('required');

	$('#three_zip').addClass('required');

    return true;

    }

	else{

		

	

	return true; 	

	}	}

function pUchoice(val){

    if(val == ''){    

	 return false;

    }

    if(val == 'Will Call'){ 

	$('#returnpickup').removeAttr("class");	

	$('#rpTime').hide();	

	  return true;

    }else{

	$('#returnpickup').attr("class","txt_boxX required");	

	$('#rpTime').show();

	return true; 	

	}	

}

function chProg(val){

    if(val == '0'){

     $('#labelXid').html('CIS ID');	

     $('#cisidsp').show();			     

     $('#ssnsp').hide();

	 $('#ssn').attr("class","txt_boxX");

	 $('#cisid').attr("class","txt_boxX required");	 		 

	 return true;

    }

    if(val == '1'){

     $('#labelXid').html('Social Security Number');	

     $('#ssnsp').show();	

     $('#cisidsp').hide();	 

	 $('#cisid').attr("class","txt_boxX");

	 $('#ssn').attr("class","txt_boxX required");		  		

    return true;

    }else{

     $('#labelXid').html('CIS ID');	

     $('#cisidsp').show();			     

     $('#ssnsp').hide();

	 $('#ssn').attr("class","txt_boxX");

	 $('#cisid').attr("class","txt_boxX required");

    return true;	 		

	}	

}

function app_type(type){ //alert(type);

	 if(type == 'specialist'){

	 $('.spec').show();

	 $('#fname').attr("class","txt_boxX required chars");

	 $('#lname').attr("class","txt_boxX required chars");

	 $('#phyaddress').attr("class","txt_boxX required");

	 $('#phycity').attr("class","txt_boxX required");

	 $('#phystate').attr("class","txt_boxX required");

	 $('#phyzip').attr("class","txt_boxX required digits");

	 $('#phyphone').attr("class","txt_boxX required");

	 $('#reason').attr("class","required");      }

	 else if(type == 'general'){

	 $('.spec').hide();

	 $('#fname').attr("class","txt_boxX chars");

	 $('#lname').attr("class","txt_boxX chars");

	 $('#phyaddress').attr("class","txt_boxX");

	 $('#phycity').attr("class","txt_boxX");

	 $('#phystate').attr("class","txt_boxX");

	 $('#phyzip').attr("class","txt_boxX digits");

	 $('#phyphone').attr("class","txt_boxX");

	 $('#reason').attr("class","");	 }

	  }	 

function back_address(val){

	  //alert(val);

	  if(val == '0'){

		$('.btaddress').show();

		$('#backto').attr("class","txt_boxX required");

		$('#backtocity').attr("class","txt_boxX required");

		$('#backtostate').attr("class","txt_boxX required");

		$('#backtozip').attr("class","txt_boxX required digits");

		  }

	  else if(val == '1'){

		$('.btaddress').hide();

		$('#backto').attr("class","");

		$('#backtocity').attr("class","");

		$('#backtostate').attr("class","");

		$('#backtozip').attr("class","");

		  }

	  }

function time(t){ 

//var atime = document.getElementById('t').value; 

var atime = $('#'+t).val();

//alert(atime);

var hours = atime.split(':');

var hour = hours[0];

var minut = hours[1]; 

if(hour >23 || minut >59) 

{

alert('Please enter correct Appointment/Pick Time!');

$('#'+t).val('');

return false }}

function check_check3(){

	if($('#three_will_call').attr('checked')){

	$('#three_pickup').attr("disabled",true);

	$('#am_pm3').attr("disabled",true);

	$('#three_pickup').removeClass('required');

	$('#am_pm3').removeClass('required'); 

	$('#three_pickup').val('');   }

	else {

	$('#three_pickup').attr("disabled",false);

	$('#am_pm3').attr('disabled',false);

	$('#three_pickup').addClass('required');

	$('#am_pm3').addClass('required'); }

	 }	

function check_check4(){

	if($('#four_will_call').attr('checked')){ 

	$('#four_pickup').attr('disabled',true);

	$('#am_pm4').attr('disabled',true);

	$('#four_pickup').removeClass('required');

	$('#am_pm4').removeClass('required'); 

	$('#four_pickup').val('');    }

	else {

	$('#four_pickup').attr('disabled',false);

	$('#am_pm4').attr('disabled',false);

	$('#four_pickup').addClass('required');

	$('#am_pm4').addClass('required'); }

	 }		

function check_check5(){

	if($('#five_will_call').attr('checked')){ 

	$('#five_pickup').attr('disabled',true);

	$('#am_pm5').attr('disabled',true);

	$('#five_pickup').removeClass('required');

	$('#am_pm5').removeClass('required'); 

	$('#five_pickup').val('');   }

	else {

	$('#five_pickup').attr('disabled',false);

	$('#am_pm5').attr('disabled',false);

	$('#five_pickup').addClass('required');

	$('#am_pm5').addClass('required'); }

	 }

/*function initialize() {

  autocomplete = new google.maps.places.Autocomplete(

(document.getElementById('autocomplete')),

      { types: ['geocode'] });

}

function initialize2() {

  autocomplete = new google.maps.places.Autocomplete(

(document.getElementById('autocomplete2')),

      { types: ['geocode'] });

}

function initialize3() {

  autocomplete = new google.maps.places.Autocomplete(

(document.getElementById('autocomplete3')),

      { types: ['geocode'] });

}*/
function googleapihandler(id,data){
	
		/*  $('#'+id).blur(function(){
					   $('#div_'+id).remove();
		 });*/
		  var str1 = document.getElementById(id);
		  var curLeft=0;
		  if (str1.offsetParent){
			  while (str1.offsetParent){
		   curLeft += str1.offsetLeft;
		   str1 = str1.offsetParent;
			  }
		  }
		  var str2 = document.getElementById(id);
		  var curTop=20;
		  if (str2.offsetParent){
			  while (str2.offsetParent){
		   curTop += str2.offsetTop;
		   str2 = str2.offsetParent;
			  }
		  }
		  $('#div_'+id).remove();
		  $('#'+id).parent().append('<div id="div_'+id+'"></div>');
		  var ss = document.getElementById('div_'+id);
		  var str =data
		  if(str.length < 1)
			  document.getElementById('div_'+id).style.visibility = "hidden";
		  else
			  ss.setAttribute('style','position:absolute;top:'+curTop+';left:'+curLeft+';width:250;z-index:1;padding:5px;border: 0px solid #000000; overflow:auto; height:105; background-color:#F5F5FF; z-index:9999;');
		  ss.innerHTML = '';
  
		 // console.log(data);
		$('body').click(function() {
       $('#div_'+id).remove();
});
		  $.each(data,function(index,item){
			  
			   var suggest = '<div  ';
            suggest += ' ';
            suggest += 'onclick="javascript:$(\'#'+id+'\').val(\''+item+'\');$(\'#div_'+id+'\').remove();" ';
            suggest += 'class="small">' + item + '</div>';
            ss.innerHTML += suggest;
			  
			  });
		   $.post("../google_api_log.php", {type: ""+'Address Populate'});
		  
		  
}
function initialize() {
 /* autocomplete = new google.maps.places.Autocomplete(
(document.getElementById('autocomplete')),
      { types: ['geocode'] });*/
	  
	  $('#autocomplete').keyup(function(e){
		  switch(e.keyCode) {

			case 38: // up
			case 37: // left
			case 39: // right
			case 40: // down	
			case 9:  // tab
			case 13: // return	
			case 17: // return	
			case 18: // return	
			case 27: // return	
			case 20: // return
			case 16: // return				
				break;
			default:
				
		  var myval = $('#autocomplete').val(); 
		 if(myval.length > 5){ 
		  $.getJSON('../googleapi.php?input='+myval,function(data){
			  googleapihandler('autocomplete',data);
			  
			  });	 
		 
		 }
		 	break;
		  }
	  
	  });
	 
     // 
}
function initialize2() {
 /* autocomplete = new google.maps.places.Autocomplete(
(document.getElementById('autocomplete2')),
      { types: ['geocode'] });
        $('#autocomplete2').keydown(function(){ $.post("../google_api_log.php", {type: ""+'Address Populate'}, function(data2){ });});*/
		
		 $('#autocomplete2').keyup(function(e){
			 switch(e.keyCode) {

			case 38: // up
			case 37: // left
			case 39: // right
			case 40: // down	
			case 9:  // tab
			case 13: // return	
			case 17: // return	
			case 18: // return	
			case 27: // return	
			case 20: // return
			case 16: // return				
				break;
			default:
		  var myval = $('#autocomplete2').val(); 
		 if(myval.length > 5){ 
		  $.getJSON('../googleapi.php?input='+myval,function(data){
			  googleapihandler('autocomplete2',data);
			  
			  });	 
		 
		 }
		 
		 break;
		}
	  
	  });
	  	
}
function initialize3() {
 /* autocomplete = new google.maps.places.Autocomplete(
(document.getElementById('autocomplete3')),
      { types: ['geocode'] });
        $('#autocomplete3').keydown(function(){ $.post("../google_api_log.php", {type: ""+'Address Populate'}, function(data2){ });});*/
		
		$('#autocomplete3').keyup(function(e){
			switch(e.keyCode) {

			case 38: // up
			case 37: // left
			case 39: // right
			case 40: // down	
			case 9:  // tab
			case 13: // return	
			case 17: // return	
			case 18: // return	
			case 27: // return	
			case 20: // return
			case 16: // return				
				break;
			default:
		  var myval = $('#autocomplete3').val(); 
		 if(myval.length > 5){ 
		  $.getJSON('../googleapi.php?input='+myval,function(data){
			  googleapihandler('autocomplete3',data);
			  
			  });	 
		 
		 }
		 	break;
			}
	  
	  });
}
function initialize4() {
 /* autocomplete = new google.maps.places.Autocomplete(
(document.getElementById('ins_billing_address')),
      { types: ['geocode'] });
        $('#ins_billing_address').keydown(function(){ $.post("../google_api_log.php", {type: ""+'Address Populate'}, function(data2){ });});
*/
$('#ins_billing_address').keyup(function(e){
	switch(e.keyCode) {

			case 38: // up
			case 37: // left
			case 39: // right
			case 40: // down	
			case 9:  // tab
			case 13: // return	
			case 17: // return	
			case 18: // return	
			case 27: // return	
			case 20: // return
			case 16: // return				
				break;
			default:	
		  var myval = $('#ins_billing_address').val(); 
		 if(myval.length > 5){ 
		  $.getJSON('../googleapi.php?input='+myval,function(data){
			  googleapihandler('ins_billing_address',data);
			  
			  });	 
		 
		 }
		 break;
	}
	  
	  });
}
function initialize5() {
 /* autocomplete = new google.maps.places.Autocomplete(
(document.getElementById('pp_billing_address')),
      { types: ['geocode'] });
       $('#pp_billing_address').keydown(function(){ $.post("../google_api_log.php", {type: ""+'Address Populate'}, function(data2){ });});*/
	   
	$('#pp_billing_address').keyup(function(e){
		switch(e.keyCode) {

			case 38: // up
			case 37: // left
			case 39: // right
			case 40: // down	
			case 9:  // tab
			case 13: // return	
			case 17: // return	
			case 18: // return	
			case 27: // return	
			case 20: // return
			case 16: // return				
				break;
			default:
		  var myval = $('#pp_billing_address').val(); 
		 if(myval.length > 5){ 
		  $.getJSON('../googleapi.php?input='+myval,function(data){
			  googleapihandler('pp_billing_address',data);
			  
			  });	 
		 
		 }
		 break;
		}
	  
	  });   
}
function initialize6() {
 /* autocomplete = new google.maps.places.Autocomplete(
(document.getElementById('autocomplete4')),
      { types: ['geocode'] }); //alert(types);
      $('#autocomplete4').keydown(function(){ $.post("../google_api_log.php", {type: ""+'Address Populate'}, function(data2){ });});*/
	
	$('#autocomplete4').keyup(function(e){
		switch(e.keyCode) {

			case 38: // up
			case 37: // left
			case 39: // right
			case 40: // down	
			case 9:  // tab
			case 13: // return	
			case 17: // return	
			case 18: // return	
			case 27: // return	
			case 20: // return
			case 16: // return				
				break;
			default:
		  var myval = $('#autocomplete4').val(); 
		 if(myval.length > 5){ 
		  $.getJSON('../googleapi.php?input='+myval,function(data){
			  googleapihandler('autocomplete4',data);
			  
			  });	 
		 
		 }
		 	break;
		}
	  
	  });     
	  
}
function initialize7() {
 /* autocomplete = new google.maps.places.Autocomplete(
(document.getElementById('autocomplete5')),
      { types: ['geocode'] });


 $('#autocomplete5').keydown(function(){ $.post("../google_api_log.php", {type: ""+'Address Populate'}, function(data2){ });});
     // $.post("../google_api_log.php", {type: ""+'Address Populate'}, function(data2){ });*/
	 
	 $('#autocomplete5').keyup(function(e){
		 switch(e.keyCode) {

			case 38: // up
			case 37: // left
			case 39: // right
			case 40: // down	
			case 9:  // tab
			case 13: // return	
			case 17: // return	
			case 18: // return	
			case 27: // return	
			case 20: // return
			case 16: // return				
				break;
			default:
		  var myval = $('#autocomplete5').val(); 
		 if(myval.length > 5){ 
		  $.getJSON('../googleapi.php?input='+myval,function(data){
			  googleapihandler('autocomplete5',data);
			  
			  });	 
		 
		 }
		 	break;
		 }
	  
	  });     
}
	
/*
function initialize() {

  autocomplete = new google.maps.places.Autocomplete(

(document.getElementById('autocomplete')),

      { types: ['geocode'] });

      $.post("../google_api_log.php", {type: ""+'Address Populate'}, function(data2){ });

}

function initialize2() {

  autocomplete = new google.maps.places.Autocomplete(

(document.getElementById('autocomplete2')),

      { types: ['geocode'] });

      $.post("../google_api_log.php", {type: ""+'Address Populate'}, function(data2){ });

}

function initialize3() {

  autocomplete = new google.maps.places.Autocomplete(

(document.getElementById('autocomplete3')),

      { types: ['geocode'] });

      $.post("../google_api_log.php", {type: ""+'Address Populate'}, function(data2){ });

} 
*/
</script> 

{/literal}

<body onLoad="initialize(); initialize2(); initialize3();">

<div style="width:612px;  float:left;"></div>

  <table width="80%" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">

    <tr>

      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">

          <tr>

            <td height="19" colspan="2" align="center" class="okmsg"><span class="okmsg">{ if $msgs != ''} {$msgs} {/if}

              

              { if $errors != ''} {$errors} {/if}</span></td>

          </tr>

          <tr>

            <td height="19" colspan="2" align="center"><div align="right" id="add_div" style="padding-right:40px; padding-bottom:5px;"> [<a href="javascript:history.back();">Back</a>]</div></td>

          </tr>

          <tr>

            <td colspan="2"><form name="search" id="search" method="post" action="" >

                <table width="100%" border="0">

                  <tr>

                    <td><strong>Patient:</strong></td>

                    <td><input type="text" name="clientname" id="pname" value="{$clientname}"  class="required" onKeyUp="searchSuggest();" autocomplete="off"/>

                      <div id="layer1"></div></td>

                     <td><strong>Trip Day:</strong></td>

              <td><select name="day" >

              <option value=""> All </option>

              <option value="monday" {if $day eq 'monday'} selected{/if}>Monday</option>

              <option value="tuesday" {if $day eq 'tuesday'} selected{/if}>Tuesday</option>

              <option value="wednesday" {if $day eq 'wednesday'} selected{/if}>Wednesday</option>

              <option value="thursday" {if $day eq 'thursday'} selected{/if}>Thursday</option>

              <option value="friday" {if $day eq 'friday'} selected{/if}>Friday</option>

              <option value="saturday" {if $day eq 'saturday'} selected{/if}>Saturday</option>

              <option value="sunday" {if $day eq 'sunday'} selected{/if}>Sunday</option>

              </select></td>

            </tr>

                  </tr>

                  <tr>

                    <td><strong>Start Date:</strong></td>

                    <td><input type="text" name="startdate" id="startdate" class="required" value="{$startdate}"/></td>

                    <td><strong>Till Date:</strong></td>

                    <td><input type="text" name="enddate" id="enddate" class="required" size="32"  value="{$enddate}"/></td>

                  </tr>

                  <tr>

                    <td colspan="2"><span  style="font-size:9px; color:#F00;">Date format mm/dd/yyyy</span></td>



                  </tr>

                  <tr>

                    <td>&nbsp;</td>

                    <td><input type="submit" value="Search" name="search" class="btn"/></td>

                    <td>&nbsp;</td>

                    <td>&nbsp;</td>

                  </tr>

                </table>

              </form></td>

          </tr>

          {if $pendingids neq ''}

          <tr ><td colspan="2" bgcolor="border-collapse:#000 1px solid;"><form name="search" id="search2" method="post" action="index33.php" >

                <table width="100%" border="0" >

                  <tr>

                    <td colspan="2"><span  style="font-size:11px; color:#F00;">&raquo; Please verify patient information from below form before deleting trips.</span></td>

                  </tr>

                  <tr>

                    

                    <td>&nbsp;<input type="submit" name="submit" value="Delete all searched trips" class="inputButton btn"  />

                        <input type="hidden" name="pendingids" value="{$pendingids}"  /></td>

                  </tr>

                </table>

              </form></td></tr>

              {/if}

          {if $data neq ''}

          <tr>

            <td height="19" align="left" class="admintopheading"></td>

            <td class="admintopheading" style="text-align:center;">REQUESTS DETAIL <!--{if $clinic neq ''}[{$clinic}]{/if}-->  .:||:.  Total Trips: {$c}<br/>

              <span style=" color:#F00;" >Update All Information Along with Blanket Form.</span></td>

          </tr>

          <tr>

            <td height="44" colspan="2" align="center"  valign="top" style="padding-bottom:50px;"><div style="width:100%; border: #F00 0px solid; float:left;">

                <form name="adduser" id="adduser" method="post" action="index22.php" onSubmit="javascript:load();">

                  <table width="80%" border="0" cellspacing="2" cellpadding="2" align="center">

                    <tr>

                      <td colspan="3" valign="top" class="admintopheading" align="left"><strong><span class="form_heading">Member Information</span></strong></td>

                    </tr>

                    <tr>

                  <td align="left" valign="top" class="labels">Billing Account on File:</td>

                  <td colspan="2" align="left"><select name="account"  id="account"  class="txt_box required">

                    <option  value="">-- Select Billing Account --</option>

                      {section name=n loop=$accounts}

					<option value="{$accounts[n].id}" {if $accounts[n].id eq $data.0.account}selected{/if}> {$accounts[n].account_name} </option>

                		{/section}

				    </select></td>

                </tr>

                    <tr>

                      <td align="left" valign="top" class="labels"><strong><span class="label">Patient Name</span>:</strong></td>

                      <td colspan="2" align="left"><input name="pname" type="text" class="txt_box required" id="pname11"  value="{$data.0.clientname}" maxlength="50" />

                        <input type="hidden" name="hos_is" value="{$data.0.userid}"  /></td>

                    </tr>

                    <tr>

                      <td align="left" valign="top" class="labels"><span class="label">Patient Phone No: </span></td>

                      <td colspan="2" align="left"><input type="text" name="phnum" id="phnum" value="{$data.0.phnum}" class="txt_box" maxlength="14" />

                        &nbsp;</td>

                    </tr>

                    <tr>

                      <td align="left" valign="top" class="labels"><span class="label">P.O #: </span></td>

                      <td colspan="2" align="left"><input type="text" name="po" id="po" value="{$data.0.po}" class="txt_box" maxlength="14" />

                        &nbsp;</td>

                    </tr>

                     <tr>

                  <td align="left" valign="top" class="labels"><span class="label">Claim #: </span></td>

                  <td colspan="2" align="left"><input type="text" name="claim_no" id="claim_no" value="{$data.0.claim_no}" class="txt_box" maxlength="14" />

                    &nbsp;</td>

                </tr>

                    <tr>

                      <td align="left" valign="top" class="labels"><strong><span class="label">Member DOB </span>:</strong></td>

                      <td colspan="2" align="left"><input type="text" name="dob" id="dob1" value="{$data.0.dob}" class="txt_box required" />

                        <span class="SmallnoteTxt">*</span>(yyyy-mm-dd)</td>

                    </tr>

                    <tr>

                      <td align="left" valign="top" class="labels"><span class="label">Patient Weight: </span></td>

                      <td colspan="2" align="left"><input type="text" name="patient_weight" id="patient_weight" value="{$data.0.patient_weight}" class="txt_box required" maxlength="14" />

                        &nbsp;* (Lbs)</td>

                    </tr>

                    <tr>

                      <td colspan="3" valign="top" class="admintopheading"><strong><span class="form_heading">Trip Information</span></strong></td>

                    </tr>

                    <tr>

                      <td width="30%" align="left" valign="top" class="labels"><strong><span class="label">Select Trip Type</span>:</strong></td>

                      <td colspan="2" align="left"><select name="triptype"  class="txt_box required" id="triptype" onChange="return chTrip(this.value);" >

                          <option value="">--Select Trip Type--</option>

                          <option value="One Way" 		{if $data.0.triptype eq 'One Way'}selected{/if}>One Way--(1 Destination)</option>

                          <option value="Round Trip" 	{if $data.0.triptype eq 'Round Trip'}selected{/if}>Two Way--(2 Destinations)</option>

                          <option value="Three Way" 	{if $data.0.triptype eq 'Three Way'}selected{/if}>Three Way--(3 Destinations)</option>

                          <option value="Four Way" 		{if $data.0.triptype eq 'Four Way'}selected{/if}>Four Way--(4 Destinations)</option>

                         <!-- <option value="Five Way" 	{if $data.0.triptype eq 'Five Way'}selected{/if}>Five Way--(5 Destinations)</option>-->

                        </select>

                        &nbsp;<span class="SmallnoteTxt">*</span></td>

                    </tr>

                    <tr>

                      <td align="left" valign="top" class="labels"><strong><span class="label">Vehicle Preference:</span></strong></td>

                      <td colspan="2" align="left"><select name="vehtype" class="required txt_box" id="vehtype"  >

                          <option value="">Select</option>

                          

                      			  {section name=q loop=$vehiclepref}	

                          

                          <option value="{$vehiclepref[q].id}" {if $data.0.vehtype eq $vehiclepref[q].id}selected{/if}>{$vehiclepref[q].vehtype}</option>

                          

                      {/section}

                        

                        </select>

                        &nbsp;<span class="SmallnoteTxt">*</span></td>

                    </tr>

                    <tr>

                  <td width="30%" align="left" valign="top" class="labels"><strong><span class="label">Oxygen Required ?</span></strong></td>

                  <td colspan="2" align="left"><select name="oxygen"  class="txt_box required" id="oxygen" >

                      <option value="">Select Oxygen Option</option>

                      <option value="Yes" {if $data.0.oxygen eq 'Yes'}selected{/if}> Yes </option>

                      <option value="No" {if $data.0.oxygen eq 'No'}selected{/if}> No </option>                     

                    </select>

                    &nbsp;<span class="SmallnoteTxt">*</span></td>

                </tr>   

                    <tr>

                      <td colspan="3" valign="top" class="admintopheading"><strong><span class="form_heading">Appointment Information</span></strong></td>

                    </tr>

                    <tr>

                      <td align="left" valign="top" class="labels"><strong><span class="label">Appointment Date</span>:</strong></td>

                      <td colspan="2" align="left"><input type="text" name="appdate" id="appdate" value="{$data.0.appdate}" class="required txt_box"  maxlength="15" />

                        &nbsp;<span class="SmallnoteTxt">*</span> <span class="SmallnoteTxt">(yyyy-mm-dd)</span></td>

                    </tr>

                    <tr>

                      <td colspan="3" height="3"></td>

                    </tr>

                    <tr>

                      <td align="left" valign="top" class="labels"><strong><span class="label">Appointment Time</span>:</strong></td>

                      <td colspan="2" align="left"><input type="text" name="org_apptime" id="org_apptime" value="{$data.0.org_apptime}" class="required txt_box"  maxlength="5"  onblur="return time(this.id);"/>

                        &nbsp;<span class="SmallnoteTxt">* (e.g. 15:30 Hrs)</span></td>

                    </tr>

                    <tr>

                      <td align="left" valign="top" class="labels"><strong><span class="label">Pick Time</span>:</strong></td>

                      <td colspan="2" align="left"><input type="text" name="apptime" id="apptime" value="{$data.0.apptime}" class="required txt_box"  maxlength="5"  onblur="return time(this.id);" onKeyUp="ptime(this.value);"/>

                        &nbsp;<span class="SmallnoteTxt">* (e.g. 15:30 Hrs)</span></td>

                    </tr>

                    <tr  id="rpu">

                      <td align="left" valign="top" class="labels"><strong><span class="label">Return Pickup</span>:</strong><br/>

                        <span style="color:#666; font-size:10px;">For last destination</span></td>

                      <td colspan="2" align="left"><select name="puchoice" id="puchoice" class="txt_box required" onChange="return pUchoice(this.value);" >

                          <option value="Time" {if $data.0.pickupchoice eq 'Time'}selected{/if}>Time</option>

                          <option value="Will Call" {if $data.0.pickupchoice eq 'Will Call'}selected{/if}>Will Call</option>

                        </select>

                        &nbsp;<span class="SmallnoteTxt">*</span></td>

                    </tr>

                    <tr id="rpTime" style="display:none;">

                      <td align="left" valign="top" class="labels"><span class="label">Return Pick Time</span>:</td>

                      <td colspan="2" align="left"><input type="text" name="returnpickup" id="returnpickup" value="{$data.0.returnpickup}"  class="txt_box required " maxlength="5" onBlur="return time(this.id);" />

                        &nbsp;<span class="SmallnoteTxt">* (e.g. 15:30 Hrs)</span></td>

                    </tr>

                    <tr>

                      <td align="left" valign="top" class="labels"><span class="label">Today Date:</span></td>

                      <td colspan="2" align="left"><input type="text" name="todaydate" id="todaydate" value='{$smarty.now|date_format}' class="txt_box required" readonly  /></td>

                    </tr>

                    <tr align="left">

                      <td colspan="3" valign="top">&nbsp;</td>

                    </tr>

                    <tr>

                      <td colspan="2"><div class="admintopheading">General Options</div></td>

                    </tr>

                    <tr>

                      <td colspan="2"><table width="100%" border="0">

                          <tr>

                            <td height="4px" colspan="4"></td>

                          </tr>

                          <tr>

                            <!--<td class="labels">Stretcher :</td>

                            <td class="labels"><input type="checkbox" name="stretcher" value="Yes" {if $data.0.stretcher eq 'Yes'} checked="checked"{/if}/>

                              &nbsp;Yes </td>-->

                            <td class="labels">Bariatric Stretcher :</td>

                            <td class="labels"><input type="checkbox" name="bar_stretcher" value="Yes" {if $data.0.bar_stretcher eq 'Yes'} checked="checked"{/if}/>

                              &nbsp;Yes</td>

                          </tr>

                          <tr>

                            <td class="labels">2 Man Team :</td>

                            <td class="labels"><input type="checkbox" name="dstretcher" value="Yes" {if $data.0.dstretcher eq 'Yes'} checked="checked"{/if}/>

                              &nbsp;Yes </td>

                           <!-- <td class="labels">Escort :</td>

                            <td class="labels"><input type="checkbox" name="escort" value="Yes" {if $data.0.escort eq 'Yes'} checked="checked"{/if} />

                              &nbsp;Yes</td>-->

                          </tr>

                          <tr>

                            <!--<td class="labels">Wheel Chair :</td>

                            <td class="labels"><input type="checkbox" name="wchair" value="Yes" {if $data.0.wchair eq 'Yes'} checked="checked"{/if}/>

                              &nbsp;Yes</td>-->

                            <td class="labels">Wheel Chair Rental :</td>

                            <td class="labels"><input type="checkbox" name="dwchair" value="Yes" {if $data.0.dwchair eq 'Yes'} checked="checked"{/if}/>

                              &nbsp;Yes</td>

                          </tr>

                          <!--<tr>

                            <td class="labels">0xygen :</td>

                            <td class="labels"><input type="checkbox" name="oxygen" value="Yes" {if $data.0.oxygen eq 'Yes'} checked="checked"{/if}/>

                              &nbsp;Yes</td>

                            <td class="labels"></td>

                            <td class="labels"></td>

                          </tr>-->

                        </table></td>

                    </tr>

                    <tr>

                      <td colspan="3"><div class="admintopheading">Pick Up Information</div></td>

                    </tr>

                    <tr>

                      <td valign="top"   class="labelX" >Pick Up Location:</td>

                      <td><input type="text" name="picklocation" id="picklocation"  class="txt_box" value="{$data.0.picklocation}" size="40" />

                        <span class="SmallnoteTxt"></span></td>

                      <td>&nbsp;</td>

                    </tr>

                    <tr>

                      <td valign="top"   class="labelX" ><strong>Pick up address:</strong></td>

                      <td width="47%"><input type="text" name="pickaddress" id="autocomplete" value="{$pckaddr}" class="txt_box required" size="40" />

                        &nbsp;<span class="SmallnoteTxt">*</span></td>

                     

                    </tr>

                    <tr>

                      <td class="labelX">Suite #/Room #:</td>

                      <td><input type="text" name="psuiteroom" id="psuiteroom" value="{$psuiteroom}"  class="txt_box"  maxlength="50" /></td>

                      <td></td>

                    </tr>

                    <tr>

                      <td valign="top" class="labelX" ><strong>Pick Up Instructions:</strong></td>

                      <td valign="top"><textarea name="pickup_instruction" cols="60" rows="5" id="pickup_instruction" tabindex="28" style="width:300px;"  >{$data.0.pickup_instruction}</textarea></td>

                      <td valign="top">&nbsp;</td>

                    </tr>

                    <tr>

                      <td class="labelX">Pickup Phone #:</td>

                      <td><input type="text" name="p_phnum" id="p_phnum" value="{$data.0.p_phnum}" class="txt_box " maxlength="14" />

                        &nbsp;<span class="SmallnoteTxt"></span></td>

                      <td></td>

                    </tr>

                    <tr>

                      <td colspan="3"><div class="admintopheading">Destination Address</div></td>

                    </tr>

                    <tr>

                      <td valign="top"   class="labelX" >Drop Location:</td>

                      <td><input type="text" name="droplocation" id="droplocation"  class="txt_box" value="{$data.0.droplocation}" size="40" />

                        <span class="SmallnoteTxt"></span></td>

                      <td>&nbsp;</td>

                    </tr>

                    <tr>

                      <td width="37%" valign="top"  class="labelX" ><strong>Destination Address:<br/>

                        <span class="SmallnoteTxt"></span></strong></td>

                      <td colspan="2"><input type="text" name="destination" id="autocomplete2" value="{$drpaddr}"  class="txt_box"  size="40" />

                        &nbsp;<span class="SmallnoteTxt">*</span></td>

                    </tr>

                    <tr>

                      <td class="labelX">Suite #/Room #:</td>

                      <td><input type="text" name="dsuiteroom" id="dsuiteroom" value="{$dsuiteroom}"  class="txt_box"  maxlength="50" /></td>

                      <td></td>

                    </tr>

                    <tr>

                      <td class="labels">Destination Instructions: </td>

                      <td colspan="2"><textarea rows="3" cols="40" name="destination_instruction" id="destination_instruction">{$data.0.destination_instruction}</textarea></td>

                    </tr>

                    <tr>

                      <td class="labelX">Destination Phone Number:</td>

                      <td><input type="text" name="d_phnum" id="d_phnum" value="{$data.0.d_phnum}" class="txt_box " maxlength="14" tabindex="4"/>

                        &nbsp;<span class="SmallnoteTxt"></span></td>

                      <td></td>

                    </tr>

                    {if $triptype eq 'Four Way' || $triptype eq 'Five Way' || $triptype eq 'Three Way' || $triptype eq ''} {/if}

                     <tr id="three0" style="display:none">

                  <td colspan="3"><div class="admintopheading">Second Destination Information</div></td>

                </tr>

                <tr id="three1" style="display:none">

                  <td class="labels">2nd Pick Time: </td>

                  <td colspan="2"><input type="text" name="three_pickup" id="three_pickup" value="{$data.0.three_pickup}"  class="txt_box " maxlength="5" onBlur="javascript:time(this.id);" />

                    

                               <span class="SmallnoteTxt">*</span>&nbsp;Will Call&nbsp;

                    <input type="checkbox" name="three_will_call" id="three_will_call" onClick="check_check3();" {if $data.0.three_will_call eq 'on'} checked="checked" {/if} /></td>

                </tr>

               <tr id="three2" style="display:none">

                  <td class="labels">2nd Destination Location:</td>

                  <td><input  type="text" name="droplocation2" id="droplocation2" value="{$data.0.droplocation2}"  class="txt_box"  size="45"  onKeyUp="searchSuggest5();"  autocomplete="off"/><div id="layer5"></div>

                    </td>

                  <td><a onClick="addressla(3);"><img src="../graphics/arrow.png" ></a></td>

                </tr>

                <tr  id="three3" style="display:none">

                  <td class="labels">2nd Destination Address:</td>

                  <td><input  type="text" name="destination2" id="autocomplete4" value="{$destination2}" placeholder="Enter Address"  class="txt_box "  maxlength="150"  size="45" />

                    &nbsp;<span class="SmallnoteTxt">*</span></td>

                  <td></td>

                </tr>

                 <tr  id="three4" style="display:none">

                  <td class="labels">Suite / Apt / Bld:</td> 

               <td><input type="text" name="dsuiteroom2" id="dsuiteroom2" value="{$dsuiteroom2}"  class="txt_box"  maxlength="150"  size="45" />

                 </td>

                  <td></td>

                </tr>

                <tr  id="three5" style="display:none">

                  <td class="labels">2nd Destination Phone Number:</td>

                  <td><input type="text" name="d_phnum2" id="d_phnum2" value="{$data.0.d_phnum2}" class="txt_box" maxlength="14"  onChange="use_same(this.id);" />

                    &nbsp;<span class="SmallnoteTxt"></span></td>

                  <td></td>

                </tr> 

                

                <tr  id="three6" style="display:none">

                  <td class="labels">2nd Destination Instructions: </td>

                  <td colspan="2"><textarea rows="3" cols="40" name="destination_instruction2" id="destination_instruction2">{$data.0.destination_instruction2}</textarea>

                    </td>

                </tr>

                <!--<tr  id="three7" style="display:none">

                  <td class="labels">Contain a pharmacy stop?:</td>

                  <td><select name="pharmacyb" id="pharmacyb" class="txt_box " >

                      <option value="No" {if $data.0.pharmacyb eq 'No'}selected{/if}>No</option>

                      <option value="Yes" {if $data.0.pharmacyb eq 'Yes'}selected{/if}>Yes</option>

                    </select></td>

                  <td></td>

                </tr>-->

                    {if $triptype eq 'Four Way' || $triptype eq 'Five Way' || $triptype eq ''}{/if}

                    <tr id="four0" style="display:none">

                  <td colspan="3"><div class="admintopheading">Third Destination Address</div></td>

                </tr>

                <tr id="four1" style="display:none">

                  <td class="labels">Pick Time: </td>

                  <td colspan="2"><input type="text" name="four_pickup" id="four_pickup" value="{$data.0.four_pickup}"  class="txt_box " maxlength="5" onBlur="javascript: time(this.id);" />

                    <span class="SmallnoteTxt">*</span>&nbsp;Will Call&nbsp;

                    <input type="checkbox" name="four_will_call" id="four_will_call" onClick="check_check4();" {if $data.0.four_will_call eq 'on'} checked="checked" {/if}/></td>

                </tr>

                <tr id="four2" style="display:none">

                  <td class="labels">3rd Destination Location:</td>

                  <td><input  type="text" name="droplocation3" id="droplocation3" value="{$data.0.droplocation3}"  class="txt_box"  size="45"  onKeyUp="searchSuggest6();"  autocomplete="off"/><div id="layer6"></div>

                    </td>

                  <td><a onClick="addressla(4);"><img src="../graphics/arrow.png" ></a></td>

                </tr>

                <tr  id="four3" style="display:none">

                  <td class="labels">3rd Destination Address:</td>

                  <td><input  type="text" name="destination3" id="autocomplete5" value="{$destination3}" placeholder="Enter Address"  class="txt_box "  maxlength="150"  size="45" />

                    &nbsp;<span class="SmallnoteTxt">*</span></td>

                  <td></td>

                </tr>

                 <tr  id="four4" style="display:none">

                  <td class="labels">Suite / Apt / Bld:</td> 

               <td><input type="text" name="dsuiteroom3" id="dsuiteroom3" value="{$dsuiteroom3}"  class="txt_box"  maxlength="150"  size="45" />

                 </td>

                  <td></td>

                </tr>

                <tr  id="four5" style="display:none">

                  <td class="labels">3rd Destination Phone Number:</td>

                  <td><input type="text" name="d_phnum3" id="d_phnum3" value="{$data.0.d_phnum3}" class="txt_box" maxlength="14"  onChange="use_same(this.id);" />

                    &nbsp;<span class="SmallnoteTxt"></span></td>

                  <td></td>

                </tr> 

                <tr  id="four6" style="display:none">

                  <td class="labels">3rd Destination Instructions: </td>

                  <td colspan="2"><textarea rows="3" cols="40" name="destination_instruction3" id="destination_instruction3">{$data.0.destination_instruction3}</textarea>

                    </td>

                </tr>

                <!--<tr  id="four7" style="display:none">

                  <td class="labels">Contain a pharmacy stop?:</td>

                  <td><select name="pharmacyc" id="pharmacyc" class="txt_box " >

                      <option value="No" {if $data.0.pharmacyc eq 'No'}selected{/if}>No</option>

                      <option value="Yes" {if $data.0.pharmacyc eq 'Yes'}selected{/if}>Yes</option>

                    </select></td>

                  <td></td>

                </tr>-->

                       

                

                    

                    {if $triptype eq 'Four Way' || $triptype eq 'Five Way' || $triptype eq 'Three Way' || $triptype=='' || $triptype eq 'Round Trip'}{/if}

                    <tr id="b0" style="display:none">

                      <td colspan="3"><div class="admintopheading">Last Destination Address</div>

                        <br/>

                        Use Same Pickup Information

                        <input type="checkbox" name="sameadd" id="sameadd" onClick="test();"/></td>

                    </tr>

                    <tr id="b2" style="display:none" > 

<td valign="top"   class="labelX" >Back To Location:</td>

<td><input type="text" name="backtolocation" id="backtolocation"  class="txt_box" value="{$data.0.backtolocation}" size="40" />

                   <span class="SmallnoteTxt"></span></td>

<td>&nbsp;</td>

</tr>

            <tr id="b1" style="display:none" >

           	<td class="labelX"  >

                    Back To Address:<br/></td>

<td><input name="backto" type="text"  class="txt_box " id="autocomplete3" value="{$bck}" maxlength="150" size="40" />&nbsp;<span class="SmallnoteTxt">*</span></td><td></td></tr>

  <tr id="b5" style="display:none;">

                  <td class="labels">Suite #/Room #:</td> 

               <td><input type="text" name="bsuiteroom" id="bsuiteroom" value="{$bsuiteroom}"  class="txt_box"  maxlength="50" />

                 </td>

                  <td></td>

                </tr>

                <tr id="b3" style="display:none;">

                  <td class="labels">Back to Instructions: </td>

                  <td colspan="2"><textarea rows="3" cols="40" name="backto_instruction" id="backto_instruction">{$data.0.backto_instruction}</textarea>

                    </td>

                </tr>

                    

                    

                    {literal} 

                    <script type="text/javascript" language="javascript">

$(document).ready(function(){	$("#aptmonday, #retmonday, #apttuseday, #rettuseday, #aptwednesday, #retwednesday, #aptthirsday, #retthirsday, #aptfriday, #retfriday, #aptsaturday, #retsaturday, #aptsunday, #retsunday").mask("29:59");

	$("#tdmonday, #tdtuseday, #tdwednesday, #tdthirsday, #tdfriday, #tdsaturday, #tdsunday").mask("9999-19-39");

	$("#tdmonday, #tdtuseday, #tdwednesday, #tdthirsday, #tdfriday, #tdsaturday, #tdsunday").datepicker( {minDate: '0'} );});

function ptime(ptime){  

	var apptime = $('#apptime').val(); // alert(apptime);

	$('#aptmonday','#apttuseday','#aptwednesday','#aptthirsday','#aptfriday','#aptsaturday','#aptsunday').val(apptime);

	}	

function checkrecday(feildid){

	//alert(feildid);

	if($('#'+feildid).attr('checked')){

		$('#org_apt'+feildid+', #apt'+feildid+', #ret'+feildid+', #td'+feildid).removeAttr('disabled');

		var apptime = $('#apptime').val();  			$('#apt'+feildid).val(apptime); 

		var returnpickup = $('#returnpickup').val(); 	$('#ret'+feildid).val(returnpickup); 

		}

	else {

		$('#org_apt'+feildid+', #apt'+feildid+', #ret'+feildid+', #td'+feildid).attr('disabled','disabled');

		$('#org_apt'+feildid+', #apt'+feildid+', #ret'+feildid+', #td'+feildid).val('');

		}

	

	}

</script> 

                    {/literal}

                    <tr>

                      <td colspan="3"><div class="admintopheading">Recurring (Blanket Orders)</div></td>

                    </tr>

                    <tr>

                      <td colspan="3"><table width="100%" border="0">

                          <tr>

                            <td>&nbsp;</td>

                            <td>Pick Time</td>

                            <td>ReturnPick Time</td>

                            <td>Till Date</td>

                          </tr>

                          <tr>

                            <td><input type="checkbox" id="monday" name="monday" onChange="checkrecday(this.id);" {if $Mondaycheck eq '1'}checked{/if}/>

                              &nbsp;Monday</td>

                            <td><input  name="aptmonday" id="aptmonday" type="text" class="appt_txtbox" size="15" maxlength="5" onBlur="return tValid(this.value,'aptmonday');" {if $Mondaycheck eq '1'} value="{$data.0.apptimeM}" {else}disabled="disabled"{/if}/></td>

                            <td><input  name="retmonday" id="retmonday" type="text" class="appt_txtbox" size="15" maxlength="5" onBlur="return tValid(this.value,'retmonday');" {if $Mondaycheck eq '1'} value="{$data.0.returnpickupM}" {else}disabled="disabled"{/if}/></td>

                            <td><input name="tdmonday" id="tdmonday" type="text"  class="appt_txtbox" size="20" maxlength="10" {if $Mondaycheck eq '1'} value="{$tdmonday}" {else}disabled="disabled"{/if}/></td>

                          </tr>

                          <tr>

                            <td><input type="checkbox" id="tuseday" name="tuseday"  onchange="checkrecday(this.id);" {if $Tuesdaycheck eq '1'}checked{/if}/>

                              &nbsp;Tuesday</td>

                            <td><input  name="apttuseday" id="apttuseday" type="text" class="appt_txtbox" size="15" maxlength="5" onBlur="return tValid(this.value,'apttuseday');" {if $Tuesdaycheck eq '1'} value="{$data.0.apptimeTU}" {else}disabled="disabled"{/if}/></td>

                            <td><input  name="rettuseday" id="rettuseday" type="text" class="appt_txtbox" size="15" maxlength="5" onBlur="return tValid(this.value,'rettuseday');" {if $Tuesdaycheck eq '1'} value="{$data.0.returnpickupTU}" {else}disabled="disabled"{/if}/></td>

                            <td><input name="tdtuseday" id="tdtuseday" type="text"  class="appt_txtbox" size="20" maxlength="10" {if $Tuesdaycheck eq '1'} value="{$tdtuseday}" {else}disabled="disabled"{/if}/></td>

                          </tr>

                          <tr>

                            <td><input type="checkbox" id="wednesday" name="wednesday"  onchange="checkrecday(this.id);" {if $Wednesdaycheck eq '1'}checked{/if}/>

                              &nbsp;Wednesday</td>

                            <td><input  name="aptwednesday" id="aptwednesday" type="text" class="appt_txtbox" size="15" maxlength="5" onBlur="return tValid(this.value,'aptwednesday');" {if $Wednesdaycheck eq '1'} value="{$data.0.apptimeW}" {else}disabled="disabled"{/if}/></td>

                            <td><input  name="retwednesday" id="retwednesday" type="text" class="appt_txtbox" size="15" maxlength="5" onBlur="return tValid(this.value,'retwednesday');" {if $Wednesdaycheck eq '1'} value="{$data.0.returnpickupW}" {else}disabled="disabled"{/if}/></td>

                            <td><input name="tdwednesday" id="tdwednesday" type="text"  class="appt_txtbox" size="20" maxlength="10" {if $Wednesdaycheck eq '1'} value="{$tdwednesday}" {else}disabled="disabled"{/if}/></td>

                          </tr>

                          <tr>

                            <td><input type="checkbox" id="thirsday" name="thirsday"  onchange="checkrecday(this.id);" {if $Thursdaycheck eq '1'}checked{/if}/>

                              &nbsp;Thursday</td>

                            <td><input  name="aptthirsday" id="aptthirsday" type="text" class="appt_txtbox" size="15" maxlength="5" onBlur="return tValid(this.value,'aptthirsday');" {if $Thursdaycheck eq '1'} value="{$data.0.apptimeTH}" {else}disabled="disabled"{/if}/></td>

                            <td><input  name="retthirsday" id="retthirsday" type="text" class="appt_txtbox" size="15" maxlength="5" onBlur="return tValid(this.value,'retthirsday');" {if $Thursdaycheck eq '1'} value="{$data.0.returnpickupTH}" {else}disabled="disabled"{/if}/></td>

                            <td><input name="tdthirsday" id="tdthirsday" type="text"  class="appt_txtbox" size="20" maxlength="10" {if $Thursdaycheck eq '1'} value="{$tdthirsday}" {else}disabled="disabled"{/if}/></td>

                          </tr>

                          <tr>

                            <td><input type="checkbox" id="friday" name="friday"  onchange="checkrecday(this.id);" {if $Fridaycheck eq '1'}checked{/if}/>

                              &nbsp;Friday</td>

                            <td><input  name="aptfriday" id="aptfriday" type="text" class="appt_txtbox" size="15" maxlength="5" onBlur="return tValid(this.value,'aptfriday');" {if $Fridaycheck eq '1'} value="{$data.0.apptimeF}" {else}disabled="disabled"{/if}/></td>

                            <td><input  name="retfriday" id="retfriday" type="text" class="appt_txtbox" size="15" maxlength="5" onBlur="return tValid(this.value,'retfriday');" {if $Fridaycheck eq '1'} value="{$data.0.returnpickupF}" {else}disabled="disabled"{/if}/></td>

                            <td><input name="tdfriday" id="tdfriday" type="text"  class="appt_txtbox" size="20" maxlength="10" {if $Fridaycheck eq '1'} value="{$tdfriday}" {else}disabled="disabled"{/if}/></td>

                          </tr>

                          <tr>

                            <td><input type="checkbox" id="saturday" name="saturday"  onchange="checkrecday(this.id);" {if $Saturdaycheck eq '1'}checked{/if}/>

                              &nbsp;Saturday</td>

                            <td><input  name="aptsaturday" id="aptsaturday" type="text" class="appt_txtbox" size="15" maxlength="5" onBlur="return tValid(this.value,'aptsaturday');" {if $Saturdaycheck eq '1'} value="{$data.0.apptimeSA}" {else}disabled="disabled"{/if}/></td>

                            <td><input  name="retsaturday" id="retsaturday" type="text" class="appt_txtbox" size="15" maxlength="5" onBlur="return tValid(this.value,'retsaturday');" {if $Saturdaycheck eq '1'} value="{$data.0.returnpickupSA}" {else}disabled="disabled"{/if}/></td>

                            <td><input name="tdsaturday" id="tdsaturday" type="text"  class="appt_txtbox" size="20" maxlength="10" {if $Saturdaycheck eq '1'} value="{$tdsaturday}" {else}disabled="disabled"{/if}/></td>

                          </tr>

                          <tr>

                            <td><input type="checkbox" id="sunday" name="sunday"  onchange="checkrecday(this.id);" {if $Sundaycheck eq '1'}checked{/if}/>

                              &nbsp;Sunday</td>

                            <td><input  name="aptsunday" id="aptsunday" type="text" class="appt_txtbox" size="15" maxlength="5" onBlur="return tValid(this.value,'aptsunday');" {if $Sundaycheck eq '1'} value="{$data.0.apptimeSU}" {else}disabled="disabled"{/if}/></td>

                            <td><input  name="retsunday" id="retsunday" type="text" class="appt_txtbox" size="15" maxlength="5" onBlur="return tValid(this.value,'retsunday');" {if $Sundaycheck eq '1'} value="{$data.0.returnpickupSU}" {else}disabled="disabled"{/if}/></td>

                            <td><input name="tdsunday" id="tdsunday" type="text"  class="appt_txtbox" size="20" maxlength="10" {if $Sundaycheck eq '1'} value="{$tdsunday}" {else}disabled="disabled"{/if}/></td>

                          </tr>

                          <tr>

                            <td><input type="hidden" name="mon" value="monday" />

                              <input type="hidden" name="tus" value="tuesday" />

                              <input type="hidden" name="wed" value="wednesday" />

                              <input type="hidden" name="thi" value="thursday" />

                              <input type="hidden" name="fri" value="friday" />

                              <input type="hidden" name="sat" value="saturday" />

                               <input type="hidden" name="sun" value="sunday" /></td>

                          </tr>

                        </table></td>

                    </tr>

                    <tr align="left">

                      <td colspan="3" valign="top" class="admintopheading"><strong>Comments OR Notes</strong></td>

                    </tr>

                    <tr>

                      <td align="left" valign="top" class="labels">&nbsp;</td>

                      <td align="left" valign="top">&nbsp;</td>

                      <td valign="top">&nbsp;</td>

                    </tr>

                    <tr>

                      <td colspan="3" align="left" valign="top" class="labels"><textarea tabindex="50" name="comments" cols="74" rows="7" class="txtarea" id="comments">{$data.0.comments}</textarea></td>

                    </tr>

                    <tr>

                      <td align="left" valign="top" class="labels">&nbsp;</td>

                      <td colspan="2" align="left" valign="top">&nbsp;</td>

                    </tr>

                    <tr>

                      <td valign="top">&nbsp;</td>

                      <td colspan="2" align="right"><input type="submit" name="submit" value="Update......" class="inputButton btn"  />

                        <input type="reset" name="reset" value="Reset" class="inputButton btn"  />

                        <input type="hidden" name="pendingids" value="{$pendingids}"  /></td>

                    </tr>

                  </table>

                </form>

              </div></td>

          </tr>

          {/if}

        </table></td>

    </tr>

  </table>

</body>

{literal}<script>chTrip('{/literal}{$data.0.triptype}{literal}');</script>{/literal}

{ include file = innerfooter.tpl} 