<?php
if(isset($_POST) and $_POST['submitForm'] == "ExtraClass" ){
$course = $_POST['course_num'];
$timing = $_POST['timing'];
$date = $_POST['date'];
// Day from date should be calculated

//
$day = "Th";
// code to check whether free or not.
echo "instructor want to held an extra class of ". $course. " on ". $date[0]. "/". $date[1]. "/". $date[2]. " at ". $timing;

echo "students registered in the course are \n";
$con = new MongoClient();
 if($con){
 	$db = $con->acadSchedular;
 	$col_courses = $db->courses;
 	$col_schedule = $db->schedule;
 	$result = $col_courses->find();
 	$cursor = $col_courses->find(array("course_name" => $course), array("_id" => 0, "students" => 1));
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
header('refresh:5;url=instructor.php');
} else{
	echo "cursor was null";
	header('refresh:5;url=instructor.php');
	
}

 } else{
 	echo "error in connection with database";
 }


}
?>
