<?php
session_start();
?>


<!DOCTYPE html> 
<html lang="ro"> 
<head> 
<meta charset="utf-8">
<link rel="stylesheet" href="Style.css" type="text/css" />

<title>Inregistrare</title>

 </head>


   <body id="fond">
   <form action="Login.php" method="POST" >
    <div id="meniu">
     <div></div>
    <div> <a href = "Inregistrare.html">Inregistrare</a></div>
	<div> <a href = "Login.html">Login</a></div>
	<div> <a href = "Forum.php">Forum</a></div>
 </div>
 <br/><br/><br/>
 <div style="float:left;background-image: url(Images/forum.png); width:300px;height:300px;margin-left:80px"></div>
 
 <br/><br/><br/><br/><br/><br/><br/>
 <div style="float:left; margin-left:80px">
   <h2>Username : <input size="20" type="text" name="Username" style="height:30px"></h2>
   <h2>Parola :  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="password" name="Parola" style="height:30px"></h2>    
   <input type="submit" name="sub" value="Login" style=" width:80px ;height:40px;background-color:#0099CC; margin-left:124px">
  </div>
 </form>
 </body>
 </head>
 </html>
 
  <?php

$user = $_SESSION["username"];
	if( $user != "")
	{   
	
	   echo "<script>window.location = 'Forum.php';</script>";
	  
      // header("Location: http://localhost/Forum/Forum.php");
      /// die(); 
	  
    }
	
?>