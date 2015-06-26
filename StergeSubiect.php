<?php
session_start();


?>


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
	<div> <a href = "LoginPahe.php">Login</a></div>
	<div> <a href = "Forum.php">Forum</a></div>
	<div> <a href = "AdaugaSubiect.php">Adauga subiect nou </a></div>
 </div>
 </br></br>
 </body>
</html >

 <?php
    
     $con=mysqli_connect("localhost","root","lab223","test");
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

else
{ 
  echo '<form action="" method="Post">';
  $sql = "SELECT * from Subiect where Dom_Id = ".$_REQUEST['Id'];
  $result = $con->query($sql);
  $ThisID = $_REQUEST['Id'];
  if ($result->num_rows > 0)
   {  
      echo '<select name="Subiecte" MULTIPLE size="7" style="min-width:200px">';
      
      while($row = $result->fetch_assoc())
	  {
        echo '<option>'.$row["Nume_Subiect"].'</option>';	 
	  }
	  echo '</select>';
	  echo '</br></br>';
	 
	  echo '</br></br>';
	  echo '<input type="submit"  name="sterge" value = "Sterge">';
	  echo '<input type="submit"  name="Replies" value = "Sterge Raspunsuri ">';
	  echo '</form>';
    }
}

if($_POST["Sterge"]!="") 
{  
    $SelectDom_ID = "select Dom_id from domeniu where Nume_Domeniu = '".$_POST["Domenii"]."'";
	$resultID = $con->query($SelectDom_ID);
	$row = $resultID->fetch_assoc();
	$DomID = $row["Dom_id"];
    echo "<script>window.location = 'StergeSubiect.php?Id=".$DomID."';</script>";
}

if($_POST["sterge"]!="") 
{  
    $sql = "Select * from subiect where Nume_Subiect = '".$_POST["Subiecte"]."'";	
	$result = $con->query($sql);
    if ($result->num_rows > 0)
    {  
	  $row = $result->fetch_assoc();	   
      
      $sql2 = "delete from replies where Id_Subiect = ".$row["Id_Subiect"];
	  echo $sql2;
	  mysqli_query($con,$sql2);
       
	}
	$StergeSubiect = "delete from Subiect where Nume_Subiect = '".$_POST["Subiecte"]."'";
	mysqli_query($con,$StergeSubiect);
	echo $StergeSubiect;
	echo "<script>window.location = 'AdaugaSubiect.php';</script>";
}
if($_POST["Replies"]!="") 
{  
    $sql = "Select * from subiect where Nume_Subiect = '".$_POST["Subiecte"]."'";	
	$result = $con->query($sql);
    $row = $result->fetch_assoc();	
	echo $row["Id_Subiect"];
    echo "<script>window.location = 'StergeRaspunsuri.php?Id=".$row["Id_Subiect"]."';</script>";
//	echo "<script>window.location = 'StergeSubiect.php?Id=".$DomID."';</script>";
}
  ?>
