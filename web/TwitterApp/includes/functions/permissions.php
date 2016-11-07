<?php

/**
 * Checks if id in URL is not null or not integer.
 * If it is, then redirects to error page.
 * @param $id
 */
function checkIntValueOfId($id) {
    if(null === $id) {
        redirect(\route\Route::get("errorPage")->generate());
    }

    if(intval($id) < 1) {
        redirect(\route\Route::get("errorPage")->generate());
    }
}

/**
 * Checks if id is numerical and if user with provided id exists.
 * @param $id
 * @param $user
 */
function checkRequestURL($id, $user) {
    checkUnauthorizedAccess();
    checkIntValueOfId($id);

    if($user == null) {
        redirect(\route\Route::get("errorPage")->generate());
    }

}

/**
 * Checks if user tried to enter page for which he has not access.
 * It redirects to unauthorized access page.
 */
function checkUnauthorizedAccess() {
    if(!isLoggedIn()) {
        redirect(\route\Route::get("unauthorizedAccess")->generate());
    }
}

/**
 * Checks if user has permission to post tweet.
 * User has permission to post tweet on his own wall or his friend's wall.
 * @return bool
 */
function checkPermissionToTweet() {
    $toid = getIdFromURL();
    $currentID = \Repository\UserRepository::getIdByUsername($_SESSION['username']);

    checkIntValueOfId($toid);

    if($toid != $currentID) {
        if(\Repository\FriendRepository::isFriend($currentID, $toid) == null ||
            \Repository\ResctrictionRepository::isBlocked($toid, $currentID) != null) {
            return false;
        }
    }

    return true;
}

/**
 * Checks if user has permission to comment on tweet.
 * User can comment tweet only if he is friend with user that posted tweet.
 * @return true if user has permission to comment tweet
 */
function checkPermissionToCommentTweet() {
    $tweetid = getIdFromURL();
    $tweet = \Repository\TweetRepository::getTweetById($tweetid);
    $fromID = $tweet['fromid'];
    $toid = $tweet['toid'];
    $currentID = \Repository\UserRepository::getIdByUsername($_SESSION['username']);

    checkIntValueOfId($tweetid);

    if($toid != $currentID) {
        if(\Repository\FriendRepository::isFriend($currentID, $toid) == null ||
            \Repository\ResctrictionRepository::isBlocked($toid, $currentID) != null) {
            return false;
        }
    }

    return true;
}

/**
 * Checks if user has permission to comment on photo or edit tags.
 * User can comment photo or edit tags if he is friend with user that posted the tweet.
 * @return true if user has permission to comment photo or edit tag
 */
function checkPermissionToCommentPhotoAndEditTags() {
    $photoid = getIdFromURL();
    $photo = \Repository\PhotoRepository::getPhotoByID($photoid);
    $activeUserID = \Repository\UserRepository::getIdByUsername($_SESSION['username']);
    $gallery = \Repository\GalleryRepository::getByID($photo['galleryid']);
    $galleryCreatorID = $gallery['userid'];

    if($activeUserID != $galleryCreatorID) {
        if(\Repository\FriendRepository::isFriend($activeUserID, $galleryCreatorID) == null ||
            \Repository\ResctrictionRepository::isBlocked($galleryCreatorID, $activeUserID) != null) {
            return false;
        }
    }

    return true;
}

/**
 * Checks if user has permission to add photo to selected gallery.
 * User can add photo to a gallery only if he created the gallery.
 * @param $gallery
 * @return true if user has permission to add photo to the gallery
 */
function checkPermissionToAddPhotoToGallery($gallery) {
    $galleryCreatorID = $gallery['userid'];
    $activeUserID = \Repository\UserRepository::getIdByUsername($_SESSION['username']);

    return ($activeUserID == $galleryCreatorID);
}