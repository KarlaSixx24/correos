<?php
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    //Retrieve from data
    $destinatario = $_POST["destinatario"];
    $asunto = $_POST["asunto"];
    $mensaje = $_POST ["mensaje"];

    //Check if form fields are empty
    if (empty($destinatario) || empty($asunto) || empty($mensaje)){
        echo "Todos los campos son obligatorios";
        exit;
    }
}

$mail = new PHPMailer(); //New Object PHPMailer
$mail->isSMTP();
$mail->Host = "smtp-mail.outlook.com";
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->SMTPAuth = true;
$mail->Username = 'karlasixx8@gmail.com';
$mail->Password = 'amoelchocolate';
$mail->Port = 587;
$mail->CharSet = "UTF-8";
$mail->Encoding = "quoted-printable";

//$body = file_get_contents('contenido.html'); //debes tener listo el documento html
$body = $mensaje;
//Parametros de correo de envio y nombre de a quien va
$mail->SetFrom('brendalibra14@gmail.com', 'Brenda Muñiz');
$mail->AddReplyTo("galiciaosmar24@outlook.com", "Osmar Galicia");
//Defino la direccion a la que se enviara el mensaje
$address = $destinatario;
//La añado a la clase, indicando el nombre de la persona destinatario
$mail->AddAddress($address, "Brenda Muñiz");

//Añado un asuntyo al mensaje
$mail->Subject = $asunto;

//Puedo definir un cuerpo alternativo del mensaje, que contenga solo texto
$mail->AltBody = "Cuerpo alternativo del mensaje";

//Inserto el texto del mensaje en formato HTML
$mail->MsgHTML($body);

//Asigno un archivo adjunto al mensaje
//$mail->AddAttachment("ruta y formato");

//Envio el mensaje, comprobando si se envio correctamente
if(!$mail->Send()){
    echo "Error al enviar el mensaje: " . $mail->ErrorInfo;
} else {
    echo "Mensaje enviado!!";
}
?>