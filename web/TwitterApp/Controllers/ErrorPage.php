<?php

namespace Controllers;

use templates\Main;

class ErrorPage implements  Controller {

    /**
     * Function renders error page for not existing URLs.
     */
    public function action()
    {
        $body = new \templates\errors\ErrorPage();
        echo $body;
    }


}