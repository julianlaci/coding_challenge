<?php

namespace App\Controllers;

class BaseController
{
    /**
     * Require a view.
     *
     * @param string $name
     * @param array $data
     */
    public function view($name, $data = [])
    {
        extract($data);

        return require "app/views/{$name}.views.php";
    }

    /**
     * Redirect to a new page.
     *
     * @param string $path
     */
    public function redirect($path)
    {
        header("Location: /{$path}");
    }

    /**
     * shows an error message
     * @return mixed
     */
    public function showError()
    {
        return $this->view('error');
    }
}
