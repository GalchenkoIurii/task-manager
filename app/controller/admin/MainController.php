<?php
/**
 * Created by PhpStorm.
 * User: Iurii
 * Date: 10.10.2020
 * Time: 16:14
 */

namespace app\controller\admin;


use core\Controller;

class MainController extends Controller
{
    public function indexAction()
    {
        $this->setMeta('Admin | Task manager');
        $this->setData(compact());
    }
}