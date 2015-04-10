<?php
/**
 * Created by PhpStorm.
 * User: Raul
 * Date: 09/04/2015
 * Time: 20:04
 */

class ProducaoDTO extends DataTransferObject{

    private $id_pedido_produto;
    private $id_pedido;
    private $id_produto;
    private $quantidade;
    private $valorunitario;

    /** @var  array */
    private $reflex;

    public function __construct()
    {
        $this->reflex = array(
            'id_pedido_produto' => 'getIdPedidoProduto',
            'id_pedido' => 'getIdPedido',
            'id_produto' => 'getIdProduto',
            'quantidade' => 'getQuantidade',
            'valorunitario' => 'getValorunitario',
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
    public function getIdPedidoProduto()
    {
        return $this->id_pedido_produto;
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
    public function getIdProduto()
    {
        return $this->id_produto;
    }

    /**
     * @return mixed
     */
    public function getQuantidade()
    {
        return $this->quantidade;
    }

    /**
     * @return mixed
     */
    public function getValorunitario()
    {
        return $this->valorunitario;
    }

    /**
     * @param mixed $id_pedido_produto
     */
    public function setIdPedidoProduto($id_pedido_produto)
    {
        $this->id_pedido_produto = $id_pedido_produto;
        return $this;
    }

    /**
     * @param mixed $id_pedido
     */
    public function setIdPedido($id_pedido)
    {
        $this->id_pedido = $id_pedido;
        return $this;
    }

    /**
     * @param mixed $id_produto
     */
    public function setIdProduto($id_produto)
    {
        $this->id_produto = $id_produto;
        return $this;
    }

    /**
     * @param mixed $quantidade
     */
    public function setQuantidade($quantidade)
    {
        $this->quantidade = $quantidade;
        return $this;
    }

    /**
     * @param mixed $valorunitario
     */
    public function setValorunitario($valorunitario)
    {
        $this->valorunitario = $valorunitario;
        return $this;
    }



}