<?php

namespace Models;

/**
 * Class Photo
 * @package Models
 * Photo contains photo id, gallery id, title, list of tags, date of creation and name of picture.
 */
class Photo extends Model {

    private $galleryid;
    private $title;
    private $tags;
    private $created;
    private $imageName;
    private $imagePath;

    /**
     * @return mixed
     */
    public function getGalleryid()
    {
        return $this->galleryid;
    }

    /**
     * @param mixed $galleryid
     */
    public function setGalleryid($galleryid)
    {
        $this->galleryid = $galleryid;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param mixed $tags
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param mixed $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * @return mixed
     */
    public function getImageName()
    {
        return $this->imageName;
    }

    /**
     * @param mixed $imageName
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;
    }

    /**
     * @return mixed
     */
    public function getImagePath()
    {
        return $this->imagePath;
    }

    /**
     * @param mixed $imagePath
     */
    public function setImagePath($imagePath)
    {
        $this->imagePath = $imagePath;
    }

}