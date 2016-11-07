<?php

namespace Repository;

use includes\libraries\Database;

class RequestRepository {

    public static function getRequest($otherID, $myID) {
        $db = Database::getInstance();
        $query = $db->prepare('SELECT id FROM requests WHERE (fromid = ? AND toid = ?)');
        $query->execute([$otherID, $myID]);
        return $query->fetch()['id'];
    }

    public static function sendRequest($myID, $otherID) {
        $db = Database::getInstance();
        $query = $db->prepare('SELECT id FROM requests WHERE (fromid = ? AND toid = ?)');
        $query->execute([$myID, $otherID]);
        return $query->fetch()['id'];
    }

    public static function sendFriendRequest($myID, $profileID) {
        $db = Database::getInstance();
        $query = $db->prepare('INSERT INTO requests (fromid, toid) VALUES (?, ?)');
        $query->execute([$myID, $profileID]);
    }

    public static function cancelRequest($myID, $profileID) {
        $db = Database::getInstance();
        $query = $db->prepare('DELETE FROM requests WHERE (fromid = ? AND toid = ?)');
        $query->execute([$myID, $profileID]);
    }

    public static function acceptRequest($myID, $profileID) {
        $db = Database::getInstance();
        $query = $db->prepare('INSERT INTO friends (user1, user2) VALUES (?, ?)');
        $query->execute([$myID, $profileID]);
    }

    public static function deleteRequest($myID, $profileID) {
        $db = Database::getInstance();
        $query = $db->prepare('DELETE FROM requests WHERE (fromid = ? AND toid = ?)');
        $query->execute([$profileID, $myID]);
    }

    public static function checksNewRequests($myID) {
        $db = Database::getInstance();
        $query = $db->prepare('SELECT * FROM requests WHERE toid = ?');
        $query->execute([$myID]);
        return $query;
    }

}