<?php 
//include ("includes/head.php");
?>
<?php
ob_start();
error_reporting(E_ALL);
try
{
 $m = new MongoClient();
  $db   = $m->acadScheduler;
//  $db   = $m->bookMyevent;
//  echo "<br>Connection to database successfully";
  $coll = $db->Users;
//  echo "<br> Database mydb selected";
}
catch (MongoConnectionException $e)
{
  die('<br>Error connecting to MongoDB server');
} 
catch (MongoException $e) {
  die('<br> Error: ' . $e->getMessage());
}

//echo "running";
include_once("includes/functions.php");
session_start();
$_SESSION['userid'] = Null;
$_SESSION['password'] =Null;
$_SESSION['loggedIn'] ;


?>
