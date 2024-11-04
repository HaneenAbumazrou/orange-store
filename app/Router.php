<?php


class Router {

    private $routes;

    public function add ($method, $route, $callback) {
        $routePatteren= preg_replace('/\{[a-zA-Z]+\}|/', '([a-zA-Z]+)', $route);
        $this->routes[$method]['#^'.$routePatteren.'$#'] = $callback;
    }

    public function get($route, $callback) {
        $this->add('GET', $route, $callback);
    }

    public function post($route, $callback) {
        $this->add('POST', $route, $callback);
    }

    public function put ($route, $callback) {
        $this->add('PUT', $route, $callback);
    }

    public function delete ($route, $callback) {
        $this->add('DELETE', $route, $callback);
    }

    

    public function dispatch ($requestedRoute) {
        $method = $_SERVER['REQUEST_METHOD'];
        foreach ($this->routes[$method] as $route => $callback) {
            if (preg_match($route, $requestedRoute, $matches)) {
                list($controllerName, $methodName) = explode('@', $callback);
                $controllerFile='controllers/'.$controllerName.'.php';
                if (file_exists($controllerFile)) {
                    require $controllerFile;
                    $controller = new $controllerName();
                    $controller->$methodName;
                    return;
                }
            }

            if(is_callable($callback)) {
                $callback();
                return;
            }
        
    }

  
}

}
