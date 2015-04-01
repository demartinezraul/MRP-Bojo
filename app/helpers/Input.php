<?php

/**
 * Classe para abstração de retorno de valores das variáveis globais
 * $_POST E $_GET
 */
class Input
{
    /**
     * Descobre se $_POST ou $_GET estão definidos
     * @param string $type = tipo de array, 'post' ou 'get'
     * @return bool
     */
    public static function exists($type = 'post')
    {
        switch ($type) {
            case 'post':
                return (!empty($_POST)) ? true : false;
                break;
            case 'get':
                return (!empty($_GET)) ? true : false;
                break;
            case 'files':
                return (!empty($_FILES)) ? true : false;
                break;
            default:
                return false;
                break;
        }
    }

    /**
     * Retorna um valor armazenado em $_POST ou $_GET
     * @param mixed $item = nome do valor
     * @return mixed
     */
    public static function get($item)
    {
        if (isset($_POST[$item])) {
            return $_POST[$item];
        } else if (isset($_GET[$item])) {
            return $_GET[$item];
        }else if (isset($_FILES[$item])) {
            return $_FILES[$item];
        }
        return '';
    }

    /**
     * Recebe uma string e subtitui caracteres com pontuação
     * ou inválidos para nome de arquivo por traço '-'
     * @param string $nome = String a ser limpa
     * @return string
     */
    public static function limpar($nome)
    {
        $format = array();
        $format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:,\\\'<>°ºª';
        $format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                 ';

        $string = strtr(utf8_decode($nome), utf8_decode($format['a']), $format['b']);
        $string = strip_tags(trim($string));
        $string = str_replace(' ', '-', $string);
        $string = str_replace(array('-----', '----', '---', '--'), '-', $string);

        return strtolower(utf8_encode($string));

    }

}
