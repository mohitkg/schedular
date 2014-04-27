<?php
    include('includes/head.php');
    session_start();
	include('includes/functions.php');
	if(loggedIn()){
	$usr_email = $_SESSION['userid'];
	redirecting($usr_email);
	}
?>
<p><br><br><br></p>
    <div id="left">
    <div id="content">
   		<center>     <h3 id="assignText">  Sign Up </h3> <br>	</center>
	 </div>
     <center>
	<div id="form1">

	<form action='signin.php' method='POST'>
        <table>
            <tr>
                <td>Name:</td>
                <td><input type='text' name='name' class="span3" placeholder="Name"></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><input type='text' name='userid' class="span3" placeholder="Email"></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input type='password' name='password1' class="span3" placeholder="Password"></td>
            </tr>
		  <tr>
                <td>Re-Password:</td>
                <td> <input type='password' name='re_password1' class="span3" placeholder="Re_Password"></td>
            </tr>
		  <tr>
          <td></td>
            <td> <input type="radio" name="occup" value="instructor">Instructor</td>
            <td><input type="radio" name="occup" value="student">Student</td>
            </tr>
        </table>

                <button type="submit" name = "submit" class="btn">Sign up</button>

            </form>

	</center>
    </div>
    </div>


    <div id="form">

	<div>
   		<center >     <h3 id="assignText">  Login Here </h3> <br> 	</center>
	 </div>
              <center>
                <form action='loginCheck.php' method='POST'>
                <table>
                    <tr>
                        <td>Your Email:</td>
                        <td><input type='text' name='userid' class="span3" placeholder="Email"></td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td><input type='password' name='password' class="span3" placeholder="Password"></td>
                    </tr>
                </table>
               <button class="btn btn-primary" type="submit" name="submit" class="btn">Log in</button>
               <!--  <center>   <a href = "change_pwd.php"> Or change password </a> </center>-->

            </form>
         </center>
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
