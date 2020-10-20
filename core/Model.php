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

    public function getItems($offset, $limit)
    {
        $query = "SELECT * FROM $this->table LIMIT $offset, $limit";
        $statement = $this->db->prepare($query);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getSortedItems($offset, $limit, $orderBy, $order = 'ASC')
    {
        $query = "SELECT * FROM $this->table ORDER BY $orderBy $order LIMIT $offset, $limit";
        $statement = $this->db->prepare($query);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getTotalItemsCount()
    {
        $query = "SELECT COUNT(*) AS count FROM $this->table";
        $statement = $this->db->prepare($query);
        $statement->execute();
        $result = $statement->fetch(\PDO::FETCH_OBJ);
        return $result->count;
    }
}