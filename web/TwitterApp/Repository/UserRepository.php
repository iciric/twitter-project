<?php

namespace Repository;

use includes\libraries\Database;
use Models\User;

class UserRepository {

    public static function isLoggedIn() {
        return(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true);
    }

    public static function login($username, $password) {
        $db = Database::getInstance();
        $query = $db->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
        $query->execute([$username, $password]);
        $result = $query->fetchAll();
        if(count($result) == 1) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            return true;
        } else {
            return false;
        }
    }

    public static function logout(){
        session_destroy();
    }

    public static function registerUser(User $user) {
        $db = Database::getInstance();
        $query = $db->prepare('INSERT INTO users (firstname, lastname, username, password, email) VALUES (?, ?, ?, ?, ?)');
        $query->execute([$user->getFirstName(), $user->getLastName(), $user->getUsername(), $user->getPassword(), $user->getEmail()]);
        $affected = $query->rowCount();
        if($affected == 1) {
            redirect(\route\Route::get("index")->generate());
        } else {

            ?>

            <script>
                document.getElementById("failedRegister").innerHTML =
                    "User already exists.";
            </script>

            <?php
        }
    }

    public static function getAllUsers()
    {
        $db = Database::getInstance();
        $query = $db->prepare("SELECT * FROM users WHERE visibility = 1");
        $query->execute();
        return $query;
    }

    public static function getUserByID($id) {
        $db = Database::getInstance();
        $query = $db->prepare('SELECT * FROM users WHERE userid = ?');
        $query->execute([$id]);
        return $query->fetch();
    }

    public static function getUserByUsername($username) {
        $db = Database::getInstance();
        $query = $db->prepare('SELECT * FROM users WHERE username = ?');
        $query->execute([$username]);
        return $query->fetch();
    }

    public static function getIdByUsername($username) {
        $db = Database::getInstance();
        $query = $db->prepare('SELECT userid FROM users WHERE username = ?');
        $query->execute([$username]);
        return $query->fetch()['userid'];
    }

    public static function changePassword($username, $password) {
        $db = Database::getInstance();
        $query = $db->prepare('UPDATE users SET password = ? WHERE username = ?');
        $query->execute([$password, $username]);
    }

    public static function changeUsername($oldUsername, $newUsername)
    {
        $db = Database::getInstance();
        $query = $db->prepare('UPDATE users SET username = ? WHERE username = ?');
        $query->execute([$newUsername, $oldUsername]);
    }

    public static function getProfilePicture($username) {
        $db = Database::getInstance();
        $query = $db->prepare('SELECT image FROM users WHERE username = ?');
        $query->execute([$username]);
        return $query->fetch()['image'];
    }

    public static function setProfilePicture($username) {
        $db = Database::getInstance();
        $query = $db->prepare("UPDATE users SET image = ? WHERE username = ?");
        $query->execute([$_FILES['file']['name'], $username]);
    }

    public static function searchUsers($str) {
        $db = Database::getInstance();
        $query = $db->prepare('SELECT * FROM users WHERE username LIKE ?');
        $query->execute(['%' . $str . '%']);
        return $query->fetchAll();
    }

    public static function setBackground($image, $userid) {
        $db = Database::getInstance();
        $query = $db->prepare('UPDATE users SET background = ? WHERE userid = ?');
        $query->execute([$image, $userid]);
    }

    public static function hideFromUsersList($userid) {
        $db = Database::getInstance();
        $query = $db->prepare('UPDATE users SET visibility = 0 WHERE userid = ?');
        $query->execute([$userid]);
    }

    public static function showInUsersList($userid) {
        $db = Database::getInstance();
        $query = $db->prepare('UPDATE users SET visibility = 1 WHERE userid = ?');
        $query->execute([$userid]);
    }

}