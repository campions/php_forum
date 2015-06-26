<html>
  <body style="background:url(Images/EmailPage.jpg) no-repeat ; background-size: 100% 100%">   
  <form action="TrimitereMail.php" method="POST" >
	<table border="1" style="width:30%;margin-left:150px;margin-top:160px">
	  <tr >
	     <td style="height:70px">Expeditor</td>
		 <td><input size="40" type="text" name="Expeditor" required="true"></td>
	 </tr>
	 <tr>
		<td style="height:70px">Parola</td>
		<td><input size="40" type="password" name="Parola" required="true"></td>
	 </tr>
	 
	 <tr>
		<td style="height:70px">Destinatar</td>
		<td>
		<?php
		//<input size="40" type="text" name="Destinatar" required="true">
		echo '<select name="Destinatar">';
		$con=mysqli_connect("localhost","root","lab223","test");
		$sql = "select email from users";
		$result = $con->query($sql);
		while( $row = $result->fetch_assoc())
		{
  
              echo '<option value="' .$row["email"]. '">'.$row["email"].'</option>';
        }
         echo '</select>';
		?>
		</td>
	 </tr>
	 
    </table>
	<br /><br/>
	<div style="margin-left:150px">Subiect <textarea name="subiect" rows="1" cols="50"  style="min-width:600px">
	</textarea>
	</div>
	<br /><br/>
	<textarea name="mesaj" rows="4" cols="50" style="min-height:150px;margin-left:150px;min-width:600px">
	</textarea>
	<br />
	<input type="submit" name="sub" value="Send" style="width:90px ;margin-top:30px;height:40px;background-color:#CCCCFF; margin-left:150px">
  </form>
  </body>
</html>  