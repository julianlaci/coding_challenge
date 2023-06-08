<?php

$router->get('login', 'UsersController@showLogin');
$router->post('login', 'UsersController@login');
$router->get('logout', 'UsersController@logout', ['shouldBeLoggedIn']);

$router->get('posts', 'PostsController@showPostForm', ['shouldBeLoggedIn']);
$router->post('posts', 'PostsController@store', ['shouldBeLoggedIn']);
$router->get('', 'PostsController@index');
$router->get('error', 'BaseController@showError');



