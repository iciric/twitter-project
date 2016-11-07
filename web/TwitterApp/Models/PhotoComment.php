<?php

namespace Models;

class PhotoComment extends Model {

    private $photoid;
    private $userid;
    private $content;

    /**
     * @return mixed
     */
    public function getPhotoid()
    {
        return $this->photoid;
    }

    /**
     * @param mixed $photoid
     */
    public function setPhotoid($photoid)
    {
        $this->photoid = $photoid;
    }

    /**
     * @return mixed
     */
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * @param mixed $userid
     */
    public function setUserid($userid)
    {
        $this->userid = $userid;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

}