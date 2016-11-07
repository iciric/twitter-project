<?php

namespace Repository;

use includes\libraries\Database;
use Models\TweetComment;

class TweetCommentRepository {

    public static function getTweetComments($tweetID) {
        $db = Database::getInstance();
        $query = $db->prepare("SELECT * FROM tweetcomments WHERE tweetid = ? ORDER BY commid ASC ");
        $query->execute([$tweetID]);
        return $query->fetchAll();
    }

    public static function postComment(TweetComment $comment) {
        $db = Database::getInstance();
        $query = $db->prepare('INSERT INTO tweetcomments (tweetid,userid,content) VALUES (?, ?, ?)');
        $query->execute([$comment->getTweetid(), $comment->getUserid(), $comment->getContent()]);
    }

}