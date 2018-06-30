<?php
use Core\Facade\Router;

Router::get('/', 'HomeController@index')->name('homepage');
Router::get('/episodes/latest', 'LatestEpisodeController@show')->name('latest_episode');
Router::get('/episodes', 'EpisodesController@index')->name('all_episodes');
Router::get('/episodes/page/{pageNumber}', 'PagedEpisodesController@show')->name('paged_episodes');
