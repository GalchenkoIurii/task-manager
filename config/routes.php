<?php

use core\Router;


Router::addRoute('^login$', ['controller' => 'Main',
    'action' => 'login']);
Router::addRoute('^logout$', ['controller' => 'Main',
    'action' => 'logout']);

Router::addRoute('^add$', ['controller' => 'Main',
    'action' => 'add']);

//Router::addRoute('^admin$', ['controller' => 'Main',
//    'action' => 'index', 'prefix' => 'admin']);
//Router::addRoute('^admin/?(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$',
//    ['prefix' => 'admin']);

Router::addRoute('^$', ['controller' => 'Main',
    'action' => 'index']);
Router::addRoute('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');