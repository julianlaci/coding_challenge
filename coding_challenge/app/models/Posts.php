<?php


namespace App\Models;

use Core\App;

class Posts implements Models
{
    public function find($data)
    {
        $results = App::get('database')->find('posts', $data);
        if (!$results) return null;
        return $results[0];
    }

    public function findAll()
    {
        $posts = App::get('database')->selectAll('posts');
        return $posts;
    }

    public function store($postData)
    {
        $postData['author_id'] = $_SESSION['userId'];
        $post = App::get('database')->insert('posts', $postData);
        return $post;
    }

    public function update()
    {
        // TODO: Implement update() method.
    }

    public function delete()
    {

    }

    public function getPostForPage($page, $limit, $orderBy, $filter = [])
    {
        $posts = App::get('database')->getWithPagination('posts', $page, $limit, $orderBy, $filter, 'users', 'author_id', 'id');
        return $posts;


    }
}
