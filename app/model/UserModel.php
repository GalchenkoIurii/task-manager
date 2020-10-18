<?php
/**
 * Created by PhpStorm.
 * User: Iurii
 * Date: 18.10.2020
 * Time: 15:20
 */

namespace app\model;


use core\Model;

class UserModel extends Model
{
    public $table = 'user';

    public function getUserByName($name)
    {
        $query = "SELECT * FROM $this->table WHERE user_name = :name";
        $statement = $this->db->prepare($query);
        $statement->execute([':name' => $name]);
        $result = $statement->fetch(\PDO::FETCH_OBJ);
        return $result;
    }
}