<?php
/**
 * Created by PhpStorm.
 * User: Raul
 * Date: 08/04/2015
 * Time: 16:48
 */

class ClienteDAO extends DataAccessObject{

    public function __construct()
    {
        parent::__construct();
        $this->tabela = 'tb_cliente';
        $this->primaryKey = 'id_cliente';
        $this->dataTransfer = 'ClienteDTO';

    }

    /**
     * @param PessoaJuridicaDTO $pessoaJuridica
     * @return bool|DataTransferObject
     * @throws Exception
     */
    public function gravar(ClienteDTO $cliente)
    {
        if ($cliente->getIdCliente() == '') {
            if (!$obj = $this->insert($cliente)) {
                throw new Exception('Impossível Inserir Pessoa Jurídica');
            }
        } else {
            if (!$obj = $this->update($cliente)) {
                throw new Exception('Impossível Atualizar Pessoa Jurídica');
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