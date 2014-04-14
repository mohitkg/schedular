<?php

include('includes/dashboard.php');

if(!isset($_POST['submit'])){
	die("Fill up the form for activity first");
}
else{
	session_start();
	$user = $_SESSION['userid'];
	$event_title = $_POST['title'];
	$event_time_start = intval($_POST['timing1']);
	$event_time_end = intval($_POST['timing2']);
	if($event_time_start > $event_time_end){
		echo 'please choose start and end time properly';
	//	header('refresh:2;url=instructor.php');
	}
 	$event_date = $_POST['date'];
 	$event_location = $_POST['location'];
	date_default_timezone_set('Asia/Calcutta');
	$extraClass_day = date('D',strtotime($extraClass_date));

	echo $user."wants to add an event ". $event_title. " on ". $event_date ." from ". $event_time_start." to ". $event_time_end . " at ". $event_location. "<br>";

	// Configuration
	$dbhost = 'localhost';
	$dbname = 'acadScheduler';

	// Connect to test database
	$m = new Mongo("mongodb://$dbhost");
	$db = $m->$dbname;

	// Get the users collection
	$collection = $db->PersonalSchedule;

	$success = $collection->update(array('userid' => $user), array('$push' => array('schedule'=> array('title' => $event_title, 'date' => $event_date, 'location' => $event_location, 't1' => $event_time_start, 't2' => $event_time_end))));
	if($success) echo 'done';
	else echo 'fail';


}