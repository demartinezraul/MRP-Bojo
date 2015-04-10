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
     * @param string $css = Informar este parâmetro apenas se estiver enviando mensagem.
     * @return mixed
     */
    public static function put($name, $value, $css = null) {
        $_SESSION[$name] = ( $css ? array('mensagem' => $value, 'css' => $css) : $value);
        return $_SESSION[$name];
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
     * @param string $string = mensagem
     * @param string $css = classe da caixa de mensagem ('info','success','warning','danger')
     * @return mixed/string
     */
    public static function flash($name, $string = '', $css = '') {
        if (self::exists($name)) {
            $session = self::get($name);
            $titulo = 'MENSAGEM!';

            echo "<div class=\"alert alert-dismissable alert-{$session['css']}\">";
            echo '<button type="button" class="close" data-dismiss="alert">×</button>';
            echo "<strong> {$titulo} </strong><br>";
            echo $session['mensagem'];
            echo "</div>";

            self::delete($name);
        } else {
            self::put($name, $string, $css);
        }
        //echo Session::flash('fail');
    }

}
