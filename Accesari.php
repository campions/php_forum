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
   $sql = "SELECT * from Domeniu";
  $result = $con->query($sql);
  if ($result->num_rows > 0)
   {  
      echo '<table style="width:20%;margin-left:20px;background-image:url(Images/FondDomenii.png);border: 1px solid black">';
      echo '<tr style="height:35px">';
      echo '<td style="border:1px solid black">Domeniu</td>'; 
      echo '<td style="border:1px solid black">Numar de Accesari</td>'; 
	  echo '</tr>';	  
      while($row = $result->fetch_assoc())
	  { 
	    echo '<tr>';
	    echo '<td style="border:1px solid black">';
        echo '<a href="AccesariDomeniu.php?Domeniu='.$row["Dom_id"].'">'.$row["Nume_Domeniu"].'</a>';
		echo '</td>';
        $NrAccesariCommand = "select sum(s.NumarAccesari)
                        from Domeniu d
                        join subiect s
                        on d.dom_id = s.dom_id
                        where d.dom_id =".$row["Dom_id"];						
        $NrAccesari = $con->query($NrAccesariCommand);
        $row = $NrAccesari->fetch_assoc();
        echo '<td style="border:1px solid black">';		
		echo $row["sum(s.NumarAccesari)"];
		echo '</td>';
		echo '</tr>';		
	  }
echo '</table>';	  
   }
}