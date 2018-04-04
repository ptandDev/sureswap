<?php

//$router->get('parser', ['uses' => 'ParseController@run']);
//$router->get('parse', ['uses' => 'ParseController@parseCitiesCbr']);
$router->get('/', ['as' => 'index','uses' => 'IndexController']);
$router->get('{slug}', ['uses' => 'FrontController']);