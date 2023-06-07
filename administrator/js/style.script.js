var prevElementIdHolder = "";
var prevDivIdHolder = "";



function do_delete(url,name){
	$statues = confirm('Are you sure you want to delete "'+name+'" ?');
	if($statues)
		window.location = url;
}

function showHideBlock(elementID1){
	
	if(prevElementIdHolder != "" && prevElementIdHolder != elementID1) 
	{
		document.getElementById(prevElementIdHolder).style.display='none';
	}
	
	if(document.getElementById(elementID1).style.display=='block'){
	document.getElementById(elementID1).style.display='none';
	}else{
	document.getElementById(elementID1).style.display='block';
	}
	prevElementIdHolder = elementID1;
}

function toggleDivz(divElementID)
{
	
	
	if(prevDivIdHolder == "")
	{
		prevDivIdHolder = divElementID;
	}
	else if(prevDivIdHolder == divElementID)
	{
		//DO NOTHING
		//DIV WILL BE TOGGLED BY THE JQUERY FUNCTION
	}
	else
	{
		document.getElementById(prevDivIdHolder).style.display='none';
		prevDivIdHolder = divElementID;
	}
	
	
}

/*
function validateForm(subFormID)
{
	if(trim(document.getElementById(subFormID).getElementById('fullname').value)=="")
	{
		alert("Name field required please!");
		window.event.return false;
	}
			window.event.return false;
}
*/


/*
function setValue(varactive)
{
	alert("Function called");
	if(document.form.getElementById(varactive).checked)
	{
			document.getElementById(varactive).value="Yes"
	}
		
}*/