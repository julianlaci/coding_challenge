<?php

namespace App\Models;
interface Models
{
    function find($data);

    function findAll();

    function store($data);

    function update();

    function delete();
}
