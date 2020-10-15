<?php

namespace app\model;


use core\Model;

class TaskModel extends Model
{
    public $table = 'task';
    public $limit = 3;

    public function setTask($name, $email, $task)
    {
        $query = "INSERT INTO $this->table (user_name, user_email, task_description) VALUES (:name, :email, :task)";
        $statement = $this->db->prepare($query);
        return $statement->execute([':name' => $name, ':email' => $email, ':task' => $task]);
    }
}