<?php

namespace Models;

class TweetComment extends Model {

    private $tweetid;
    private $userid;
    private $content;

    /**
     * @return mixed
     */
    public function getTweetid()
    {
        return $this->tweetid;
    }

    /**
     * @param mixed $tweetid
     */
    public function setTweetid($tweetid)
    {
        $this->tweetid = $tweetid;
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