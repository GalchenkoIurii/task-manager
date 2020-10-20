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
        $itemsPerPage = ITEMS_PER_PAGE;
        $tasksCount = (int)$taskModel->getTotalItemsCount();
        $pagination = new Pagination($itemsPerPage, $tasksCount, $page);
        $startPage = $pagination->getStart();

        if (isset($_GET['sort'])) {
            $sort = htmlspecialchars($_GET['sort']);
            switch ($sort) {
                case 'nameasc':
                    $tasks = $taskModel->getSortedItems($startPage, $itemsPerPage, 'user_name');
                    break;
                case 'namedesc':
                    $tasks = $taskModel->getSortedItems($startPage, $itemsPerPage, 'user_name', 'DESC');
                    break;
                case 'emailasc':
                    $tasks = $taskModel->getSortedItems($startPage, $itemsPerPage, 'user_email');
                    break;
                case 'emaildesc':
                    $tasks = $taskModel->getSortedItems($startPage, $itemsPerPage, 'user_email', 'DESC');
                    break;
                case 'statusasc':
                    $tasks = $taskModel->getSortedItems($startPage, $itemsPerPage, 'status');
                    break;
                case 'statusdesc':
                    $tasks = $taskModel->getSortedItems($startPage, $itemsPerPage, 'status', 'DESC');
                    break;
                default:
                    $tasks = $taskModel->getItems($startPage, $itemsPerPage);
            }
        } else {
            $tasks = $taskModel->getItems($startPage, $itemsPerPage);
        }

        $this->setMeta('Home page | Task manager', 'Task manager app', 'task, manager');
        $this->setData(compact('tasks', 'pagination', 'user'));
    }

    public function addAction()
    {
        $errorMessages = [];
        $successMessage = 'Задача успешно добавлена';
        $dbErrorMessage = 'Ошибка добавления задачи';
        $formAction = 'add';
        $user = $this->user;
        $this->setData(compact('formAction', 'user'));

        if (isset($_POST['addTask'])) {
            if (empty($_POST['name'])) {
                $errorMessages[] = 'Не заполнено обязательное поле Имя';
            } elseif (empty($_POST['email'])) {
                $errorMessages[] = 'Не заполнено обязательное поле Email';
            } elseif (empty($_POST['task'])) {
                $errorMessages[] = 'Не заполнено обязательное поле Текст задачи';
            }

            if (!empty($errorMessages)) {
                $this->setData(compact('errorMessages', 'formAction'));
            } else {
                $name = htmlspecialchars(trim($_POST['name']));
                $email = htmlspecialchars(trim($_POST['email']));
                $task = htmlspecialchars(trim($_POST['task']));
                $taskModel = new TaskModel();
                ($taskModel->setTask($name, $email, $task)) ? $this->setData(compact('successMessage', 'formAction'))
                    : $this->setData(compact('dbErrorMessage', 'formAction'));
            }
        }
    }

    public function editAction()
    {
        $errorMessages = [];
        $successMessage = 'Задача успешно отредактирована';
        $dbErrorMessage = 'Ошибка редактирования задачи';

        $this->view = 'add';

        $formAction = 'edit';
        $user = $this->user;
        $this->setData(compact('formAction', 'user'));

        $taskModel = new TaskModel();

        if (isset($_GET['id']) && !empty($this->user) && $this->user['name'] === 'admin') {
            $id = (int)htmlspecialchars($_GET['id']);
            $task = $taskModel->getItem($id);
            setcookie('taskDescription', $task['task_description'], time() + 600);
            $this->setData(compact('task', 'formAction', 'user'));
        }

        if (isset($_POST['addTask'])) {
            if ($_SESSION['user']['name'] === 'admin') {
                if (empty($_POST['name'])) {
                    $errorMessages[] = 'Не заполнено обязательное поле Имя';
                } elseif (empty($_POST['email'])) {
                    $errorMessages[] = 'Не заполнено обязательное поле Email';
                } elseif (empty($_POST['task'])) {
                    $errorMessages[] = 'Не заполнено обязательное поле Текст задачи';
                }

                if (!empty($errorMessages)) {
                    $this->setData(compact('errorMessages', 'formAction', 'user'));
                } else {
                    $taskId = (int)htmlspecialchars($_POST['taskId']);
                    $name = htmlspecialchars(trim($_POST['name']));
                    $email = htmlspecialchars(trim($_POST['email']));
                    $task = htmlspecialchars(trim($_POST['task']));
                    $taskDescription = ($_COOKIE['taskDescription']) ?: null;
                    setcookie('taskDescription', '', time() - 600);
                    $status = ($_POST['status']) ? 1 : null;
                    $edited = ($taskDescription !== $task) ? 1 : null;
                    ($taskModel->editTask($taskId, $name, $email, $task, $status, $edited)) ? $this->setData(compact('successMessage', 'formAction', 'user'))
                        : $this->setData(compact('dbErrorMessage', 'formAction', 'user'));
                }
            } else {
                $this->redirect('login');
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