<?php

require 'vendor/autoload.php';
require 'core/bootstrap.php';

use Core\Router;
use Core\Request;

function lazy_session_start()
{
    if (!isset($_SESSION) || !is_array($_SESSION)) {
        session_start();
    }
}
lazy_session_start();


Router::load('app/routes.php')
    ->direct(Request::uri(), Request::method());
