<?php


session_start();
include('includes/functions.php');


if(loggedIn() && $_SESSION['userType']=='instructor'){
  include('includes/dashboardInstructor.php');
  $inst_email = $_SESSION['userid'];
  $instructor = User_Name($inst_email);
  echo '<div id="extraClassForm"><center>
  <h3>Add an Extra Class</h3>
  <form action="extraclass.php" method="POST">';

  echo '<table>
  <tr><td>Course:</td>';
  $con = new MongoClient();
  if($con){
      $db = $con->acadScheduler;
      $col = $db->Users;
      $cursor = $col->find(array("userid"=>$inst_email), (array("_id" => 0, "courses" => 1)));
      //$cursor = $col->find();

      //echo "size ";
      //echo $cursor->count();
      //echo iterator_to_array($cursor);

      echo "<td><select name='course_num' value='course_num'>course";
      if($document = $cursor->getNext()) {
        $course_list = $document["courses"];
        $n = count($course_list);
        for($i = 0; $i < $n; $i++){
        echo "<option value=".$course_list[$i].">".$course_list[$i]."</option>";
      }
      }
  }
  echo "</select></td></tr>";
  echo '<tr><td>
  Date:</td>
  <td><input type="text" name="date" id="datepicker2"></td></tr>
  <script>
    $(function() {
      $( "#datepicker2" ).datepicker({
        dateFormat: "yy-mm-dd"
      });
    });
  </script>

  <tr><td>Timing:</td>
  <td><select name="timing">
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
  </select></td></tr></table></center>
  <center><button class="btn btn-primary" name="submit" type="submit">ExtraClass</button>
  </center></form></div>
  ';
}
else
{
echo("Don't act smart, my bwoy!");
header('Location: index.php');
exit;
}
?>
