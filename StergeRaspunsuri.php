<!DOCTYPE html> 
<html lang="ro"> 
<head> 
<meta charset="utf-8">
<link rel="stylesheet" href="Style.css" type="text/css" />

<title>Administrare</title>

 </head>
 <div id="meniu">
     <div></div>
    <div> <a href = "Inregistrare.html">Inregistrare</a></div>
	<div> <a href = "LoginPage.php">Login</a></div>
	<div> <a href = "Forum.php">Forum</a></div>
	<div> <a href = "AdaugaSubiect.php">Adauga subiect nou </a></div>
 </div>
 </br></br>
 </body>
</html >
<?php
$array = array();
$con=mysqli_connect("localhost","root","lab223","test");
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

else
{
   $ThisID = $_REQUEST['Id'];
   $sql = "Select * from replies where Id_Subiect =" .$ThisID;
   $result = $con->query($sql);
   
   while($row = $result->fetch_assoc())
	  { 
	    echo '<form action="" method="Post" name="sterge">';
        echo $row["Raspuns"];
		echo '</br>';
		echo '<input type="submit" value ="Sterge" name = "'.$row["Rep_id"].'" >';
		echo '</br></br></br></br>';
	    echo '</form>';
		echo "</br>";
		array_push($array, $row["Rep_id"]);

	  }
}
   $Length = sizeof($array);
   for($index = 0 ;$index < $Length;$index++)
   {
      if($_POST[$array[$index]] != "")
	  {
	    
		$DeleteRaspuns = "Delete from replies where Rep_id = ".$array[$index];
		mysqli_query($con,$DeleteRaspuns);
		echo "<script>window.location = 'StergeRaspunsuri.php?Id=".$ThisID."';</script>";
	  }
	  
   }
?>