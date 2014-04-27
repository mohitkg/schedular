<?php


	session_start();
	include('includes/functions.php');


if(loggedIn() && $_SESSION['userType']=='instructor'){
	include('includes/dashboardInstructor.php');
	$inst_email = $_SESSION['userid'];
	$instructor = User_Name($inst_email);


//echo "</br>Your Name : " . $instructor .'</br>'.' email-id : '. $inst_email .'</br></br>';
// Configuration
/*$dbhost = 'localhost';
$dbname = 'test';

// Connect to test database
$m = new Mongo("mongodb://$dbhost");
$db = $m->$dbname;

// Get the users collection
$c_users = $db->users;*/



}
else
{
echo("Don't act smart, my bwoy!");
header('Location: index.php');
exit;
}


?>
