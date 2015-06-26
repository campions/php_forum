
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
	<div> <a href = "AdaugaSubiect.php">Administrare Subiecte </a></div>
 </div>
 </br></br>
 <div style="float:left;height: 500px;width:600px;margin-left:40px;background-image:url(Images/FondDomenii.png)">
 <form method="Post" action ="" >
 <div style="margin-left : 50px">
 <h3>Adauga Un Domeniu</h3>
 </br></br>
  Nume Domeniu : <input type="text" name="NumeDomeniu">
  </br></br>
  <input type="submit" value="Adauga">
  </div>
  </form>
  </div>
 
   <div style="margin-left : 50px">
  <?php
     $con=mysqli_connect("localhost","root","lab223","test");
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
else
{ 
echo ' <div style="float:left;margin-left:40px;height: 500px;width:600px;background-image:url(Images/FondDomenii.png)">';
echo '<h3>&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp Sterge Un Domeniu </h3>
</br></br>';

  echo '<form action="" method="Post" >';
  $sql = "SELECT * from Domeniu";
  $result = $con->query($sql);
  if ($result->num_rows > 0)
   {  
      echo '&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp&nbsp<select name="Domenii" MULTIPLE size="7" style="min-width:200px">';
      
      while($row = $result->fetch_assoc())
	  {
        echo '<option>'.$row["Nume_Domeniu"].'</option>';	 
	  }
	  echo '</select>';
	 
	  echo '</br></br>';
	  echo '&nbsp;&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp;&nbsp<input type="submit"  value = "Sterge">';
	  
	  echo '</form>';
	  echo '</div>';
    }
}
  ?>
  </div>
 </body>
</html>
<?php 
//Adauga Domeniul
if($_POST["NumeDomeniu"]!="")
{
    $con=mysqli_connect("localhost","root","lab223","test");
 
 if (mysqli_connect_errno()) {
     echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
	else
	{  
	   
	   $sql = "Insert into Domeniu (Nume_Domeniu) values ('".$_POST["NumeDomeniu"]."')";
       $result = $con->query($sql);
      echo "<script>window.location = 'Forum.php';</script>";
	}
}

//Sterge Domeniul
if( isset($_POST['Domenii']) ){ 
    echo $_POST["Domenii"];
	$sql = "Select * from subiect where Nume_Domeniu = '".$_POST["Domenii"]."'";
	
	$result = $con->query($sql);
    if ($result->num_rows > 0)
    {  
	   while($row = $result->fetch_assoc())
	   {
         $row["Id_Subiect"];
		 $sql2 = "delete from replies where Id_Subiect = ".$row["Id_Subiect"];
		 mysqli_query($con,$sql2);
       }
	}
	$StergeSubiect = "delete from Subiect where Nume_Domeniu = '".$_POST["Domenii"]."'";
	mysqli_query($con,$StergeSubiect);
	echo $StergeSubiect;
	
	$StergeDomeniu = "delete from domeniu where Nume_Domeniu = '".$_POST["Domenii"]."'";
	mysqli_query($con,$StergeDomeniu);
	echo $StergeDomeniu;
	echo "<script>window.location = 'Administrare.php';</script>";
}
?>