<?php 
    include('includes/head.php');
    session_start();
	include('includes/functions.php');
	if(loggedIn()){
	$usr_email = $_SESSION['userid'];
	$usr_password = $_SESSION['password'];
	redirecting($usr_email,$usr_password);
	}
?>
<p><br><br><br></p>
    <div id="content">
   		<center>     <h3 id="assignText">  Sign In Here </h3> <br>	</center>
	 </div> 
	<div id="form1">

	<form action='signin.php' method='POST'>
                Name  <input type='text' name='name' class="span3" placeholder="Name"><br>
                Email  <input type='text' name='userid' class="span3" placeholder="Email"><br>
                Password  <input type='password' name='password1' class="span3" placeholder="Password"><br>
		Re-Password  <input type='password' name='re_password1' class="span3" placeholder="Re_Password"><br>
		Occupation &nbsp  &nbsp <input type="radio" name="occup" value="instructor">Instructor<br>
		<div id = "occu_student" >	<input type="radio" name="occup" value="student">Student  </div> <br>
                <button type="submit" name = "submit" class="btn">Sign in</button>
            </form>
	
    	</div>

	</div>

	
    <div id="form">
	
	<div>
   		<center >     <h3 id="assignText">  Login Here </h3> <br> 	</center> 
	 </div> 	    
              <form action='loginCheck.php' method='POST'>
                Your Email  <input type='text' name='userid' class="span3" placeholder="Email"><br>
                Password  <input type='password' name='password' class="span3" placeholder="Password"><br>
               <button type="submit" name="submit" class="btn">Log in</button>
               <!--  <center>   <a href = "change_pwd.php"> Or change password </a> </center>
    -->        </form>
         
            <br>

            <?php
            /*if(isset($_SESSION['username']))
                echo "hello"; */
         /*   if( isset($_SESSION['username']) && isset($_COOKIE['username']) )
            {
                echo '
                    <a href="member.php">
                        <div class="btn-group">
                        <button class="btn" id="continueButton">You are already logged in! Continue</button>
                        </div>
                    </a><br>
                ';
            }
            else
            {
                echo '
                    <a href="member.php">
                        <div class="btn-group">
                        <button class="btn" id="continueButton">Continue without logging in!</button>
                        </div>
                    </a><br>  
                ';
            }
           */ ?>
<!--            <a href="register.php" id="register">    
                <div class="btn-group">
                    <button class="btn" id="registerButton">Register</button>
                </div><!--<span class="label label-success">Register</span>
-->
            </a><br>
            </center>
        </div>
</body>
</html>
