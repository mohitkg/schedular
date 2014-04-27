<?php
session_start();
include('includes/functions.php');
if(isset($_POST['submitForm']) && $_SESSION['userType']=='instructor' && loggedIn()){


	include('includes/dashboardInstructor.php');
	$inst_email = $_SESSION['userid'];
	$instructor = User_Name($inst_email);
//	echo $instructor ;
	$course = $_POST['course_num'];
	$timing = explode('-', $_POST['timing'])[0];
	$days = $_POST['days'];
	$error = array();
	if(empty($course)){

	$error[] = "Enter your course name </br>";
	}
	if(empty($days)){

	$error[] = "Please select date </br>";
	}


	if(count($error)==0){
		$n = count($days);

	$con = new MongoClient();
	//	echo "Connection to database successfully";
		if($con){
		// Select Database
		$db = $con->acadScheduler;
		$student = [];
		// Select Collection
		$collection = $db->Courses;
		// check if the course is already there
		$cursor1 = $collection->findOne(array("course_name" => $course));
		if($cursor1 == null){
			$insert = array("instructor_name" => $instructor, "instructor_id" => $inst_email, "course_name" => $course, "timing" => $timing, "days" => $days, "	students" => $student);
			$collection ->insert($insert);
			echo "<center><h4>Course to be created: ".$course." at ".$timing."00 hrs on ";
			for($i=0; $i < $n; $i++){
				echo $days[$i];
			}
			echo "</h4><br>";
		//update Users database : add course to the instructor's course list
			$collection = $db->Users;
			echo "Updating Instructor Schedule<br>";
			$collection->update(array("userid" => $inst_email), array('$push' => array("courses" => $course)));
			echo "Course added succesfully";

/*		$collection = $db->schedule;
		echo "schedule of instructor is updating<br>";
		for($i=0 ; $i < count($days); $i++)
		{
		//	echo $a['days'][$i];
		$collection->update(array("name"=>$instructor), array('$push' => array($days[$i] => array($timing, $course))));
			//print_r($d);
		}*/
//			print_r($a);
		//echo "schedule of instructor has updated </br>    ";

		}
		else{
			echo '<center><h5>The course is already taken</h5></center>';
		}


		//

		header('refresh:2;url=addcourseForm.php');
	/*$qry = array("user" => $usr_email,"password" => md5($usr_password));

	$result = $people->findOne($qry);
	if($result){
	$success = "You are successully loggedIn";
	// Rest of code up to you....
	}*/
	}
	 else {
		echo "error";
	die("Mongo DB not installed");
	}
	}
	else{
		echo $error[0];
		header('refresh:4;url=instructor.php');
		exit;
	}
}
else{
	die("Don't act smart, my bwoy!");
}



?>
