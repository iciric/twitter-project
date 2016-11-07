<?php

namespace Repository;

use includes\libraries\Database;
use Models\PhotoComment;

class PhotoCommentRepository {

    public static function getPhotoComments($photoID) {
        $db = Database::getInstance();
        $query = $db->prepare("SELECT * FROM photocomments WHERE photoid = ? ORDER BY pcommid ASC ");
        $query->execute([$photoID]);
        return $query->fetchAll();
    }

    public static function postComment(PhotoComment $comment) {
        $db = Database::getInstance();
        $query = $db->prepare('INSERT INTO photocomments (photoid,userid,content) VALUES (?, ?, ?)');
        $query->execute([$comment->getPhotoid(), $comment->getUserid(), $comment->getContent()]);
    }

}