<?php
class Config
{
    /**
     * Recebe o array 'config' que foi atribuído a $GLOBALS
     * no arquivo init.php
     * @param string $path = caminho para a configuração
     * String com formato 'configuração/valor'.
     * @return type string = valor da configuração
     * Separa o nome da configuração e valor e retorna o valor.
     */
    public static function get($path = null) {
        if ($path) {
            $config = $GLOBALS['config'];
            $path = explode('/', $path);

            foreach ($path as $bit) {
                if (isset($config[$bit])) {
                    $config = $config[$bit];
                }
            }

            return $config;
        }

        return false;
    }
}