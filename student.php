<?php
include('includes/dashboardStudent.php');
session_start();
  include('includes/functions.php');

if(loggedIn()){
  $stud_email = $_SESSION['userid'];
  $stud_name = User_Name($stud_email);

echo "</br>Your Name : " . $stud_name .'</br>'.' email-id : '. $stud_email .'</br></br>';
}
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
