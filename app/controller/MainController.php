<?php

namespace app\controller;


use app\model\TaskModel;
use app\model\UserModel;
use core\Controller;
use core\Pagination;

class MainController extends Controller
{
    public function indexAction()
    {
        $user = $this->user;
        $taskModel = new TaskModel();

        $page = isset($_GET['page']) ? (int)htmlspecialchars($_GET['page']) : 1;
        $itemsPerPage = 3;
        $tasksCount = (int)$taskModel->getTotalItemsCount();
        $pagination = new Pagination($itemsPerPage, $tasksCount, $page);
        $startPage = $pagination->getStart();
        $tasks = $taskModel->getItems($startPage, $itemsPerPage);

        $this->setMeta('Home page | Task manager', 'Task manager app', 'task, manager');
        $this->setData(compact('tasks', 'pagination', 'user'));
    }

    public function addAction()
    {
        $errorMessages = [];
        $successMessage = 'Задача успешно добавлена';
        $dbErrorMessage = 'Ошибка добавления задачи';
        if (isset($_POST['addTask'])) {
            if (empty($_POST['name'])) {
                $errorMessages[] = 'Не заполнено обязательное поле Имя';
            } elseif (empty($_POST['email'])) {
                $errorMessages[] = 'Не заполнено обязательное поле Email';
            } elseif (empty($_POST['task'])) {
                $errorMessages[] = 'Не заполнено обязательное поле Текст задачи';
            }

            if (!empty($errorMessages)) {
                $this->setData(compact('errorMessages'));
            } else {
                $name = htmlspecialchars(trim($_POST['name']));
                $email = htmlspecialchars(trim($_POST['email']));
                $task = htmlspecialchars(trim($_POST['task']));
                $taskModel = new TaskModel();
                ($taskModel->setTask($name, $email, $task)) ? $this->setData(compact('successMessage'))
                    : $this->setData(compact('dbErrorMessage'));
            }
        }
    }

    public function loginAction()
    {
        $errorMessage = '';
        if (!empty($_POST)) {
            $userName = (trim(htmlspecialchars($_POST['user_name']))) ?: null;
            $password = (trim(htmlspecialchars($_POST['password']))) ?: null;

            if ($userName && $password) {
                $user = new UserModel();
                $userData = $user->getUserByName($userName);

                if ($userData) {
                    if ($userData->password === md5($password)) {
                        $_SESSION['user']['name'] = $userData->user_name;
                        $this->redirect('/');
                    }
                } else {
                    //$_SESSION['error_login'] = 'Логин или пароль введены неверно';
                    $errorMessage = 'Логин или пароль введены неверно';
                }
            }
        }
        $this->setData(compact('errorMessage'));
        $this->setMeta('Вход');
    }

    public function logoutAction()
    {
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
            unset($this->user);
        }
        $this->redirect('/');
    }
}