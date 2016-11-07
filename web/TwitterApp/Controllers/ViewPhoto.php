<?php

namespace Controllers;

use Models\PhotoComment;
use Repository\GalleryRepository;
use Repository\PhotoCommentRepository;
use Repository\PhotoRepository;
use Repository\UserRepository;
use templates\Main;

class ViewPhoto implements Controller {

    /**
     * Opens selected photo.
     */
    public function action()
    {

        $id = getIdFromURL();
        checkIntValueOfId($id);

        $photo = PhotoRepository::getPhotoByID($id);
        $comments = PhotoCommentRepository::getPhotoComments($id);

        if($photo == null) {
            redirect(\route\Route::get("errorPage")->generate());
        }


        $galleryID = $photo['galleryid'];
        $gallery = GalleryRepository::getByID($galleryID);
        $galleryTitle = $gallery['title'];

        $main = new Main();
        $body = new \templates\ViewPhoto();
        $body->setPhoto($photo)->setTitle($galleryTitle)->setComments($comments);

        echo $main->setBody($body)->setPageTitle("View Photo");
    }

    /**
     * Sets selected photo as gallery icon.
     */
    public function setGalleryIcon() {

        $id = getIdFromURL();
        checkUnauthorizedAccess();

        $photo = PhotoRepository::getPhotoByID($id);
        $galleryID = PhotoRepository::getGalleryID($id);
        $icon = $photo['image'];

        try {
            GalleryRepository::setGalleryIcon($icon, $galleryID);
            redirect(\route\Route::get("listGalleries")->generate());
        } catch (\PDOException $e) {
            $e->getMessage();
        }

    }

    public function setUserBackground() {

        $id = getIdFromURL();
        checkUnauthorizedAccess();

        $photo = PhotoRepository::getPhotoByID($id);
        $galleryID = PhotoRepository::getGalleryID($id);
        $gallery = GalleryRepository::getByID($galleryID);
        $background = $gallery['title'] . '/' . $photo['image'];

        $userid = UserRepository::getIdByUsername($_SESSION['username']);

        try {
            UserRepository::setBackground($background, $userid);
            redirect(\route\Route::get("viewPhoto")->generate(array("id" => $photo['photoid'])));
        } catch (\PDOException $e) {
            $e->getMessage();
        }
    }

    public function postPhotoComment()
    {
        checkUnauthorizedAccess();
        $id = getIdFromURL();
        checkIntValueOfId($id);

        if (post('comment')) {
            $photoID = $id;
            $username = $_SESSION['username'];
            $userid = UserRepository::getIdByUsername($_SESSION['username']);
            $content = htmlentities(trim(post('comment')));

            $comment = new PhotoComment();
            $comment->setPhotoid($photoID);
            $comment->setUserid($userid);
            $comment->setContent($content);

            try {
                PhotoCommentRepository::postComment($comment);
                echo json_encode([
                    'comment' => parseText($comment->getContent()),
                    'user' => $username
                ]);
            } catch (\PDOException $e) {
                $e->getMessage();
            }
        }
    }

    public function editPhotoTags() {
        checkUnauthorizedAccess();
        $id = getIdFromURL();
        checkIntValueOfId($id);

        if(post('postTags')) {
            $tags = post('tags');
            try {
                PhotoRepository::editPhotoTags($tags, $id);
                redirect(\route\Route::get("viewPhoto")->generate(array("id" => $id)));
            } catch (\PDOException $e) {
                $e->getMessage();
            }
        }
    }

}