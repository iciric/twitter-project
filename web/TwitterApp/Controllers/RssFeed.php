<?php

namespace Controllers;

use Repository\GalleryRepository;
use Repository\PhotoCommentRepository;
use Repository\PhotoRepository;
use Repository\TweetCommentRepository;
use templates\Main;

class RssFeed implements Controller {

    public function action()
    {
        // TODO: Implement action() method.
    }

    public function photoCommentsRss() {

        checkUnauthorizedAccess();
        $photoID = getIdFromURL();
        checkIntValueOfId($photoID);
        $photo = PhotoRepository::getPhotoByID($photoID);

        if($photo == null) {
            redirect(\route\Route::get("errorPage")->generate());
        }

        $photoComments = PhotoCommentRepository::getPhotoComments($photoID);

        $title = "Tweet";
        $link = "http://localhost:8080/TwitterApp/tweet/" . $photoID;
        $description = "List of all comments for selected tweet.";

        generateCommentsRss($title, $link, $description, $photoComments);

    }

    public function tweetCommentsRss() {

        checkUnauthorizedAccess();
        $tweetID = getIdFromURL();
        checkIntValueOfId($tweetID);
        $tweetComments = TweetCommentRepository::getTweetComments($tweetID);

        $title = "Tweet";
        $link = "http://192.168.56.101/TwitterApp/tweet/" . $tweetID;
        $description = "List of all comments for selected tweet.";

        generateCommentsRss($title, $link, $description, $tweetComments);

    }

    public function galleryRssFeed() {

        checkUnauthorizedAccess();
        $galleryID = getIdFromURL();
        checkIntValueOfId($galleryID);
        $gallery = GalleryRepository::getByID($galleryID);

        if($gallery == null) {
            redirect(\route\Route::get("errorPage")->generate());
        }

        $photos = PhotoRepository::getPhotosByGalleryID($galleryID);

        $title = $gallery['title'];
        $link = "http://192.168.56.101/TwitterApp/gallery/" . $galleryID;
        $description = "Images in selected gallery.";

        generateGalleryRss($title, $link, $description, $photos);
    }

}