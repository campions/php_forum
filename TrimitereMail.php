<?php    
//echo $_POST["Expeditor"]." ".$_POST["Parola"]." ".$_POST["Destinatar"]." ".$_POST["mesaj"];
include('PHPMailer-master\class.phpmailer.php');

 require('PHPMailer-master\class.smtp.php');
$mail = new PHPMailer(); // create a new object
$mail->IsSMTP(); // enable SMTP
//$mail->SMTPDebug = 2; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
$mail->Host = "plus.smtp.mail.yahoo.com";
$mail->Port = 465; // or 587
$mail->IsHTML(true);
//$mail->Username = "cali_scuter_09@yahoo.com";
$mail->Username = $_POST["Expeditor"];
//$mail->Password = "";
$mail->Password = $_POST["Parola"];
//$mail->SetFrom("cali_scuter_09@yahoo.com");
$mail->SetFrom($_POST["Expeditor"]);
$mail->Subject = $_POST["subiect"];
$mail->Body = $_POST["mesaj"];
//$mail->AddAddress("cali_scuter_09@yahoo.com");
$mail->AddAddress($_POST["Destinatar"]);
//echo "Loading...";
 if(!$mail->Send())
    {
      echo "Mailer Error: " . $mail->ErrorInfo;
    }
    else
    {
       //echo "Message has been sent !";
	   header("Location: ./Email.php");
    }
	//echo "Finish";
	
?>