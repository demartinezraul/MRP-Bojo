<?php

class Cookie {

    /**
     * 
     * @param string $name = nome do cookie
     * @return boolean
     */
    public static function exists($name) {
        return (isset($_COOKIE[$name])) ? true : false;
    }

    /**
     * 
     * @param string $name = nome do cookie
     * @return string
     */
    public static function get($name) {
        return $_COOKIE[$name];
    }

    /**
     * 
     * @param string $name
     * @param type $value
     * @param type $expiry
     * @return boolean
     */
    public static function put($name, $value, $expiry) {
        if (setcookie($name, $value, time() + $expiry, '/')) {
            return true;
        }
        return false;
    }

    /**
     * Remove cookie
     * @param string $name = nome do cookie
     */
    public static function delete($name) {
        self::put($name, '', time() - 1);
    }

}
