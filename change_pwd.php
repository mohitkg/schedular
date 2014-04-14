<?php 
    include('includes/head.php');
    
include('includes/functions.php');
	if(loggedIn()){
	header('Location: members.php');
	}
?>    
 <div id="content">
   		<center>     <h3 id="assignText">  Change Password </h3> <br>	
</center>	 </div> 
	<div id="form1">

	<form action='change_passwd.php' method='POST'>
                Email  <input type='text' name='email' class="span3" placeholder="Email"><br>
                Password  <input type='password' name='password' class="span3" placeholder="Password"><br>
		New Password  <input type='password' name='new_password' class="span3" placeholder="New_Password"><br>
		Occupation &nbsp  &nbsp <input type="radio" name="occup" value="instructor">Instructor<br>
		<div id = "occu_student" >	<input type="radio" name="occup" value="student">Student  </div> <br>
                <button type="submit" name = "submit" class="btn">Change Password</button>
            </form>
	
    	</div>
    	
	</div>
	<div>
	
</body>
</html>	
