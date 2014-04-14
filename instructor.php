<?php
//include('includes/dashboard.php');

	session_start();
	include('includes/functions.php');
	

if(loggedIn()){	
	$inst_email = $_SESSION['userid'];
	$instructor = User_Name($inst_email);

echo "</br>Your Name : " . $instructor .'</br>'.' email-id : '. $inst_email .'</br></br>';
 echo '<a href = "logout.php"> Logout </br></a>'; 
// Configuration
/*$dbhost = 'localhost';
$dbname = 'test';

// Connect to test database
$m = new Mongo("mongodb://$dbhost");
$db = $m->$dbname;

// Get the users collection
$c_users = $db->users;*/
echo '
<form action="addcourse.php" method="POST">
Course Number:
<input type="text" id="course_num" name="course_num"  />
</br>
Timing
<select name="timing">
  <option value="8-9">8-9</option>	
  <option value="9-10">9-10</option>
  <option value="10-11">10-11</option>
  <option value="11-12">11-12</option>
</select>
</br>
<input type="checkbox" name="days[]" value="M">M
<input type="checkbox" name="days[]" value="T">T
<input type="checkbox" name="days[]" value="W">W
<input type="checkbox" name="days[]" value="Th">Th
<input type="checkbox" name="days[]" value="F">F
</br>
<input  name="submitForm" id="submitForm" type="submit" value="Add" />
</form>
';
echo '
<form action="extraclass.php" method="POST">';
echo 'Course';
$con = new MongoClient();
if($con){
    $db = $con->acadSchedular;
    $col = $db->Users;
    $cursor = $col->find(array("userid"=>$inst_email), (array("_id" => 0, "courses" => 1)));
    //$cursor = $col->find(); 

    //echo "size ";
    //echo $cursor->count();
    //echo iterator_to_array($cursor);

    echo "<select name='course_num' value='course_num'>course"; 
    if($document = $cursor->getNext()) {
      $course_list = $document["courses"];
      $n = count($course_list);
      for($i = 0; $i < $n; $i++){
      echo "<option value=".$course_list[$i].">".$course_list[$i]."</option>"; 
    }
    }
}
    echo "</select>";
echo '
<input type="text" id="course_num" name="date[]">DD</input>
<input type="text" id="course_num" name="date[]">MM</input>
<input type="text" id="course_num" name="date[]">YY</input>
Timing
<select name="timing">
  <option value="8-9">8-9</option>	
  <option value="9-10">9-10</option>
  <option value="10-11">10-11</option>
  <option value="11-12">11-12</option>
</select>
<input  name="submitForm" id="submitForm" type="submit" value="ExtraClass" />
</form>
';
}
else
{
header('Location: index.php');
exit;
}


?>
