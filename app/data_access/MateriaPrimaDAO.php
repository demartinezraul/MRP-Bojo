<?php
/**
 * Created by PhpStorm.
 * User: Raul
 * Date: 10/04/2015
 * Time: 20:32
 */

class MateriaPrimaDAO extends DataAccessObject{

    public function __construct()
    {
        parent::__construct();
        $this->tabela = 'tb_materia_prima';
        $this->primaryKey = 'id_materia_prima';
        $this->dataTransfer = 'MateriaPrimaDTO';

    }

    /**
     * @param PessoaJuridicaDTO $pessoaJuridica
     * @return bool|DataTransferObject
     * @throws Exception
     */
    public function gravar(MateriaPrimaDTO $materiaprima)
    {
        if ($materiaprima->getIdMateriaPrima() == '') {
            if (!$obj = $this->insert($materiaprima)) {
                throw new Exception('Impossível Inserir Materia Prima');
            }
        } else {
            if (!$obj = $this->update($materiaprima)) {
                throw new Exception('Impossível Atualizar Materia Prima');
            }
        }

    }

    /**
     * @param $where
     * @return bool | DataTransferObject
     */
    public function get($where)
    {
        return $this->select($where, null, null, null);
    }
}