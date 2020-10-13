<?php

namespace app\controller;


use app\model\TaskModel;
use core\Controller;

class MainController extends Controller
{
    public function indexAction()
    {
        $taskModel = new TaskModel();
        $tasks = $taskModel->getAllData();
        print_r($tasks);
        $this->setMeta('Home page | Task manager', 'Task manager app', 'task, manager');
        $this->setData(compact('tasks'));
    }

    public function addAction()
    {
        $postData = $_POST;
        $this->setData(compact('postData'));

    }
}