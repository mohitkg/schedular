<?php

if(isset($_POST) and $_POST['submitForm'] == "Add" ){
	session_start();
	include('includes/functions.php');
	$inst_email = $_SESSION['userid'];
	$instructor = User_Name($inst_email);
//	echo $instructor ; 
	$course = $_POST['course_num'];
	$timing = $_POST['timing'];
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

		echo $course . "on ". $timing. " days ";
	for($i=0; $i < $n; $i++){
		echo $days[$i]. " </br>" ;
	}
	$con = new MongoClient();
	//	echo "Connection to database successfully";
		if($con){
		// Select Database
		$db = $con->acadSchedular;
		$student = [];
		// Select Collection
		$collection = $db->Courses;
		// check if the course is already there
		$cursor1 = $collection->findOne(array("course_name" => $course));
		if($cursor1 == null){
			$insert = array("instructor_name" => $instructor, "instructor_id" => $inst_email, "course_name" => $course, "timing" => $timing, "days" => $days, "	students" => $student);
			$collection ->insert($insert);
			echo "course created";
		//update Users database : add course to the instructor's course list
			$collection = $db->Users;
			echo "schedule of instructor is updating";
			$collection->update(array("userid" => $inst_email), array('$push' => array("courses" => $course)));
			echo "course added succesfully";

/*		$collection = $db->schedule;
		echo "schedule of instructor is updating<br>";
		for($i=0 ; $i < count($days); $i++)
		{
		//	echo $a['days'][$i];
		$collection->update(array("name"=>$instructor), array('$push' => array($days[$i] => array($timing, $course))));
			//print_r($d);
		}*/
//			print_r($a);
		echo "schedule of instructor has updated </br>    ";

		}
		else{
			echo 'the course is being taken';
		}


		//

		header('refresh:2;url=instructor.php');
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
		header('refresh:2;url=instructor.php');
		exit;
	}
}




?>
