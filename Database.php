<?php

class Database
{
    public $connection;

    public function __construct()
    {
        $host = "localhost";
        $port = "5432";
        $db   = "CadastroLivros";
        $user = "postgres";
        $pass = "postgres";

        $dsn = "pgsql:host=$host;port=$port;dbname=$db";

        $this->connection = new PDO($dsn, $user, $pass);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
}