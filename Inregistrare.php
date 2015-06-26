<?php
 $con=mysqli_connect("localhost","root","lab223","test");
 if (mysqli_connect_errno()) {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
 }

/*
$stmt = $con->prepare("INSERT INTO Users (Username,Parola,Nume,Prenume,email,DataNasterii) 
VALUES (:u, :pwd, :name,:pname,:mail,:DN)");
$txt = "'".$_POST['Username']."'";
echo $txt;
$stmt->bindParam(':u', $txt);
$stmt->bindParam(':pwd', $_POST['Parola']);
$stmt->bindParam(':name', $_POST['Nume']);
$stmt->bindParam(':pname', $_POST['Prenume']);
$stmt->bindParam(':mail', $_POST['Email']);
$stmt->bindParam(':DN', $_POST['Data']);
  $stmt->execute();*/
  
   $sql = "INSERT INTO Users (Username,Parola,Nume,Prenume,email,DrepturiAdmin) 
            VALUES ('".$_POST['Username']."', '".$_POST['Parola']."','".$_POST['Nume']."','".$_POST['Prenume']."', '".$_POST['Email']."',0)";

  mysqli_query($con,$sql);
  echo $sql;
  $Select = "Select id from users where Username = '".$_POST['Username']."'";
  $result = $con->query($Select);
  $row = $result->fetch_assoc();
  $InsertStatist = "Insert into statistici (id,nume,Data) VALUES(".$row["id"].",'".$_POST['Username']."','".date('Y-m-d H:i:s')."')";
  mysqli_query($con,$InsertStatist);
  
  $con->close();
  header("Location: ./Welcome.html");
  die();

?>