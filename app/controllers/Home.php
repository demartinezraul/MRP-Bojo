<?php
/**
 * Created by PhpStorm.
 * User: Raul
 * Date: 29/03/2015
 * Time: 21:33
 */

class Home extends Controller
{
    private $name;

    /**
     * O construtor apenas instancia um objeto da camada de Modelo (dados)
     */
    public
    function __construct()
    {
        $this->model = new HomeModel;
    }

    public
    function start() // Só um exemplo de parâmetro recebido pelo método
    {

        /** $this->dados é um array que o método envia para a view usando o método output() */
        $this->dados = [
            'pagesubtitle' => 'Olá mundo',
            'pagetitle' => 'Página',
            'name' => ''
        ];

        /** O parâmetros 'Home' define o Controller e 'start' define o método que será executado*/
        $this->view = new View('Home', 'start');
        $this->view->output($this->dados);
    }

    public
    function dashboard($param = 'Alex') // Só um exemplo de parâmetro recebido pelo método
    {

        $this->name = $param;

        /** $this->dados é um array que o método envia para a view usando o método output() */
        $this->dados = [
            'pagesubtitle' => 'Olá mundo',
            'pagetitle' => 'Página',
            'name' => $this->name
        ];

        /** O parâmetros 'Home' define o Controller e 'start' define o método que será executado*/
        $this->view = new View('Home', 'dashboard');
        $this->view->output($this->dados);
    }

    public
    function test()
    {
        $this->dados = [
            'pagesubtitle' => 'Testes com Banco de dados',
            'pagetitle' => 'Testando'
        ];

        $this->view = new View('Home', 'test');
        $this->view->output($this->dados);
    }

}