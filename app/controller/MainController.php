<?php

namespace app\controller;


use core\Controller;

class MainController extends Controller
{
    public function indexAction()
    {
        $this->setMeta('Home page | Task manager', 'Task manager app', 'task, manager');
        $this->setData(compact('test'));
    }
}