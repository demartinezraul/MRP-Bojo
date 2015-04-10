<?php
/**
 * Created by PhpStorm.
 * User: Raul
 * Date: 09/04/2015
 * Time: 17:15
 */

class ProdutoDAO extends DataAccessObject{

    public function __construct()
    {
        parent::__construct();
        $this->tabela = 'tb_produto';
        $this->primaryKey = 'id_produto';
        $this->dataTransfer = 'ProdutoDTO';

    }

    /**
     * @param ProdutoDTO $produto
     * @throws Exception
     */
    public function gravar(ProdutoDTO $produto)
    {
        if ($produto->getIdProduto() == '') {
            if (!$obj = $this->insert($produto)) {
                throw new Exception('Impossível Inserir produto');
            }
        } else {
            if (!$obj = $this->update($produto)) {
                throw new Exception('Impossível Atualizar Produto');
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