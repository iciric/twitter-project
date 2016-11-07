<?php

namespace templates\errors;

use Views\AbstractView;

class UnauthorizedAccess extends AbstractView
{

    protected function outputHTML()
    {
        ?>

        <div class="container">
            <h1>Unauthorized access!</h1>
            <p>Please go to home page and login or sign up.</p>
        </div>

        <?php
    }

}