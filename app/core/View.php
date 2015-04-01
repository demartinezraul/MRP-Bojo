<?php
/**
 * Created by PhpStorm.
 * User: Raul
 * Date: 29/03/2015
 * Time: 21:29
 */

class View
{
    /**
     * @var string = endereço que define qual arquivo de view será requerido
     */
    protected $viewfile;

    /**
     * @param $controllerclass = a classe Controller
     * @param $metodo = o método que será chamado (este definirá qual view será carregada)
     */
    public function __construct($controllerclass, $metodo)
    {
        $this->viewfile = 'app/views/' . $controllerclass . '/' . $metodo . '.php';
    }

    /**
     * @param array $data = array associativo que será enviado para a tela de saída (view)
     * @param string $template = modelo de página que irá carregar a view
     */
    public function output(array $data, $template = 'defaulttemplate')
    {
        $templatefile = 'app/views/' . $template . '.php';

        if (!file_exists($this->viewfile)) {
            $data['pagetitle'] = 'Erro! View não encontrada.';
            $this->viewfile = 'app/views/Erro/errorview.php';
        }

        if (file_exists($templatefile)) {
            require $templatefile;
        } else {
            require 'app/views/defaulttemplate.php';
        }
    }
}