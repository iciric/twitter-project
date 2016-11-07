<?php

namespace templates;

use Views\AbstractView;
use Repository\UserRepository;

class UploadProfilePicture extends AbstractView
{

    protected function outputHTML()
    {
        ?>

        <div class="container">

            <form class="form-horizontal" id="change-profile-pic" role="form" method="post" action=""
                  enctype="multipart/form-data"
                >

                <div class="form-group">
                    <h3 class="col-md-4 col-md-offset-4">
                        Select profile picture
                    </h3>
                </div>

                <div class="form-group">
                    <div class="col-md-4 col-md-offset-4">
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