<?php

namespace core;


class Db
{
    protected $dbConnection = '';

    public function __construct()
    {
        $config_db = require_once dirname(__DIR__) . '/config/config_db.php';
        try {
            $this->dbConnection = new \PDO($config_db['dsn'], $config_db['user'], $config_db['password']);
        } catch (\PDOException $exception) {
            echo "Ошибка подключения к БД: $exception->errorInfo";
        }
    }

    public function getDbConnection()
    {
        return $this->dbConnection;
    }
}