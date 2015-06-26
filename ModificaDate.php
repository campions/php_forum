<?php
session_start();
?>

<?php
$uid =  $_SESSION["id"];
if($uid == "")
   echo "<script>window.location = 'Forum.php';</script>";
$Username;
$Nume;
$Prenume;
$Email;
$Data;
$Parola;
$Conf;

$con=mysqli_connect("localhost","root","lab223","test");
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
else
{ 
   $sql = "Select * from users where id = ".$uid;   
   $result = $con->query($sql);
  if ($result->num_rows > 0) 
   {
     $row = $result->fetch_assoc();
	 $Username = $row["Username"];
	 $Nume = $row["Nume"];
     $Prenume = $row["Prenume"] ;
     $Email = $row["email"];
     $Data = $row["DataNasterii"];
     $Parola = $row["Parola"];
	 $Conf = $Parola;
   }
}


?>

<!DOCTYPE html> 
<html lang="ro" > 
<head> 
<meta charset="utf-8">
<link rel="stylesheet" href="Style.css" type="text/css" />

<title>Inregistrare</title>
 </head>
   <body id="fond">
   <form  action="Update.php" method="POST" >
    <div id="meniu">
     <div></div>
    <div> <a href = "Inregistrare.html">Inregistrare</a></div>
	<div> <a href = "LoginPage.php">Login</a></div>
	<div> <a href = "Forum.php">Forum</a></div>
 </div>
 <br/>
     <table border="1" style="width:53%;margin-left:150px;margin-top:60px">
	  <tr>
	     <td>Username</td>
		 <td><input size="100" type="text"  value=<?php echo $Username ?> name="Username" required="true"></td>
	 </tr>
	 <tr>
		<td>Parola</td>
		<td><input type="password"  value=<?php echo $Parola ?> name="Parola" required="true"></td>
	 </tr>
	 <tr>
		<td>Confirma</td>
		<td><input type="password" name="Confirma"  value=<?php echo $Conf ?> required="true"></td>
		
	 </tr>
	 <tr>
	     <td>Nume</td>
		 <td><input type="text" name="Nume"  value=<?php echo $Nume ?> required="true"></td>
	 </tr>
	 <tr>
		<td>Prenume</td>
		<td><input type="text" name="Prenume"  value=<?php echo $Prenume ?> required="true"></td>
	 </tr>
	 <tr>
		<td>Email</td>
		<td><input type="text" name="Email"  value=<?php echo $Email ?> required="true"></td>
	 </tr>
	
    </table>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="submit" name="sub" value="Modifica" style="width:90px ;margin-top:30px;height:40px;background-color:#CCCCFF; margin-left:124px">
	</form>
	
   </body>
 </html>