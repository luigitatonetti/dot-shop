<?php
include_once './app/controllers/OrdersController.php';
include_once './app/controllers/ProductsController.php';
include_once './app/controllers/UsersController.php';

class Router
{
    protected $routes;

    function load($routes)
    {
        $this->routes = $routes;
    }

    public function direct($uri, $requestType)
    {
        if (array_key_exists($uri, $this->routes[$requestType])) {
            return $this->callAction(
                ...explode('@', $this->routes[$requestType][$uri])
            );
        }

        foreach ($this->routes[$requestType] as $regex => $controller) {
            $pattern = preg_replace('/\/:[a-zA-Z0-9]+/', '\/[a-zA-Z0-9]+', $regex);
            $pattern = '/' . $pattern . '/';
            if (preg_match($pattern, $uri) === 1) {
                return $this->callAction(
                    ...explode('@', $this->routes[$requestType][$regex])
                );
            }
        }

        throw new Exception('No route defined for this URI.');
    }

    protected function callAction($controller, $action)
    {
        $controller = new $controller;

        if (! method_exists($controller, $action)) {
            throw new Exception(
                "{$controller} does not respond to the {$action} action."
            );
        }

        return $controller->$action();
    }
}


