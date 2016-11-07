<?php

namespace templates;

use Views\AbstractView;

class ChangeUsername extends AbstractView {

    protected function outputHTML()
    {
        ?>

        <script src="TwitterApp/assets/js/changeUsernameValidation.js"></script>

        <div class="container">

            <form class="form-horizontal" id="change-username-form" role="form" method="post" action="">

                <div class="form-group">
                    <h3 class="col-md-4 col-md-offset-4">
                        Change username
                    </h3>
                </div>

                <div class="form-group">
                    <div class="col-md-4 col-md-offset-4">
                        <input type="text" class="form-control" name="first" id="first" placeholder="Enter new username" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-4 col-md-offset-4">
                        <input type="text" class="form-control" name="second" id="second" placeholder="Confirm new username" required>
                        <div style="color: red" id="usernameError"></div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-4 col-md-offset-4">
                        <label for="security">Please enter number between 1113 and 1207.</label>
                        <input type="text" class="form-control" name="security" id="security" placeholder="Enter number" required>
                        <div style="color: red" id="securityError"></div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-4 col-md-offset-4">
                        <input type="submit" class="btn btn-info btn-block" name="change-username" id="change-username" value="Submit changes">
                    </div>
                </div>

            </form>

        </div>

        <?php
    }

}