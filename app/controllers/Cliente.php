<?php
/**
 * Created by PhpStorm.
 * User: Raul
 * Date: 29/03/2015
 * Time: 22:34
 */

class Cliente extends Controller
{
    /** @var \ClienteModel */
    private $ClienteModel;

    public function __construct()
    { //o método é herdado da classe pai 'Controller'
        $this->setModel(new ClienteDAO());
        $this->clienteModel = new ClienteModel();
    }

    public function start()
    { //Pega a lista completa de perfis
        $cliente_list = (array)$this->model->fullList();

        $dados = array(
            'pagesubtitle' => '',
            'pagetitle' => 'Cliente',
            'list' => $cliente_list
        );

        $this->view = new View('Cliente', 'start');
        $this->view->output($dados);
    }

    public function getFullJSON()
    {
        $result = (array)$this->model->fullList();
        $count = count($result);

        $lista = array();
        if ($count > 0) {
            foreach ($result as $cliente) {
                $lista[] = $this->clienteModel->setDTO($cliente)->getArrayDados();
            }
        }

        $return = array(
            'iTotalRecords' => $count,
            'iTotalDisplayRecords' => 10,
            'sEcho' => 10,
            'aaData' => $lista
        );

        echo json_encode($return, JSON_PRETTY_PRINT);
    }

    /**
     * @todo Sanitizar entrada de dados
     */
    public function cadastra()
    {
        if (Input::exists()) {
            if (Token::check(Input::get('token'))) {

                $cliente = $this->setDados();

                try {
                    $obj = $this->model->gravar($cliente);
                    return $obj;
                } catch (Exception $e) {
                    CodeFail((int)$e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
                }
                return false;
            }
        }
    }

    private function setDados()
    {
        $dto = new clienteDTO();

        $dto->setIdCliente(Input::get('id_cliente'))
            ->setNome(Input::get('nome'))
            ->setCpf(Input::get('cpf'))
            ->setEmail(Input::get('email'))
            ->setDataNascimento(Input::get('data_nascimento'));

        return $dto;
    }

    public function removerCliente(ClienteDTO $dto)
    {
        if (Input::exists()) {

            if (Token::check(Input::get('token'))) {

                $this->model->delete($dto);

            }
        }
    }

    protected function findById($id)
    {
        if (!$obj = $this->model->getById($id)) {
            /** Envia mensagem */
            Session::flash('fail', 'Cadastro não encontrado', 'danger');
            /** Redireciona para página de lista de Perfis */
            Redirect::to(SITE_URL . get_called_class());
        }
        return $obj;
    }

    public function buscaAjax()
    {
        $return = $this->ClienteModel->getCliente();
        echo json_encode($return);
    }

    public function checkExisteCPF()
    {
        $cpf = Input::get('cpf');
        $id = Input::get('id_cliente');

        $return = array(
            'valid' => $this->ClienteModel->existeCPF($cpf, $id)
        );

        echo json_encode($return);
    }

    public function checkExisteEmail()
    {
        $email = Input::get('email');
        $id = Input::get('id_cliente');

        $return = array(
            'valid' => $this->ClienteModel->existeEmail($email, $id)
        );

        echo json_encode($return);
    }
}