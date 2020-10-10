<?php

namespace core;


abstract class Model
{
    public $attributes = [];
    public $errors = [];
    public $rules = [];
    public $db;

    public function __construct()
    {
        $dbInstance = new Db();
        $this->db = $dbInstance->getDbConnection();
    }
}