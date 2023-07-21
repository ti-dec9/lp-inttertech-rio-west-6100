<?php 

/* PHPMAILER */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$name  = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$cnpj  = $_POST['cnpj'];

/* $data = array(
    'name' => $name,
    'email' => $email,
    'phone' => $phone,
    'cnpj' => $cnpj,
); */


//Recipient
//$mailTo = 'contato@intertechrio.com.br';
$mailTo = 'xploter13@gmail.com';

$body = "<div style='font-size: 26px;color: #41637e;font-family: sans-serif;margin-bottom: 20px;' id='emb-email-header'>
<p>Você tem uma nova mensagem do site, segue os dados abaixo:</p>
</div>
<p style='Margin-top: 0;color: #565656;font-family: Arial,serif;font-size: 14px;line-height: 5px;margin-bottom: 5px'>
 <b>Nome: </b> $name
</p> <br>    
<p style='Margin-top: 0;color: #565656;font-family: Arial,serif;font-size: 14px;line-height: 5px;margin-bottom: 5px'>
 <b>Email: </b> $email
</p> <br>    
<p style='Margin-top: 0;color: #565656;font-family: Arial,serif;font-size: 14px;line-height: 5px;margin-bottom: 5px'>
 <b>Telefone: </b> $phone
</p> <br>
<p style='Margin-top: 0;color: #565656;font-family: Arial,serif;font-size: 14px;line-height: 5px;margin-bottom: 5px'>
 <b>CNPJ: </b> $cnpj
</p>";

$mail = new PHPMailer; //From email address and name 

//AUTHENTICATION
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
$mail->Username = "xploter13@gmail.com";
$mail->Password = "tasroilazsrlaocq";

/* SENDMAIL */
$mail->From = "$email"; 
$mail->FromName = "$name"; //To address and name 
$mail->addAddress("$mailTo", "$name");//Recipient name is optional
$mail->addReplyTo("$email", "Reply"); //CC and BCC 
/* $mail->addCC("cc@example.com"); 
$mail->addBCC("bcc@example.com"); //Send HTML or Plain Text email  */
$mail->isHTML(true); 
$mail->Subject = "Contato - LP Controlador de temperatura west 6100 - Lead Form CTA WHATSAPP";
$mail->Body = "$body";
$mail->AltBody = "This is the plain text version of the email content"; 
$mail->send();

/* DEBUG */
/* if(!$mail->send()) { 
    echo "Mailer Error: " . $mail->ErrorInfo; 
} else { 
    echo "Message has been sent successfully"; 
} */

/* echo "<pre>";
print_r($data);
echo "</pre>"; */

header('location:https://wa.me/5521996072513?text=Gostaria%20de%20informações%20sobre%20o%20produto%20West%206100');
