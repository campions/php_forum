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
	<div> <a href = "AdaugaSubiect.php">Administrare Subiecte</a></div>
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
  echo '<div style="margin-left:100px"><form action="" method="Post">';
  $sql = "SELECT * from Domeniu";
  $result = $con->query($sql);
  if ($result->num_rows > 0)
   {  
      echo '<table style="width:90%;margin-left:20px;background-image:url(Images/FondDomenii.png);border: 1px solid black">';
	  echo '<tr><td colspan="2" style="border:1px solid black">';
      echo 'Alege un Domeniu  <select name="Domenii"  style="min-width:200px">';     
      while($row = $result->fetch_assoc())
	  {
        echo '<option>'.$row["Nume_Domeniu"].'</option>';	 
	  }
	
	  echo '</select>';
	  echo '</td></tr>';
	  echo '</br></br></br></br>';
	  echo '<tr><td style="border:1px solid black">';
	  echo '</br></br>';
	  echo 'Subiect Nou';
	  echo '<input type="text" name ="Subiect" style="min-width:10px">'; 
	  echo '<input type="submit"  name ="Add" value = "Adauga" style="margin-left:20px">';
	  echo '</td>';
	  echo '<td style="border:1px solid black">';
	  echo '</br></br>';
	  echo '<input type="submit"  name ="Sterge" value = "Sterge Un Subiect" style="margin-left:20px">';
	  echo '</td></tr>';
	  echo '</table>';
	  echo '</form></div>';
    }
}

if($_POST["Add"]!="") { 
    $SelectDom_ID = "select Dom_id from domeniu where Nume_Domeniu = '".$_POST["Domenii"]."'";
	$resultID = $con->query($SelectDom_ID);
	$row = $resultID->fetch_assoc();
	$DomID = $row["Dom_id"];
	//echo $DomID;
    $sql = "insert into subiect (Nume_Subiect,Dom_id,Nume_Domeniu) values('".$_POST["Subiect"]."',".$DomID.",'".$_POST["Domenii"]."')";
	//select * from domeniu d join subiect s on d.Dom_id = s.Dom_id where d.Nume_domeniu = 'Masini'
	//echo $_POST["Domenii"];
	//echo $sql;
	//echo $SelectDom_ID;
	mysqli_query($con,$sql);
	echo "<script>window.location = 'AdaugaSubiect.php';</script>";
	
}
if($_POST["Sterge"]!="") 
{  
    $SelectDom_ID = "select Dom_id from domeniu where Nume_Domeniu = '".$_POST["Domenii"]."'";
	$resultID = $con->query($SelectDom_ID);
	$row = $resultID->fetch_assoc();
	$DomID = $row["Dom_id"];
    echo "<script>window.location = 'StergeSubiect.php?Id=".$DomID."';</script>";
}
?>