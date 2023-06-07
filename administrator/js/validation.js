function change_pass()
{
	if(document.getElementById("newPass").value != document.getElementById("confPass").value)
	{
		alert("New password donot match with a Confirm Password");
		document.getElementById("newPass").focus();
		return false;
	}
	if(document.getElementById("newPass").value.length == 0)
	{
		alert("New password cannot be empty");
		document.getElementById("newPass").focus();
		return false
	}
}
function admin_prof()
{
	if(document.getElementById("admin_user").value.length == 0)
	{
		alert("Admin username cannot be empty");
		document.getElementById("admin_user").focus();
		return false
	}

	if(document.getElementById("admin_name").value.length == 0)
	{
		alert("Admin name cannot be empty");
		document.getElementById("admin_name").focus();
		return false
	}
}

function delete_user()
{
	var conf;
	conf = confirm("Are You Sure You want to Delete?");
	if(conf)
	{
		return true;
	}else{
		return false;
	}
	
}
