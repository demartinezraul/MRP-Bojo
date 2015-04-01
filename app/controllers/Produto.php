<?php
/**
 * Created by PhpStorm.
 * User: Raul
 * Date: 31/03/2015
 * Time: 00:35
 */

class Produto extends Controller{

    /** @var \ProdutoModel */
    private $ProdutoModel;

    public function __construct()
    { //o método é herdado da classe pai 'Controller'
        $this->setModel(new ProdutoDAO());
        $this->ProdutoModel = new ProdutoModel();
    }

    public function start()
    { //Pega a lista completa de perfis
        $produto_list = (array)$this->model->fullList();

        $dados = array(
            'pagesubtitle' => '',
            'pagetitle' => 'Produto',
            'list' => $produto_list
        );

        $this->view = new View('Produto', 'start');
        $this->view->output($dados);
    }

    public function getFullJSON()
    {
        $result = (array)$this->model->fullList();
        $count = count($result);

        $lista = array();
        if ($count > 0) {
            foreach ($result as $produto) {
                $lista[] = $this->ProdutoModel->setDTO($produto)->getArrayDados();
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

                $produto = $this->setDados();

                try {
                    $obj = $this->model->gravar($produto);
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
        $dto = new ProdutoDTO();

        $dto->setIdProduto(Input::get('id_produto'))
            ->setDescricao(Input::get('descricao'))
            ->setTamanho(Input::get('tamanho'))
            ->setCor(Input::get('cor'))
            ->setPreco(Input::get('preco'))
            ->setSaldoEstoque(Input::get('saldo_estoque'));

        return $dto;
    }

    public function removerProduto(ProdutoDTO $dto)
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
}