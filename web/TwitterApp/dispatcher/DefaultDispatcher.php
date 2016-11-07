<?php

namespace dispatcher;

use route\Route;

class DefaultDispatcher implements Dispatcher
{

    /**
     * @var Route
     */
    private $matched;
    private static $instance;

    public static function instance()
    {
        if (null === self::$instance) {
            self::$instance = new DefaultDispatcher();
        }
        return self::$instance;
    }

    /**
     * @return Route
     */
    public function getMatched()
    {
        return $this->matched;
    }

    public function dispatch()
    {

        $request = $_SERVER["REQUEST_URI"];
        if (($pos = strpos($request, "?")) !== false) {
            $request = substr($request, 0, $pos);
        }
        $this->matched = null;
        /* @var \route\Route $route */
        foreach (Route::get() as $route) {
            if (!$route->match($request)) {
                continue;
            }
            $this->matched = $route;
            break;
        }

        if (null === $this->matched) {
            throw new \Exception();
        }
        $controller = "\\Controllers\\" . ucfirst($this->matched->getParam("controller"));
        $action = $this->matched->getParam("action");
        //dirty fix to try and load class
        $func = function ($className) {
            throw new \Exception();
        };
        spl_autoload_register($func);
        $ctl = null;
        try {
            $ctl = new $controller;
        } catch (\Exception $e) {
            throw new \Exception();
        }
        spl_autoload_unregister($func);
        if (!is_callable(array($ctl, $action))) {
            throw new \Exception();
        }
        $ctl->$action();
    }

}