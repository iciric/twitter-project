<?php

namespace templates;

use Repository\UserRepository;
use Views\AbstractView;

class ShowRequests extends AbstractView {

    private $requests;

    protected function outputHTML()
    {
        ?>

        <div class="container">

            <div class="panel panel-info" id="comments">
                <div class="panel-heading">
                    <h3 class="panel-title">Friend Requests</h3>
                </div>

                <div class="panel-body">
                    <?php

                   $counter = 0;

                        foreach($this->requests as $request) {
                            $counter++;
                            $userid = $request['fromid'];
                            $user = UserRepository::getUserByID($userid);

                            echo "<p><a href='" . \route\Route::get("userProfile")->generate(array("id" => $userid)) . "'>" . $user['username']. "</a></p>";
                        }
                    if($counter == 0) {
                        echo "<p>There are no new friend requests.</p>";
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
    public function getRequests()
    {
        return $this->requests;
    }

    /**
     * @param mixed $requests
     */
    public function setRequests($requests)
    {
        $this->requests = $requests;
    }

}