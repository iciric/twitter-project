<?php

namespace Controllers;

use models\Gallery;
use Repository\GalleryRepository;
use Repository\UserRepository;
use templates\Main;

class AddGallery implements Controller {

    /**
     * Function creates new gallery and saves it to database.
     * Gallery has user id, title, tag and date of creation.
     * Title and tag are entered by user.
     */
    public function action()
    {
        checkUnauthorizedAccess();

        $main = new Main();
        $main->setPageTitle("Create gallery");
        $body = new \templates\AddGallery();
        $main->setBody($body);
        echo $main;

        $username = $_SESSION['username'];

        if(post('addGallery')) {

            $userID = UserRepository::getIdByUsername($username);
            $title = trim(post('galleryTitle'));
            $tag = trim(post('galleryTag'));
            $dateOfCreation = date('Y-m-d H:i:s');

            //server side validation of data
            $error = false;

            if(strlen($title) < 4 || strlen($title) > 25) {
                $error = true;
            }

            if(strlen($tag) < 3 || strlen($tag) > 25) {
                $error = true;
            }

            if(!$error) {
                $gallery = new Gallery();
                $gallery->setUserID($userID);
                $gallery->setTitle($title);
                $gallery->setTag($tag);
                $gallery->setCreated($dateOfCreation);

                try {
                    GalleryRepository::addGallery($gallery);
                    redirect(\route\Route::get("listGalleries")->generate());
                } catch (\PDOException $e) {
                    $e->getMessage();
                }
            }

        }

    }

}