<?php

namespace Repository;

use includes\libraries\Database;

class ResctrictionRepository {

    public static function addResctriction($fromid, $toid) {
        $db = Database::getInstance();
        $query = $db->prepare('INSERT INTO restrictions (fromid,toid) VALUES (?, ?)');
        $query->execute([$fromid, $toid]);
    }

    public static function removeRestriction($fromid, $toid) {
        $db = Database::getInstance();
        $query = $db->prepare('DELETE FROM restrictions WHERE (fromid = ? AND toid = ?)');
        $query->execute([$fromid, $toid]);
    }

    public static function isBlocked($fromID, $toID) {
        $db = Database::getInstance();
        $query = $db->prepare('SELECT resctrictionid FROM restrictions WHERE (fromid = ? AND toid = ?)');
        $query->execute([$fromID, $toID]);
        return $query->fetch()['resctrictionid'];
    }

}