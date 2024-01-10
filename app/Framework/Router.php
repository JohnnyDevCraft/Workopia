<?php


namespace Framework;
use App\Controllers\ErrorController;

class Router {
    protected $routes = [];

    /**
     * Registers a route by adding it to the routes array
     *
     * @param $method
     * @param $uri
     * @param $controller
     * @return void
     */
    private function registerRoute($method, $uri, $action){

        list($controller, $controllerMethod) = explode('@', $action);

        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller,
            'controllerMethod' => $controllerMethod
        ];
    }



    /**
     * Add a Get Route
     *
     * @param string $uri
     * @param string $controller
     * @return void
     */
    public function Get($uri, $controller)
    {
        $this->registerRoute('GET', $uri, $controller);
    }

    /**
     * Add a Get Route
     *
     * @param string $uri
     * @param string $controller
     * @return void
     */
    public function Put($uri, $controller)
    {
        $this->registerRoute('PUT', $uri, $controller);
    }

    /**
     * Add a Get Route
     *
     * @param string $uri
     * @param string $controller
     * @return void
     */
    public function Post($uri, $controller)
    {
        $this->registerRoute('POST', $uri, $controller);
    }

    /**
     * Add a Get Route
     *
     * @param string $uri
     * @param string $controller
     * @return void
     */
    public function Delete($uri, $controller)
    {
        $this->registerRoute('DELETE', $uri, $controller);
    }

    /**
     * Routes the request
     *
     * @param string $uri
     * @param string $method
     * @return void
     */
    public function Route($uri){

        $requestMethod = $_SERVER['REQUEST_METHOD'];
        foreach ($this->routes as $route){

            $uriSegments = explode('/', trim($uri, '/'));

            $routeSegments = explode('/', trim($route['uri'], '/') );

            $match = true;

            if( count($uriSegments) === count($routeSegments) && strtoupper($route['method']) === $requestMethod){
                $params = [];
                $match = true;

                for($i = 0; $i < count($uriSegments); $i++){
                    if($routeSegments[$i] !== $uriSegments[$i] &&
                        !preg_match('/\{(.+?)}/', $routeSegments[$i])){
                            $match = false;
                            break;
                        }

                    if(preg_match('/\{(.+?)}/', $routeSegments[$i], $matches)){
                        $params[$matches[1]] = $uriSegments[$i];
                    }


                }
                if($match){

                    $controller = 'App\\Controllers\\' . $route['controller'];
                    $controllerMethod = $route['controllerMethod'];

                    $controllerInstance = new $controller();
                    $controllerInstance->$controllerMethod($params);
                    return;
                }
            }
        }

        ErrorController::NotFound($uri);
    }
}
