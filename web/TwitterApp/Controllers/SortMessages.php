<?php

namespace Controllers;

use Repository\MessageRepository;
use Repository\UserRepository;
use templates\Main;
use templates\ShowMessages;

class SortMessages implements Controller {

    /**
     * Sorts messages by id. Newer messages are listed first.
     * Bigger id means that message is sent later.
     */
    public function action()
    {
        checkUnauthorizedAccess();
        $order = getSortingOrderFromURL();

        $myID = UserRepository::getIdByUsername($_SESSION['username']);

        $messages = MessageRepository::newestFirst($myID);

        if($order == "oldest") {
            $messages = MessageRepository::oldestFirst($myID);

        } else if($order == "unread") {
            $messages = MessageRepository::unreadFirst($myID);
        } else if($order == "read") {
            $messages = MessageRepository::readFirst($myID);
        }

        $main = new Main();
        $body = new ShowMessages();
        $body->setMessages($messages);
        echo $main->setPageTitle("Messages")->setBody($body);
    }

}