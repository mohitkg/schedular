<?php
function redirecting($usr_email , $usr_password)
{
$m = new MongoClient();
  $db   = $m->acadScheduler;
  $coll = $db->Users;
$query = $coll->find(array('userid' => $usr_email, 'password'=>  md5($usr_password)));

$array = iterator_to_array($query);

foreach ($array as $value) {
	if($value['occupation'] == "student")
   		header("Location: student.php");
   	if($value['occupation'] == "instructor")
   		header("Location: instructor.php");
}
}
function newUser($name,$email, $password,$occup)
{
	global $coll;
	$coll->insert(array('name'=> $name,'userid' => $email, 'password' => md5($password),'occupation' => $occup, 'courses' => []));
	return true;
}
function update_pwd($email, $password,$newpwd,$occup)
{
	global $coll;
	$coll-> update(array('userid' => $email, 'password' => md5($password),'occupation' => $occup),array('$set' => array('userid' => $email, 'password' => md5($newpwd),'occupation' => $occup))	);

	return true;
}
function checkPass($email, $password)
{
	global $coll;
	$res = $coll->findOne(array('userid' => $email, 'password' => md5($password)));
	if($res):
	return true;
	endif;
}
function User_Name($email)
{
	$m = new MongoClient();
  	$db   = $m->acadScheduler;
  	$coll = $db->Users;
//global $coll;
//	echo $email;
	$res = $coll->find(array('userid' => $email));

	$array = iterator_to_array($res);

	foreach ($array as $value) {
		return $value['name'];

}

}

function cleanMemberSession($email, $userType)
{

	$_SESSION["userid"]= $email;
	$_SESSION["userType"]=$userType;
	$_SESSION["loggedIn"]=true;
}

function flushMemberSession()
{
	unset($_SESSION["userid"]);
	unset($_SESSION["password"]);
	unset($_SESSION["loggedIn"]);
	session_destroy();
	return true;
}

function loggedIn()
{
	if(isset($_SESSION['loggedIn'])):
	  return true;
	else:
	  return false;
	endif;
}
?>
