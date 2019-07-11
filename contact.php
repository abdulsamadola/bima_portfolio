<?php
if(isset($_POST['user_email'])){  
		
		
require 'master/PHPMailerAutoload.php';

$mail = new PHPMailer;

$fname = ucfirst($_POST['user_name']);
$reason = $_POST['email_message'];
$phone = $_POST['phone'];
$email = $_POST['user_email'];
$subject=$_POST['email_subject'];
$file = $_FILES['attachment']['tmp_name'];

$message = $_POST['email_message'];

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isMail();                                      // Set mailer to use SMTP
$mail->Host = 'localhost';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'suleimanolamilekan03@gmail.com';                 // SMTP username
$mail->Password = '08142287687';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->From = $_POST['email'];
$mail->FromName = $_POST['user_name'];
$mail->addAddress('360campstore@gmail.com');               // Name is optional

//$mail->addAttachment('./formget.jpg');         // Add attachments

$mail->isHTML(true);                                  // Set email format to HTML
$name = ucfirst($_POST['user_name']);
$pword = $row['password'];
$mail->Subject = "$subject";
$mail->Body .= '<br /> <table width="98%" class="form-table" id="login" summary="Table for entering login information">
  <tbody> 
    <tr>
      <td width="100%" bgcolor="#fff"><p align="center"><strong class="form-table"><img src="http://360campstore.com/assets/logo.png" alt="360CampStore" width="97" height="97" align="middle" /></strong></p>      </td>
    </tr>
    <tr>
      <td bgcolor="#51a351"><div align="center"><strong style="color: #FFFFFF">From, '.$name.'</strong></div></td>
    </tr>
  </tbody>
</table>';
$mail->Body .= "<br />-------------------------------------------------------------------------------------<br />";
$mail->Body .= "<br />Name:<strong> $name</strong><br />";
$mail->Body .= "<br />Email:<strong> $email</strong><br />";
$mail->Body .= "<br />-------------------------------------------------------------------------------------<br />";
$mail->Body .= "<br />Message: <strong>$message</strong><br />";
$mail->Body .= "<br />-------------------------------------------------------------------------------------<br />";

$mail->AltBody = 'You are using basic web browser ';
if(is_array($_FILES)) {
    $mail->AddAttachment($_FILES['attachment']['tmp_name'],$_FILES['attachment']['name']); 
}
 
if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
	json_encode('1');
    //echo 'Message has been sent';
echo '<script>alert("Thank You! Your message has been received. We\'ll get back to you as soon as possible!");
history.goback(-1);
</script>';

}
		
}
?>   
