<?php

function newMessageNotification() {
    $userid = \Repository\UserRepository::getIdByUsername($_SESSION['username']);
    $messages = \Repository\MessageRepository::getMessages($userid);
    $unread = false;
    foreach($messages as $message) {
        if($message['readflag'] == 0) {
            $unread = true;
        }
    }

    $color = "default";

    if($unread) {
        $color = "red";
    }
    return $color;
}

function newRequestNotification() {
    $myID = \Repository\UserRepository::getIdByUsername($_SESSION['username']);
    $requests = \Repository\RequestRepository::checksNewRequests($myID);
    $counter = 0;
    foreach ($requests as $r) {
        $counter++;
    }

    $color = "default";
    if($counter > 0) {
        $color = "red";
    }
    return $color;
}