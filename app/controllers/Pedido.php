<?php
/**
 * Created by PhpStorm.
 * User: Raul
 * Date: 29/03/2015
 * Time: 22:34
 */

class Pedido extends Controller
{
    /** @var \ClienteModel */
    private $PedidoModel;

    public function __construct()
    { //o método é herdado da classe pai 'Controller'
        $this->setModel(new PedidoDAO());
        $this->PedidoModel = new PedidoModel();
    }

    public function start()
    { //Pega a lista completa de perfis
        $pedido_list = (array)$this->model->fullList();

        $dados = array(
            'pagesubtitle' => '',
            'pagetitle' => 'Pedido',
            'list' => $pedido_list
        );

        $this->view = new View('Pedido', 'start');
        $this->view->output($dados);
    }

    public function getFullJSON()
    {
        $result = (array)$this->model->fullList();
        $count = count($result);

        $lista = array();
        if ($count > 0) {
            foreach ($result as $pedido) {
                $lista[] = $this->pedidoModel->setDTO($pedido)->getArrayDados();
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


    public function formpedido($id = null)
    {
        $cliente = (new ClienteDAO())->fullList();

        if ($id) {
            /** @var PedidoDTO */
            $pedidoarr = $this->findById($id);

            $producao = (new ProducaoModel())->getProducaoPedido($id);
            //Formatação de datas

            if ($pedidoarr->getDataPedido()) {
                $nasc = new DateTime($pedidoarr->getDataPedido());
                $pedidoarr->setDataPedido($nasc->format('d/m/Y'));
            }
            $dados = array(
                'pagetitle' => '',
                'pagesubtitle' => '',
                'cliente' => $cliente,
                'producao' => $producao,
                'id' => $id,
                'pedido' => $pedidoarr,
            );

        } else {
            $pedido = new PedidoDTO();
            $dados = array(
                'pagetitle' => 'Cadastro de Pedido',
                'pagesubtitle' => '',
                'cliente' => $cliente,
                'id' => null,
                'pedido' => $pedido
            );
        }

        $this->view = new View('Pedido', 'formpedido');
        $this->view->output($dados);
    }

    public function visualizar($id = null)
    {
        $id = (int)$id;
        $pessoa = $this->findById($id);
        $dadosPessoais = $this->PedidoModel->setDTO($pessoa)->getArrayDados();

        $dados = array(
            //o campo 'obs' vai ser o subtítulo
            'pagesubtitle' => '',
            //o campo 'nome' vai ser o título da página
            'pagetitle' => 'Pedido',
            //todos os atributos do perfil
            'dados_pessoais' => $dadosPessoais,
        );

        $this->view = new View('Pedido', 'visualizar');
        $this->view->output($dados);
    }

    /**
     * @todo Sanitizar entrada de dados
     */
    public function cadastra()
    {
        if (Input::exists()) {
            if (Token::check(Input::get('token'))) {

                $pedido = $this->setDados();

                try {
                    $obj = $this->model->gravar($pedido);
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
        $dto = new pedidoDTO();

        $dto->setIdPedido(Input::get('id_pedido'))
            ->setIdCliente(Input::get('id_cliente'))
            ->setdataPedido(Input::get('data_pedido'));
            //->setValorTotal(Input::get('valortotal'));

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
}