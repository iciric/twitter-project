<?php

namespace Controllers;

use Models\Message;
use Repository\MessageRepository;
use Repository\UserRepository;
use templates\Main;
use templates\ReadMessage;
use templates\ShowMessages;

class Messages implements Controller {

    /**
     * Renders form for sending messages.
     * Sends message content to selected user.
     * If message is sent, user is notified.
     */
    public function action()
    {
        checkUnauthorizedAccess();

        $main = new Main();
        $body = new \templates\SendMessage();
        echo $main->setPageTitle("Send Message")->setBody($body);

        if(post('send')) {

            $senderID = UserRepository::getIdByUsername($_SESSION['username']);
            $recipientID = getIdFromURL();
            $content = htmlentities(trim(post('content')));

            //stvaranje poruke
            $message = new Message();
            $message->setSenderID($senderID);
            $message->setRecipientID($recipientID);
            $message->setContent($content);
            $message->setCreated(date('Y-m-d H:i:s'));

            try {
                //slanje poruke
                MessageRepository::sendMessage($message);
                ?>
                <script src="/TwitterApp/assets/js/messageSent.js"></script>
                <?php
            } catch (\PDOException $e) {
                $e->getMessage();
            }
        }
    }

    /**
     * Shows all recieved messages from all users. Newer messages are on top.
     * If message is unread, user will be notified.
     */
    public function showMessages() {

        checkUnauthorizedAccess();

        $myID = UserRepository::getIdByUsername($_SESSION['username']);
        $messages = MessageRepository::getMessages($myID);

        $main = new Main();
        $body = new ShowMessages();
        $body->setMessages($messages);
        echo $main->setPageTitle("Messages")->setBody($body);
    }

    public function readMessage() {

        checkUnauthorizedAccess();

        $id = getIdFromURL();

        if(null === $id) {
            redirect(\route\Route::get("errorPage")->generate());
        }

        if(intval($id) < 1) {
            redirect(\route\Route::get("errorPage")->generate());
        }

        //dohvati poruku preko id-a
        $message = MessageRepository::getMessageByID($id);
        //obavijesti da je poruka pročitana
        MessageRepository::setRead($id);

        $main = new Main();
        $body = new ReadMessage();
        $body->setMessage($message);
        echo $main->setPageTitle("Read Message")->setBody($body);

    }

}