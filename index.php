<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>EnviarEmail</title>
    </head>
    <body>
      <?php
        // put your code here
require_once 'vendor/autoload.php';
        
$from = isset($_POST['Fromemail'])? $_POST['Fromemail']:'';
$nome = isset($_POST['nome'])? $_POST['nome']:'';
$msg = isset($_POST['message'])? $_POST['message']:'';


use PHPMailer\PHPMailer\PHPMailer;

$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPOptions = array( 'ssl' => array( 'verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true ) ); 
$mail->SMTPDebug = 0;
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
$mail->Username = "artgio32@gmail.com";
$mail->Password = "081020731";
$mail->setFrom($from, $nome);
$mail->addReplyTo('artgio32@gmail.com');
$mail->addAddress('acesarrocha3@hotmail.com',$from, 'Suporte/CallBack');
$mail->Subject = 'Support/CallBack Site';
$mail->msgHTML($msg);
$mail->AltBody = $msg;
//$mail->addAttachment('images/phpmailer_mini.png');//Enviar uma imagem

if ($mail->send()) {
    
     header('location:formemail.html');
    
} else {
   
   echo "Error: " . $mail->ErrorInfo;
}

function save_mail($mail)
{
    //You can change 'Sent Mail' to any other folder or tag
    $path = "{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail";

    //Tell your server to open an IMAP connection using the same username and password as you used for SMTP
    $imapStream = imap_open($path, $mail->Username, $mail->Password);

    $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
    imap_close($imapStream);

    return $result;
}
        ?>
    </body>
</html>

