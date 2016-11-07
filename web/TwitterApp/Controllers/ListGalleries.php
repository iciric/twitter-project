<?php

namespace Controllers;

use templates\Main;
use Repository\UserRepository;
use models\Gallery;
use Repository\GalleryRepository;

class ListGalleries implements Controller {

    /**
     * Function lists all galleries stored in database.
     */
    public function action()
    {

        checkUnauthorizedAccess();

        $main = new Main();
        $body = new \templates\ListGalleries();
        $galleries = GalleryRepository::listGalleries();
        $body->setGalleries($galleries);
        $main->setPageTitle("Galleries")->setBody($body);
        echo $main;


    }

}