<?php

namespace templates;

use Repository\FriendRepository;
use Repository\UserRepository;
use Views\AbstractView;

class ShowFriends extends AbstractView {

    private $users;

    protected function outputHTML()
    {
        ?>

        <div class="container">

            <div class="panel panel-info" id="comments">
                <div class="panel-heading">
                    <h3 class="panel-title">Friends</h3>
                </div>

                <div class="panel-body">
                    <?php

                    $myID = UserRepository::getIdByUsername($_SESSION['username']);

                    $counter = 0;

                    foreach($this->users as $user) {
                        $id = FriendRepository::isFriend($myID, $user['userid']);

                        if(count($id) != 0) {
                            $counter++;
                            echo "<p><a href='" . \route\Route::get("userProfile")->generate(array("id" => $user['userid'])) . "'>" . $user['username']. "</a></p>";
                        }
                    }

                    if($counter == 0) {
                        echo "<p>You do not have friends. Please add members.</p>";
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
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @param mixed $users
     */
    public function setUsers($users)
    {
        $this->users = $users;
    }

}