<?php /* Smarty version 2.6.12, created on 2022-09-23 14:30:10
         compiled from driver_availibility.tpl */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.10.2/main.min.css" rel="stylesheet">
    <title>Calendar</title>
</head>
<body>
    <section>
        <div id="calendar">

        </div>
    </section>
</body>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.10.2/main.min.js"></script>
<script src="https://unpkg.com/tooltip.js/dist/umd/tooltip.min.js"></script>
<script src="https://unpkg.com/popper.js/dist/umd/popper.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<?php echo '
<script>
    document.addEventListener(\'DOMContentLoaded\', function() {
        var calendarEl = document.getElementById(\'calendar\');
        var calendar = new FullCalendar.Calendar(calendarEl,{
            schedulerLicenseKey: \'CC-Attribution-NonCommercial-NoDerivatives9\',
            initialView: \'resourceTimeGridDay\',
           	initialDate: '; ?>
'<?php echo $this->_tpl_vars['today']; ?>
'<?php echo ',
            slotDuration: \'00:10\',
            slotLabelInterval:\'01:00\',
            nowIndicator: true,
            allDaySlot:false,
            eventTimeFormat: {
                hour: "2-digit",
                minute: "2-digit",
                hour12: true
            },
            slotLabelFormat:{
                hour: \'2-digit\',
                minute: \'2-digit\',
                hour12:true
            },
            expandRows:true,
            dayMinWidth:200,
            stickyFooterScrollbar : true,
            // now: new Date.parse(Date.now()),
            timeZone:\'America/Arizona\',
			
             headerToolbar: {
                 left: \'\',
                 center: \'\',
                 right: \'\'
             },
            editable:false,
            resources:[
                
						'; ?>

                        <?php unset($this->_sections['index']);
$this->_sections['index']['name'] = 'index';
$this->_sections['index']['loop'] = is_array($_loop=$this->_tpl_vars['drivers']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['index']['show'] = true;
$this->_sections['index']['max'] = $this->_sections['index']['loop'];
$this->_sections['index']['step'] = 1;
$this->_sections['index']['start'] = $this->_sections['index']['step'] > 0 ? 0 : $this->_sections['index']['loop']-1;
if ($this->_sections['index']['show']) {
    $this->_sections['index']['total'] = $this->_sections['index']['loop'];
    if ($this->_sections['index']['total'] == 0)
        $this->_sections['index']['show'] = false;
} else
    $this->_sections['index']['total'] = 0;
if ($this->_sections['index']['show']):

            for ($this->_sections['index']['index'] = $this->_sections['index']['start'], $this->_sections['index']['iteration'] = 1;
                 $this->_sections['index']['iteration'] <= $this->_sections['index']['total'];
                 $this->_sections['index']['index'] += $this->_sections['index']['step'], $this->_sections['index']['iteration']++):
$this->_sections['index']['rownum'] = $this->_sections['index']['iteration'];
$this->_sections['index']['index_prev'] = $this->_sections['index']['index'] - $this->_sections['index']['step'];
$this->_sections['index']['index_next'] = $this->_sections['index']['index'] + $this->_sections['index']['step'];
$this->_sections['index']['first']      = ($this->_sections['index']['iteration'] == 1);
$this->_sections['index']['last']       = ($this->_sections['index']['iteration'] == $this->_sections['index']['total']);
?>
                        <?php echo '
                        {
                            id:';  echo $this->_tpl_vars['drivers'][$this->_sections['index']['index']]['Drvid'];  echo ',
                            title: '; ?>
"<?php echo $this->_tpl_vars['drivers'][$this->_sections['index']['index']]['fname']; ?>
 <?php echo $this->_tpl_vars['drivers'][$this->_sections['index']['index']]['lname']; ?>
",  
                        },
                        <?php endfor; endif; ?>
                        <?php echo '
						/*{$drivers[index].fname}    {$smarty.section.index.iteration} Driver {$drivers[index].fname} {$drivers[index].lname} {$drivers[index].drv_code}-
						 D-{$smarty.section.index.iteration} */
            ],
            events: [
               
                '; ?>

                        <?php unset($this->_sections['q']);
$this->_sections['q']['name'] = 'q';
$this->_sections['q']['loop'] = is_array($_loop=$this->_tpl_vars['driversFreeSlots']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['q']['show'] = true;
$this->_sections['q']['max'] = $this->_sections['q']['loop'];
$this->_sections['q']['step'] = 1;
$this->_sections['q']['start'] = $this->_sections['q']['step'] > 0 ? 0 : $this->_sections['q']['loop']-1;
if ($this->_sections['q']['show']) {
    $this->_sections['q']['total'] = $this->_sections['q']['loop'];
    if ($this->_sections['q']['total'] == 0)
        $this->_sections['q']['show'] = false;
} else
    $this->_sections['q']['total'] = 0;
if ($this->_sections['q']['show']):

            for ($this->_sections['q']['index'] = $this->_sections['q']['start'], $this->_sections['q']['iteration'] = 1;
                 $this->_sections['q']['iteration'] <= $this->_sections['q']['total'];
                 $this->_sections['q']['index'] += $this->_sections['q']['step'], $this->_sections['q']['iteration']++):
$this->_sections['q']['rownum'] = $this->_sections['q']['iteration'];
$this->_sections['q']['index_prev'] = $this->_sections['q']['index'] - $this->_sections['q']['step'];
$this->_sections['q']['index_next'] = $this->_sections['q']['index'] + $this->_sections['q']['step'];
$this->_sections['q']['first']      = ($this->_sections['q']['iteration'] == 1);
$this->_sections['q']['last']       = ($this->_sections['q']['iteration'] == $this->_sections['q']['total']);
?>
                        <?php echo '
                        
				{
                    id:';  echo $this->_sections['q']['iteration'];  echo ',
                    description:"Driver Calendar",
                    resourceIds:[';  echo $this->_tpl_vars['driversFreeSlots'][$this->_sections['q']['index']]['Drvid'];  echo '],
                    title: "Driver Free Time Slot",
                    start: "';  echo $this->_tpl_vars['driversFreeSlots'][$this->_sections['q']['index']]['free_start'];  echo '",
                    end:"';  echo $this->_tpl_vars['driversFreeSlots'][$this->_sections['q']['index']]['free_end'];  echo '",
                    //startStr:"';  echo $this->_tpl_vars['driversFreeSlots'][$this->_sections['q']['index']]['free_start'];  echo '",
                    //endStr:"';  echo $this->_tpl_vars['driversFreeSlots'][$this->_sections['q']['index']]['free_end'];  echo '",
					color:"#6C6",
                    allDay:false,
                },
				'; ?>

                <?php endfor; endif; ?>
                        <?php echo '
               ],
        });
        calendar.render();
    });
</script>
<style>
.fc-license-message { display:none;}
</style>
'; ?>

</html>