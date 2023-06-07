
                    {section name=q loop=$membdetail}
                    <tr  valign="top" id="{$membdetail[q].tdid}"  bgcolor="{cycle values="#eeeeee,#d0d0d0"}" class="{$membdetail[q].color_class}">
                      <!--<td > {$membdetail[q].ccode}  <input type="checkbox" value="{$membdetail[q].tdid}" class="forcheck" /> </td>
                      <td align="left" valign="top" class="grid_content"><b>{$membdetail[q].trip_clinic}</b></td>-->
                      <td align="left" valign="top" class="grid_content"><b>
                      {section name=p loop=$accounts}
                      { if $accounts[p].id eq $membdetail[q].account } {$accounts[p].account_name} {/if} 
                      {/section}
                      </b><br/>{$membdetail[q].ccode} 
                      {$membdetail[q].modiv_id}
                      {if $membdetail[q].modiv_detail_id neq ''}<br/>{$membdetail[q].modiv_detail_id}{/if}
                      </td>
                      <td align="left" valign="top" class="grid_content">{$membdetail[q].trip_user}<br/>
                      {if $membdetail[q].pcomments neq ''}<img src="../images/icons/information2.png" title="{$membdetail[q].pcomments}" >{else}
                      <img src="../images/icons/information.png" title="{$membdetail[q].pcomments}" >{/if}
                      {if $membdetail[q].modiv_flage eq '1'}<img style="margin-top: -11px;" border="0" width="60" height="30" title="ModivCare" alt="ModivCare" src="../graphics/modiv30.svg" />{/if}</td>
                      <!--<td align="left" valign="top" class="grid_content"> 
                      {if $st neq '9'}
{$membdetail[q].driver}-[{$membdetail[q].drv_id}]
{else}
<select name="staff1" id="staff1" class="required" onchange="return dvmap(this.value,'{$membdetail[q].tdid}','{$membdetail[q].trip_date}','{$membdetail[q].pck_time}','{$membdetail[q].acknowledge_status}')">
<option value="">--Select--</option>
{section name=r loop=$driverdata}
<option value="{$driverdata[r].drv_code}" {if $driverdata[r].drv_code eq $membdetail[q].drv_id}selected{/if}>{$driverdata[r].fname} {$driverdata[r].lname}</option>
{/section}
</select>
{/if} </td>-->
        <td align="left" valign="top" class="grid_content"><select name="staff1" id="staff1" class="required" onchange="return dvmap(this.value,'{$membdetail[q].tdid}','{$membdetail[q].trip_date}','{$membdetail[q].pck_time}','{$membdetail[q].acknowledge_status}')">
                         <option value="">--Select--</option>
                         {if $membdetail[q].modiv_flage eq '1'}
{section name=r loop=$driverdata_modiv}
            <option value="{$driverdata_modiv[r].drv_code}" {if $driverdata_modiv[r].drv_code eq $membdetail[q].drv_id}selected{/if}>{$driverdata_modiv[r].fname} {$driverdata_modiv[r].lname}</option>
{/section}  
{else}
                         
{section name=r loop=$driverdata}
            <option value="{$driverdata[r].drv_code}" {if $driverdata[r].drv_code eq $membdetail[q].drv_id}selected{/if}>{$driverdata[r].fname} {$driverdata[r].lname}</option>
{/section} {/if} </select>
<br/>
{section name=r loop=$driverdata}
             {if $driverdata[r].drv_code eq $membdetail[q].escort_id}ESC &raquo;{$driverdata[r].fname} {$driverdata[r].lname}{/if}
{/section}
<br/>
{if $membdetail[q].drv_id neq ''}
&nbsp;&nbsp;<a href="#" onclick="hsscort('{$membdetail[q].tdid}')" ><input type="button" class="inputButton btn" value=" + ESCORT "  /></a>
{/if}

<span id="scorts{$membdetail[q].tdid}" style="display:none;" >
<select id="sl{$membdetail[q].tdid}" onchange="return addescort(this.value,'{$membdetail[q].tdid}')">
<option value="">--Select Escort--</option>
{section name=r loop=$driverdata}
            <option value="{$driverdata[r].drv_code}" {if $driverdata[r].drv_code eq $membdetail[q].escort_id}selected{/if}>{$driverdata[r].fname} {$driverdata[r].lname}</option>
{/section}  </select></span>
</td>
             <!--<td align="left" valign="top" class="grid_content"> {if $membdetail[q].drv_id neq ''}
{$membdetail[q].driver}-[{$membdetail[q].drv_id}]
{else}
{if $st== '5' || $st== '9'}
<select name="staff1" id="staff1" class="required" onchange="return dvmap(this.value,'{$membdetail[q].tdid}','{$membdetail[q].trip_date}','{$membdetail[q].pck_time}')">
<option value="">--Select--</option>
{section name=r loop=$driverdata}
<option value="{$driverdata[r].drv_code}" {if $driverdata[r].drv_code eq $staff1}selected{/if}>{$driverdata[r].fname} {$driverdata[r].lname}</option>
{/section}
</select>
{/if}
{/if} </td>
-->
                   <td align="left" valign="top" class="grid_content">{if $membdetail[q].picklocation neq ''}[<strong>Pick Location:</strong> {$membdetail[q].picklocation}]<br/>{/if}
                   {$membdetail[q].pck_add}{if $membdetail[q].pickup_instruction neq ''}<br/>[<strong>Instruction:</strong> {$membdetail[q].pickup_instruction}]{/if}{if $membdetail[q].p_phnum neq ''}<br/>[<strong>Phone #:</strong> {$membdetail[q].p_phnum}]{/if}
                        <!--<a href="#" onclick="findcoord('pick','{$membdetail[q].pck_add}','{$membdetail[q].tdid}');" > {if $membdetail[q].pick_latlong eq '' || $membdetail[q].pick_latlong eq 'NULL'}<img src="../images/icons/null_cord.png" title="Find Coordinate" >{else}<img src="../images/icons/yes_cord.png" title="Find Updated Coordinate" >{/if}</a>--></td>
                      <td align="left" valign="top" class="grid_content">{if $membdetail[q].droplocation neq ''}[<strong>Drop Location:</strong> {$membdetail[q].droplocation}]<br/>{/if}
                      {$membdetail[q].drp_add}{if $membdetail[q].destination_instruction neq ''}<br/>[<strong>Instruction:</strong> {$membdetail[q].destination_instruction}]{/if}{if $membdetail[q].d_phnum neq ''}<br/>[<strong>Phone #:</strong> {$membdetail[q].d_phnum}]{/if}<!--<br/>
<a href="#" onclick="findcoord('drop','{$membdetail[q].drp_add}','{$membdetail[q].tdid}');" >{if $membdetail[q].drop_latlong eq '' || $membdetail[q].drop_latlong eq 'NULL'}<img src="../images/icons/null_cord.png" title="Find Coordinate" >{else}<img src="../images/icons/yes_cord.png" title="Find Updated Coordinate" >{/if}</a>--></td>
                      <td align="left" valign="top" class="grid_content">
                      
                      {if $membdetail[q].wc eq '1'} W/C
                      
                      
                      {if $membdetail[q].wc eq '1' && $membdetail[q].rideInitiated eq '0' && $membdetail[q].modiv_flage eq '1'}
                      
                      <input type="button" id="rideIntiateButton{$membdetail[q].tdid}" value=" Initiate " class="btn" onclick="initiate2('{$membdetail[q].tdid}');" title="Initiate call to ModiVCare before Enrouting Ride" />  
                      <span id="rideIntiateSpan{$membdetail[q].tdid}" style="display:none">
                      <input type="text" id="initiate_picktime{$membdetail[q].tdid}" size="5" class="initiate_picktime" maxlength="5"   />
                      <input type="button" value="Click to Initiate " class="btn" onclick="initiate('{$membdetail[q].tdid}');" title="Initiate call to ModiVCare before Enrouting Ride" />
                      </span>
                      	<!--{if $membdetail[q].callup eq 0}<a href="#" onclick="callup('{$membdetail[q].tdid}')">
                      <img src="../graphics/call_icon.png" title="Call Up" ></a>{/if}-->
                      {/if}
                     <!-- {if $membdetail[q].rideInitiated eq '1' }<br/><span style="color:#F00; font-weight:bold;">Ride Initiated</span>{/if}-->
                      {else} 
                      <span id="pick_time_2{$membdetail[q].tdid}">{$membdetail[q].pck_time|date_format:"%H:%M"}</span>
                      {if $membdetail[q].modiv_flage eq '1'}
                      <a id="pick_time_button_{$membdetail[q].tdid}" href="#" onclick="change_time2('{$membdetail[q].tdid}')"><img src="../graphics/schedule.png" height="24" width="24" title="Change Ride Pick Up Time" ></a>
                      <span id="pick_time_{$membdetail[q].tdid}" style="display:none">
                      <input type="text" id="pick_time{$membdetail[q].tdid}" size="5" class="initiate_picktime" maxlength="5" value="{$membdetail[q].pck_time|date_format:"%H:%M"}"  />
                      <input type="button" value=" Updade " class="btn" onclick="change_time('{$membdetail[q].tdid}');" title="Update Ride Pick Up Time" />
                      </span>
                      
                     
                      
                      {/if}
                      
                      <!--<input disabled="disabled" class="dispatch_picktime" style="width:50px" id="disable{$membdetail[q].tdid}" maxlength='5' type="text" onchange="create_receipt_approve('{$membdetail[q].tdid}','time',this.value)" value="{$membdetail[q].pck_time|date_format:"%H:%M"}" />
                      <img border="0" onclick="enabled('{$membdetail[q].tdid}')" width="12px" alt="Edit" src="../graphics/edit.png">-->
                      
                      
                      {/if}
                      
                      {if $membdetail[q].status eq '4' || $membdetail[q].status eq '1'}
                      <br/><span style="color:#F00;">{$membdetail[q].aptime}</span>{/if}
                      {if $membdetail[q].status eq '10' && $membdetail[q].wait_time neq ''}<br/><img src="../graphics/waiting.png" title="Waiting" ><br/><span style="font-size:8px; color:#F00;">{$membdetail[q].wait_time}{/if}</span></td>
                      <td align="left" valign="top" class="grid_content" >{if $membdetail[q].org_apptime neq ''}  {$membdetail[q].org_apptime}{else}--:--{/if}</td>
                      <td align="left" valign="top" class="grid_content">{if $membdetail[q].wc eq '1'} --:--{else}{$membdetail[q].drp_time}{/if}
                      {if $membdetail[q].status eq '4' || $membdetail[q].status eq '1'}
                      <br/><span style="color:#F00;">{$membdetail[q].drp_atime}</span>{/if}
                      </td>
                      <td align="left" valign="top" class="grid_content">{$membdetail[q].trip_miles}
                       {if $membdetail[q].modiv_flage eq '1'}
                      <br/>$ {$membdetail[q].legcharges}
                      {/if}</td>
                      <td align="left" valign="top" class="grid_content">
                      
                      {$membdetail[q].vehtype}<span style="font-size:9px; color:#F00;">
                      {if $membdetail[q].dstretcher eq 'Yes'}<br/>&raquo; 2Man-Team {/if}
                      {if $membdetail[q].bar_stretcher eq 'Yes'}<br/>&raquo; Bariatric-Str. {/if}
                      {if $membdetail[q].dwchair eq 'Yes'}<br/>&raquo; W-Chair-Rental {/if}
                      {if $membdetail[q].oxygen eq 'Yes'}<br/>&raquo; Oxygen {/if}</span>
                      
                      </td>
                      <td align="left" valign="top" class="grid_icon"><!--<a  href="#" onclick="popWind('editgrid-new.php?id={$membdetail[q].tdid}&type={if $st eq 6}1{else}2{/if}');" title="Edit"> <img border="0" alt="Edit" src="../graphics/edit.png"></a>--><!--<a  href="editgrid-new.php?id={$membdetail[q].tdid}&type={if $st eq 6}1{else}2{/if}" rel="facebox" title="Edit"> <img border="0" alt="Edit" src="../graphics/edit.png"></a>-->
                      {if $membdetail[q].modiv_flage eq '1' && ($membdetail[q].status eq '3' || $membdetail[q].status eq '4' || $membdetail[q].status eq '6' || $membdetail[q].status eq '12')}	
                    {else}
                      <a  href="#" onclick="window.open('edit2.php?id={$membdetail[q].reqid}')" title="Edit" ><img border="0" alt="Edit" src="../graphics/edit.png"></a>&nbsp;&nbsp;		  {/if}
    {if $st eq 4} 
    <a href="javascript:popWind('../reports/details.php?id={$membdetail[q].tdid}');" title="View">
     {if $membdetail[q].status eq '4'}
                        Completed
                        {/if}	 
                        {if $membdetail[q].status eq '1'}
                        Completed
                        {/if} </a>&nbsp;&nbsp;
                        {else}  <a href="javascript:popWind('../reports/details.php?id={$membdetail[q].tdid}');" title="View"> View</a>&nbsp;&nbsp;
                        {/if}
                     {if $smarty.session.admuser.admin_level eq '0'}{/if} <a href="#"  onclick="return deleteRec('{$membdetail[q].tdid}','{$id}');"  title="Remove"> <img alt="Remove" border="0"  src="../graphics/delete.png"></a> &nbsp; 
                       <a href="#" onclick="alerts('{$membdetail[q].drv_id}')" ><img src="../graphics/alert.png" height="20px" width="20px" /></a>
                <br/><!--&nbsp;<a href="#" onclick="popWind3('temp_comments.php?tdid={$membdetail[q].tdid}');" ><img src="../graphics/temp_comments.png" height="20px" width="20px" /></a>-->
                 {if $st neq '14'}
                {if $membdetail[q].modiv_flage eq '1' && $membdetail[q].drv_id eq ''} Assign Driver {else}
                        <select name="st_status" id="st_status" onchange="st_status_change('{$membdetail[q].tdid}',this.value,'{$membdetail[q].reqid}');" style="width:110px;" >
                       {if $membdetail[q].status eq '5' || $membdetail[q].status eq '0'}                       
                          <option value="5" {if $membdetail[q].status eq '5'} selected="selected"{/if}>Scheduled</option>
                          <option value="13" {if $membdetail[q].status eq '13'} selected="selected"{/if}>Enroute</option>
                          <option value="3" {if $membdetail[q].status eq '3'} selected="selected"{/if}>Cancelled</option>
                         <option value="8" {if $membdetail[q].status eq '8'} selected="selected"{/if}>non-Billable No-Show</option>
                          <option value="7" {if $membdetail[q].status eq '7'} selected="selected"{/if}>Billable No-Show</option>
                          
						 {elseif $membdetail[q].status eq '13'}	
						  <option value="5" {if $membdetail[q].status eq '5'} selected="selected"{/if}>Scheduled</option>
                          <option value="13" {if $membdetail[q].status eq '13'} selected="selected"{/if}>Enroute</option>
                          <option value="10" {if $membdetail[q].status eq '10'} selected="selected"{/if}>Arrived at Pickup</option>
                          <option value="3" {if $membdetail[q].status eq '3'} selected="selected"{/if}>Cancelled</option>
                          <option value="8" {if $membdetail[q].status eq '8'} selected="selected"{/if}>non-Billable No-Show</option>
                          <option value="7" {if $membdetail[q].status eq '7'} selected="selected"{/if}>Billable No-Show</option>
                          {elseif $membdetail[q].status eq '10'}	
						  <option value="13" {if $membdetail[q].status eq '13'} selected="selected"{/if}>Enroute</option>
                          <option value="10" {if $membdetail[q].status eq '10'} selected="selected"{/if}>Arrived at Pickup</option>
                          <option value="6" {if $membdetail[q].status eq '6'} selected="selected"{/if}>Picked Up</option>
                          <option value="3" {if $membdetail[q].status eq '3'} selected="selected"{/if}>Cancelled</option>
                          <option value="8" {if $membdetail[q].status eq '8'} selected="selected"{/if}>non-Billable No-Show</option>
                          <option value="7" {if $membdetail[q].status eq '7'} selected="selected"{/if}>Billable No-Show</option>
                          {elseif $membdetail[q].status eq '6'}
                          <option value="10" {if $membdetail[q].status eq '10'} selected="selected"{/if}>Arrived at Pickup</option>
                          <option value="6" {if $membdetail[q].status eq '6'} selected="selected"{/if}>Picked Up</option>
                          <option value="12" {if $membdetail[q].status eq '12'} selected="selected"{/if}>Arrived at Drop Off</option>
                          {elseif $membdetail[q].status eq '12'}
                          <option value="6" {if $membdetail[q].status eq '6'} selected="selected"{/if}>Picked Up</option>
                          <option value="12" {if $membdetail[q].status eq '12'} selected="selected"{/if}>Arrived at Drop Off</option>
                          <option value="4" {if $membdetail[q].status eq '4'} selected="selected"{/if}>Dropped</option>
						  {elseif $membdetail[q].status eq '3'}	
                          <option value="5" {if $membdetail[q].status eq '5'} selected="selected"{/if}>Scheduled</option>
                          <option value="3" {if $membdetail[q].status eq '3'} selected="selected"{/if}>Cancelled</option>
							{elseif $membdetail[q].status eq '7'}	
                          <option value="5" {if $membdetail[q].status eq '5'} selected="selected"{/if}>Scheduled</option>
                         <option value="7" {if $membdetail[q].status eq '7'} selected="selected"{/if}>Billable No-Show</option>
							{elseif $membdetail[q].status eq '8'}	
                          <option value="5" {if $membdetail[q].status eq '5'} selected="selected"{/if}>Scheduled</option>
                          <option value="8" {if $membdetail[q].status eq '8'} selected="selected"{/if}>non-Billable No-Show</option>
							{elseif $membdetail[q].status eq '9'}	
                          <option value="9" {if $membdetail[q].status eq '9'} selected="selected"{/if}>Pending</option>
                          <option value="3" {if $membdetail[q].status eq '3'} selected="selected"{/if}>Cancelled</option>
                          {elseif $membdetail[q].status eq '4' || $membdetail[q].status eq '1'}	
                          <option value="4" {if $membdetail[q].status eq '4'} selected="selected"{/if}>Dropped</option>
                          <option value="6" {if $membdetail[q].status eq '6'} selected="selected"{/if}>Picked</option>
                          <option value="5" {if $membdetail[q].status eq '5'} selected="selected"{/if}>Scheduled</option>
							{/if}
                        </select>
                        {/if}
                        {/if}</td>
                      <td > {if $st eq '9' }
                        {if $membdetail[q].acknowledge_status eq '0'}Pending{/if}<br/>
                        {if $membdetail[q].acknowledge_status eq '0'}<span style="color:#66F; font-weight:bold;"><a href="#" onclick="ack('{$membdetail[q].tdid}')">Ack. by Admin</a></span>{/if}
                {if $membdetail[q].acknowledge_status eq '2'}<span style="color:#F00; font-weight:bold;">Denied</span>{/if}
                        {else} <a title="[{$membdetail[q].drv_id}]" href="driver.php?dri_code={$membdetail[q].drv_id}&a={$membdetail[q].pck_add}&b={$membdetail[q].drp_add}" target="_blank"><img alt="Track" border="0" src="../graphics/gps.png"></a><br/><!--
                        <a title="[{$membdetail[q].drv_id}] Multi Routes" href="driver_trips.php?dri_code={$membdetail[q].drv_id}" target="_blank"><img alt="Track" border="0" src="../graphics/multiroutes.png"></a>-->
                        {/if}<!--{if $membdetail[q].gps neq ''} <a title="GPS" href="{$membdetail[q].gps}"><img alt="GPS" border="0"  src="../graphics/gps.png"></a>{else}<img alt="GPS Not Installed" border="0"  src="../graphics/dgps.png">{/if}&nbsp;&nbsp;
--></td>
                      <!--<td class="grid_content">{if $membdetail[q].sip neq ''}<a href="sip:{$membdetail[q].sip}" title="Call"><img alt="Call" border="0"  src="../graphics/call_driver.png"></a>{else}<img alt="Call Not Configured" border="0"  src="../graphics/dcall.png">{/if}</td>-->
                    </tr>
                    {/section}