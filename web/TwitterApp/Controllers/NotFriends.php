<?php

namespace Controllers;

use templates\Main;

class NotFriends implements Controller {

    public function action()
    {
        $main = new Main();
        $body = new \templates\errors\NotFriends();
        $main->setPageTitle("Not Friends")->setBody($body);
        echo $main;
    }

}