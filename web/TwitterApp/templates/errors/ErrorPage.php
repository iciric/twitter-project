<?php

namespace templates\errors;

use Views\AbstractView;

class ErrorPage extends AbstractView
{

    protected function outputHTML()
    {
        ?>

        <div class="container">
            <h1>Not found.</h1>
            <p>The requested URL was not found on this server.</p>
            <hr/>
        </div>

        <?php
    }

}