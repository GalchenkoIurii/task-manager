<?php

namespace core;


class Pagination
{
    public $itemsPerPage;
    public $itemsTotal;
    public $pagesCount;
    public $currentPage;
    public $uri;

    public function __construct($itemsPerPage, $itemsTotal, $page)
    {
        $this->itemsPerPage = $itemsPerPage;
        $this->itemsTotal = $itemsTotal;
        $this->pagesCount = $this->getPagesCount();
        $this->currentPage = $this->getCurrentPage($page);
        $this->uri = $this->getQueryParams();
        var_dump($this->uri);
    }

    public function getPagesCount()
    {
        return ceil($this->itemsTotal / $this->itemsPerPage) ?: 1;
    }

    public function getCurrentPage($page)
    {
        if (!$page || $page < 1) {
            $page = 1;
        } elseif ($page > $this->pagesCount) {
            $page = $this->pagesCount;
        }
        return $page;
    }

    public function getStart()
    {
        return ($this->currentPage - 1) * $this->itemsPerPage;
    }

    public function getQueryParams()
    {
        $url = $_SERVER['REQUEST_URI'];
        $url = explode('?', $url);
        $uri = $url[0] . '?';
        if (isset($url[1]) && $url[1] != '') {
            $params = explode('&', $url[1]);
            foreach ($params as $param) {
                if (!preg_match("#page=#", $param)) {
                    $uri .= "{$param}&amp;";
                }
            }
        }
        return urldecode($uri);
    }
}