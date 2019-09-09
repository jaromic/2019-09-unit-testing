<?php

namespace UnitTesting;

class Session
{
    static $instance;

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new Session();
        }

        return self::$instance;
    }

    public function put($key, $value) {
        $_SESSION[$key] = $value;
    }

    public function get($key) {
        if(isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            return null;
        }
    }

    public function start() {
        session_start();
    }

    public function end() {
        session_destroy();
    }
}