<?php

namespace App\Models;

use Core\App;

class Users implements Models
{
    public function find($data)
    {
        $results = App::get('database')->find('users', $data);
        if (!$results) return null;
        return $results[0];
    }

    public function findAll()
    {
        $users = App::get('database')->selectAll('users');
        return $users;
    }

    public function store($data)
    {
        // TODO: Implement store() method.
    }

    public function update()
    {
        // TODO: Implement update() method.
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }
}
