<?php
/**
 * Created by PhpStorm.
 * User: Raul
 * Date: 10/04/2015
 * Time: 18:12
 */

class FormulaDAO extends DataAccessObject
{

    public function __construct()
    {
        parent::__construct();
        $this->tabela = 'tb_formula';
        $this->primaryKey = 'id_formula';
        $this->dataTransfer = 'FormulaDTO';
    }

    /**
     * @param PessoaFisicaDTO $pessoaFisica
     * @return bool|DataTransferObject
     * @throws Exception
     */
    public function gravar(FormulaDTO $formula)
    {
        if ($formula->getIdFormula() == '') {
            if (!$obj = $this->insert($formula)) {
                throw new Exception('Impossível Inserir Formula');
            }
        } else {
            if (!$obj = $this->update($formula)) {
                throw new Exception('Impossível Atualizar Formula');
            }
        }
        return $obj;
    }

    /**
     * @return bool| DataTransferObject
     */
    public function fullList()
    {
        return $this->select(null, null, null, "id_formula");

    }

}