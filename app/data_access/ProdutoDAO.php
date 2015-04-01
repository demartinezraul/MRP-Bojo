<?php
/**
 * Created by PhpStorm.
 * User: Raul
 * Date: 31/03/2015
 * Time: 00:35
 */

class ProdutoDAO extends DataAccessObject
{

    public function __construct()
    {
        parent::__construct();
        $this->tabela = 'tb_produto';
        $this->primaryKey = 'id_produto';
        $this->dataTransfer = 'ProdutoDTO';
    }


    public function gravar(ProdutoDTO $produto)
    {
        if ($produto->getIdProduto() == '') {
            if (!$obj = $this->insert($produto)) {
                throw new Exception('Impossível Inserir Pessoa Física');
            }
        } else {
            if (!$obj = $this->update($produto)) {
                throw new Exception('Impossível Atualizar Pessoa Física');
            }
        }
        $obj = $this->getById($obj->getIdProduto());
        return $obj;
    }
    /**
     * @return bool| DataTransferObject
     */
    public function fullList()
    {
        return $this->select(null, null, null, "id_produto");

    }
}