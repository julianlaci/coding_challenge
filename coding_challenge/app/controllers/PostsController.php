<?php

namespace App\Controllers;

use Core\App;

class PostsController extends BaseController
{
    public function __construct($model)
    {
        $this->postModel = $model;
    }

    /**
     * @return a html view for the post form
     */
    public function showPostForm()
    {
        return $this->view('addPost');
    }

    public function store()

    {
        $postData = array_intersect_key(
            $_POST,
            array_flip(['title', 'description'])
        );

        $this->postModel->store($postData);

        $this->redirect('');
    }

    public function index()
    {
        $getData = array_intersect_key(
            $_GET,
            array_flip(['page'])
        );
        if (!isset($getData['page'])) {
            $getData['page'] = 0;
        }

        $posts = $this->postModel->getPostForPage($getData['page'], 5, 'created_at');
        $this->view('index', compact('posts'));
    }
}
