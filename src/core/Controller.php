<?php

declare(strict_types=1);

namespace app\core;

class Controller
{


    public function render(string $view, $params=[])
    {

        return Application::$app->router->renderView($view, $params);

    }//end render()


}//end class
