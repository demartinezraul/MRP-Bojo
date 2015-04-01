<?php
/**
 * Created by PhpStorm.
 * User: Raul
 * Date: 29/03/2015
 * Time: 22:39
 */

class ClienteDAO extends DataAccessObject
{

    public function __construct()
    {
        parent::__construct();
        $this->tabela = 'tb_cliente';
        $this->primaryKey = 'id_cliente';
        $this->dataTransfer = 'ClienteDTO';
    }


    public function gravar(ClienteDTO $cliente)
    {
        if ($cliente->getIdCliente() == '') {
            if (!$obj = $this->insert($cliente)) {
                throw new Exception('Impossível Inserir Pessoa Física');
            }
        } else {
            if (!$obj = $this->update($cliente)) {
                throw new Exception('Impossível Atualizar Pessoa Física');
            }
        }
        $obj = $this->getById($obj->getIdCliente());
        return $obj;
    }
    /**
     * @return bool| DataTransferObject
     */
    public function fullList()
    {
        return $this->select(null, null, null, "nome");

    }
}