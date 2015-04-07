<?php
/**
 * Created by PhpStorm.
 * User: Raul
 * Date: 29/03/2015
 * Time: 22:39
 */

class PedidoDTO extends DataTransferObject
{

    private $id_pedido;
    private $id_cliente;
    private $data_pedido;
    private $valortotal;

    /** @var  array */
    private $reflex;

    public function __construct()
    {
        $this->reflex = array(
            'id_pedido' => 'getIdPedido',
            'id_cliente' => 'getIdCliente',
            'data_pedido' => 'getDataPedido',
            'valortotal' => 'getValortotal'
        );
    }

    /**
     * Retorna um array com todos os campos da classe e seus métodos 'Getters'
     * Objetivo: fornecer um meio para que o seu respectivo DAO possa saber
     * dinamicamente quais os campos da tabela e quais métodos executar para
     * resgatar os dados
     * @return array
     */
    public function getReflex()
    {
        return $this->reflex;
    }

    /**
     * @return mixed
     */
    public function getIdPedido()
    {
        return $this->id_pedido;
    }

    /**
     * @return mixed
     */
    public function getIdCliente()
    {
        return $this->id_cliente;
    }

    /**
     * @return mixed
     */
    public function getDataPedido()
    {
        return $this->data_pedido;
    }

    /**
     * @return mixed
     */
    public function getValortotal()
    {
        return $this->valortotal;
    }

    ################### SETTERS #######################

    /**
     * @param mixed $id_pedido
     */
    public function setIdPedido($id_pedido)
    {
        $this->id_pedido = $id_pedido;
    }

    /**
     * @param mixed $id_cliente
     */
    public function setIdCliente($id_cliente)
    {
        $this->id_cliente = $id_cliente;
    }

    /**
     * @param mixed $data_pedido
     */
    public function setDataPedido($data_pedido)
    {
        $this->data_pedido = $data_pedido;
    }

    /**
     * @param mixed $valortotal
     */
    public function setValortotal($valortotal)
    {
        $this->valortotal = $valortotal;
    }
}