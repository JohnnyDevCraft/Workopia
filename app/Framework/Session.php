<?php

namespace Framework;

class Session
{

    /**
     * Starts a PHP Session
     *
     * @return void
     */
    public static function Start() {
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }
    }

    /**
     * Sets a Session Value
     *
     * @param string $key
     * @param $value
     * @return void
     */
    public static function Set(string $key, $value) {
        $_SESSION[$key] = $value;
    }

    /**
     * returns Session Value
     *
     * @param string $key
     * @param null $default
     * @return mixed|null
     */
    public static function Get(string $key, $default = null) {
        return $_SESSION[$key] ?? $default;
    }

    /**
     * Clears a session variable
     *
     * @param string $key
     * @return void
     */
    public static function Clear(string $key){
        if(isset($_SESSION[$key])){
            unset($_SESSION[$key]);
        }
    }

    /**
     * Check if Session key exists
     *
     * @param string $key
     * @return bool
     */
    public static function Has(string $key): bool
    {
        return isset($_SESSION[$key]);
    }


    /**
     * Clears all Session Keys, and destroys session.
     *
     * @return void
     */
    public static function ClearAll(){
        session_unset();
        session_destroy();
    }

}