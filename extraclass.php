<?php

include('includes/dashboard.php');

if(!isset($_POST['submit'])){
	die("Fill up the form for extra class first");
}
else{
	
	$extraClass_course = $_POST['course_num'];
	$extraClass_slot = intval(explode('-',$_POST['timing'])[0]);
	$extraClass_date = $_POST['date'];
	date_default_timezone_set('Asia/Calcutta');
	$extraClass_day = date('D',strtotime($extraClass_date));

	echo "Instructor wants to hold an extra class of ". $extraClass_course. " on ". $extraClass_date ." at ". $extraClass_slot."<br>";
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

	$course_students = $courses->findOne( array('course_name'=>$extraClass_course) )['students'];
	$all_courses = array();
	print_r($course_students);
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
		print_r($all_courses);

		//check clashes
		$clash = 0;
		foreach ($all_courses as $course) {
			$course_days = $courses->findOne( array('course_name'=>$course) )['days'];
			$course_slot = $courses->findOne( array('course_name'=>$course) )['timing'];
			if (in_array($extraClass_day, $course_days) && $course_slot==$extraClass_slot ){
				echo "Clash with ".$course."<br>";
				$clash = 1;
				break;
			}
		}
		if($clash == 0){
			//echo 'no clash';
			$courses->update( array('course_name'=>$extraClass_course), array(
				'$push'=> array("extra_class"=> array($extraClass_date=>intval($extraClass_slot)))
			));
			echo 'Extra class created';
		}
	}	
}

/*if(isset($_POST) and $_POST['submitForm'] == "ExtraClass" ){
$course = $_POST['course_num'];
$timing = $_POST['timing'];
$date = $_POST['date'];
// Day from date should be calculated*/

//
/*$day = "Th";
// code to check whether free or not.
echo "instructor want to held an extra class of ". $course. " on ". $date[0]. "/". $date[1]. "/". $date[2]. " at ". $timing;

echo "students registered in the course are \n";
$con = new MongoClient();
 if($con){
 	$db = $con->acadScheduler;
 	$col_courses = $db->courses;
 	$col_schedule = $db->schedule;
 	$result = $col_courses->find();
 	$cursor = $col_courses->find(array("course_name" => "eco101"), array("_id" => 0, "students" => 1));
 	echo "count of cursor is ";
 	echo $cursor->count();
 	if($document = $cursor->getNext()){
	 	//echo iterator_to_array($document);
 		$student_list = $document["students"];
 		$n = count($student_list);

	 	for($i=0; $i < $n; $i++){
			if($cursor = $col_schedule->find(array("name" => $student_list[$i]), array("_id" => 0, $day => 1))){
			// this will give the schedule of i'th student on that day.
				$doc = $cursor->getNext();
				$time_list = $doc[$day];
				$m = count($time_list);
				for($j=0;$j<$m;$j++){ 
					if($time_list[$j][0] == $timing ){
						echo  $student_list[$i]; 
						echo " has a clash\n";
					}
				}
			}
			else{
				echo "query failed";
			}
		}
} else{
	echo "cursor was null";
}

 } else{
 	echo "error in connection with database";
 }*/



?>