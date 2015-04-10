<?php
/**
 * Created by PhpStorm.
 * User: Raul
 * Date: 09/04/2015
 * Time: 20:03
 */

class Producao extends Controller {

    /** @var \ProducaoModel */
    private $producaoModel;

    public function __construct()
    { //o método é herdado da classe pai 'Controller'
        $this->setModel(new ProducaoDAO());
        $this->producaoModel = new ProducaoModel();
    }

    public function start()
    { //Pega a lista completa de perfis
        $producao_list = (array)$this->model->fullList();

        $dados = array(
            'pagesubtitle' => '',
            'pagetitle' => 'Pedido Produto',
            'list' => $producao_list
        );

        $this->view = new View('Producao', 'formproducao');
        $this->view->output($dados);
    }

    public function getFullJSON()
    {
        $result = (array)$this->model->fullList();
        $count = count($result);

        $lista = array();
        if ($count > 0) {
            foreach ($result as $producao) {
                $lista[] = $this->producaoModel->setDTO($producao)->getArrayDados();
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

    public function formproducao($id = null)
    {
        $pedido = (new PedidoDAO())->fullList();
        $produto = (new ProdutoDAO())->fullList();


        if ($id) {
            /** @var PedidoDTO */
            $producaoarr = $this->findById($id);

            $dados = array(
                'pagetitle' => '',
                'pagesubtitle' => '',
                'pedido' => $pedido,
                'produto' => $produto,
                'id' => $id,
                'producao' => $producaoarr,
            );

        } else {
            $producao = new ProducaoDTO();
            $dados = array(
                'pagetitle' => 'Cadastro de Pedido Produto',
                'pagesubtitle' => '',
                'pedido' => $pedido,
                'produto' => $produto,
                'id' => null,
                'producao' => $producao
            );
        }

        $this->view = new View('Producao', 'formproducao');
        $this->view->output($dados);
    }

    /**
     * @todo Sanitizar entrada de dados
     */
    public function cadastra()
    {
        if (Input::exists()) {
            if (Token::check(Input::get('token'))) {

                $producao = $this->setDados();

                try {
                    $obj = $this->model->gravar($producao);
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
        $dto = new ProducaoDTO();

        $dto->setIdPedidoProduto(Input::get('id_pedido_produto'))
            ->setIdPedido(Input::get('id_pedido'))
            ->setIdProduto(Input::get('id_produto'))
            ->setQuantidade(Input::get('quantidade'))
            ->setValorunitario(Input::get('valorunitario'));

        return $dto;
    }

    public function removerProduto(ProducaoDTO $dto)
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
}