<?php
/**
 * Created by PhpStorm.
 * User: Raul
 * Date: 29/03/2015
 * Time: 21:25
 */

class App {

    protected $controller = 'Home';
    protected $method = 'start';
    protected $params = array();

    public function __construct()
    {
        $url = $this->parseUrl();

        if (file_exists('app/controllers/' . $url[0] . '.php')) {
            $this->controller = $url[0];
            unset($url[0]);
        }

        require_once 'app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        //reseta o array para iniciar no zero
        //se params estiver vazio, recebe um array vazio
        $this->params = $url ? array_values($url) : array();

        //Verifica se existe uma sessão de login ativo
        /*        if (1Session::exists('user')) {
                    //caso o usuário não esteja logado
                    //executa o método loginScreen da Classe User
                    require_once 'app/controllers/User.php';
                    $login = new User;
                    $login->loginScreen();
                } else {
                    // caso a sessão 'user' exista, quer dizer que tem um usuário logado
                    // sendo assim, executa o Controller e o método originalmente chamado
                    call_user_func_array(array($this->controller, $this->method), $this->params);
                }*/
        call_user_func_array(array($this->controller, $this->method), $this->params);
    }

    public function parseUrl()
    {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }

}