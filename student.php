<html>
<body>

<?php 
include('includes/dashboard.php');
session_start();
  include('includes/functions.php');
  
if(loggedIn()){ 
  $stud_email = $_SESSION['userid'];
  $stud_name = User_Name($stud_email);
  
echo "</br>Your Name : " . $stud_name .'</br>'.' email-id : '. $stud_email .'</br></br>';
}
echo 'Add a course </br> ';
$con = new MongoClient();
if($con){
    $db = $con->acadScheduler;
    $col_user = $db->Users;
    $cursor = $col_user->find(array("userid" => $stud_email), array("_id" => 0, "courses" => 1));
    $my_courses = $cursor->getNext();
    $my_courses_list = $my_courses["courses"];
/*    if(in_array("eso201", $my_courses_list) == false){
      echo 'ho gya';
    }
    else{
      echo 'nhi hua';
    }*/
//    $my_courses_list = iterator_to_array($my_courses);
//    print_r($my_courses);
//    print_r($my_courses_list);

    $col = $db->Courses;
    $cursor = $col->find(array("course_name"=>array('$ne'=>null)), (array("_id" => 0, "course_name" => 1)));
    //$cursor = $col->find(); 

    //echo "size ";
    //echo $cursor->count();
    //echo iterator_to_array($cursor);

    echo '<form action="addcourse_student.php" method="POST">';
    echo "<select name='course_num' value='course_num'>course"; 
    while($r = $cursor->getNext()) {
       if(in_array($r['course_name'], $my_courses_list) == false){
      //echo "jai mata di";
          echo "<option value=".$r['course_name'].">".$r['course_name']."</option>"; 
        }
    }
    echo "</select>";
    echo '<input  name="submitForm" id="submitForm" type="submit" value="Add" />
          </form>';
/*    echo '<form action="addcourse_student.php" method="POST">';
    echo "<select name='dropdown' value='course_num' id='course_num'>course"; 
    echo "<option value='sexy'>sexy</option>";
    echo "<option value='sexy2'>sexy2</option>";
    echo "</select>";
    echo '<input  name="submitForm" id="submitForm" type="submit" value="Add" />
          </form>';
*/
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
else echo "dfdf";
?>

