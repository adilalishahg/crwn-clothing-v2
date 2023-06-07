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
{literal}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl,{
            schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives9',
            initialView: 'resourceTimeGridDay',
           	initialDate: {/literal}'{$today}'{literal},
            slotDuration: '00:10',
            slotLabelInterval:'01:00',
            nowIndicator: true,
            allDaySlot:false,
            eventTimeFormat: {
                hour: "2-digit",
                minute: "2-digit",
                hour12: true
            },
            slotLabelFormat:{
                hour: '2-digit',
                minute: '2-digit',
                hour12:true
            },
            expandRows:true,
            dayMinWidth:200,
            stickyFooterScrollbar : true,
            // now: new Date.parse(Date.now()),
            timeZone:'America/Arizona',
			
             headerToolbar: {
                 left: '',
                 center: '',
                 right: ''
             },
            editable:false,
            resources:[
                
						{/literal}
                        {section name=index loop=$drivers}
                        {literal}
                        {
                            id:{/literal}{$drivers[index].Drvid}{literal},
                            title: {/literal}"{$drivers[index].fname} {$drivers[index].lname}",  
                        },
                        {/section}
                        {literal}
						/*{$drivers[index].fname}    {$smarty.section.index.iteration} Driver {$drivers[index].fname} {$drivers[index].lname} {$drivers[index].drv_code}-
						 D-{$smarty.section.index.iteration} */
            ],
            events: [
               
                {/literal}
                        {section name=q loop=$driversFreeSlots}
                        {literal}
                        
				{
                    id:{/literal}{$smarty.section.q.iteration}{literal},
                    description:"Driver Calendar",
                    resourceIds:[{/literal}{$driversFreeSlots[q].Drvid}{literal}],
                    title: "Driver Free Time Slot",
                    start: "{/literal}{$driversFreeSlots[q].free_start}{literal}",
                    end:"{/literal}{$driversFreeSlots[q].free_end}{literal}",
                    //startStr:"{/literal}{$driversFreeSlots[q].free_start}{literal}",
                    //endStr:"{/literal}{$driversFreeSlots[q].free_end}{literal}",
					color:"#6C6",
                    allDay:false,
                },
				{/literal}
                {/section}
                        {literal}
               ],
        });
        calendar.render();
    });
</script>
<style>
.fc-license-message { display:none;}
</style>
{/literal}
</html>