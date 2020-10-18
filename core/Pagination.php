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

    public function __toString()
    {
        return $this->getHTML();
    }

    public function getHTML()
    {
        $backLink = null;
        $forwardLink = null;
        $startPageLink = null;
        $endPageLink = null;

        if ($this->currentPage > 1) {
            $backLink = "<li class='page-item'><a class='page-link' href='{$this->uri}page="
                . ($this->currentPage - 1) . "'>&lt;</a></li>";
        }
        if ($this->currentPage < $this->pagesCount) {
            $forwardLink = "<li class='page-item'><a class='page-link' href='{$this->uri}page="
                . ($this->currentPage + 1) . "'>&gt;</a></li>";
        }
        if ($this->currentPage > 3) {
            $startPageLink = "<li class='page-item'><a class='page-link' href='{$this->uri}page=1'>В начало</a></li>";
        }
        if ($this->currentPage < ($this->pagesCount - 2)) {
            $endPageLink = "<li class='page-item'><a class='page-link' href='{$this->uri}page="
                . "{$this->pagesCount}'>В конец</a></li>";
        }

        return $startPageLink . $backLink . "<li class='page-item active' aria-current='page'><span class='page-link'>"
            . $this->currentPage . "<span class='sr-only'>(current)</span></span></li>" . $forwardLink . $endPageLink;
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