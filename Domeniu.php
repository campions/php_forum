<?php
session_start();


?>

<!DOCTYPE html> 
<html lang="ro"> 
<head> 
<meta charset="utf-8">
<link rel="stylesheet" href="Style.css" type="text/css" />

<script type='text/javascript'>
function test()
 {
   var menu =  document.getElementById('meniu');
   var newDiv = document.createElement('div');
   var node = document.createTextNode("Administrare");   
   var a = document.createElement('a');
   a.setAttribute("href", "Administrare.php");
    a.appendChild(node);
   newDiv.appendChild(a);
  
   menu.appendChild(newDiv);
 }
</script>
<title>Forum</title>
 </head>
 <div id="meniu">
     <div></div>
    <div> <a href = "Inregistrare.html">Inregistrare</a></div>
	<div> <a href = "LoginPage.php">Login</a></div>
	<div> <a href = "Forum.php">Forum</a></div>
 </div>
 
 <?php
 $IsAdmin = 0;
 $con=mysqli_connect("localhost","root","lab223","test");
 
 if (mysqli_connect_errno()) {
     echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    else
   {
     $uid =  $_SESSION["id"];  
     $sql = "SELECT * from Users where id = " .$uid ." and DrepturiAdmin = 1";
     $result = $con->query($sql);
     if ($result->num_rows > 0) 
     {
       //e admin
	   $message = "wrong answer";
       echo "<script type='text/javascript'>test();</script>";
	   $IsAdmin = 1;
     }
	$user = $_SESSION["username"];
	if( $user != "")
	{
       echo "Hello ";
       echo $user; 
    }
  }
  
  $NrAccesariCommand = "SELECT * from Subiect where Id_Subiect =" .$_REQUEST['SubId']; 
  $NrAccesari = $con->query($NrAccesariCommand); 
  $row = $NrAccesari->fetch_assoc();
  $DomeniuID = $row["Dom_id"];  
  $val =  $row["NumarAccesari"] + 1 ;
  $IncrNrAccesari = "Update subiect set NumarAccesari = ".$val." where Id_Subiect=".$_REQUEST['SubId']; 
  mysqli_query($con,$IncrNrAccesari);
  
  
 
  
  
  $sql = "SELECT * from replies where Id_Subiect = '".$_REQUEST['SubId']."'";
  $result = $con->query($sql);
  if ($result->num_rows > 0)
  {  
     echo"</br></br>";
	 if(!isset($_REQUEST['actiune'])){ 
     while($row = $result->fetch_assoc())
	 {
       echo '<div style="min-height: 200px;margin-left:40px;margin-right:30px;background-image:url(Images/FondDomenii.png)">';
       echo '<table>';
	   echo '<tr>';
	   echo '<td style="width:150px;border-right:1px solid white;border-bottom:1px solid white;">';
	   $UserNameSelect ="Select * from Users where Id =" .$row["User_Id"];
	   
	   $resultUserSelect = $con->query($UserNameSelect);
	   if($resultUserSelect->num_rows > 0){
	   $rowUserSelect = $resultUserSelect->fetch_assoc();
	   echo $rowUserSelect["Username"];
	   }
	   echo '</br>';
	   echo $row["Data"];
	   echo '</td>';
	   echo '<td>';
	   echo '<div style="min-height:200px">';
	   echo $row["Raspuns"];
	   echo '</div>';
	   echo '</td>';
	   echo '</tr>';
	   echo '</table>';
       echo'</div>';
       echo "</br></br>";	   
	 }
   }
 }
  if($uid != null)
  {  
     if(!isset($_REQUEST['actiune'])){ 
	 echo '<form method="GET" action="'.$_SERVER['PHP_SELF'].'">
						<input type="hidden" name="actiune" value="show">	
						<input type="hidden" name="SubId" value="'.$_REQUEST['SubId'].'">	
						<button type="hidden" >Adauga Comment</button></form>';
	 }
	 
	 if(isset($_REQUEST['actiune']) && !empty($_REQUEST['actiune'])){
	      if($_REQUEST['actiune'] == "show")
	           {
						echo '<form method="post" action="'.$_SERVER['PHP_SELF'].'">'; 
						echo '<input type="hidden" name="actiune" value="addReply">';
						echo '<input type="hidden" name="SubId" value="'.$_REQUEST['SubId'].'">';
	                    echo '<textarea name="comment" rows="4" cols="50" style="min-height:150px;margin-left:40px;min-width:1000px">';	
	                    echo '</textarea>';	 
	                    echo '</br></br>';
	                    echo '<input style="margin-left:40px;width:70px" type="submit" name="submit" value="Submit">';
	                    echo '</form>';
						
				}
		}
     
	 
  }
  
  if($_REQUEST['actiune'] == "addReply")
   {
   
     if ( !empty($_POST["comment"])) {
        $com = $_POST["comment"];
		$SUB_ID = $_REQUEST['SubId'];
		$Data = date('Y-m-d H:i:s');
		//echo $SUB_ID." ".$Data." ".$com." ".$uid;
		$Sql = "Insert into replies (Id_Subiect,User_Id,Data,Raspuns) values (".$SUB_ID.",".$uid.",'".$Data."','".$com."')";
		//echo $Sql;
		mysqli_query($con,$Sql);
		//header("Location: http://localhost/Forum//Domeniu.php?SubId=".$SUB_ID);
      /// exit(0);
	  $_REQUEST['actiune'] = false;
	 // echo"Inserare cu succes<br/>";
     echo'<a href="Domeniu.php?SubId='.$SUB_ID.'">Inapoi</a>';
     } 
     $_REQUEST['actiune'] = "show";// echo $_REQUEST['actiune']; 
	// header("Location: http://localhost/Forum//Domeniu.php?SubId=".$SUB_ID);
	
  }  
 ?>

<body> 

  
  
</body>
</html>