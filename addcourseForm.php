<?php


session_start();
include('includes/functions.php');


if(loggedIn() && $_SESSION['userType']=='instructor'){
  include('includes/dashboardInstructor.php');
  $inst_email = $_SESSION['userid'];
  $instructor = User_Name($inst_email);

  echo '<div id="addCourseForm">
  <center><h3>Add a New Course</h3>
  <form action="addcourse.php" method="POST">
  <table><tr><td>
  Course Number:</td>
  <td><input type="text" id="course_num" name="course_num"  /></td></tr>
  <tr><td>
  Timing:</td><td>
  <select name="timing">
    <option value="8-9">8-9</option>
    <option value="9-10">9-10</option>
    <option value="10-11">10-11</option>
    <option value="11-12">11-12</option>
    <option value="12-13">12-13</option>
    <option value="13-14">13-14</option>
    <option value="14-15">14-15</option>
    <option value="15-16">15-16</option>
    <option value="16-17">16-17</option>
    <option value="17-18">17-18</option>
  </select></td></tr></table>

  <input type="checkbox" name="days[]" value="Mon">Mon
  <input type="checkbox" name="days[]" value="Tue">Tue
  <input type="checkbox" name="days[]" value="Wed">Wed
  <input type="checkbox" name="days[]" value="Thu">Thu
  <input type="checkbox" name="days[]" value="Fri">Fri
  <br><br>
  <button class="btn btn-primary" name="submitForm" type="submit">Add</button>
  </form>
  </center>
  </div>
  ';
}
else
{
echo("Don't act smart, my bwoy!");
header('Location: index.php');
exit;
}
?>
