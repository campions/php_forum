<?php
session_start();



 $con=mysqli_connect("localhost","root","lab223","test");
 if (mysqli_connect_errno()) {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
 }

$sql = "SELECT * from Users where Username = '" .$_POST['Username']."'and Parola = '".$_POST['Parola']."'";
$result = $con->query($sql);

if ($result->num_rows > 0) {
      
	  $user =  $_POST['Username'];
	  $_SESSION["username"] = $user;
	  
	  $row = $result->fetch_assoc();
	 // $row = mysql_fetch_assoc($result);
	  $_SESSION["id"] = $row["id"];
	  //$UpdateStat = "Update statistici set Data = '".date('Y-m-d H:i:s')."' where id = ".$row["id"];
	  $AddStatistici = "insert into statistici(nume,Data,Ip) values ('".$user."','".date('Y-m-d H:i:s')."','".$_SERVER['REMOTE_ADDR']."')";

	   mysqli_query($con,$AddStatistici);
      $con->close();
  header("Location: http://localhost/Forum/Forum.php");
  die();
    }
 else {
    echo "0 results";
	$con->close();
}

?>