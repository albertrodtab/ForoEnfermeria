<?php
require_once("controller/conexion.php");

use PHPMailer\controller\Phpmailer\PHPMailer;

require 'controller/Phpmailer/Exception.php';
require 'controller/Phpmailer/PHPMailer.php';
require 'controller/Phpmailer/SMTP.php';
require 'config.php';
class usuario
{
    public $user;              //Nombre de modelUsuario
    public $email;              //Email del modelUsuario
    public $password;           //Contraseña del modelUsuario
    public $data;               //Fecha de creación del modelUsuario
    public $level;              //Nivel acceso modelUsuario
    public $conexion;           //Objeto que permite conectar con la bbdd

    //Constructor de la clase
    public function __construct($user, $password, $email)
    {
        $this->conexion = new Conexion();
        $this->user = $user;
        $this->password = $this->encriptar($password);
        $this->email = $email;
        $currentDate = new DateTime();
        $currentDateTime = $currentDate->format('Y-m-d H:i:s');
        $this->data = $currentDateTime;
        $this->level = 1;

    }

    //Método que permite encriptar la contraseña a partir de un hash
    public function encriptar($enc)
    {
        $opciones = ['cost' => 12,];
        $passHash = password_hash($enc, PASSWORD_BCRYPT, $opciones);
        return $passHash;

    }

    //Metodo que comprueba que los campos no esten vacios, el email sea correcto y el alias no este repetido
    public function comprobaciones($mensageError, $mensajeExito)
    {
        $this->conexion->conectar();

        $mensajeError = "";
        $mensajeExito = "";

        //Comprobamos que los campos no estén vacíos
        if (empty($this->user) || empty($this->password) || empty($this->email)) {
            $mensajeError = "Por favor rellene todos los campos.";
        }
        //Comprobamos que la dirección de correo sea valida
        else if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $mensajeError = "La dirección de correo electrónico " . $this->email . " es inválida. Por favor, introduzca una correcta.";
        }
        //Comprobamos que el alias no esta ya registrado
        else {
            //Consultamos los registros y su valor en la columna user y los almacenamos en el array $usuarios
            $usuarios = $this->conexion->consultar("SELECT * from users");
            if (count($usuarios)) {
                //Recorremos el array y en el caso de que el nombre introducido corresponda con alguno ya registrado impedirá el registro
                foreach ($usuarios as $users) {
                    if ($users['user'] == $this->user) {
                        $mensajeError = "Alias ya registrado. Por favor elija otro.";
                        break;
                    }
                }
            }
        }



        //Si no hay errores, creamos el nuevo usuario
        if (empty($mensajeError)) {
            $this->nuevo($this);
            $mensajeExito = "Registro Realizado con Éxito.";

        }
        $this->conexion->desconectar();
        return array($mensajeError, $mensajeExito);
    }

    public function nuevo($user): void
    {
        try {
            $this->conexion->conectar();
            $this->conexion->ejecutar("INSERT INTO users SET user_name='$this->user', user_pass='$this->password', user_email='$this->email', user_date='$this->data', user_level='$this->level'");
            //Crea un objeto correo cuyos parámetros son el nombre de Usuario y el email introducido para posteriormente llamar al método enviar() y mandarle el correo
            $this->enviar($user);
            $this->conexion->desconectar();
        } catch (PDOException $ex) {
            //Devuelve la excepción en caso de no poder insertar el modelUsuario
            throw $ex;
        }
        $this->conexion->desconectar();
    }

    //Método que envía el correo y devuelve un error si no es posible
    public function enviar($user)
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
        $mail->setFrom('albertrodtab@hotmail.es', 'El equipo de Enfermería en Casa');

        // Estableciendo a quién se va a enviar el mail
        $mail->addAddress($_POST['email'], $_POST['user']);

        $mail->Subject = 'Usuario registrado en Foro Enfermería';
        $mail->isHTML(false);
        $mail->Body = <<<EOT
                El equipo de enfermería En Casa le da la bienvenida a nuestro foro de consulta, estos son su datos de acceso:
                Nombre: {$_POST['user']}
                Password: {$_POST['password']}
                EOT;
        // Enviando el modelMensaje y controlando los errores
        if (!$mail->send()) {
            echo "No se pudo enviar el correo. Intentelo más tarde.";
        } else {
            echo "Gracias por querer formar parte de nuestro foro.";
        }
    }


    public function verificar($user, $password)
    {
        try {
            $this->conexion->conectar();
            //Recogemos todas las filas con las columnas user y password y las almacenamos en el array $usuarios
            $usuarios = $this->conexion->consultar("SELECT user_name, user_pass FROM users");
            if (count($usuarios)) {
                //Recorremos todas las filas del array
                foreach ($usuarios as $usuario) {
                    if ($usuario['user_name'] == $user && password_verify($password, $usuario['user_pass'])) {
                        echo "Contraseña correcta";
                        return true;
                    }
                }
            }
            //$this->conexion->desconectar();
        } catch (PDOException $ex) {
            throw $ex;
        }
        $this->conexion->desconectar();
    }

    public function getId($user)
    {
        $this->conexion->conectar();
        $usuario = $this->conexion->consultar("SELECT user_id FROM users WHERE user_name = '$user'");
        if (count($usuario)) {
            $usuario[0] ['user_id'];
        }
        $this->conexion->desconectar();
        return $usuario[0] ['user_id'];
    }

    public function getUserLevel($user)
    {
        $this->conexion->conectar();
        $usuario = $this->conexion->consultar("SELECT user_level FROM users WHERE user_name = '$user'");
        if (count($usuario)) {
            $usuario[0] ['user_level'];
        }
        $this->conexion->desconectar();
        return $usuario[0] ['user_level'];
    }

    public function getAliasById($id_usuario)
    {
        $this->conexion->conectar();
        $usuario = $this->conexion->consultar("SELECT user_name FROM users WHERE user_id = '$id_usuario'");
        if (count($usuario)) {
            $usuario[0] ['user_name'];
        }
        $this->conexion->desconectar();
        return $usuario[0] ['user_name'];
    }

}