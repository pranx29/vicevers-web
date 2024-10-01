<?php

class App
{

    protected $controller = "HomeController";
    protected $method = "index";
    protected $params = [];

    public function __construct()
    {
        $this->navigateRoute();
    }

    private function parseUrl()
    {
        if (isset($_GET['url']) && !empty($_GET['url'])) {
            $url = filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL);
            return explode('/', $url);
        }
        return [''];
    }

    private function findRoute($url)
    {
        require_once '../app/routes.php';

        if (isset($url[0])) {
            $route = $url[0];
        }
        if (isset($url[1])) {
            $route = $url[0] . '/' . $url[1];
        }

        // Check if the route exists
        if (isset($routes[$route])) {
            return [
                'controller' => $routes[$route]['controller'],
                'method' => $routes[$route]['method'],
                'params' => array_slice($url, 2)
            ];
        }
    }

    private function invokeAction($controller, $method, $params = [])
    {
        require_once BASE_URL . '/app/controllers/' . $controller . '.php';
        $this->controller = new $controller();
        call_user_func_array([$this->controller, $method], $params);
    }


    private function navigateRoute()
    {
        $url = $this->parseUrl();
        $routeInfo = $this->findRoute($url);

        if ($routeInfo) {
            $this->invokeAction($routeInfo['controller'], $routeInfo['method'], $routeInfo['params']);
        } else {
            echo "404 - Not Found";
        }
    }
}