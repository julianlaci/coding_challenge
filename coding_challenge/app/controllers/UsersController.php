<?php

namespace App\Controllers;

use Core\App;

class UsersController extends BaseController
{
    public function __construct($model)
    {
        $this->userModel = $model;
    }

    public function login()
    {
        $loginCredentials = array_intersect_key(
            $_POST,
            array_flip(['username', 'password'])
        );
        $user = $this->userModel->find($loginCredentials);
        if ($user) {
            $_SESSION["userId"] = $user->id;
            $this->redirect('');
        } else {
            $this->redirect('login');
        }

    }

    public function logout()
    {
        if (!isset($_SESSION["userId"])) {
            die('error');

        }
        $user = $this->userModel->find(['id' => $_SESSION["userId"]]);
        if ($user) {
            session_destroy();
            $this->redirect('');
        } else {
            die("user not found");

        }
    }

    public function showLogin()
    {
        return $this->view('login');
    }
}
