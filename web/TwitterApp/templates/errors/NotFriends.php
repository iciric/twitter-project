<?php

namespace templates\errors;

use Views\AbstractView;

class NotFriends extends AbstractView
{

    protected function outputHTML()
    {
        ?>

        <div class="container">
            <h1>You are not friends!</h1>
            <p>Please add user as your friend to post or comment tweet or to add tags and comments to photos.</p>
        </div>

        <?php
    }

}