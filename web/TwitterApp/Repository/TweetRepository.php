<?php

namespace Repository;

use includes\libraries\Database;
use Models\Tweet;

class TweetRepository {

    public static function getMyTweets($myID) {
        $db = Database::getInstance();
        $query = $db->prepare("SELECT * FROM tweets WHERE toid = ? ORDER BY tweetid DESC ");
        $query->execute([$myID]);
        return $query;
    }

    public static function postTweet(Tweet $tweet) {
        $db = Database::getInstance();
        $query = $db->prepare('INSERT INTO tweets (fromid,toid,content,tag, image) VALUES (?, ?, ?, ?, ?)');
        $query->execute([$tweet->getFromid(),$tweet->getToid(), $tweet->getContent(), $tweet->getTag(), $tweet->getImage()]);
    }

    public static function getTweetById($id) {
        $db = Database::getInstance();
        $query = $db->prepare("SELECT * FROM tweets WHERE tweetid = ?");
        $query->execute([$id]);
        return $query->fetch();
    }

    public static function getNumberOfComments($id) {
        $db = Database::getInstance();
        $query = $db->prepare("SELECT COUNT(tweetid) AS n FROM tweetcomments WHERE tweetid = ?");
        $query->execute([$id]);
        return $query->fetch()['n'];
    }

}