<?php

namespace Core;

class Router
{
    /**
     * All registered routes.
     *
     * @var array
     */
    public $routes = [
        'GET' => [],
        'POST' => []
    ];

    public $middlewares = [
        'GET' => [],
        'POST' => []
    ];

    /**
     * Load a user's routes file.
     *
     * @param string $file
     */
    public static function load($file)
    {
        $router = new static;

        require $file;

        return $router;
    }

    /**
     * Register a GET route.
     *
     * @param string $uri
     * @param string $controller
     */
    public function get($uri, $controller, $middleware = [])
    {
        $this->routes['GET'][$uri] = $controller;
        $this->middlewares['GET'][$uri] = $middleware;
    }

    /**
     * Register a POST route.
     *
     * @param string $uri
     * @param string $controller
     */
    public function post($uri, $controller, $middleware = [])
    {
        $this->routes['POST'][$uri] = $controller;
        $this->middlewares['POST'][$uri] = $middleware;
    }

    /**
     * Load the requested URI's associated controller method.
     *
     * @param string $uri
     * @param string $requestType
     */
    public function direct($uri, $requestType)
    {
        if (array_key_exists($uri, $this->middlewares[$requestType])) {
            $middlewares = $this->middlewares[$requestType][$uri];
            $middlewareClassName = "App\\Middleware\\Middleware";
            $middlewareClass = new $middlewareClassName;
            foreach ($middlewares as $middleware) {
                if (method_exists($middlewareClass, $middleware)) {
                    $middlewareClass->$middleware();
                }
            }
        }


        if (array_key_exists($uri, $this->routes[$requestType])) {
            return $this->callAction(
                ...explode('@', $this->routes[$requestType][$uri])
            );
        }

        throw new Exception('No route defined for this URI.');
    }

    /**
     * Load and call the relevant controller action.
     *
     * @param string $controller
     * @param string $action
     */
    protected function callAction($controller, $action)
    {
        $name = str_replace('Controller', '', $controller);
        $controller = "App\\Controllers\\{$controller}";
        //model name

        $modelName = "App\\Models\\{$name}";
        if(class_exists($modelName)){
            $model = new $modelName;
            $controller = new $controller($model);
        }else{
            $controller = new $controller();
        }

        if (!method_exists($controller, $action)) {
            throw new Exception(
                "{$controller} does not respond to the {$action} action."
            );
        }

        return $controller->$action();
    }
}
