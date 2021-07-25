<?php

declare(strict_types=1);

namespace app\controllers;

class SiteController extends Controller
{


    public function contact()
    {
        $params = [ 'name' => 'celphi' ];

        return $this->render('contact', $params);

    }//end contact()


    public function handleContact()
    {
        return "viewing POST of contact";

    }//end handleContact()


}//end class
