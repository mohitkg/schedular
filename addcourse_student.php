<?php
if(isset($_POST['submitForm']) ){
	session_start();
	include('includes/functions.php');
	include('includes/dashboardStudent.php');
	$stud_email = $_SESSION['userid'];
	$student_name = User_Name($stud_email);
	//echo $student_name;
	$course = $_POST['course_num'];
	//echo $course;
	$con = new MongoClient();
	//	echo "Connection to database successfully";
		if($con){
		// Select Database
		$db = $con->acadScheduler;
		$student = [];
		// Select Collection

		$collection = $db->Courses;

		$collection->update(array("course_name"=>$course), array('$push' => array("students" => $stud_email )));
		echo "<center><h4>Student added to List <br>";
/*		$cursor = $collection->find(array("course_name"=>$course), array("_id" => 0, "timing" => 1, "days" => 1));
		if($a = $cursor->getNext()){
			//echo $a['timing'];
			print_r($a['days']);
			echo "size of array is ";
			echo count($a['days']);
			echo "first days is ";
			echo $a['days'][0];
			echo "second day is ";
			echo $a['days'][1];
			$collection = $db->schedule;

			for($i=0 ; $i < count($a['days']); $i++)
			{	echo "inserting for ";
				echo $a['days'][$i];
 				$collection->update(array("name"=>$student_name), array('$push' => array($a['days'][$i] => array($a['timing'], $course))));
				//print_r($d);
			}
			print_r($a);
		}*/
		$collection = $db->Users;
		echo "Updating your schedule<br>";
		$collection->update(array("userid" => $stud_email), array('$push' => array("courses" => $course)));
		echo "Registered in Course succesful</h4></center>";
		/*echo $cursor['timing'];
		echo "is timing";
		echo $cursor['days'];
		echo "are days";*/

	header('refresh:1;url=basic-views.php');
	}
}
else
{
echo("Don't act smart, my bwoy!");
header('Location: index.php');
exit;
}?>
