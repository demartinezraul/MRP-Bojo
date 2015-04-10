<?php
/**
 * Created by PhpStorm.
 * User: Raul
 * Date: 30/03/2015
 * Time: 00:37
 */

class PedidoModel extends Model
{
    /** @var  PedidoDTO */
    private $dto;
    /** @var  PedidoDAO */
    private $dao;

    /**
     *
     */
    public function __construct()
    {
        $this->dao = new PedidoDAO();
    }

    public function getArrayDados()
    {
       $empresa = '';
        if($this->dto->getIdCliente()){
            $empresa = (new ClienteDAO())->getById($this->dto->getIdCliente())->getNome();
        }
        return array(
            'id_pedido' => $this->dto->getIdPedido(),
            'id_cliente' => $this->dto->getIdCliente(),
            'empresa' => $empresa,
            'data_pedido' => $this->dto->getDataPedido(),
            //'valortotal' => $this->dto->getValortotal()

        );
    }

    public function getPedido()
    {
        $_POST = filter_input_array(INPUT_POST);
        $pedido = Input::get('id_pedido');
        $pedidos = $this->dao->get("id_pedido ilike '%{$pedido}%' order by id_pedido limit 5");

        $resultado = array();

        foreach ($pedidos as $pessoa) {
            $resultado[] = $this->setDTO($pessoa)->getBasicInfo();
        }

        return $resultado;
    }

    public function getBasicInfo()
    {
        return array(
            'id' => $this->dto->getIdPedido(),
            'id_cliente' => $this->dto->getIdCliente(),
            'data_pedido' => (new DateTime($this->dto->getDataPedido()))->format('d/m/Y'),
            //'valortotal' => $this->dto->getValortotal()
        );
    }

    public function getDAO()
    {
        return $this->dao;
    }

    public function setDTO(PedidoDTO $dto)
    {
        $this->dto = $dto;
        return $this;
    }
}