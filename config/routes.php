<?php

use core\Router;


Router::addRoute('^login$', ['controller' => 'Main',
    'action' => 'login']);
Router::addRoute('^logout$', ['controller' => 'Main',
    'action' => 'logout']);

Router::addRoute('^add$', ['controller' => 'Main',
    'action' => 'add']);
Router::addRoute('^edit$', ['controller' => 'Main',
    'action' => 'edit']);

Router::addRoute('^$', ['controller' => 'Main',
    'action' => 'index']);
Router::addRoute('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');