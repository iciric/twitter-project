<?php

namespace templates;

use Views\AbstractView;

class AddPhoto extends AbstractView {

    protected function outputHTML()
    {
        ?>

        <script src="/TwitterApp/assets/js/addPhotoValidation.js"></script>

        <div class="container">

            <form class="form-horizontal" id="upload-photo" role="form" method="post" action=""
                  enctype="multipart/form-data"
                >

                <div class="form-group">
                    <h3 class="col-md-4 col-md-offset-4">
                        Upload photo to gallery
                    </h3>
                </div>

                <div class="form-group">
                    <div class="col-md-4 col-md-offset-4">
                        <label for="photo-name">Photo Name:</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="Enter photo name" required>
                        <div style="color: red" id="titleError"></div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-4 col-md-offset-4">
                        <label for="tags">Tags:</label>
                        <input type="text" class="form-control" name="tags" id="tags" placeholder="Enter photo tags separated by space" required>
                        <div style="color: red" id="tagError"></div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-4 col-md-offset-4">
                        <label for="file">Choose photo:</label>
                        <input
                            type="file" class="form-control" name="file" id="file">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-2 col-md-offset-4">
                        <input type="submit" class="btn btn-info btn-block" name="submit" id="submit"
                               value="Submit">
                    </div>
                </div>

            </form>

        </div>

        <?php
    }

}