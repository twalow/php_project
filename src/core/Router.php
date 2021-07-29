<?php

declare(strict_types=1);

namespace app\core;

class Router
{

    public Request $request;

    public Response $response;

    protected array $routes = [];


    public function __construct(Request $request, Response $response)
    {

        $this->request = $request;
        $this->response = $response;

    }//end __construct()


    public function get(string $path, $callback): void
    {
        $this->routes['get'][$path] = $callback;

    }//end get()


    public function post(string $path, callable $callback): void
    {
        $this->routes['post'][$path] = $callback;

    }//end post()


    public function resolve(): string
    {

        $path = $this->request->getPath();
        $method = $this->request->getMethod();

        $callback = ($this->routes[$method][$path] ?? false);

        if ($callback === false) {
            $this->response->setStatusCode(404);
            return "Not found";
        }

        if (is_string($callback)) {
            return $this->renderView($callback);
        }

        if (is_array($callback)) {
            $callback[0] = new $callback[0];
        }

        return call_user_func($callback);

    }//end resolve()


    public function renderView(string $view, array $params=[]): string
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderViewOnly($view, $params);
        return str_replace('{{content}}', $viewContent, $layoutContent);

    }//end renderView()


    protected function layoutContent(): string
    {
        ob_start();
        include_once Application::$rootDir.'/views/layouts/main.php';
        return ob_get_clean();

    }//end layoutContent()


    protected function renderViewOnly(string $view, array $params): string
    {
        extract($params, EXTR_SKIP);

        ob_start();
        include_once Application::$rootDir."/views/$view.php";
        return ob_get_clean();

    }//end renderViewOnly()


}//end class
