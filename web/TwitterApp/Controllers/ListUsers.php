<?php

namespace Controllers;

use Repository\FriendRepository;
use Repository\RequestRepository;
use Repository\UserRepository;
use templates\Main;
use templates\ShowFriends;

class ListUsers implements Controller {

    public function action()
    {
        checkUnauthorizedAccess();

        $main = new Main();
        $body = new \templates\ListUsers();
        $users = UserRepository::getAllUsers();
        $body->setUsers($users);
        $main->setPageTitle("Users")->setBody($body);
        echo $main;
    }

    public function showRequests() {

        checkUnauthorizedAccess();

        $main = new Main();
        $body = new \templates\ShowRequests();
        $myID = UserRepository::getIdByUsername($_SESSION['username']);
        $requests = RequestRepository::checksNewRequests($myID);
        $body->setRequests($requests);
        $main->setPageTitle("Friend Requests")->setBody($body);
        echo $main;
    }

    public function showFriends() {

        checkUnauthorizedAccess();

        $users = UserRepository::getAllUsers();

        $main = new Main();
        $body = new ShowFriends();
        $body->setUsers($users);
        $main->setPageTitle("Friends")->setBody($body);
        echo $main;

    }

}