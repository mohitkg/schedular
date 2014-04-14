<?php
include('functions.php');

session_start();
if(!loggedIn()){
	die("Don't act smart, my buoy!");
}
else{

$userid = $_SESSION['userid'];
$userid = 'pri';

// Configuration
$dbhost = 'localhost';
$dbname = 'acadScheduler';

// Connect to test database
$m = new Mongo("mongodb://$dbhost");
$db = $m->$dbname;

// Get the users collection
$users = $db->Users;
$courses = $db->Courses;

$userInfo = $users->findOne(array('userid'=>$userid));

date_default_timezone_set('Asia/Calcutta');
$userCourses = $userInfo['courses'];
$dateToday = getdate();
$dayToday = $dateToday['wday'];

$eventsList = array();
foreach ($userCourses as $course) {
	$courseInfo = $courses->findOne(array('course_name'=>$course));
	$courseSlot = $courseInfo['timing'];
	$courseDays = $courseInfo['days'];
	
	foreach ($courseDays as $day) {
		$classDateThisWeek = date("d")-( $dayToday-date('N', strtotime($day)) );
		
		for ($i=-9; $i < 10; $i++) { 
			$startDate = mktime($courseSlot, 0, 0, date("m")  ,$classDateThisWeek+(7*$i) , date("Y"));
			$startDate = date("Y-m-d\TH:i:sO",$startDate);
			$endDate = mktime($courseSlot+1, 0, 0, date("m")  ,$classDateThisWeek+(7*$i) , date("Y"));
			$endDate = date("Y-m-d\TH:i:sO",$endDate);
			$eventsList[] = array(
				'title' => $course,
				'start' => $startDate,
				'end' => $endDate,
				'allDay' => false
			);
		}
	}
}
echo json_encode($eventsList);
die();

foreach ($sch as $key => $value) {
	if($key != '_id')
	{
	/*var_dump($value);
	echo '<br>';*/
	foreach ($value as $course => $slot) {
		$slot = intval($slot);
		$eventDate = date("d")-( $dayToday-date('N', strtotime($key)) );

		for ($i=-9; $i < 10; $i++) { 
			$startDate = mktime($slot, 0, 0, date("m")  ,$eventDate+(7*$i) , date("Y"));
			$startDate = date("Y-m-d\TH:i:sO",$startDate);
			$endDate = mktime($slot+1, 0, 0, date("m")  ,$eventDate+(7*$i) , date("Y"));
			$endDate = date("Y-m-d\TH:i:sO",$endDate);
			$eventsList[] = array(
				'title' => $course,
				'start' => $startDate,
				'end' => $endDate,
				'allDay' => false
			);
		}

	}
	}
}

echo json_encode($eventsList);
}
/*echo '
[{"title":"CS335","start":"2014-04-07T08:00:00+0530","end":"2014-04-07T09:00:00+0530","allDay":false},{"title":"CS345","start":"2014-04-07T09:00:00+0530","end":"2014-04-07T10:00:00+0530","allDay":false},{"title":"PHI422","start":"2014-04-07T11:00:00+0530","end":"2014-04-07T12:00:00+0530","allDay":false},{"title":"CS315","start":"2014-04-08T16:00:00+0530","end":"2014-04-08T17:00:00+0530","allDay":false},{"title":"COMM","start":"2014-04-08T17:00:00+0530","end":"2014-04-08T18:00:00+0530","allDay":false},{"title":"CS335","start":"2014-04-09T08:00:00+0530","end":"2014-04-09T09:00:00+0530","allDay":false},{"title":"CS345","start":"2014-04-09T09:00:00+0530","end":"2014-04-09T10:00:00+0530","allDay":false},{"title":"PHI422","start":"2014-04-10T10:00:00+0530","end":"2014-04-10T11:00:00+0530","allDay":false},{"title":"MBA630","start":"2014-04-10T15:00:00+0530","end":"2014-04-10T16:00:00+0530","allDay":false},{"title":"CS315","start":"2014-04-11T15:00:00+0530","end":"2014-04-11T16:00:00+0530","allDay":false},{"title":"MBA630","start":"2014-04-11T17:00:00+0530","end":"2014-04-11T18:00:00+0530","allDay":false},
{"title":"CS335 - Extra Class","start":"2014-04-08T10:00:00+0530","end":"2014-04-08T11:00:00+0530","color": "green", "allDay":false},{"title":"CS315 - Extra Class","start":"2014-04-09T15:00:00+0530","end":"2014-04-09T16:00:00+0530","color": "green", "allDay":false},{"title":"Meeting with Dentist","start":"2014-04-09T17:00:00+0530","end":"2014-04-09T18:00:00+0530","color": "#54E3C9", "allDay":false},{"title":"Project Discussion","start":"2014-04-09T13:00:00+0530","end":"2014-04-09T14:00:00+0530","color": "#54E3C9", "allDay":false}
]
';*/
?>