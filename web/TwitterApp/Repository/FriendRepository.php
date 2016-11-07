<?php

namespace Repository;

use includes\libraries\Database;

class FriendRepository {

    public static function isFriend($firstID, $secondID) {
        $db = Database::getInstance();
        $query = $db->prepare('SELECT id FROM friends WHERE (user1 = ? AND user2 = ?) OR (user1 = ? AND user2 = ?)');
        $query->execute([$firstID, $secondID, $secondID, $firstID]);
        return $query->fetch()['id'];
    }

    public static function unfriend($firstID, $secondID) {
        $db = Database::getInstance();
        $query = $db->prepare('DELETE FROM friends WHERE (user1 = ? AND user2 = ?) OR (user1 = ? AND user2 = ?)');
        $query->execute([$firstID, $secondID, $secondID, $firstID]);
    }

}