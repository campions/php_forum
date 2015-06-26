<?php
session_start();
?>

<?php
$uid =  $_SESSION["id"];

function validateDate($date, $format = 'Y-m-d')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

 $con=mysqli_connect("localhost","root","lab223","test");
 if (mysqli_connect_errno()) {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
 }
else{
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
  if($_POST['Parola'] == $_POST['Confirma']){
   //if(var_dump(validateDate($_POST['Data']))){
 //  if (DateTime::createFromFormat('Y-m-d G:i:s', $_POST['Data']) !== FALSE) {
  // it's a date

   $sql = "Update Users  set 
   Username = '".$_POST['Username']."',
   Parola = '".$_POST['Parola']."',
   Nume = '".$_POST['Nume']."',
   Prenume = '".$_POST['Prenume']."',
   email = '".$_POST['Email']."'
    where id = ".$uid ;  
   echo $sql;
  mysqli_query($con,$sql);
  $con->close();
  echo "<script>window.location = 'ModificaDate.php';</script>";
 // header("Location: ./ModificaDate.php");
 // die();
 //}
 /*else{
 echo "Data nu a fost introdusa corect ! ! ";
  echo '<a href = "http://localhost/Forum/ModificaDate.php">Inapoi</a>';
 }*/
}
else
{
  echo "Parolele nu corespund ! ";
  echo '<a href = "http://localhost/Forum/ModificaDate.php">Inapoi</a>';
}
}
?>