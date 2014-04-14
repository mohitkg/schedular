<?php
include_once("includes/head.php");
session_start();
include('includes/functions.php');
if(loggedIn()){
$usr_email = $_SESSION['userid'];
$usr_password = $_SESSION['password'];
redirecting($usr_email,$usr_password);
//echo $usr_email . $usr_password;
}

if(isset($_POST["submit"]))
{
//echo "SahilSolanki\n";

$usr_email = $_POST['userid'];
$usr_password = $_POST['password'];

if(empty($usr_email) or !filter_var($usr_email,FILTER_VALIDATE_EMAIL) )
{
	$error[] = "Empty or invalid email address";
}
if(empty($usr_password)){

	$error[] = "Enter your password";
}

//echo $error;

if(count($error)==0)
{
	include_once("config.php");
	if(!($row = checkPass($_POST["userid"], $_POST["password"]))){
	    echo "<p>Incorrect login/password, try again</p>";
	    echo '<p> Go back to <a href =  \' index.php \'> Login again </a>';
	    exit;
	    }


$query = $coll->find(array('userid' => $usr_email, 'password'=>  md5($usr_password)));
$array = iterator_to_array($query);

foreach ($array as $value) {
	if($value['occupation'] == "student"){
  	cleanMemberSession($_POST["userid"], $value['occupation']);
		header("Location: basic-views.php");
	}
  if($value['occupation'] == "instructor"){
  	cleanMemberSession($_POST["userid"], $value['occupation']);
		header("Location: basic-views.php");
	}
}	/*
if(  $value['occupation']== "student")


   else if($value['occupation']== "instructor")
	header("Location: instructor.php");
	*/
//	echo $query['email'];


	//echo $res["occupation"];
//    header("Location: members.php");
}
else
{

echo " <h3 >" . $error[0] . "</h3> <br>";

header('refresh:4;url=index.php');
}

}
/*
else
{
header ('Location : index.php');
exit;
}
*/
?>

<?php
?>
