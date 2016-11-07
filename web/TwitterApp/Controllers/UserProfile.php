<?php

namespace Controllers;

use Repository\FriendRepository;
use Repository\RequestRepository;
use Repository\ResctrictionRepository;
use Repository\UserRepository;
use route\Route;
use templates\Main;

class UserProfile implements Controller {

    public function action()
    {

        $id = getIdFromURL();
        $user = UserRepository::getUserByID($id);

        checkRequestURL($id, $user);

        $main = new Main();
        $body = new \templates\UserProfile();
        $user = UserRepository::getUserByID($id);
        $body->setUser($user);
        $main->setPageTitle("User Profile")->setBody($body);
        echo $main;

    }

    public function sendFriendRequest() {

        $profileID = getIdFromURL();
        $user = UserRepository::getUserByID($profileID);
        checkRequestURL($profileID, $user);

        $myID = UserRepository::getIdByUsername($_SESSION['username']);

        RequestRepository::sendFriendRequest($myID, $profileID);
        redirect(Route::get("userProfile")->generate(array("id" => $profileID)));

    }

    public function cancelRequest() {

        $profileID = getIdFromURL();
        $user = UserRepository::getUserByID($profileID);
        checkRequestURL($profileID, $user);

        $myID = UserRepository::getIdByUsername($_SESSION['username']);

        RequestRepository::cancelRequest($myID, $profileID);
        redirect(Route::get("userProfile")->generate(array("id" => $profileID)));
    }

    public function acceptRequest() {

        $profileID = getIdFromURL();
        $user = UserRepository::getUserByID($profileID);
        checkRequestURL($profileID, $user);

        $myID = UserRepository::getIdByUsername($_SESSION['username']);

        RequestRepository::acceptRequest($myID, $profileID);
        RequestRepository::deleteRequest($myID, $profileID);
        redirect(Route::get("userProfile")->generate(array("id" => $profileID)));
    }

    public function deleteRequest() {

        $profileID = getIdFromURL();
        $user = UserRepository::getUserByID($profileID);
        checkRequestURL($profileID, $user);

        $myID = UserRepository::getIdByUsername($_SESSION['username']);

        RequestRepository::deleteRequest($myID, $profileID);
        redirect(Route::get("userProfile")->generate(array("id" => $profileID)));
    }

    public function unfriend() {

        $profileID = getIdFromURL();
        $user = UserRepository::getUserByID($profileID);
        checkRequestURL($profileID, $user);

        $myID = UserRepository::getIdByUsername($_SESSION['username']);

        FriendRepository::unfriend($myID, $profileID);
        redirect(Route::get("userProfile")->generate(array("id" => $profileID)));
    }

    public function blockUser() {
        $profileID = getIdFromURL();
        $activeUserID = UserRepository::getIdByUsername($_SESSION['username']);

        try {
            ResctrictionRepository::addResctriction($activeUserID, $profileID);
            redirect(Route::get("userProfile")->generate(array("id" => $profileID)));
        } catch (\PDOException $e) {
            $e->getMessage();
        }

    }

    public function unblockUser() {
        $profileID = getIdFromURL();
        $activeUserID = UserRepository::getIdByUsername($_SESSION['username']);

        try {
            ResctrictionRepository::removeRestriction($activeUserID, $profileID);
            redirect(Route::get("userProfile")->generate(array("id" => $profileID)));
        } catch (\PDOException $e) {
            $e->getMessage();
        }
    }

}