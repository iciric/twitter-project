<?php

namespace Repository;

use includes\libraries\Database;
use Models\Photo;

class PhotoRepository
{

    /**
     * Adds photo to database. Photo is inside gallery with galleryid.
     * @param Photo $photo
     */
    public static function addPhoto(Photo $photo)
    {
        $db = Database::getInstance();
        $query = $db->prepare('INSERT INTO photo (galleryid,title,tags,created,image, path) VALUES (?, ?, ?, ?, ?, ?)');
        $query->execute([$photo->getGalleryid(), $photo->getTitle(), $photo->getTags(), $photo->getCreated(), $photo->getImageName(), $photo->getImagePath()]);
    }

    /**
     * Getts all photos in gallery with provided id.
     * @param $galleryID
     * @return \PDOStatement
     */
    public static function getPhotosByGalleryID($galleryID)
    {
        $db = Database::getInstance();
        $query = $db->prepare("SELECT * FROM photo WHERE galleryid = ?");
        $query->execute([$galleryID]);
        return $query;
    }

    /**
     * Getts photo with provided id.
     * @param $ID
     * @return mixed
     */
    public static function getPhotoByID($ID)
    {
        $db = Database::getInstance();
        $query = $db->prepare("SELECT * FROM photo WHERE photoid = ?");
        $query->execute([$ID]);
        return $query->fetch();
    }

    /**
     * Getts gallery id for provided photo id.
     * @param $photoID
     * @return mixed
     */
    public static function getGalleryID($photoID) {
        $db = Database::getInstance();
        $query = $db->prepare("SELECT galleryid FROM photo WHERE photoid = ?");
        $query->execute([$photoID]);
        return $query->fetch()['galleryid'];
    }

    /**
     * Looks for photos which contain tag that matches provided string.
     * @param $str
     * @return array
     */
    public static function searchPhotos($str) {
        $db = Database::getInstance();
        $query = $db->prepare('SELECT * FROM photo WHERE tags LIKE ?');
        $query->execute(['%' . $str . '%']);
        return $query->fetchAll();
    }

//    public static function advancedPhotoSearch($str) {
//        $db = Database::getInstance();
//        $query = $db->prepare('SELECT * FROM photo WHERE tags LIKE ?');
//        $query->execute(['%' . $str . '%']);
//        return $query->fetchAll();
//    }

    public static function editPhotoTags($tags, $photoID) {
        $db = Database::getInstance();
        $query = $db->prepare('UPDATE photo SET tags = ? WHERE photoid = ?');
        $query->execute([$tags, $photoID]);
    }

    public static function getAllUserPhotos($id) {
        $db = Database::getInstance();
        $query = $db->prepare('SELECT photo.image, photo.path FROM gallery JOIN photo ON gallery.galleryid = photo.galleryid WHERE gallery.galleryid = ?');
        $query->execute([$id]);
        return $query;
    }

    public static function getAllPhotos() {
        $db = Database::getInstance();
        $query = $db->prepare('SELECT * FROM photo');
        $query->execute();
        return $query;
    }

}