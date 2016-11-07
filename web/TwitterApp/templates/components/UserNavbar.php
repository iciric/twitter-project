<?php

namespace templates\components;

use Repository\MessageRepository;
use Views\AbstractView;
use Repository\UserRepository;

class UserNavbar extends AbstractView
{

    private $userid;

    protected function outputHTML()
    {

        ?>

        <nav class="navbar navbar-default">
            <div class="container-fluid">

                <div class="navbar-header">
                    <a class="navbar-brand"
                       href="<?php echo \route\Route::get("twitterWall")->generate(array("id" => $this->userid)); ?>"><span
                            class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a>
                </div>

                <script>
                    $(function () {
                        $('#input').keyup(function () {
                            var search = $('#input').val();
                            $.post("<?php echo \route\Route::get("searchBar")->generate()?>", {"search": search}, function (data) {
                                $('.entry').html(data);
                            });
                        });
                    });
                </script>


                <div class="collapse navbar-collapse">

                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-haspopup="true" aria-expanded="false">Menu
                                <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="<?php echo \route\Route::get("listGalleries")->generate(); ?>">Galleries</a>
                                </li>
                                <li><a href="<?php echo \route\Route::get("listUsers")->generate(); ?>">Users</a></li>
                                <li><a href="<?php echo \route\Route::get("showFriends")->generate(); ?>">Friends</a></li>
                            </ul>
                        <li>
                            <?php
                                $color = newRequestNotification();
                            ?>
                            <a style="color: <?php echo $color?>" href="<?php echo \route\Route::get("showRequests")->generate(); ?>">Requests</a>
                        </li>
                        <li>
                            <?php
                            $color = newMessageNotification();
                            ?>
                            <a style="color: <?php echo $color?>" href="<?php echo \route\Route::get("showMessages")->generate(); ?>">Messages</a>
                        </li>
                        <li>
                            <form class="navbar-form navbar-left" role="search">
                                <div class="form-group">
                                    <input type="text" name="search" id="input" class="form-control" placeholder="Search">
                                </div>
                            </form>
                        </li>

                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <ul>
                                <?php

                                $image = UserRepository::getProfilePicture($_SESSION['username']);

                                if ($image == "") {
                                    echo "<img width='50' height='50' src='/TwitterApp/assets/images/profile/default.jpg' alt='Default Profile Pic'>";
                                } else {
                                    echo "<img width='50' height='50' src='/TwitterApp/assets/images/profile/" . $image . "' alt='Default Profile Pic'>";
                                }

                                ?>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-cog"
                                                                                aria-hidden="true"></span> Settings
                                <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?php echo \route\Route::get("changeProfilePicture")->generate(); ?>">Upload
                                        profile picture</a></li>
                                <li><a href="<?php echo \route\Route::get("changeUsername")->generate(); ?>">Change
                                        username</a></li>
                                <li><a href="<?php echo \route\Route::get("changePassword")->generate(); ?>">Change
                                        password</a></li>

                                <?php
                                $user = UserRepository::getUserByID($this->userid);
                                if ($user['visibility'] == 1) {
                                    ?>
                                    <li><a href="<?php echo \route\Route::get("changeVisibility")->generate(); ?>">Hide
                                            from users list</a></li>
                                    <?php
                                } else {
                                    ?>
                                    <li><a href="<?php echo \route\Route::get("changeVisibility")->generate(); ?>">Show
                                            in users list</a></li>
                                    <?php
                                }
                                ?>


                                <li class="divider"></li>
                                <li><a href="<?php echo \route\Route::get("logout")->generate(); ?>">Log Out</a></li>
                            </ul>
                        </li>

                    </ul>
                </div>

            </div>
        </nav>

        <?php
    }

    /**
     * @return mixed
     */
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * @param mixed $userid
     */
    public function setUserid($userid)
    {
        $this->userid = $userid;
        return $this;
    }

}