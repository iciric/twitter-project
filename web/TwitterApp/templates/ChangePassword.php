<?php

namespace templates;

use Views\AbstractView;

class ChangePassword extends AbstractView
{

    protected function outputHTML()
    {
        ?>

        <script src="/TwitterApp/assets/js/changePasswordValidation.js"></script>

        <div class="container">

            <form class="form-horizontal" id="change-pwd-form" role="form" method="post" action=""
                >

                <div class="form-group">
                    <h3 class="col-md-4 col-md-offset-4">
                        Change password
                    </h3>
                </div>

                <div class="form-group">
                    <div class="col-md-4 col-md-offset-4">
                        <input
                            type="password" class="form-control" name="first" id="first"
                            placeholder="Enter new password" required
                            >
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-4 col-md-offset-4">
                        <input type="password" class="form-control"
                               name="second" id="second"
                               placeholder="Confirm new password" required
                            >

                        <div style="color: red" id="passwordError"></div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-4 col-md-offset-4">
                        <label for="security">Please enter number between 1113 and 1207.</label>
                        <input type="text" class="form-control" name="security" id="security"
                               placeholder="Enter number" required>

                        <div style="color: red" id="securityError"></div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-4 col-md-offset-4">
                        <input type="submit" class="btn btn-info btn-block" name="change-pwd" id="change-pwd"
                               value="Submit changes">
                    </div>
                </div>

            </form>

        </div>

        <?php
    }

}