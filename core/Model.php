<?php

namespace core;


abstract class Model
{
    public $attributes = [];
    public $errors = [];
    public $rules = [];
    public $db;
    public $table;
    public $limit;

    public function __construct()
    {
        $dbInstance = new Db();
        $this->db = $dbInstance->getDbConnection();
    }

    public function getAllData($limit = 0)
    {
        $query = ($limit) ? "SELECT * FROM $this->table LIMIT $limit" : "SELECT * FROM $this->table";
        return $this->db->query($query)->fetchAll();
    }

    public function getTotalItemsCount()
    {
        $query = "SELECT COUNT(*) AS count FROM $this->table";
        $statement = $this->db->prepare($query);
        $statement->execute();
        return $statement->fetch(\PDO::FETCH_OBJ);
    }
}