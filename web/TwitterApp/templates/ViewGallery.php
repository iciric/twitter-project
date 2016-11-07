<?php

namespace templates;

use route\Route;
use Views\AbstractView;

class ViewGallery extends AbstractView
{

    private $galleryID;
    private $gallery;
    private $photos;

    protected function outputHTML()
    {

        ?>

        <div class="container">

        <div class="panel panel-info" id="comments">
            <div class="panel-heading">
                <h3 class="panel-title">Gallery <a href="<?php echo Route::get("galleryRssFeed")->generate(array("id" => $this->galleryID))?>" class="btn btn-info">RSS Feed</a></h3>
            </div>

            <?php

            $counter = 0;

            foreach ($this->photos as $photo) {
                $counter++;
                ?>

                <div class="panel-body">

                    <p><?php echo "<img width='100' height='100' src='" . $photo['path'] . "' alt='image'>"; ?></p>

                    <p>Photo Title: <?php echo $photo['title']; ?></p>

                    <p>Photo Tags: <?php echo $photo['tags']; ?></p>

                    <p>Created: <?php echo $photo['created'] ?></p>

                    <p>
                        <a href="<?php echo \route\Route::get("viewPhoto")->generate(array("id" => $photo['photoid'])); ?>">View
                            Photo</a></p>
                </div>

                <?php

            }

            if ($counter == 0) {
                ?>

                <div class="panel-body">
                    <p>Gallery is empty. To add a photo click the button below.</p>
                </div>

                <?php
            }

            ?>

            <?php
            if (checkPermissionToAddPhotoToGallery($this->gallery)) {
                ?>
                <div class="panel-footer">
                    <p>
                        <a href="<?php echo \route\Route::get("addPhoto")->generate(array("galleryID" => $this->galleryID)); ?>"
                           class="btn btn-danger">Add Photo</a></p>
                </div>
                <?php
            } else {
                ?>
                <div class="panel-footer">
                    <p style='color: red'>Adding photos is enabled only for user who created the gallery.</p>
                </div>

                <?php
            }
            ?>


        </div>



        <?php

    }

    /**
     * @return mixed
     */
    public function getGalleryID()
    {
        return $this->galleryID;
    }

    /**
     * @param mixed $galleryID
     */
    public function setGalleryID($galleryID)
    {
        $this->galleryID = $galleryID;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGallery()
    {
        return $this->gallery;
    }

    /**
     * @param mixed $gallery
     */
    public function setGallery($gallery)
    {
        $this->gallery = $gallery;
        return $this;
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
        return $this;
    }

}