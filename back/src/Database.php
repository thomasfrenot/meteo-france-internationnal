<?php
namespace App;

class Database
{
    private $connection = null;

    public function __construct()
    {
        $databaseUrl = $_ENV['DATABASE_URL'];
        $login = $_ENV['DATABASE_LOGIN'];
        $password = $_ENV['DATABASE_PASSWORD'];

        try {
            $this->connection = new \PDO(
                $databaseUrl,
                $login,
                $password
            );
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_WARNING);
            $this->connection->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE,\PDO::FETCH_OBJ);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage());
        }
    }

    public function getConnection(): \PDO
    {
        return $this->connection;
    }
}
