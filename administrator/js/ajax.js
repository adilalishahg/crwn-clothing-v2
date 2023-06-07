
var showobj;
    function makeRequest(url,obj) {
		showobj=obj;
		
        var http_request = false;

        if (window.XMLHttpRequest) { // Mozilla, Safari, ...
            http_request = new XMLHttpRequest();
            if (http_request.overrideMimeType) {
                http_request.overrideMimeType('text/xml');
                // See note below about this line
            }
        } else if (window.ActiveXObject) { // IE
            try {
                http_request = new ActiveXObject("Msxml2.XMLHTTP");
            } catch (e) {
                try {
                    http_request = new ActiveXObject("Microsoft.XMLHTTP");
                } catch (e) {}
            }
        }

        if (!http_request) {
            alert('Giving up :( Cannot create an XMLHTTP instance');
            return false;
        }
        http_request.onreadystatechange = function() { alertContents(http_request); };
        http_request.open('GET', url, true);
        http_request.send(null);
    }

    function alertContents(http_request) {

        if (http_request.readyState == 4) {
            if (http_request.status == 200) {
			//alert(http_request.responseText);
                document.getElementById(showobj).innerHTML =  http_request.responseText;
            } else {
                alert('There was a problem with the request.');
            }
        }else{
			//document.getElementById(showobj).innerHTML ='<br><img src="graphix/loading.gif"><br>';
		}
		
		
    }
	
function getSelected()
{ //alert('ok1');
	ob=document.getElementById("cat_l1");
	nlength=ob.length;
	//alert('ok1');
	tmp='';
	for ( i=0; i<nlength; i++ ) {
		
		if (ob.options[i].selected == true) {
			if (tmp == '' )
			{
				tmp= ob.options[i].value;
			}else{
				tmp=tmp + ',' + ob.options[i].value;
			}
		}
	}

	if (tmp!='') makeRequest('pages/response.php?cid=' +tmp,'citylist','lev1');
}

function getSelected1()
{ //alert('ok1');
	ob=document.getElementById("fromcity");
	nlength=ob.length;
	//alert('ok1');
	tmp='';
	for ( i=0; i<nlength; i++ ) {
		
		if (ob.options[i].selected == true) {
			if (tmp == '' )
			{
				tmp= ob.options[i].value;
			}else{
				tmp=tmp + ',' + ob.options[i].value;
			}
		}
	}

	if (tmp!='') makeRequest('pages/response.php?cid1=' +tmp,'citylist1');
}






function delete_selected(url,field)
{

 // document.getElementById("tbl_nm11").value;
 selected_items='';
//if(document.getElementById("check_all").checked== true){
for (i = 0; i < field.length; i++){
	if(field[i].checked == true){
		
	selected_items=selected_items+','+field[i].value;
		
		
	}
	

}
  url=url+'&selected_items='+selected_items
 
 if(selected_items !=''){
  $status = confirm('Are you sure you want to delete selected items');
		if($status)
	makeRequest(url,'del_result'); 
 }else{
	 
	   alert('No item selected');
	 }
	
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function get_sub_cat()
{ 
    var cat_id=document.getElementById("pid").value;
	alert(cat_id);
	 // var typ=document.getElementById("typ").value;
	  //var file_name=document.getElementById("file_name").value;
	 //  var f_url=document.getElementById("f_url").value;
	 // alert(f_url);
 makeRequest('get_sub_cat.php?cat_id='+cat_id,'sub_cat_div');
}


function change_answer(ans_id)
{ 
    
	
	var q_id=document.getElementById("cat_id1").value;
	document.getElementById('ans_div'+ans_id).style.display='';
	 //var ans_id=document.getElementById("ans").value;
	//alert(cat_id);
	 // var typ=document.getElementById("typ").value;
	  //var file_name=document.getElementById("file_name").value;
	 //  var f_url=document.getElementById("f_url").value;
	 // alert(ans_id);
 makeRequest('ajax_resp_files/select_answer.php?q_id='+q_id+'&ans_id='+ans_id,'ans_div'+ans_id);
}




