<?php
/**
 * Created by PhpStorm.
 * User: Raul
 * Date: 29/03/2015
 * Time: 22:39
 */

class PedidoDAO extends DataAccessObject
{

    public function __construct()
    {
        parent::__construct();
        $this->tabela = 'tb_pedido';
        $this->primaryKey = 'id_pedido';
        $this->dataTransfer = 'PedidoDTO';
    }


    public function gravar(PedidoDTO $pedido)
    {
        if ($pedido->getIdPedido() == '') {
            if (!$obj = $this->insert($pedido)) {
                throw new Exception('Impossível Inserir Pedido');
            }
        } else {
            if (!$obj = $this->update($pedido)) {
                throw new Exception('Impossível Atualizar Pedido');
            }
        }
        $obj = $this->getById($obj->getIdPedido());
        return $obj;
    }
    /**
     * @return bool| DataTransferObject
     */
    public function fullList()
    {
        return $this->select(null, null, null, "id_cliente");

    }
}