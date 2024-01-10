<?php

namespace Framework;
use Exception;
use PDO;
use PDOException;

class Database {
    public $Connection;

    /**
     * Constructor for the Database Class
     *
     * @param array $config
     * @return void
     * @throws Exception
     */
    public function __construct(array $config)
    {
        $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']}";

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        ];

        try {
            $this->Connection = new PDO($dsn, $config['username'], $config['password'], $options);
        } catch (PDOException $e){
            throw new Exception("Database connection failed: {$e->getMessage()}");
        }
    }

    /**
     * Query the Database
     *
     * @param string $query
     * @return false|PDOStatement|\PDOStatement
     * @throws Exception
     */
    public function Query($query, $params = []){
        try {
            $sth = $this->Connection->prepare($query);
            // Bind Parameters
            foreach ($params as $param => $value) {
                $sth->bindValue(':'. $param, $value);
            }

            $sth->execute();
            return $sth;
        } catch (PDOException $e){
            throw new Exception("Query failed to execute: {$e->getMessage()}");
        }
    }
}