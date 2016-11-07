<?php

namespace Controllers;

use Models\Photo;
use templates\Main;
use Repository\PhotoRepository;
use Repository\GalleryRepository;

class AddPhoto implements Controller
{

    /**
     * Function adds photo to gallery.
     * Photo has user id, title, list of tags, date of creation and name of chosen picture.
     */
    public function action()
    {

        checkUnauthorizedAccess();
        $id = \dispatcher\DefaultDispatcher::instance()->getMatched()->getParam("galleryID");
        checkIntValueOfId($id);

        $gallery = GalleryRepository::getByID($id);

        if ($gallery == null) {
            redirect(\route\Route::get("errorPage")->generate());
        }

        $main = new Main();
        $body = new \templates\AddPhoto();
        $main->setBody($body)->setPageTitle("Upload photo");
        echo $main;

        if (post('submit')) {

            $title = trim(post('title'));
            $tags = trim(post('tags'));

            $error = false;

            if (strlen($title) < 4 || strlen($title) > 25) {
                $error = true;
            }

            if (strlen($tags) < 4 || strlen($tags) > 250) {
                $error = true;
            }

            if (!$error) {
                $dir = $gallery['title'];
                $path = 'assets/images/galleries/' . $dir;
                $localPath = $path . "/" . $_FILES['file']['name'];
                $completePath = "/TwitterApp/" . $path . "/" . $_FILES['file']['name'];

                $photo = new Photo();
                $photo->setGalleryid($id);
                $photo->setTitle($title);
                $photo->setTags($tags);
                $photo->setCreated(date('Y-m-d H:i:s'));
                $photo->setImageName($_FILES['file']['name']);
                $photo->setImagePath($completePath);

                try {

                    if (!file_exists($path)) {
                        mkdir($path);
                    }

                    move_uploaded_file($_FILES['file']['tmp_name'], $localPath);
                    PhotoRepository::addPhoto($photo);

                    redirect(\route\Route::get("viewGallery")->generate(array("id" => $id)));
                } catch (\PDOException $e) {
                    $e->getMessage();
                }
            }

        }

    }

}