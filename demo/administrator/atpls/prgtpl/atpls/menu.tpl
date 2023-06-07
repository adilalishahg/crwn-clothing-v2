<div class="chromestyle" id="chromemenu">

  <ul>

	<li><a href="../index.php">Home</a></li>

	{if $smarty.session.admuser.admin_level eq '0'}	

	<li><a href="#" rel="dropmenu1" >Corporations</a></li>

	{/if}

	{if $smarty.session.admuser.admin_level eq '0'}	

    <li><a href="../requests/">Trip Requests</a></li>

	

	<li><a href="#" rel="dropmenu2">Testimonials</a></li>

	<li><a href="../cms/">CMS</a></li>

	{/if}

	<li><a href="#" rel="vehcle">Vehicles</a></li>

     <li><a href="#" rel="drivers">Drivers</a></li>	

    <li><a href="#" rel="attendance">Attendance</a></li>

    {if $smarty.session.admuser.admin_level eq '0'}	

	<li><a href="../reports/">Reports</a></li>		

	

	<li><a href="#" rel="dropmenu7">Admin Users</a></li>

	<li><a href="#" rel="dropmenu4">Web Settings</a></li>

	{/if}

    {if $smarty.session.admuser.admin_level neq '0'}	

    <li><a href="../routingpanel/">Routing Panel</a></li>

    {/if}

	<li><a href="../logout.php">Logout</a></li>

	<!-- <li><a href="#" rel="dropmenu6">Reports</a></li>-->



  </ul>

</div>

<div id="dropmenu1" class="dropmenudiv" style="width: 150px;">

  <a href="../Corporates/">Manage</a>

  <a href="../Corporates/add.php">Add Corporate</a>   

   <!--<a href="../categories/add_category.php" rel="facebox">Add Category</a> -->

</div>



<div id="dropmenu2" class="dropmenudiv" style="width: 150px;">

  <a href="../testimonials/">Manage</a>

  <a href="../testimonials/addtestimonials.php">Add Testimonial</a>  

</div>

<div id="dropmenu3" class="dropmenudiv" style="width: 150px;">

  <a href="../cms/">Manage Content</a>

  <a href="../cms/addpage.php" rel="facebox">Add Page</a>

</div>



<div id="dropmenu4" class="dropmenudiv" style="width: 150px;">

    <a href="../admin_profile.php">Manage Admin Profile</a>

	<a href="../changepass.php">Change Passowrd</a>

	<a href="../copyright.php">Change Copyrights</a>	

</div>



<div id="vehcle" class="dropmenudiv" style="width: 180px;">

    <a href="../vehicles/vehtypes.php">Manage Vehicle Types</a>	

    <a href="../vehicles/vtype_trash.php">Vehicles Types Trash</a>	

    <a href="../vehicles/index.php">Manage Vehicles</a>

	<a href="../vehicles/addvehicle.php">Add Vehicle</a>

	<a href="../vehicles/veh_trash.php">Vehicles Trash</a>	

    <a href="../maintenance/index.php">Maintenance Management</a>	

    <a href="../maintenance/men_types.php">Maintenance Types</a>

      <a href="../tickets/index.php">Ticket Management</a>		

</div>

<div id="drivers" class="dropmenudiv" style="width: 150px;">

    <a href="../drivers/index.php">Manage Drivers</a>

	<a href="../drivers/add-drv.php">Add Driver</a>

	<a href="../drivers/drvtypes.php">Manage Drivers Types</a>	

    <a href="../drivers/drv_trash.php">Drivers Trash</a>	

    <a href="../drivers/dtype_trash.php">Drivers Types Trash</a>	

    <a href="../dvmapping/index.php">Assign Vehicle to Driver</a>	

      <a href="../tickets/index.php">Ticket Management</a>	

</div>



<div id="attendance" class="dropmenudiv" style="width: 150px;">

    <a href="../attandance/index.php">Manage Attendance</a>

	<a href="../attandance/timein.php" rel="facebox">Add TimeIn</a>

</div>



<div id="dropmenu6" class="dropmenudiv" style="width: 150px;">

	<a href="../sales/monthly.php">Monthly Report</a>

	<a href="../sales/revenue_generate.php">Revenue Generation</a>

	<a href="../sales/busy_session.php">Busy Session Report</a>

	<a href="../sales/slow_session.php">Slow Session Report</a>

	<a href="../sales/top_selling_product.php">Top Selling Product Report</a>

</div>



<div id="dropmenu7" class="dropmenudiv" style="width: 150px;">

  <a href="../admusers/">Manage</a>

  <a href="../admusers/adduser.php">Add User</a>   

</div>	

{if $smarty.session.admuser.admin_level eq '0'}

<div class="chromestyle" id="chromemenu2">

  <ul>

	

	<li><a href="../routingpanel/">Routing Panel</a></li>

    <li><a href="../logs/">Activity Log</a></li>



  </ul>

</div>

	{/if}



<script type="text/javascript">

cssdropdown.startchrome("chromemenu")

cssdropdown.startchrome("chromemenu2")

</script>		

		

			

		

		

		

		



		

		

		

		

		

			

		







