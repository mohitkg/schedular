<?php
include('includes/functions.php');
session_start();
if(!loggedIn()){
	die("Don't act smart, my bwoy!");
}
else{
if($_SESSION['userType']=='instructor')
	include('includes/dashboardInstructor.php');
else
	include('includes/dashboardStudent.php');


echo "<html>
<head>
<link href='includes/fullcalendar.css' rel='stylesheet' />
<link href='includes/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='lib/jquery.min.js'></script>
<script src='lib/jquery-ui.custom.min.js'></script>
<script src='lib/fullcalendar.min.js'></script>
<script type='text/javascript' src='includes/jquery.simpletip.min.js'></script>
<script>

	$(document).ready(function() {

		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();

		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next,today',
				center: 'title',
				right: 'month, agendaWeek, agendaDay'
			},
			defaultView: 'agendaWeek',
			minTime: 8,
			maxTime: 19,
			editable: false,
			events:	'includes/feedPersonal.php',
			eventMouseover: function(calEvent, jsEvent){
				$('<p></p>')
			        .addClass('tooltip')
			        .text(calEvent.title)
			        .appendTo('body')
			    $(this).css('z-index', 10000);
			    $('.tooltip').fadeIn('fast');
			    $('.tooltip').fadeTo('10', 1.9);
				$(this).mouseover(function(e) {

			    }).mousemove(function(e) {
			        $('.tooltip').css('top', e.pageY + 10);
			        $('.tooltip').css('left', e.pageX + 20);
			    });


					/*$(this).mouseover(function(e){
				        //alert(calEvent.title);
				        $(this).css('z-index', 10000);
				        // Hover over code
				        $('<p></p>')
				        .addClass('tooltip')
				        .text(calEvent.title)
				        .appendTo('body')
				        .fadeIn('slow');
					}).mousemove(function(e) {
				        var mousex = e.pageX + 20; //Get X coordinates
				        var mousey = e.pageY + 10; //Get Y coordinates
				        $('.tooltip')
				        .css({ top: mousey, left: mousex })
					});*/
			},
			eventMouseout: function(calEvent, jsEvent) {
  	  			$(this).css('z-index', 8);
    			$('.tooltip').remove();
			},
		});
	});
</script>
<style>

	body {
		margin-top: 40px;
		text-align: center;
		font-size: 14px;
		font-family: 'Lucida Grande',Helvetica,Arial,Verdana,sans-serif;
		}

	#calendar {
		width: 900px;
		margin: 0 auto;
		}

</style>
</head>
<body>
<div id='calendar'></div>
</body>
</html>";
}
?>



<!-- [
				{
					title: 'All Day Event',
					start: new Date(y, m, 1)
				},
				{
					title: 'Long Event',
					start: new Date(y, m, d-5),
					end: new Date(y, m, d-2)
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: new Date(y, m, d-3, 16, 0),
					allDay: false
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: new Date(y, m, d+4, 16, 0),
					allDay: false
				},
				{
					title: 'Meeting',
					start: new Date(y, m, d, 10, 30),
					allDay: false
				},
				{
					title: 'Lunch',
					start: new Date(y, m, d, 12, 0),
					end: new Date(y, m, d, 14, 0),
					allDay: false
				},
				{
					title: 'Birthday Party',
					start: new Date(y, m, d+1, 19, 0),
					end: new Date(y, m, d+1, 22, 30),
					allDay: false
				},
				{
					title: 'Click for Google',
					start: new Date(y, m, 28),
					end: new Date(y, m, 29),
					url: 'http://google.com/'
				}
			] -->
