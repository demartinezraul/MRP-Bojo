<?php
/**
 * Created by PhpStorm.
 * User: Raul
 * Date: 10/04/2015
 * Time: 20:32
 */

class MateriaPrimaDTO extends DataTransferObject{

    private $id_materia_prima;
    private $descricao;
    private $preco;
    private $saldo_estoque;

    /** @var  array */
    private $reflex;

    public function __construct()
    {
        $this->reflex = array(
            'id_materia_prima' => 'getIdMateriaPrima',
            'descricao' => 'getDescricao',
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
    public function getIdMateriaPrima()
    {
        return $this->id_materia_prima;
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
     * @param mixed $id_materia_prima
     */
    public function setIdMateriaPrima($id_materia_prima)
    {
        $this->id_materia_prima = $id_materia_prima;
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
     * @param mixed $preco
     */
    public function setPreco($preco)
    {
        $this->preco = $preco;
        return $this;
    }

    /**
     * @param mixed $saldo_estoque
     */
    public function setSaldoEstoque($saldo_estoque)
    {
        $this->saldo_estoque = $saldo_estoque;
        return $this;
    }


}