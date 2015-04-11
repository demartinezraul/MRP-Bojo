<?php
/**
 * Created by PhpStorm.
 * User: Raul
 * Date: 09/04/2015
 * Time: 20:04
 */

class ProducaoModel extends Model{

    /** @var  ProducaoDTO */
    private $dto;
    /** @var  ProducaoDAO */
    private $dao;

    /**
     *
     */
    public function __construct()
    {
        $this->dao = new ProducaoDAO();
    }

    public function getArrayDados()
    {
        $produto = '';
        if($this->dto->getIdProduto()){
            $produto = (new ProdutoDAO())->getById($this->dto->getIdProduto())->getDescricao();
        }
        $pedido = '';
        if($this->dto->getIdPedido()){
            $pedido = (new PedidoDAO())->getById($this->dto->getIdPedido())->getIdPedido();
        }
        return array(
            'id_pedido_cliente' => $this->dto->getIdPedidoProduto(),
            'id_pedido' => $this->dto->getIdPedido(),
            'pedido' => $pedido,
            'id_produto' => $this->dto->getIdProduto(),
            'produto' => $produto,
            'quantidade' => $this->dto->getQuantidade(),
            'valorunitario' => $this->dto->getValorunitario()
        );
    }

    public function getProducaoPedido($id)
    {
        $producao = $this->dao->get("id_pedido = {$id}");
        $lista = array();
        foreach ($producao as $prod) {
            $lista[] = $this->setDTO($prod)->getArrayDados();
        }
        return $lista;
    }

    public function getBasicInfo()
    {
        return array(
            'id' => $this->dto->getIdPedidoProduto(),
            'id_pedido' => $this->dto->getIdPedido(),
            'id_produto' => $this->dto->getIdProduto(),
            'quantidade' => $this->dto->getQuantidade(),
            'valorunitario' => $this->dto->getValorunitario()
        );
    }

    public function getDAO()
    {
        return $this->dao;
    }

    public function setDTO(ProducaoDTO $dto)
    {
        $this->dto = $dto;
        return $this;
    }
}