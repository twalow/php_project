<?php

declare(strict_types=1);

namespace app\core;

class Application
{

    public static string $rootDir;

    public Router $router;

    public Request $request;

    public Response $response;

    public static Application $app;


    public function __construct(string $rootDir)
    {
        self::$rootDir = $rootDir;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->router  = new Router($this->request, $this->response);

    }//end __construct()


    public function run(): void
    {
        echo $this->router->resolve();

    }//end run()


}//end class
