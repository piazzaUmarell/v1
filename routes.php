<?php
use Core\Facade\Router;

Router::get('/', 'HomeController@index')->name('homepage');
