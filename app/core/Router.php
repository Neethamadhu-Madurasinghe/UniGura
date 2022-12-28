<?php

class Router {
//    Default controller, method and parameter list
    protected string $defaultController = 'Pages';
    protected string $defaultMethod = 'index';
    protected array $params = [];
    protected array $routes = [];
    protected Request $request;


    public function __construct(Request $request) {
        $this->request = $request;
    }

    public function registerController(string $path, array $callback): void {
        $this->routes[trim($path, '/')] = $callback;
    }

    public function resolve() {
        $path = $this->request->getPath();
        $callback = $this->routes[$path] ?? false;

        //      Not found route
        if ($callback === false) {
//            TODO: Handle not found
            echo '<pre>' . $this->request->getPath() . '</pre>';
            die('404');
        }

        if (file_exists('../app/controllers/' . $callback[0] . '.php')) {
            require_once '../app/controllers/' . $callback[0] . '.php';

//          Eg- [ClassName, MethodName]
//          Call the correct method in the controller - request object which as request body and request type is passed
            $callback[0]= new $callback[0]();
            call_user_func($callback, $this->request);
        }

//       Make an object of the Controller class




    }
}