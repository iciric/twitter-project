<?php

namespace templates;

use Views\AbstractView;

class AddGallery extends AbstractView
{

    protected function outputHTML()
    {

        ?>

        <script src="/TwitterApp/assets/js/addGalleryValidation.js"></script>

        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <form class="form-horizontal" role="form" id="create-gallery-form" method="post" action="<?php \route\Route::get("addGallery")->generate(); ?>">
                        <div class="form-group">
                            <h3 class="col-md-6 col-md-offset-3">
                                Create gallery
                            </h3>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3" for="email">Gallery Title:</label>

                            <div class="col-md-9">
                                <input type="text" class="form-control" id="galleryTitle" name="galleryTitle"
                                       placeholder="Enter gallery title">
                                <div style="color: red" id="titleError"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="pwd">Gallery Tag:</label>

                            <div class="col-md-9">
                                <input type="text" class="form-control" id="galleryTag" name="galleryTag"
                                       placeholder="Enter gallery tag">
                                <div style="color: red" id="tagError"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-3 col-sm-offset-3">
                                <input type="submit" class="btn btn-block btn-danger" name="addGallery" id="addGallery"
                                       value="Create gallery">
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <?php

    }

}