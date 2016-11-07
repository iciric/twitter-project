<?php

namespace Models;

class Tweet extends Model {

    private $fromid;
    private $toid;
    private $content;
    private $image;
    private $tag;

    /**
     * @return mixed
     */
    public function getFromid()
    {
        return $this->fromid;
    }

    /**
     * @param mixed $fromid
     */
    public function setFromid($fromid)
    {
        $this->fromid = $fromid;
    }

    /**
     * @return mixed
     */
    public function getToid()
    {
        return $this->toid;
    }

    /**
     * @param mixed $toid
     */
    public function setToid($toid)
    {
        $this->toid = $toid;
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

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @param mixed $tag
     */
    public function setTag($tag)
    {
        $this->tag = $tag;
    }

}