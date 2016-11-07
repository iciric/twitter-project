<?php

namespace templates;

use Repository\FriendRepository;
use Repository\RequestRepository;
use Repository\ResctrictionRepository;
use Repository\UserRepository;
use Views\AbstractView;

class UserProfile extends AbstractView
{

    private $user;

    protected function outputHTML()
    {
        ?>

        <div class="container">

            <div class="panel panel-info" id="comments">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo $this->user['username']; ?> profile</h3>
                </div>

                <div class="panel-body">
                    <p>First name: <?php echo $this->user['firstname'] ?></p>

                    <p>Last name: <?php echo $this->user['lastname'] ?></p>

                    <p>E-mail address: <?php echo $this->user['email'] ?></p>

                    <p>
                        <a href="<?php echo \route\Route::get("twitterWall")->generate(array("id" => $this->user['userid'])); ?>">User
                            wall</a></p>
                    <?php

                    $userid = UserRepository::getIdByUsername($_SESSION['username']);
                    //ako otvoreni profil nije profil ulogiranog korisnika
                    if (!($this->user['userid'] == $userid)) {

                        $friendsID = FriendRepository::isFriend($userid, $this->user['userid']);

                        //ako su prijatelji ponuditi opciju Unfriend
                        if ($friendsID != null) {
                            ?>
                            <p><a href="<?php echo \route\Route::get("sendMessage")->generate(array("id" => $this->user['userid'])); ?>" class="btn btn-info">Send Message</a>
                                <a href="<?php echo \route\Route::get("unfriend")->generate(array("id" => $this->user['userid'])); ?>" class="btn btn-danger">Unfriend</a>
                                <?php
                                    $restrictionID = ResctrictionRepository::isBlocked($userid, $this->user['userid']);
                                if($restrictionID == null) {
                                    ?>
                                    <a href="<?php echo \route\Route::get("blockUser")->generate(array("id" => $this->user['userid'])); ?>" class="btn btn-warning">Block user</a></p>
                                    <?php
                                } else {
                                    ?>
                                        <a href="<?php echo \route\Route::get("unblockUser")->generate(array("id" => $this->user['userid'])); ?>" class="btn btn-warning">Unblock user</a></p>
                                    <?php
                                }
                                ?>
                            <?php
                            //ako nisu prijatelji ponuditi opcije za prihvaćanje, odbijanje, uklanjanje
                            //i slanje zahtjeva ovisno o situaciji
                        } else {
                            $getRequestID = RequestRepository::getRequest($this->user['userid'], $userid);
                            $fromRequestID = RequestRepository::getRequest($userid, $this->user['userid']);

                            if ($getRequestID != null) {
                                ?>
                                <p><a href="<?php echo \route\Route::get("acceptRequest")->generate(array("id" => $this->user['userid'])); ?>" class="btn btn-success">Accept</a> | <a href="<?php echo \route\Route::get("deleteRequest")->generate(array("id" => $this->user['userid'])); ?>" class="btn btn-danger">Delete</a>
                                </p>
                                <?php
                            } else if ($fromRequestID != null) {
                                ?>
                                <a href="<?php echo \route\Route::get("cancelRequest")->generate(array("id" => $this->user['userid'])); ?>" class="btn btn-danger">Cancel Request</a>
                                <?php
                            } else {
                                ?>
                                <a href="<?php echo \route\Route::get("sendFriendRequest")->generate(array("id" => $this->user['userid'])); ?>" class="btn btn-info">Send Friend Request</a>
                                <?php
                            }
                        }
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
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

}