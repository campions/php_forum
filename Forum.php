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
<title>Forum</title>
 </head>
 <div id="meniu">
     <div></div>
    <div> <a href = "Inregistrare.html">Inregistrare</a></div>
	<div> <a href = "LoginPage.php">Login</a></div>
	<div> <a href = "Forum.php">Forum</a></div>	
	
 </div>
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
	$message = "wrong answer";
    echo "<script type='text/javascript'>test();</script>";
   } 
	
	$user = $_SESSION["username"];
	if( $user != "")
	{
      // echo "Hello ";
     //  echo $user;  echo "IP:". $_SERVER['REMOTE_ADDR'];
	   $ip = gethostbyname('localhost');
	  // echo $ip;
    }
 }
 /*
echo '<div>';
echo "test";
echo '</div>';*/

 $sql = "SELECT * from Domeniu";
 $result = $con->query($sql);
 if ($result->num_rows > 0)
  {     
	for($index = 0 ; $index<$result->num_rows;$index++)
	{ 
	    $row = $result->fetch_assoc();		
	    echo '<div class="Domeniu">'.$row["Nume_Domeniu"] .'</div>';
		echo '<table  style="width:90%;margin-left:20px;background-image:url(Images/FondDomenii.png);border: 1px solid black">';        
	    $NR_Dom = $row["Dom_id"];
	    $Sql2 = "select * from subiect where Dom_id = " .$NR_Dom;
	    $result2 = $con->query($Sql2);
	    if ($result2->num_rows > 0) 
		  {
		     if($result2->num_rows > 0)
			 {
	           for($index2 = 0 ; $index2<$result2->num_rows;$index2++)
			   {
	               $row2 = $result2->fetch_assoc();		               
	               if($index2 + 1 == $result2->num_rows)
				   {
                     echo'<thead>
	                        <tr  style="height:80px">
		                           <td style="border-top:1px solid black;border-bottom:1px solid white;border-left:1px solid black"></td>
		                           <td style="border-top:1px solid black;border-bottom:1px solid white;border-left:1px solid white;width: 610px">';
		                                echo '<a href=http://localhost/Forum/Domeniu.php?SubId='.$row2["Id_Subiect"].' >';	
										echo $row2["Nume_Subiect"];
										echo '</a>';
		                            echo '</td>
		                            <td style="border-top:1px solid black;border-bottom:1px solid white;border-left:1px solid white;"></td>
		                            <td style="border-top:1px solid black;border-bottom:1px solid white;border-left:1px solid white;border-right:1px solid black"></td>
		                     </tr>
	                      </thead>';	                   
	                }
	               else
	                if($index2 == 0)
					{
		               echo '<tfoot>
	                           <tr  style="height:80px">
		                              <td style="border-bottom:1px solid black;border-left:1px solid black"></td>
		                              <td style="border-bottom:1px solid black;border-left:1px solid white;width: 610px">';
		                                    echo '<a href=http://localhost/Forum/Domeniu.php?SubId='.$row2["Id_Subiect"].' >';	
										    echo $row2["Nume_Subiect"];
										    echo '</a>';
		                              echo '</td>
		                              <td style="border-bottom:1px solid black;border-left:1px solid white;"></td>
		                              <td style="border-bottom:1px solid black;border-left:1px solid white;border-right:1px solid black"></td>
		                        </tr>
	                        </tfoot>';
	               }
	             else
				 {
                   echo '<tbody>
                            <tr  style="height:80px">
	                             <td class="class1"></td>
		                         <td class="class3" style="width: 610px">';
		                             echo '<a href=http://localhost/Forum/Domeniu.php?SubId='.$row2["Id_Subiect"].' >';									
									 echo $row2["Nume_Subiect"];
									 echo '</a>';
		                          echo '</td>
		                         <td class="class3"></td>
		                         <td class="class2"></td>
                            </tr>	   
                      </tbody>';
	   
	            }
 
             }
	       }
	
	     }
	  echo  '</table>';
    }
	
}
echo '</br>';

 ?>
<body style="background: url(Images/fond2.jpg) no-repeat ; background-size: 100% 100%">  
	

  
 </br></br></br>
 
</body>
</html>

<?php
	$website=file_get_contents('http://www.vremea.net/Vremea-in-Bucuresti-judetul-Ilfov/prognoza-meteo-pe-7-zile/');
	$temp1=explode('<table class="tableforecast"',$website);
	$temp2=$temp1[1];
	$temp2='<table class="tableforecast"'.$temp2;
	$sfarsit=strpos($temp2, "<h1>");	
	$temp3=substr($temp2,0,$sfarsit);
	$temp3=$temp3.'</div>';
	echo '<div>';
	echo '<h2>Vremea in Bucuresti astazi</h2>';
	echo $temp3;
	echo '</div>';
	?>