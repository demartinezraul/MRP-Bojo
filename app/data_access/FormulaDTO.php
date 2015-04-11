<?php
/**
 * Created by PhpStorm.
 * User: Raul
 * Date: 10/04/2015
 * Time: 18:13
 */

class FormulaDTO extends DataTransferObject
{
    private $id_formula;
    private $id_produto;
    private $id_materia_prima;
    private $quantidade;

    /** @var  array */
    private $reflex;

    public function __construct()
    {
        $this->reflex = array(
            'id_formula' => 'getIdFormula',
            'id_produto' => 'getIdProduto',
            'id_materia_prima' => 'getIdMateriaPrima',
            'quantidade' => 'getQuantidade',
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
    public function getIdFormula()
    {
        return $this->id_formula;
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
    public function getIdMateriaPrima()
    {
        return $this->id_materia_prima;
    }

    /**
     * @return mixed
     */
    public function getQuantidade()
    {
        return $this->quantidade;
    }

    /**
     * @param mixed $id_formula
     */
    public function setIdFormula($id_formula)
    {
        $this->id_formula = $id_formula;
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
     * @param mixed $id_materia_prima
     */
    public function setIdMateriaPrima($id_materia_prima)
    {
        $this->id_materia_prima = $id_materia_prima;
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


}