<?php
include('includes/dashboard.php');

	session_start();
	include('includes/functions.php');
	

if(loggedIn()){	
	$inst_email = $_SESSION['userid'];
	$instructor = User_Name($inst_email);

echo "</br>Your Name : " . $instructor .'</br>'.' email-id : '. $inst_email .'</br></br>'; 
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
<input type="checkbox" name="days[]" value="Mon">Mon
<input type="checkbox" name="days[]" value="Tue">Tue
<input type="checkbox" name="days[]" value="Wed">Wed
<input type="checkbox" name="days[]" value="Thu">Thu
<input type="checkbox" name="days[]" value="Fri">Fri
</br>
<input  name="submitForm" id="submitForm" type="submit" value="Add" />
</form>
';
echo '
<form action="extraclass.php" method="POST">';
echo 'Course';
$con = new MongoClient();
if($con){
    $db = $con->acadScheduler;
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
Date:
<input type="text" name="date" id="datepicker2">
<script>
  $(function() {
    $( "#datepicker2" ).datepicker({
      dateFormat: "yy-mm-dd"
    });
  });
</script>

Timing
<select name="timing">
  <option value="8-9">8-9</option>	
  <option value="9-10">9-10</option>
  <option value="10-11">10-11</option>
  <option value="11-12">11-12</option>
</select>
<button class="btn btn-primary" name="submit" type="submit">ExtraClass</button>
</form>
';
echo '
</br>
create an event
<form action="nonAcademic.php" method="POST">
Title:
<input type="text" id="title" name="title"  />
</br>
Date:
<input type="text" name="date" id="datepicker">
<script>
  $(function() {
    $( "#datepicker" ).datepicker({
      dateFormat: "yy-mm-dd"
    });
  });
</script>
<!-- Date</br>
DD<input type="text" id="course_num" name="date[]"/>
MM<input type="text" id="course_num" name="date[]"/>
YY<input type="text" id="course_num" name="date[]"/>
</br> -->
Timing start
<select name="timing1">
  <option value="8">8</option>  
  <option value="9">9</option>
  <option value="10">10</option>
  <option value="11">11</option>
  <option value="12">12</option>    
  <option value="1">13</option>
  <option value="2">14</option>
  <option value="3">15</option>
  <option value="4">16</option>
  <option value="5">17</option>

</select>
Timing end
<select name="timing2">
  <option value="8">8</option>  
  <option value="9">9</option>
  <option value="10">10</option>
  <option value="11">11</option>
  <option value="12">12</option>    
  <option value="1">13</option>
  <option value="2">14</option>
  <option value="3">15</option>
  <option value="4">16</option>
  <option value="5">17</option>

Location :  
<input type="text" id="location" name="location"/>
</br>
<button class="btn btn-primary" name="submit" type="submit">Add Event</button>
</form>     
</body>

</html>
';


}
else
{
header('Location: index.php');
exit;
}


?>
