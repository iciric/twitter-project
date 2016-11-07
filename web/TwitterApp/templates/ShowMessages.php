<?php

namespace templates;

use Repository\UserRepository;
use Views\AbstractView;

class ShowMessages extends AbstractView
{

    private $messages;

    protected function outputHTML()
    {
        ?>

        <div class="container">

            <div class="panel panel-info" id="comments">
                <div class="panel-heading">
                    <h3 class="panel-title">Messages</h3>
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-haspopup="true" aria-expanded="false">Sort By
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="<?php echo \route\Route::get("sortMessages")->generate(array("order" => "newest")); ?>">Newest</a>
                            </li>
                            <li><a href="<?php echo \route\Route::get("sortMessages")->generate(array("order" => "oldest")); ?>">Oldest</a></li>
                            <li><a href="<?php echo \route\Route::get("sortMessages")->generate(array("order" => "unread")); ?>">Unread</a></li>
                            <li><a href="<?php echo \route\Route::get("sortMessages")->generate(array("order" => "read")); ?>">Read</a></li>
                        </ul>
                    </div>
                </div>

                <div class="panel-body">
                    <?php
                    foreach ($this->messages as $message) {
                        $user = UserRepository::getUserByID($message['senderid']);

                        ?>
                        <p><a
                                href="<?php echo \route\Route::get("readMessage")->generate(array("id" => $message['id'])); ?>">From: <?php echo $user['username']; ?></a> | Sent: <?php echo $message['created']?> | <l style="color: red"><?php if ($message['readflag'] == 0) {
                                echo " Unread";
                            } ?></l></p>
                        <?php
                    }
                    ?>
                </div>

            </div>
        </div>

        <?php
    }

    /**
     * @return mixed
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * @param mixed $messages
     */
    public function setMessages($messages)
    {
        $this->messages = $messages;
    }

}