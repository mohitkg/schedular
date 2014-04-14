<?php

session_start();
include('includes/functions.php');
if(loggedIn()){
	header ('Location : members.php');
}

if(isset($_POST["submit"]))
{
//echo "SahilSolanki\n";

$usr_email = $_POST['email'];
$usr_password = $_POST['password'];
$usr_newpassword = $_POST['new_password'];
$usr_occup = $_POST['occup'];
if(empty($usr_email) or !filter_var($usr_email,FILTER_VALIDATE_EMAIL) )
{
	$error[] = "Empty or invalid email address";
}
if(empty($usr_password)){

	$error[] = "Enter your Old password";
}
if(empty($usr_newpassword)){

	$error[] = " Enter your New password";
}
if(empty($usr_occup)){

	$error[] = "Occupation not selected";
}
//echo $error;

if(count($error)==0)
{
	include_once("config.php");
	if(!($row = checkPass($_POST["email"], $_POST["password"]))){
	    echo "<p>Incorrect login/password, try again</p>";
	    echo '<p> Go back to <a href =  \' index.php \'> Login again </a>';
	    exit;
	    }

global $coll;
if(	$coll-> update(array('email' => $email, 'password' => md5($password)),array('$set' => array( 'password' => md5($newpassword)))	)	)

{
echo "true" ;
cleanMemberSession($_POST["email"], $_POST["password"]);
    header("Location: members.php");
}
else
echo "false";
		    
//    update_pwd($usr_email, $usr_password,$usr_newpassword,$user_occup);	   	  
    
}
else
{
include_once("includes/head.php");
echo " <h3 >" . $error[0] . "</h3> <br>";

header('refresh:1;url=index.php');
}

}
?>
