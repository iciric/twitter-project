<?php

namespace Controllers;

use Models\User;
use Repository\UserRepository;
use templates\Main;

class Register implements Controller {

    /**
     * Function is used for registering new users.
     * It checks entered data, register new user and redirects to user's twitter wall.
     * User must enter security number to prevent robot attacks.
     */
    public function action()
    {
        $main = new Main();
        $main->setPageTitle("Sign up for TwitterApp");
        $register = new \templates\Register();
        $main->setBody($register);
        echo $main;

        if(post('register')) {

            $firstName = htmlentities(trim(post('fname')));
            $lastName = htmlentities(trim(post('lname')));
            $username = htmlentities(trim(post('username')));
            $password = trim(post('password'));
            $hashedPassword = hash_password($password);
            $confirmedPassword = trim(post('cpassword'));
            $email = trim(post('email'));
            $userSecurityNumber = (int) trim(post('security'));

            //server-side validation
            $error = false;
            if(!ctype_alpha($firstName) || strlen($firstName) < 3 || strlen($firstName) > 25) {
                $error = true;
            }

            if(!ctype_alpha($lastName) || strlen($lastName) < 3 || strlen($lastName) > 25) {
                $error = true;
            }

            if(!ctype_alnum($username) || strlen($username) < 4 || strlen($lastName) > 25) {
                $error = true;
            }

            if(!ctype_alnum($password) || strlen($password) < 4 || strlen($password) > 25) {
                $error = true;
            }

            if(!ctype_alnum($confirmedPassword) || strlen($confirmedPassword) < 4 || strlen($confirmedPassword) > 25) {
                $error = true;
            }

            if($userSecurityNumber < 1113 || $userSecurityNumber > 1207) {
                $error = true;
            }

            if($password === $confirmedPassword && !$error){

                $user = new User();
                $user->setFirstName($firstName);
                $user->setLastName($lastName);
                $user->setUsername($username);
                $user->setPassword($hashedPassword);
                $user->setEmail($email);

                try {
                    UserRepository::registerUser($user);
                } catch (\PDOException $e) {
                    $e->getMessage();
                }

            }



        }
    }

}