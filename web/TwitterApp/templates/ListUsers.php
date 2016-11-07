<?php

namespace templates;

use Views\AbstractView;

class ListUsers extends AbstractView
{

    private $users;

    protected function outputHTML()
    {
        ?>
        <div class="container">

            <div class="panel panel-info" id="comments">
                <div class="panel-heading">
                    <h3 class="panel-title">Users</h3>
                </div>

                <div class="panel-body">
                    <?php
                        foreach($this->users as $user) {
                            echo "<p><a href='" . \route\Route::get("userProfile")->generate(array("id" => $user['userid'])) . "'>" . $user['username']. "</a></p>";
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
        return $this;
    }

}