<?php
/**
 * Created by PhpStorm.
 * User: Raul
 * Date: 09/04/2015
 * Time: 20:03
 */

class ProducaoDAO extends DataAccessObject {

    public function __construct()
    {
        parent::__construct();
        $this->tabela = 'tb_pedido_produto';
        $this->primaryKey = 'id_pedido_produto';
        $this->dataTransfer = 'ProducaoDTO';
    }

    /**
     * @param ProducaoDTO $producao
     * @return bool|DataTransferObject
     * @throws Exception
     */
    public function gravar(ProducaoDTO $producao)
    {
        if ($producao->getIdPedidoProduto() == '') {
            if (!$obj = $this->insert($producao)) {
                throw new Exception('Impossível Inserir Pedido Produto');
            }
        } else {
            if (!$obj = $this->update($producao)) {
                throw new Exception('Impossível Atualizar Pedido Produto');
            }
        }
        return $obj;
    }
        /**
     * @return bool| DataTransferObject
     */
    public function fullList()
    {
        return $this->select(null, null, null, "id_pedido_produto");

    }

}