<?php

namespace templates;

use Views\AbstractView;

class SearchResults extends AbstractView
{

    private $users;
    private $galleries;
    private $photos;

    protected function outputHTML()
    {
        ?>
        <h3>Search results</h3>

        <?php
        echo "<h5>Users:</h5>";
        if (count($this->users) == 0) {
            echo "<div>No results</div>";
            echo "<br>";
        } else {
            foreach ($this->users as $user) {
                ?>
                <div>
                    <a href="<?php echo \route\Route::get("twitterWall")->generate(array("id" => $user['userid'])); ?>">
                        <?php echo $user['username'] ?>
                    </a>
                </div>
                <?php
            }
            echo "<br>";
        }

        echo "<h5>Galleries:</h5>";
        if (count($this->galleries) == 0) {
            echo "<div>No results</div>";
            echo "<br>";
        } else {

            foreach ($this->galleries as $photo) {
                ?>
                <div>
                    <a href="<?php echo \route\Route::get("viewGallery")->generate(array("id" => $photo['galleryid'])); ?>">
                        <?php echo $photo['title'] ?>
                    </a>
                </div>
                <?php
            }
            echo "<br>";
        }

        echo "<h5>Photos:</h5>";
        if (count($this->photos) == 0) {
            echo "<div>No results</div>";
            echo "<br>";
        } else {

            foreach ($this->photos as $photo) {
                ?>
                <div>
                    <a href="<?php echo \route\Route::get("viewPhoto")->generate(array("id" => $photo['photoid'])); ?>">
                        <?php echo $photo['title'] ?>
                    </a>
                </div>
                <?php
            }
            echo "<br>";
        }

        ?>
        <br>

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

    /**
     * @return mixed
     */
    public function getGalleries()
    {
        return $this->galleries;
    }

    /**
     * @param mixed $galleries
     */
    public function setGalleries($galleries)
    {
        $this->galleries = $galleries;
    }

    /**
     * @return mixed
     */
    public function getPhotos()
    {
        return $this->photos;
    }

    /**
     * @param mixed $photos
     */
    public function setPhotos($photos)
    {
        $this->photos = $photos;
    }

}