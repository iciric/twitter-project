<?php

namespace templates;

use Views\AbstractView;

class SendMessage extends AbstractView
{

    protected function outputHTML()
    {
        ?>
        <div class="container">
            <form class="form-horizontal" id="send-message-form" role="form" method="post" action=" ">

                <div class="form-group">
                    <h3 class="col-md-4 col-md-offset-4">
                        Send Message
                    </h3>
                </div>

                <div class="form-group">
                    <div class="col-md-4 col-md-offset-4">
                        <textarea class="form-control" rows="5" name="content" id="content"
                                  placeholder="Write a message..."></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-4 col-md-offset-4">
                        <div style="color: green" id="success"></div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-4 col-md-offset-4">
                        <input type="submit" class="btn btn-info btn-block" name="send" id="send" value="Send Message">
                    </div>
                </div>

            </form>
        </div>
        <?php
    }

}