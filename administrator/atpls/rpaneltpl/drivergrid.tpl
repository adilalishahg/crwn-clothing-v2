{ include file = header_buzzer3.tpl}



{literal} 

<script type="text/javascript">

tday=new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");

tmonth=new Array("January","February","March","April","May","June","July","August","September","October","November","December");

function GetClock(){

var d=new Date();

var nday=d.getDay(),nmonth=d.getMonth()+1,ndate=d.getDate(),nyear=d.getYear();

if(nyear<1000) nyear+=1900;

var d=new Date();

var nhour=d.getHours(),nmin=d.getMinutes(),nsec=d.getSeconds(),ap;

if(nhour==0){ap=" AM";nhour=12;}

else if(nhour<12){ap=" AM";}

else if(nhour==12){ap=" PM";}

else if(nhour>12){ap=" PM";nhour-=12;}

if(nmin<=9) nmin="0"+nmin;

if(nsec<=9) nsec="0"+nsec;


document.getElementById('clockbox').innerHTML=" "+nmonth+'/'+ndate+'/'+nyear+' -- '+nhour+":"+nmin+":"+nsec+ap+"";

}

window.onload=function(){

GetClock();

setInterval(GetClock,1000);

}

</script>



<script type="text/javascript">

 $(document).ready(function() { 

});

refreshed();

function st_status_change(id,st){ 

	ok=confirm("Are you sure you want to change status of this Trip?");

		if (ok)

		{ //alert(st);		

	 $.post("editgrid_ajax.php", {id: ""+id,st: ""+st}, function(data){ //alert(data);

	 if(data.length > 0 ){  location.reload();

		 }

	});

		}else return false;

	}		

//setInterval(getalerts(),10000);

function deleteRec(id,id2)

		{

		var ok;

		ok=confirm("Are you sure you want to delete this record");

		if (ok)

		{		

			location.href="grid.php?delId="+id+"&id="+id2;

			return true;

			//document.delrecfrm.submit();

		}

		else

		{

			return false;

		}

	}

	//function dvmap(val1,val2)

function dvmap(did,tid,tdate,ttime,acknowledge_status)

	{

		var brk =  Array();
		var msg =  Array();

		if (did != '' && tid != '' && tdate != '' && ttime != '')
		{

		   	$.post("cnfrm.php", {drv_id: did, trp_id: tid, trp_date: tdate, trp_time:ttime}, function(cnfrm){ 

				$.post("dvmap.php", {did: did, tid: tid, tdate: tdate, ttime: ttime, acknowledge_status: acknowledge_status}, function(data){

						if(data.length > 0)

						{ 

							msg = data.split('^'); //alert(msg[2]);

							if(msg[1] == '0')

								alert("Not Assigned Yet");

							else {

								alert(msg[2]); // location.reload(); 

								}

							/*$(	"#msg").html(msg[0]);

							if(msg[1] == '0')

							{

								$("#dv"+msg[1]).html('Not assigned Yet');

								$("#dv"+val2).html(brk[1]);

							}

							if(msg[1] != '0' || msg[1] != 'fail'  )

							{

								$("#dv"+msg[1]).html('Not assigned Yet');

								$("#dv"+val2).html(brk[1]);			 

						}*/

						return true;

					}

					});

				//}	

			});

		}

		else

		{

			return false;

		}	

	}

	 function popWind(url){

   myWindow1 = window.open( url, "myWindow1", 

"status = 1, height = 600, width = 915, scrollbars=0, resizable = 0" );

   myWindow1.moveTo(40,50);

   myWindow1.focus();

   }

    function popWind2(url){

   myWindow1 = window.open( url, "myWindow1", 

"status = 1, height = 800, width = 1000, scrollbars=1, resizable = 1" );

   myWindow1.moveTo(40,50);

   myWindow1.focus();

   }

   function popWind3(url){

   myWindow1 = window.open( url, "myWindow1", 

"status = 1, height = 500, width = 500, scrollbars=1, resizable = 1" );

   myWindow1.moveTo(40,50);

   myWindow1.focus();

   }

function fsubmit(url,id){

location.href=url+"&driver="+id; }

function fsubmit2(url,id){

location.href=url+"&user="+id;   }

function fsubmit3(url,id){

location.href=url+"&account="+id;   		}

//Alerts code for 		

function alerts(drv_id){ 

 if(drv_id != ''){

	var message = prompt("Send Message to : "+drv_id);

		if(message !== '' && message.length > 0){	 

		$.post("sendalert.php", {messag: ""+message, driver_code:""+drv_id}, function(data){ //alert(data);

  				if(data.length > 0) { 

				}

	 }); return true; }

	 	 else {return false; }

	   	}

 	 else { return false; }

	 }

var Usmania; 

var UsmaniaA = new Array();	   

function getalerts(){

		$.post("getalerts.php", {}, function(data){

  				if(data.length > 0) {

				var alerts = data;

				Usmania = alerts;

				sadigalliaga();

			 } });

	}	
	
			 

function sadigalliaga(){ //alert(Usmania);

			 UsmaniaA = Usmania.split('@');

			 if(UsmaniaA.length > 1){

				id 		= UsmaniaA[0];

				from 	= UsmaniaA[1];

				message	= UsmaniaA[2];

				senttime= UsmaniaA[3];

				var ok;

		ok=confirm('From: '+from+'      Sent: '+senttime+'\n\nMessage: '+message);

		if (ok)

		{		

			$.post("getalerts.php", {recid: ""+id}, function(data){

			});

			return true;

		}

		else

		{

			return false;

		}

	}   }

	setInterval ( "getalerts()", 25000);

 //End of alert

 //Page refresh code

 function refreshpagejana(){

	 var value = 'refresh';

 $.post("refreshpage.php", {action: ""+value}, function(data){

	 if(data.length > 0) { //alert(data);

		 var laylay = data;

		 if(laylay == 0 || laylay == 'P0'){

		 return false;

		  }

		 else if(laylay == 1 || laylay == 'T0'){  location.reload();   }

		  }

	});

 }

 function refreshed(){ 

	 var valu = 'refreshed'; 

 $.post("refreshpage.php", {action: ""+valu}, function(data){

			});

 }

 setInterval ( "refreshpagejana()", 30000);

 //Page refresh code

 //Acknowledge by admin

  function ack(id){

 $.post("acknowledged.php", {id: ""+id}, function(data){

	 if(data.length > 0 ){location.reload(); 

		 //$('#'+id).hide();

		 }

	});

 }

 //end of acknowledge

 //start of finding coordinates from google

 function findcoord(addtype,add,id){

	 //alert(id);

	 $.post("add_cordinates.php", {id: ""+id, addtype: ""+addtype}, function(data){

		 if(data.length > 0 ){

			 if(data == 1){ location.reload();   }

			 else if(data !== 1){ return false; }

			 }

			});

	 }

 //End of finding google coordinates

function hsscort(tdid){ //alert(''+tdid);

$('#scorts'+tdid).toggle();}

function addescort(drvid,tdid){

	 $.post("addescort.php", {tdid: ""+tdid, drvid: ""+drvid}, function(data){

		 if(data.length > 0 ){ //alert(data);

			 if(data == 1){ location.reload();   }

			 else if(data !== 1){ return false; }

			 }

			});

	//alert(tdid);

	} 

  setInterval ( "autorefresh()", 90000);

  function autorefresh(){	  location.reload(); 	  }

  

  function domultiload(){

	  var arr = [];

$('input.forcheck:checkbox:checked').each(function () {

    arr.push($(this).val());

}); alert(arr);

	  }

</script> 



<style>


.ST10 { background-color:#09F; /*Green*/}



.ST5 { background-color:#999; /*Gray*/}



.ST6 { background-color:#0F0; /*Green*/}



.ST { background-color:#0F0; /*Green*/}



.ST { background-color:#0F0; /*Green*/}


.hide{ display:none;}
</style>





{/literal}



<table  width="100%" border="0" cellspacing="0" cellpadding="0"  align="left" bgcolor="#FFFFFF">

<tr><td style="background-color:#09F;">{include file = menu.tpl}</td></tr>



  <tr>

    <td><table width="100%" border="0" cellspacing="0" cellpadding="0" >

        <tr>

          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">

              <tr>

                <td  align="center" class="okmsg"><span class="okmsg">{ if $msgs != ''} {$msgs} {/if}

                  

                  

                  

                  { if $errors != ''} {$errors} {/if}</span></td>

              </tr>



              <tr>

                <td height="44" align="center"  valign="top" style="padding-bottom:50px;"><table width="100%" border="0" class="main_table" cellpadding="0" cellspacing="0" style="font-size:8pt;" >

                    <tr>

                       <td align="left" class="label_txt_heading"><strong>Unit #</strong></td>

                     <td align="left" class="label_txt_heading"><strong>P/U Time</strong></td>

                      <td align="left" class="label_txt_heading"><strong>PU Address</strong></td>

                     

                      <td align="left" class="label_txt_heading"><strong>DO Address</strong></td>

                      

                      <td align="left" class="label_txt_heading"><strong>LOS</strong></td>

                      <td align="left" class="label_txt_heading"><strong>O2</strong></td>

                      <td align="left" class="label_txt_heading"><strong>ETA</strong></td>

                      <td align="left" class="label_txt_heading"><strong>Driver</strong></td>

                      <td align="left" class="label_txt_heading"><strong>Ticket</strong></td>

                    </tr>
                    <tr><td colspan="9"><hr/><hr/></td></tr>
                    

                    <div id="sc"></div>

                    {section name=q loop=$drivers}
                    
                    {if (count($drivers[q].trips) > 0)}
<tr valign="top" id="{$drivers[q].trips[0].tdid}"   class="ST{$drivers[q].trips[0].status}">

                       <td align="left" ><strong>{$drivers[q].veh_numplate}</strong></td>

                     <td align="left"><strong>{$drivers[q].trips[0].pck_time}</strong></td>

                      <td align="left"><strong>{$drivers[q].trips[0].pck_add}</strong></td>

                 

                      <td align="left"><strong>{$drivers[q].trips[0].drp_add}</strong></td>

                     

                      <td align="left"> {$drivers[q].trips[0].vehtype}<span style="font-size:9px; color:#F00;">



                      {if $drivers[q].trips[0].dstretcher eq 'Yes'}<br/>&raquo; 2Man-Team {/if}



                      {if $drivers[q].trips[0].bar_stretcher eq 'Yes'}<br/>&raquo; Bariatric-Str. {/if}



                      {if $drivers[q].trips[0].dwchair eq 'Yes'}<br/>&raquo; W-Chair-Rental {/if}



                      {if $drivers[q].trips[0].oxygen eq 'Yes'}<br/>&raquo; Oxygen {/if}</span>
</td>

                      <td align="left"><strong>&nbsp;</strong></td>

                      <td align="left"><strong>{$drivers[q].trips[0].drp_time}</strong></td>

                      <td align="left"><strong>{$drivers[q].fname} {$drivers[q].lname}</strong></td>

                      <td align="left"><strong>&nbsp;</strong></td>

                    

                    </tr>
                    
                    {else}
                    <tr style="background-color:#CCC;">

                       <td align="left">&nbsp;</td>

                      <td align="left">&nbsp;</td>

                      <td align="left">&nbsp;</td>

                      <td align="left">&nbsp;</td>

                      <td align="left">&nbsp;</td>

                      <td align="left">&nbsp;</td>

                      <td align="left">&nbsp;</td>

                      <td align="left"><strong>{$drivers[q].fname} {$drivers[q].lname}</strong></td>

                      <td align="left">&nbsp;</td>

                    

                    </tr>
                    
                    {/if}
<tr><td colspan="9"><hr/></td></tr>
                    {sectionelse}

                    <tr>

                      <td colspan="7" align="center" valign="top" class="grid_content"><strong>No Record Found!</strong></td>

                    </tr>

                    {/section}

                  </table></td>

              </tr>

              <tr>

                <td style="text-align:center;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="background-color:#999; font-size:14px;">&nbsp;&nbsp;&nbsp;Scheduled&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <span style="background-color:#09F; font-size:14px;">&nbsp;&nbsp;&nbsp;Arrived&nbsp;&nbsp;&nbsp;</span>
                  
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="background-color:#0F0; font-size:14px;">&nbsp;&nbsp;&nbsp;Picked&nbsp;&nbsp;&nbsp;</span></td>

              </tr>

            </table></td>

        </tr>

      </table></td>

  </tr>

</table>

<script language="javascript" type="text/javascript">
{literal}
function searchme() {
		var autocomplete = new google.maps.places.Autocomplete(
				(document.getElementById('PickupAddress')),
		{types: ['geocode']});
		google.maps.event.addListener(autocomplete, 'place_changed', function () {	
			//getDistance();
		});
    }
function initMap() {
    	searchme();
    	//searchmetwo();
    }
	
	</script>
<script type="text/javascript" src="//maps.google.com/maps/api/js?sensor=false&key=AIzaSyBBE53xDKH93kCWSWREyehlzH8N_t2R2lw&callback=initMap&sensor=false&libraries=geometry,places&ext=.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>{/literal}
{ include file = innerfooter.tpl} 