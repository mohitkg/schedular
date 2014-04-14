
<?php
include_once("config.php");
if(isset($_POST['submit']))
{
$usr_name = $_POST['name'];
$usr_email = $_POST['userid'];
$usr_password = $_POST['password1'];
$usr_repassword = $_POST['re_password1'];
$usr_occup = $_POST['occup'];
$error = array();
// Email Validation
if(empty($usr_email) or !filter_var($usr_email,FILTER_VALIDATE_EMAIL) )
{
	$error[] = "Empty or invalid email address";
}
if(empty($usr_password)){

	$error[] = "Enter your password";
}
if(empty($usr_name)){

	$error[] = "Enter your Name";
}
if(empty($usr_repassword)){

	$error[] = "Re-Enter your password";
}
if(empty($usr_occup)){

	$error[] = "Occupation not selected";
}

if(!($_POST["password1"] == $_POST["re_password1"])){
	$error[] = "Password did not match";
}
if(count($error)==0)
{
//	include_once('config.php');
/*	
*/
	//echo "running";

	$query = $coll->findOne(array('userid' => $usr_email));
//	echo $query;
	if(empty($query)){
		newUser($usr_name,$usr_email, $usr_password,$usr_occup);
		cleanMemberSession($usr_email, $usr_password);
		header("Location: members.php");
		if($usr_occup == "student")
   		header("Location: student.php");
   		if($usr_occup == "instructor")
   		header("Location: instructor.php");
	}
	else {
	  echo '<p> Email already exists, please sign in with another email.</p>';
	echo '<p> Go back to <a href =  \' index.php \'> Register </a>';
	
	   }
	
}
else
{

//	include_once("config.php");
	echo "<br> <h3 >" . $error[0] . "</h3>";
	header('refresh:1;url=index.php');
}
}
/*
else
{
header ('Location :index.php');
}
*/
?>

