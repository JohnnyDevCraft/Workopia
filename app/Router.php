<?php

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
    private function registerRoute($method, $uri, $controller){
        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller
        ];
    }

    /**
     * Loads the error page
     *
     * @param int $code
     */
    public function Error($code = 404){
        http_response_code($code);
        loadView("errors/{$code}");
        exit;
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
    public function Route($uri, $method){
        foreach ($this->routes as $route){
            if($route['uri'] === $uri && $route['method'] === $method){
                require basePath($route['controller']);
                return;
            }
        }

        $this->Error(404);
    }
}
