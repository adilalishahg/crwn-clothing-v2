{literal}
  <style>
  #select {
    font-family: 'FontAwesome', 'Second Font name';
    fill:blue;
    
  }
  
  </style>
  <script src="https://kit.fontawesome.com/31ce513105.js" crossorigin="anonymous"></script>
  <script>
  
  function popWind(url){
    myWindow1 = window.open( url, "myWindow1", 
  "status = 1, height = 600, width = 915, scrollbars=0, resizable = 0" );
    myWindow1.moveTo(40,50);
    myWindow1.focus();
    }
  </script>
  {/literal}
<div id="top_menu">
  <ul>
    <li><a href="../index.php">HOME</a></li>
    <li><a href="../mercy/">ADD TRIP</a></li>
    <li><a href="../requests/">TRIP REQUESTS</a></li>
    <li><a href="../routingpanel/gridto.php" >DISPATCH</a></li>
    <li><a href="../routingpanel/futuretrips.php"  target="_blank">CALENDAR</a></li>
    <li><a href="../routingpanel/nextdaygrid.php?st=11" >NEXT DAY</a></li>
    <!-- <li><a href="../routingpanel/futuretrips.php" >FUTURE SCHEDULE </a></li>-->
    <li><a href="../routingpanel/grid2.php?st=5" >PREVIOUS DAY</a></li>
    <li><a href="../routingpanel/driver_schedule2.php" target="_blank" >DRIVERS TIME SLOTS</a></li>
    <!----> <li class="last"><a href="../autosch.php" >AUTO SCHEDULE</a></li>
    {if $smarty.session.count neq '' }
      <li  class="last">
      <select id="select"   style="width:300px;height:25px; padding-bottom:5px; background-color:#69C; color:#FFF;" >
        <option value="" >New Trips ({$smarty.session.count})<span>&#xf0f3</span></option>
        {section name=d loop=$smarty.session.req1}	
          <option value="../../reqpreview.php?id={$smarty.session.req1[d].id}" >{$smarty.session.req1[d].clientname}---{$smarty.session.req1[d].account_name}</option>
        {/section}
      </select>
      </li>
    {/if}
  </ul>            
</div>
{literal}
  <script>
  $("#select").change(function(){
    var url = $(this).val();  
    if (url) { // require a URL
      popWind(url); // redirect
    }
    location.reload()
});
  </script>
{/literal}