<?php

namespace core;


abstract class Controller
{
    public $route;
    public $controller;
    public $model;
    public $view;
    public $prefix;
    public $data = [];
    public $meta = ['title' => '', 'description' => '', 'keywords' => ''];
    public $user = [];

    public function __construct($route)
    {
        $this->route = $route;
        $this->controller = $route['controller'];
        $this->model = $route['controller'];
        $this->view = $route['action'];
        $this->prefix = $route['prefix'];
        if (isset($_SESSION['user']['name'])) {
            $this->user['name'] = $_SESSION['user']['name'];
        }
    }

    public function getView()
    {
        $viewObject = new View($this->route, $this->meta, $this->view);
        $viewObject->render($this->data);
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function setMeta($title = '', $description = '', $keywords = '')
    {
        $this->meta['title'] = $title;
        $this->meta['description'] = $description;
        $this->meta['keywords'] = $keywords;
    }

    public function redirect($url = false)
    {
        if ($url) {
            $redirectPath = $url;
        } else {
            $redirectPath = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : PATH;
        }
        header("Location: $redirectPath");
        exit;
    }
}