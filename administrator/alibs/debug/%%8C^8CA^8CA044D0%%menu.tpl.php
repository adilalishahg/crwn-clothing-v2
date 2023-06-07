<?php /* Smarty version 2.6.12, created on 2023-03-31 23:25:30
         compiled from menu.tpl */ ?>
<?php echo '
  <style>
  #select {
    font-family: \'FontAwesome\', \'Second Font name\';
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
  '; ?>

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
    <?php if ($_SESSION['count'] != ''): ?>
      <li  class="last">
      <select id="select"   style="width:300px;height:25px; padding-bottom:5px; background-color:#69C; color:#FFF;" >
        <option value="" >New Trips (<?php echo $_SESSION['count']; ?>
)<span>&#xf0f3</span></option>
        <?php unset($this->_sections['d']);
$this->_sections['d']['name'] = 'd';
$this->_sections['d']['loop'] = is_array($_loop=$_SESSION['req1']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['d']['show'] = true;
$this->_sections['d']['max'] = $this->_sections['d']['loop'];
$this->_sections['d']['step'] = 1;
$this->_sections['d']['start'] = $this->_sections['d']['step'] > 0 ? 0 : $this->_sections['d']['loop']-1;
if ($this->_sections['d']['show']) {
    $this->_sections['d']['total'] = $this->_sections['d']['loop'];
    if ($this->_sections['d']['total'] == 0)
        $this->_sections['d']['show'] = false;
} else
    $this->_sections['d']['total'] = 0;
if ($this->_sections['d']['show']):

            for ($this->_sections['d']['index'] = $this->_sections['d']['start'], $this->_sections['d']['iteration'] = 1;
                 $this->_sections['d']['iteration'] <= $this->_sections['d']['total'];
                 $this->_sections['d']['index'] += $this->_sections['d']['step'], $this->_sections['d']['iteration']++):
$this->_sections['d']['rownum'] = $this->_sections['d']['iteration'];
$this->_sections['d']['index_prev'] = $this->_sections['d']['index'] - $this->_sections['d']['step'];
$this->_sections['d']['index_next'] = $this->_sections['d']['index'] + $this->_sections['d']['step'];
$this->_sections['d']['first']      = ($this->_sections['d']['iteration'] == 1);
$this->_sections['d']['last']       = ($this->_sections['d']['iteration'] == $this->_sections['d']['total']);
?>	
          <option value="../../reqpreview.php?id=<?php echo $_SESSION['req1'][$this->_sections['d']['index']]['id']; ?>
" ><?php echo $_SESSION['req1'][$this->_sections['d']['index']]['clientname']; ?>
---<?php echo $_SESSION['req1'][$this->_sections['d']['index']]['account_name']; ?>
</option>
        <?php endfor; endif; ?>
      </select>
      </li>
    <?php endif; ?>
  </ul>            
</div>
<?php echo '
  <script>
  $("#select").change(function(){
    var url = $(this).val();  
    if (url) { // require a URL
      popWind(url); // redirect
    }
    location.reload()
});
  </script>
'; ?>