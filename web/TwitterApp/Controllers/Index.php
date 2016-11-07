<?php

namespace Controllers;
use Controllers\Controller;
use Repository\UserRepository;
use templates\Main;

class Index implements \Controllers\Controller {

    /**
     * Function renders main page and implements user login behaviour.
     * If user is already logged in, he will be redirected to his twitter wall.
     * If user doesn't exist or entered data is wrong, warning message will show.
     */
    public function action()

    {

        if(isLoggedIn()) {
            redirect(\route\Route::get("twitterWall")->generate(array("id" => UserRepository::getIdByUsername($_SESSION['username']))));
        }

        $main = new Main();
        $main->setPageTitle("Twitter App");
        $body = new \templates\Index();
        $main->setBody($body);
        echo $main;

        if(UserRepository::isLoggedIn()) {
            redirect(\route\Route::get("twitterWall")->generate());
        }


        if (post('login')) {

            $username = htmlentities(trim(post('username')));
            $password = htmlentities(trim(post('password')));

            $hashedPassword = hash_password($password);

            if (UserRepository::login($username, $hashedPassword)) {
                redirect(\route\Route::get("twitterWall")->generate(array("id" => UserRepository::getIdByUsername($_SESSION['username']))));
                exit;
            } else {
                ?>
                <script src="assets/js/loginError.js"></script>
                <?php
            }

        }

    }

    //logout korisnika
    public function logout() {
        UserRepository::logout();
        redirect(\route\Route::get("index")->generate());
    }

}