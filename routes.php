<?php
use Core\Facade\Router;

Router::get('/', 'HomeController@index')->name('homepage');
Router::get('/episodes/latest', 'LatestEpisodeController@show')->name('latest_episode');
