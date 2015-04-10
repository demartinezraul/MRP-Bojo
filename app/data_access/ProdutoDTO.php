<?php
/**
 * Created by PhpStorm.
 * User: Raul
 * Date: 09/04/2015
 * Time: 17:15
 */

class ProdutoDTO extends DataTransferObject{

    private $id_produto;
    private $descricao;
    private $tamanho;
    private $cor;
    private $preco;
    private $saldo_estoque;

    /** @var  array */
    private $reflex;

    public function __construct()
    {
        $this->reflex = array(
            'id_produto' => 'getIdProduto',
            'descricao' => 'getDescricao',
            'tamanho' => 'getTamanho',
            'cor' => 'getCor',
            'preco' => 'getPreco',
            'saldo_estoque' => 'getSaldoEstoque'
        );
    }

    /**
     * Deve retornar um array associativo onde os índices são as colunas da tabela
     * e os valores são os métodos 'Getter' da respectiva coluna
     * @return array
     */
    public function getReflex()
    {
        return $this->reflex;
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
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @return mixed
     */
    public function getTamanho()
    {
        return $this->tamanho;
    }

    /**
     * @return mixed
     */
    public function getCor()
    {
        return $this->cor;
    }

    /**
     * @return mixed
     */
    public function getPreco()
    {
        return $this->preco;
    }

    /**
     * @return mixed
     */
    public function getSaldoEstoque()
    {
        return $this->saldo_estoque;
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
     * @param mixed $descricao
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
        return $this;
    }

    /**
     * @param mixed $tamanho
     */
    public function setTamanho($tamanho)
    {
        $this->tamanho = $tamanho;
        return $this;
    }

    /**
     * @param mixed $cor
     */
    public function setCor($cor)
    {
        $this->cor = $cor;
        return $this;
    }

    /**
     * @param mixed $preco
     */
    public function setPreco($preco)
    {
        $this->preco = $preco;
        return $this;
    }

    /**
     * @param mixed $saldoestoque
     */
    public function setSaldoEstoque($saldo_estoque)
    {
        $this->saldo_estoque = $saldo_estoque;
        return $this;
    }


}