<?php

/**
 * Helper para manipulação da $_SESSION
 */
class Session {

    /**
     * Decobre se existe ou não uma sessão
     * @param string $name
     * @return boolean
     */
    public static function exists($name) {
        return (isset($_SESSION[$name])) ? true : false;
    }

    /**
     * Armazena uma variável na sessão
     * @param string $name
     * @param mixed $value
     * @return mixed
     */
    public static function put($name, $value) {
        return $_SESSION[$name] = $value;
    }

    /**
     * Retorna valor armazenado na sessão
     * @param string $name = nome do valor
     * @return mixed
     */
    public static function get($name) {
        return $_SESSION[$name];
    }

    /**
     * Apaga valor armazenado na sessão
     * @param string $name = nome do valor
     */
    public static function delete($name) {
        if (self::exists($name)) {
            unset($_SESSION[$name]);
        }
    }

    /**
     * Armazena mensagem a ser passada apenas uma vez
     * Ao passar o nome e o valor, os mesmos são armazenados
     * Ao passar somente o nome, a mensagem é retornada em forma de string
     * @param string $name = nome para a mensagem
     * @param string $string = corpo da mensagem
     * @return mixed/string
     */
    public static function flash($name, $string = '') {
        if (self::exists($name)) {
            $session = self::get($name);
            self::delete($name);
            return $session;
        } else {
            self::put($name, $string);
        }
    }

}
