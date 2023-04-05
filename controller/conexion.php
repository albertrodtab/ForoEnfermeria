<?php
//Clase que permite conectarnos con la bbdd
class Conexion
{
    private $servidor;  //Indica donde se aloja la bbdd
    private $user;      //Usuario de la bbdd
    private $password;  //Contraseña de la bbdd
    private $dbh;       //Objeto PDO

    //Constructor de la clase
    public function __construct()
    {
        $dbname = 'foroenfermeriadb';
        $this->servidor = "mysql:host=localhost;dbname=$dbname";
        $this->user = 'root';
        $this->password = '';
    }

    //Metodo que permite conectar con la bbdd
    public function conectar()
    {
        try {
            $this->dbh = new PDO($this->servidor, $this->user, $this->password);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $ex) {
            echo "Problemas al conectar con la base de datos";
        }
    }

    //Metodo que permite desconectar con la bbdd
    public function desconectar()
    {
        $this->dbh = null;
    }

    //Metodo que ejecuta una sentencia
    public function ejecutar($strComando)
    {
        try {
            $stmt = $this->dbh->prepare($strComando);
            $stmt->execute();
        } catch (PDOException $ex) {
            throw $ex;
        }
    }

    //Metodo que ejecuta una consulta
    public function consultar($strComando)
    {
        try {
            $stmt = $this->dbh->prepare($strComando);
            $stmt->execute();
            $rows = $stmt->fetchAll();
            return $rows;

        } catch (PDOException $ex) {
            throw $ex;
        }
    }
}

