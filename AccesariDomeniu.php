<!DOCTYPE html> 
<html lang="ro"> 
<head> 
<meta charset="utf-8">
<link rel="stylesheet" href="Style.css" type="text/css" />

<title>Administrare</title>

 </head>
 <body style="background-image:url(Images/Fond3.jpg);background-size:100% 100%">
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
  $sql = "SELECT * from Subiect where  Dom_id = ".$_REQUEST['Domeniu'];
  $result = $con->query($sql);
  if ($result->num_rows > 0)
   {  
      echo '<table style="width:20%;margin-left:20px;background-image:url(Images/FondDomenii.png);border: 1px solid black">';
      echo '<tr tr style="height:35px">';
      echo '<td style="border:1px solid black">Subiect</td>'; 
      echo '<td style="border:1px solid black">Numar de Accesari</td>'; 
	  echo '</tr>';
      while($row = $result->fetch_assoc())
	  { 
	    echo '<tr>';
	    echo '<td style="border:1px solid black">';
        echo $row["Nume_Subiect"];
		echo '</td>';        
        echo '<td style="border:1px solid black">';		
		echo $row["NumarAccesari"];
		echo '</td>';
		echo '</tr>';		
	  }
echo '</table>';	  
   }
}