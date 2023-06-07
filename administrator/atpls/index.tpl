{include file = mainhead.tpl}       	

            

            <!-- start of body content -->

            <div class="body_content">

            

            	<!-- start of content section -->

                <div class="content_section" >

                 

                 <ul class="gallery">

				 {if $smarty.session.admuser.admin_level eq '0'}

	<!--<li>

		<a href="cms/" class="thumb"><span><img src="cms.png" alt="" /></span></a>

		<h2><a href="cms/">Content Management</a></h2>

	</li>-->

	{/if}

	{if $smarty.session.admuser.admin_level eq '0'}

  <!--  <li>

		<a href="Corporates/" class="thumb"><span><img src="hospital.png" alt="" /></span></a>

		<h2><a href="Corporates/">Facility Management</a></h2>

	</li>-->

	{/if}

    <li>

		<a href="vehicles/" class="thumb"><span><img src="vehicle.png" alt="" /></span></a>

		<h2><a href="vehicles/">Vehicles Management</a></h2>

	</li>

    <li>

		<a href="drivers/" class="thumb"><span><img src="driver.png" alt="" /></span></a>

		<h2><a href="drivers/">Drivers Management</a></h2>

	</li>

	{if $smarty.session.admuser.admin_level eq '0'}

	<li>

		<a href="admusers/" class="thumb"><span><img src="user.png" alt="" /></span></a>

		<h2><a href="admusers/">Admin Users</a></h2>

	</li>

	{/if}

	<li>

		<a href="attandance/" class="thumb"><span><img src="attend.png" alt="" /></span></a>

		<h2><a href="attandance/">Attendance Management</a></h2>

	</li>  

	{if $smarty.session.admuser.admin_level eq '0'}  

   <!-- <li>

		<a href="testimonials/" class="thumb"><span><img src="testimonial.png" alt="" /></span></a>

		<h2><a href="testimonials/">Testimonials</a></h2>

	</li>-->

	{/if}

	 <li>

		<a href="routingpanel/" class="thumb"><span><img src="routing.png" alt="" /></span></a>

		<h2><a href="routingpanel/">Routing Panel</a></h2>

	</li>

	

    <!-- <li>

		<a href="http://203.82.61.178" target="_blank" class="thumb"><span><img src="call_manager.png" alt="" /></span></a>

		<h2><a href="routingpanel/">Call Manager</a></h2>

	</li>-->
    {if $expiredata neq ''}
    <li>
		<a href="vehicles/" class="thumb" title="{section name=q loop=$expiredata}  &raquo; {$expiredata[q].vnumber}  {/section}" ><span><img src="vehicle.gif" alt="" /></span></a>
		<h2><a href="vehicles/" title="{section name=q loop=$expiredata}  &raquo; {$expiredata[q].vnumber}  {/section}">Registration of Vehicles <br/>{if $expiring gt 0}{$expiring} Expiring {/if} {if $expired gt 0}{$expired} Expired {/if}</a></h2>
	</li>{/if}


     <!-- <li>

		<a href="http://69.64.48.92/htMap.aspx?name=662066" target="_blank" class="thumb"><span><img src="vehicle.png" alt="" /></span></a>

		<h2><a href="http://69.64.48.92/htMap.aspx?name=662066">GPS Tracking</a></h2>

	</li>

   <li>

		<a href="reports/billing.php"  class="thumb"><span><img src="billing.png" alt="" /></span></a>

		<h2><a href="reports/billing.php">Billing</a></h2>

	</li>-->

	

</ul> 

     

                </div><!-- end of content section -->               

                

                <!-- start of content section -->

                <!-- end of content section -->

                	

                

            </div> <!-- end of body content -->

            

            <!-- start of right side bar -->

             <!-- end of right side bar -->

            

            <div class="cleaner"></div> 



{include file = footer.tpl}