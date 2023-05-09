<?php


use PHPMailer\controller\Phpmailer\PHPMailer;

require 'controller/Phpmailer/Exception.php';
require 'controller/Phpmailer/PHPMailer.php';
require 'controller/Phpmailer/SMTP.php';
require 'config.php';



class consulta
{
    public $user;              //Nombre de modelUsuario
    public $contrasena;         //Contrasena del modelUsuario
    public $email;              //email del modelUsuario
    public $descripcion;           //descripcion de la consulta


//Constructor de la clase
    public function __construct($user, $password, $email, $descripcion)
    {
        $this->user = $user;
        $this->contrasena = $password;
        $this->email = $email;
        $this->descripcion = $descripcion;
    }

    //Método que envía el correo y devuelve un error si no es posible
    public function enviar($consulta)
    {
        // Creando una nueva instancia de PHPMailer
        $mail = new PHPMailer;
        // Indicando el uso de SMTP
        $mail->isSMTP();
        // Habilitando SMTP debugging
        // 0 = apagado (para producción)
        // 1 = mensajes del cliente
        // 2 = mensajes del cliente y servidor
        $mail->SMTPDebug = 0;

        // Agregando compatibilidad con HTML
        $mail->Debugoutput = 'html';

        // Estableciendo el nombre del servidor de email
        $mail->Host = 'smtp-mail.outlook.com';

        // Estableciendo el puerto
        $mail->Port = 587;

        // Estableciendo el sistema de encriptación
        $mail->SMTPSecure = 'tls';

        // Para utilizar la autenticación SMTP
        $mail->SMTPAuth = true;

        // Nombre de modelUsuario para la autenticación SMTP - usar email completo para gmail
        $mail->Username = 'albertrodtab@hotmail.es';
        // Password para la autenticación SMTP
        $mail->Password = MAIL_PASSWORD;

        // Estableciendo como quién se va a enviar el mail
        $mail->setFrom('albertrodtab@hotmail.es', 'El equipo de ArtDeveloper');

        // Estableciendo a quién se va a enviar el mail
        $mail->addAddress($_POST['email'], $_POST['user']);

            $mail->Subject = 'Su consulta ####';
            $mail->isHTML(false);
            $mail->Body = <<<EOT
                Nombre: {$_POST['user']}
                Descripcion: {$_POST['descripcion']}
                EOT;
        // Enviando el modelMensaje y controlando los errores
        if (!$mail->send()) {
            echo "No se pudo enviar el correo. Intentelo más tarde.";
        } else {
            echo "Gracias por contactarnos.";
        }
    }
}
