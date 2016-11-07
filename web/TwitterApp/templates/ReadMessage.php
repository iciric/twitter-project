<?php

namespace templates;

use Repository\UserRepository;
use Views\AbstractView;

class ReadMessage extends AbstractView
{

    private $message;

    protected function outputHTML()
    {
        $user = UserRepository::getUserByID($this->message['senderid']);

        ?>

        <div class="container">

            <div class="panel panel-info" id="comments">
                <div class="panel-heading">
                    <h3 class="panel-title">Message</h3>
                </div>

                <div class="panel-body">
                    <p>From: <?php echo $user['username']?></p>
                    <p>Content: <?php echo parseText($this->message['content'])?></p>
                    <p><a href="<?php echo \route\Route::get("sendMessage")->generate(array("id" => $user['userid'])); ?>" class="btn btn-info">Reply</a></p>
                </div>
            </div>
        </div>

        <?php
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

}