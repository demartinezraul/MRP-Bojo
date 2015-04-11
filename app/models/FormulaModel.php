<?php
/**
 * Created by PhpStorm.
 * User: Raul
 * Date: 10/04/2015
 * Time: 18:13
 */

class FormulaModel extends Model
{
    /** @var  FormulaDTO */
    private $dto;
    /** @var  FormulaDAO */
    private $dao;

    public function __construct()
    {
        $this->dao = new FormulaDAO();
    }

    public function getArrayDados()
    {

        $produto = '';
        if($this->dto->getIdProduto()){
            $produto = (new ProdutoDAO())->getById($this->dto->getIdProduto())->getDescricao();
        }

        $materiaprima = '';
        if($this->dto->getIdMateriaPrima()){
            $materiaprima = (new MateriaPrimaDAO())->getById($this->dto->getIdMateriaPrima())->getDescricao();
        }

        return array(
            'id_formula' => $this->dto->getIdFormula(),
            'id_produto' => $this->dto->getIdProduto(),
            'produto' => $produto,
            'id_materia_prima' => $this->dto->getIdMateriaPrima(),
            'materiaprima' => $materiaprima,
            'quantidade' => $this->dto->getQuantidade()
        );
    }

    public function getFormula()
    {
        $_POST = filter_input_array(INPUT_POST);
        $formula = Input::get('id_formula');
        $pessoas = $this->dao->get("id_formula ilike '%{$formula}%' order by id_formula limit 5");

        $resultado = array();

        foreach ($pessoas as $pessoa) {
            $resultado[] = $this->setDTO($pessoa)->getBasicInfo();
        }

        return $resultado;
    }

    public function getBasicInfo()
    {
        return array(
            'id' => $this->dto->getIdFormula(),
            'id_produto' => $this->dto->getIdProduto(),
            'id_materia_prima' => $this->dto->getIdMateriaPrima(),
            'quantidade' => $this->dto->getQuantidade()
        );
    }

    public function getDAO()
    {
        return $this->dao;
    }

    public function setDTO(FormulaDTO $dto)
    {
        $this->dto = $dto;
        return $this;
    }
}