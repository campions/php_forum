<?php
session_start();
?>
<html>
 <head>
  <link rel="stylesheet" href="Style.css" type="text/css" />
  <script type='text/javascript'>
function test()
 {
   var menu =  document.getElementById('meniu');
   
   var newDiv = document.createElement('div');
   var node = document.createTextNode("Mail");   
   var a = document.createElement('a');
   a.setAttribute("href", "Email.php");
   a.appendChild(node);
   newDiv.appendChild(a);  
   menu.appendChild(newDiv);
   
    
   
   var DomeniuNou = document.createElement('div');
   var node = document.createTextNode("Administrare");   
   var a = document.createElement('a');
   a.setAttribute("href", "Administrare.php");
   a.appendChild(node);
   DomeniuNou.appendChild(a);  
   menu.appendChild(DomeniuNou);
   
   var newDiv = document.createElement('div');
   var node = document.createTextNode("Statistici");   
   var a = document.createElement('a');
   a.setAttribute("href", "Statistici.php");
   a.appendChild(node);
   newDiv.appendChild(a);  
   menu.appendChild(newDiv);
 }
 
 function Autentificat()
 {
   var menu =  document.getElementById('meniu');
   
   var newDiv = document.createElement('div');
   var node = document.createTextNode("Modifica Datele Personale");   
   var a = document.createElement('a');
   a.setAttribute("href", "ModificaDate.php");
   a.appendChild(node);
   newDiv.appendChild(a);  
   menu.appendChild(newDiv);
   
   var newDiv = document.createElement('div');
   var node = document.createTextNode("Deconectare");   
   var a = document.createElement('a');
   a.setAttribute("href", "Deconectare.php");
   a.appendChild(node);
   newDiv.appendChild(a);  
   menu.appendChild(newDiv);
   
   var newDiv2 = document.createElement('div');
    var node2 = document.createTextNode("Excel");   
    var a2 = document.createElement('a');
    a2.setAttribute("href", "creareFisierXML.php");
    a2.appendChild(node2);
    newDiv2.appendChild(a2);  
    menu.appendChild(newDiv2);
 }
</script>
  <title>Inregistrare</title>
 </head>
 <div id="meniu">
     <div></div>
    <div> <a href = "Inregistrare.html">Inregistrare</a></div>
	<div> <a href = "LoginPage.php">Login</a></div>
	<div> <a href = "Forum.php">Forum</a></div>	
	
 </div>
 <body id="fond">
 </body>
</html>
<?php
$con=mysqli_connect("localhost","root","lab223","test");
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
else
{
  $uid =  $_SESSION["id"];  
  $sql = "SELECT * from Users where id = " .$uid ." and DrepturiAdmin = 1";
  
  if($uid != "")
  {
     echo "<script type='text/javascript'>Autentificat();</script>";
  }
  
  $result = $con->query($sql);
  if ($result->num_rows > 0) 
   {
    //e admin
	//$message = "wrong answer";
    echo "<script type='text/javascript'>test();</script>";
   } 
   
  $sql = "SELECT * from statistici";
  $result = $con->query($sql);
  
  echo '<table border="1"  style="width:30%;margin-left:70px;margin-top:70px;background-image:url(Images/FondDomenii.png)">';
  echo '<tr style="height:35px">';
	echo '<td>';
	echo 'User';
	echo '</td>';
	echo '<td>';
	echo 'Logare';
	echo '</td>';
	echo '<td>';
	echo 'Ip';
	echo '</td>';
	echo '<td>';
	echo 'Numar de Postari';
	echo '</td>';
	echo '</tr>';
  while($row = $result->fetch_assoc())
  {
    echo '<tr>';
	echo '<td>';
	echo $row["nume"];
	echo '</td>';
	echo '<td>';
	echo $row["Data"];
	echo '</td>';
	echo '<td>';
	echo $row["Ip"];
	echo '</td>';
	
	/*
	$SelectCountReplies = "select count(r.Rep_id) as NumarReplies 
                           from replies r
                           join users u 
                           on r.User_id = u.id
                           where u.username =  '".$row["nume"]."'";
						  */
$SelectCountReplies       ="select count(r.Rep_id) as NumarReplies 
                           from replies r
                           join users u                            
                           on r.User_id = u.id
                           join statistici s 
                           on s.nume = u.username
                           where u.username =  '".$row["nume"]."'
                           and s.data = '". $row["Data"]."'
                           and r.Data < s.Data";
						  
	$result2 = $con->query($SelectCountReplies);	
	$count = $result2->fetch_assoc();
    echo '<td>';			
	echo $count['NumarReplies'];
	echo '</td>';
	echo '</tr>';
  }
  echo '</table>';
  
  $select = "SELECT COUNT( Rep_id ) ,User_Id
             FROM replies
             GROUP BY User_Id";
  $result3 = $con->query($select);
  $nr = $result3->fetch_assoc();  
 
 echo '<a href = Accesari.php>Accesari</a>';
  
      
  
}
?>

