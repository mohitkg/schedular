<?php
session_start();
include('includes/dashboardStudent.php');

  include('includes/functions.php');

if(loggedIn()){
  $stud_email = $_SESSION['userid'];
  $stud_name = User_Name($stud_email);

  echo '<center><h3>Join a new Course</h3>';
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
      echo "</select><br>";
      echo '<button class="btn btn-primary" name="submitForm" type="submit">Add Course</button>
      </center>';
}
else
{
  echo 'db error';
}
}
else
{
echo("Don't act smart, my bwoy!");
header('Location: index.php');
exit;
}
?>
