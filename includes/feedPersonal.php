<?php
include('functions.php');

session_start();
if(!loggedIn()){
	die("Don't act smart, my bwoy!");
}
else{

$userid = $_SESSION['userid'];
//$userid = 'pri';

// Configuration
$dbhost = 'localhost';
$dbname = 'acadScheduler';

// Connect to test database
$m = new Mongo("mongodb://$dbhost");
$db = $m->$dbname;

// Get the users collection
$users = $db->Users;
$courses = $db->Courses;
$personalSchedules = $db->PersonalSchedule;

$userInfo = $users->findOne(array('userid'=>$userid));
$userPersonalSchedule = $personalSchedules->findOne(array('userid'=>$userid))['schedule'];

date_default_timezone_set('Asia/Calcutta');
$userCourses = $userInfo['courses'];
$dateToday = getdate();
$dayToday = $dateToday['wday'];

$eventsList = array();
/*
//get academic schedule
foreach ($userCourses as $course) {
	$courseInfo = $courses->findOne(array('course_name'=>$course));
	$courseSlot = $courseInfo['timing'];
	$courseDays = $courseInfo['days'];
	//print_r($courseInfo);


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
	if (!empty($courseInfo['extra_class'])) {
		$courseExtraClass = $courseInfo['extra_class'];
		foreach ($courseExtraClass as $extra_class) {
			foreach ($extra_class as $classDate => $classSlot) {
				$year = explode('-', $classDate)[0];
				$month = explode('-', $classDate)[1];
				$date = explode('-', $classDate)[2];
				$startDate = mktime($classSlot, 0, 0, $month,$date, $year);
				$startDate = date("Y-m-d\TH:i:sO",$startDate);
				$endDate = mktime($classSlot+1, 0, 0, $month,$date, $year);
				$endDate = date("Y-m-d\TH:i:sO",$endDate);
				$eventsList[] = array(
					'title' => $course." - Extra Class",
					'start' => $startDate,
					'end' => $endDate,
					'allDay' => false,
					'color' => "#CF8092"
				);
			}
		}
	}
}
*/
//get personal schedule
if(!empty($personalSchedules->findOne(array('userid'=>$userid))['schedule'])){
foreach ($userPersonalSchedule as $event) {
	$year = explode('-', $event['date'])[0];
	$month = explode('-', $event['date'])[1];
	$date = explode('-', $event['date'])[2];
	$startDate = mktime($event['t1'], 0, 0, $month,$date, $year);
	$startDate = date("Y-m-d\TH:i:sO",$startDate);
	$endDate = mktime($event['t2'], 0, 0, $month,$date, $year);
	$endDate = date("Y-m-d\TH:i:sO",$endDate);
	$eventsList[] = array(
		'title' => $event['title']." - ".$event['location'],
		'start' => $startDate,
		'end' => $endDate,
		'allDay' => false,
		'color' => "green"
	);
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
