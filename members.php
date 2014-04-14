<?php
include_once("config.php");

if(!loggedIn()):
header('Location: index.php');
endif;

print("<br> Welcome to the members page <b>".$_SESSION["userid"]."</b><br>\n");
print("Your password is: <b>".$_SESSION["password"]."</b><br>\n");
print("<a href=\"logout.php"."\">Logout</a>");
?>
