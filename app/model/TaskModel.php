<?php

namespace app\model;


use core\Model;

class TaskModel extends Model
{
    public $table = 'task';
    public $limit = 3;

    public function setTask($name, $email, $task, $status = null)
    {
        $query = "INSERT INTO $this->table (user_name, user_email, task_description, status) VALUES (:name, :email, :task, :status)";
        $statement = $this->db->prepare($query);
        return $statement->execute([':name' => $name, ':email' => $email, ':task' => $task, ':status' => $status]);
    }

    public function editTask($id, $name, $email, $task, $status, $edited)
    {
        try {
            $query = "UPDATE $this->table SET user_name = :name, user_email = :email, task_description = :task, status = :status, edited = :edited WHERE id = :id";
            $statement = $this->db->prepare($query);
            return $statement->execute([':name' => $name, ':email' => $email, ':task' => $task, ':status' => $status, ':edited' => $edited, ':id' => $id]);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
}