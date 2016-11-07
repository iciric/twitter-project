<?php

namespace Repository;

use includes\libraries\Database;
use Models\Gallery;

class GalleryRepository
{

    /**
     * Creates gallery and saves it to database.
     * @param Gallery $gallery
     */
    public static function addGallery(Gallery $gallery)
    {

        $db = Database::getInstance();
        $query = $db->prepare('INSERT INTO gallery (userid,title,tag,created) VALUES (?, ?, ?, ?)');
        $query->execute([$gallery->getUserID(), $gallery->getTitle(), $gallery->getTag(), $gallery->getCreated()]);

    }

    /**
     * Getts all galleries from database.
     * @return \PDOStatement
     */
    public static function listGalleries()
    {
        $db = Database::getInstance();
        $query = $db->prepare("SELECT * FROM gallery");
        $query->execute();
        return $query;
    }

    /**
     * Returns gallery with provided id.
     * @param $id
     * @return mixed
     */
    public static function getByID($id)
    {
        $db = Database::getInstance();
        $query = $db->prepare('SELECT * FROM gallery WHERE galleryid = ?');
        $query->execute([$id]);
        return $query->fetch();
    }

    /**
     * Sets gallery icon.
     * @param $icon
     * @param $galleryID
     */
    public static function setGalleryIcon($icon, $galleryID) {
        $db = Database::getInstance();
        $query = $db->prepare('UPDATE gallery SET icon = ? WHERE galleryid = ?');
        $query->execute([$icon, $galleryID]);
    }

    /**
     * Searches gallery tags which contain provided string.
     * @param $str
     * @return array
     */
    public static function searchGalleries($str) {
        $db = Database::getInstance();
        $query = $db->prepare('SELECT * FROM gallery WHERE tag LIKE ?');
        $query->execute(['%' . $str . '%']);
        return $query->fetchAll();
    }

    public static function getUserGalleries($userid)
    {
        $db = Database::getInstance();
        $query = $db->prepare("SELECT * FROM gallery WHERE userid = ?");
        $query->execute([$userid]);
        return $query->fetchAll();
    }

}