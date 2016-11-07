<?php

include_once "includes/config.php";

try {
    \dispatcher\DefaultDispatcher::instance()->dispatch();
}
catch (Exception $e) {

    redirect(\route\Route::get("errorPage")->generate());
}