<?php

class Hash {

    /**
     * Recebe uma string e combina com outra string ($salt)
     * para formar um hashcode através da função hash() usando
     * o algorítmo 'sha256
     * @param string $string
     * @param string $salt
     * @return hash code
     */
    public static function make($string, $salt = '') {
        return hash('sha256', $string . $salt);
    }

    /**
     * Gera um valor encriptado
     * @param int $length
     * @return valor encriptado
     */
    public static function salt($length) {
        return mcrypt_create_iv($length);
    }

    /**
     * Gera um hash através de um uniqid()
     * @return hashcode
     */
    public static function unique() {
        return self::make(uniqid());
    }

}
