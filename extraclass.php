<?php
session_start();
include('includes/functions.php');

if(loggedIn() && !isset($_POST['submit'])){
	die("Fill up the form for extra class first");
}
else{
	if(!loggedIn() && $_SESSION['userType']!='instructor')
		echo "Don't act smart by bwoy!";
	else{
	include('includes/dashboardInstructor.php');
	$extraClass_course = $_POST['course_num'];
	$extraClass_slot = intval(explode('-',$_POST['timing'])[0]);
	$extraClass_date = $_POST['date'];
	date_default_timezone_set('Asia/Calcutta');
	$extraClass_day = date('D',strtotime($extraClass_date));

	//echo "Instructor wants to hold an extra class of ". $extraClass_course. " on ". $extraClass_date ." at ". $extraClass_slot."<br>";
	//$extraClass_day = 'Mon';
	//$extraClass_slot = 8;

	// Configuration
	$dbhost = 'localhost';
	$dbname = 'acadScheduler';

	// Connect to test database
	$m = new Mongo("mongodb://$dbhost");
	$db = $m->$dbname;

	// Get the users collection
	$courses = $db->Courses;
	$users = $db->Users;

	if(empty($courses->findOne( array('course_name'=>$extraClass_course) )['students']))
		die("<center><h4>Course has no registered students</h4></center>");
	$course_students = $courses->findOne( array('course_name'=>$extraClass_course) )['students'];
	$all_courses = array();
	//print_r($course_students);
	echo '<br>';
	if (!empty($course_students)){
		//echo 'hi';
		//generate list of all courses that could possibly clash
		foreach ($course_students as $student) {
			$student_courses = $users->findOne( array('userid'=>$student) )['courses'];
			//echo gettype($student_courses);
			if (!empty($student_courses)) {
				$all_courses = array_merge($all_courses, $student_courses);
				$all_courses = array_unique($all_courses);
			}
		}
		//print_r($all_courses);

		//check clashes
		$clash = 0;
		foreach ($all_courses as $course) {
			$course_days = $courses->findOne( array('course_name'=>$course) )['days'];
			$course_slot = $courses->findOne( array('course_name'=>$course) )['timing'];

			if (in_array($extraClass_day, $course_days) && $course_slot==$extraClass_slot ){
				echo "<center><h4>Clash with a regular class of ".$course.". Some of your students are enrolled in this course."."</h4><br>
				<h5><a href='extraClassForm.php'>Click</a> to go back</h5></center>";
				$clash = 1;
			}
			if(!empty($courses->findOne( array('course_name'=>$course) )['extra_class'])){

				$course_extraSchedule = $courses->findOne( array('course_name'=>$course) )['extra_class'];
				foreach ($course_extraSchedule as $extra_class) {
					if (!empty($extra_class[$extraClass_date]) && $extra_class[$extraClass_date]==$extraClass_slot){
						echo "<center><h4>Clash with an extra class of ".$course.". Some of your students are enrolled in this course.". "</h4><br>
						<h5><a href='extraClassForm.php'>Click</a> to go back</h5></center><br>";
						$clash = 1;
						break;
					}

				}
			}
		}
		if($clash == 0){
			//echo 'no clash';
			$courses->update( array('course_name'=>$extraClass_course), array(
				'$push'=> array("extra_class"=> array($extraClass_date=>intval($extraClass_slot)))
			));
			echo '<center><h4>Extra class for '.$extraClass_course.' created on '.$extraClass_date.' at '.$extraClass_slot.'00 hrs</h4></center><br>';
			header('refresh:2;url=basic-views.php');
		}
	}
	}
}


?>
