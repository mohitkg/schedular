<?php


  session_start();
  include('includes/functions.php');


if( loggedIn() ){
  if($_SESSION['userType']=='instructor')
    include('includes/dashboardInstructor.php');
  else
    include('includes/dashboardStudent.php');

  $inst_email = $_SESSION['userid'];
  $instructor = User_Name($inst_email);
  echo '
  <br><center>
  <h3>Create a Non-academic Event</h3>
  <form action="nonAcademic.php" method="POST">
  <table>
  <tr><td>
  Title:</td>
  <td><input type="text" id="title" name="title" /></td></tr>
  <tr><td>
  Date:</td>
  <td><input type="text" name="date" id="datepicker"></td></tr>
  <script>
    $(function() {
      $( "#datepicker" ).datepicker({
        dateFormat: "yy-mm-dd"
      });
    });
  </script>
  <tr><td>
  Start Timing:</td>
  <td><select name="timing1">
    <option value="8">8</option>
    <option value="9">9</option>
    <option value="10">10</option>
    <option value="11">11</option>
    <option value="12">12</option>
    <option value="13">13</option>
    <option value="14">14</option>
    <option value="15">15</option>
    <option value="16">16</option>
    <option value="17">17</option>
  </select></td></tr>
  <tr><td>End Timing:</td>
  <td><select name="timing2">
    <option value="8">8</option>
    <option value="9">9</option>
    <option value="10">10</option>
    <option value="11">11</option>
    <option value="12">12</option>
    <option value="13">13</option>
    <option value="14">14</option>
    <option value="15">15</option>
    <option value="16">16</option>
    <option value="17">17</option>
    <option value="18">18</option>
    </select></td></tr>
  <tr><td>Location :</td>
  <td><input type="text" id="location" name="location"/></td></tr></table>
  <button class="btn btn-primary" name="submit" type="submit">Add Event</button>
  </form></center>
  </body>

  </html>
  ';
}
else
{
echo("Don't act smart, my bwoy!");
header('Location: index.php');
exit;
}


?>
