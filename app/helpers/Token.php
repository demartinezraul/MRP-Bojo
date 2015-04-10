<?php

/**
 * Gera e checa a existência de um Token
 * esse token é usado para evitar "Cross site forgery"
 */
class Token
{

    /**
     * Gera um token e armazena na session
     */
    public static function generate()
    {
        if (Session::exists('token')) {
            Session::delete('token');
        }
        return Session::put(Config::get('session/token_name'), md5(uniqid()));
    }

    /**
     * Faz a checagem do token
     * @param string $token
     * @return boolean
     */
    public static function check($token)
    {
        $tokenName = Config::get('session/token_name');

        if (Session::exists($tokenName) && $token === Session::get($tokenName)) {
            Session::delete($tokenName);
            return true;
        }
        return false;
    }

}