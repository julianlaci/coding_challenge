<?php

namespace App\Middleware;
class Middleware
{
    public function shouldBeLoggedIn()
    {
        if (!isset($_SESSION['userId'])) {
            header('Location: /error');
        }

    }
}
