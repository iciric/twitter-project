<?php

namespace templates;

use Views\AbstractView;

class ListGalleries extends AbstractView
{

    private $galleries;

    protected function outputHTML()
    {
        ?>

        <div class="container">

            <div class="panel panel-info" id="comments">
                <div class="panel-heading">
                    <h3 class="panel-title">Galleries</h3>
                </div>

                <?php
                foreach ($this->galleries as $gallery) {

                    ?>

                    <div class="panel-body">
                        <?php
                        if ($gallery['icon'] == null) {
                            ?>
                            <p><?php echo "<img width='50' height='50' src='/TwitterApp/assets/images/profile/default.jpg' alt='Default Gallery Pic'>"; ?></p>
                            <?php
                        } else {
                            ?>

                            <p><?php echo "<img width='50' height='50' src='/TwitterApp/assets/images/galleries/" . $gallery['title'] . '/' . $gallery['icon'] . "' alt='image'>"; ?></p>

                            <?php
                        }
                        ?>
                        <p>Gallery Title: <?php echo $gallery['title']; ?></p>

                        <p>Gallery Tag: <?php echo $gallery['tag']; ?></p>

                        <p>Created: <?php echo $gallery['created'] ?></p>

                        <p>
                            <a href="<?php echo \route\Route::get("viewGallery")->generate(array("id" => $gallery['galleryid'])); ?>">View
                                Gallery</a></p>
                    </div>

                    <?php

                }

                ?>

                <div class="panel-footer">
                    <p><a href="<?php echo \route\Route::get("addGallery")->generate(); ?>" class="btn btn-danger">Create
                            gallery</a></p>
                </div>

            </div>
        </div>

        <?php

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

}