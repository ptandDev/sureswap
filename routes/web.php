<?php

$router->get('/', ['as' => 'index','uses' => 'IndexController']);
$router->get('{slug}', ['uses' => 'FrontController']);