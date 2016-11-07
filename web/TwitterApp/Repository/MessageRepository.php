<?php

namespace Repository;

use includes\libraries\Database;
use Models\Message;

class MessageRepository {

    public static function sendMessage(Message $message) {
        $db = Database::getInstance();
        $query = $db->prepare('INSERT INTO messages (senderid, recipientid, content, created) VALUES (?, ?, ?, ?)');
        $query->execute([$message->getSenderID(), $message->getRecipientID(), $message->getContent(), $message->getCreated()]);
    }

    public static function getMessages($myID) {
        $db = Database::getInstance();
        $query = $db->prepare("SELECT * FROM messages WHERE recipientid = ? ORDER BY id DESC ");
        $query->execute([$myID]);
        return $query;
    }

    public static function getMessageByID($id) {
        $db = Database::getInstance();
        $query = $db->prepare('SELECT * FROM messages WHERE id = ?');
        $query->execute([$id]);
        return $query->fetch();
    }

    public static function setRead($id) {
        $db = Database::getInstance();
        $query = $db->prepare('UPDATE messages SET readflag = 1 WHERE id = ?');
        $query->execute([$id]);
    }

    //functions for sorting messages
    public static function newestFirst($myID) {
        $db = Database::getInstance();
        $query = $db->prepare("SELECT * FROM messages WHERE recipientid = ? ORDER BY created, readflag ASC ");
        $query->execute([$myID]);
        return $query;
    }

    public static function oldestFirst($myID) {
        $db = Database::getInstance();
        $query = $db->prepare("SELECT * FROM messages WHERE recipientid = ? ORDER BY created DESC ");
        $query->execute([$myID]);
        return $query;
    }

    public static function unreadFirst($myID) {
        $db = Database::getInstance();
        $query = $db->prepare("SELECT * FROM messages WHERE recipientid = ? ORDER BY readflag ASC ");
        $query->execute([$myID]);
        return $query;
    }

    public static function readFirst($myID) {
        $db = Database::getInstance();
        $query = $db->prepare("SELECT * FROM messages WHERE recipientid = ? ORDER BY readflag DESC ");
        $query->execute([$myID]);
        return $query;
    }

}