<?php

class DB_Connect
{
    private $conn;

    // Función para conectar la base de datos
    public function connect()
    {
        require_once 'configuracion.php';

        // Conecta a mysql database
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
        $this->conn->set_charset("utf8");

        // regresa database handler
        return $this->conn;
    }
}

?>