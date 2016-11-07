<?php

namespace Controllers;

use Repository\GalleryRepository;
use Repository\PhotoRepository;
use templates\Main;

class ViewGallery implements Controller {

    /**
     * Opens selected gallery, shows gallery icon, title and date of creation.
     * Also provides option of adding a new photo to gallery.
     */
    public function action()
    {
        checkUnauthorizedAccess();

        $id = \dispatcher\DefaultDispatcher::instance()->getMatched()->getParam("id");

        if(null === $id) {
            redirect(\route\Route::get("errorPage")->generate());
        }

        if(intval($id) < 1) {
            redirect(\route\Route::get("errorPage")->generate());
        }

        $gallery = GalleryRepository::getByID($id);

        if($gallery == null) {
            redirect(\route\Route::get("errorPage")->generate());
        }

        $main = new Main();
        $body = new \templates\ViewGallery();
        $photos = PhotoRepository::getPhotosByGalleryID($id);
        $gallery = GalleryRepository::getByID($id);
        $body->setGalleryID($id)->setPhotos($photos)->setGallery($gallery);
        $main->setBody($body)->setPageTitle("View gallery");
        echo $main;

    }

}