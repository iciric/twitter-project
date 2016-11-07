<?php

namespace templates;

class Index extends \Views\AbstractView {

    protected function outputHTML()
    {

        ?>


        <div class="container">
        <div class="jumbotron">
            <div class="container">
                        <h1 align="center">Welcome to TwitterApp!</h1>
                        <p align="center">This is a simple Twitter application which is used for learning.</p>
            </div>
        </div>
        </div>

        <div class="container">
            <form class="form-horizontal" id="login-form" role="form" method="post" action="<?php echo \route\Route::get("index")->generate(); ?>">

                <div class="form-group">
                    <h3 class="col-md-4 col-md-offset-4">
                        Log in to TwitterApp
                    </h3>
                </div>

                <div class="form-group">
                    <div class="col-md-4 col-md-offset-4">
                        <input type="text" class="form-control" name="username" id="username" placeholder="Enter username" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-4 col-md-offset-4">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" required>
                        <div style="color: red" id="loginError"></div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-4 col-md-offset-4">
                        <input type="submit" class="btn btn-info btn-block" name="login" id="login" value="Login">
                    </div>
                </div>

                <div class="form-group">
                    <div class="text-center">
                        New to TwitterApp? <a href="<?php echo \route\Route::get("register")->generate(); ?>" tabindex="5" class="forget-login">Sign up here</a>
                    </div>
                </div>

            </form>
        </div>

        <?php

    }

}