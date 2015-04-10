<?php
/**
 * Created by PhpStorm.
 * User: Raul
 * Date: 05/04/2015
 * Time: 22:55
 */

class AjaxClienteModel extends Model{

    public function gravarItem()
    {
        try {
            $this->setDadosCliente();
            //var_dump($this->dados);
            unset($this->dados['id_cliente']);
            $this->db->insert($this->tabela, $this->dados);
        } catch (Exception $e) {
            CodeFail($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
            return false;
        }
        return $this->db->first();
    }

    public function updateCliente()
    {
        try {
            $this->setDadosCliente();
            //var_dump($this->dados);die;
            $this->db->update($this->tabela, $this->dados, "{$this->primary_key} = {$this->dados['id_cliente']}");
        } catch (Exception $e) {
            CodeFail($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
            return false;
        }
        return $this->db->first();
    }
    public function deleteCliente()
    {
        $this->tabela = 'tb_cliente';
        $this->primary_key = 'id_cliente';

        try {
            $this->setDadosCliente();
            //var_dump($this->dados);die;
            $this->db->delete($this->tabela, "{$this->primary_key} = {$this->dados['id_cliente']}");
        } catch (Exception $e) {
            CodeFail($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
            return false;
        }
        return $this->db->first();
    }

    public function setDadosCliente()
    {
        $this->tabela = 'tb_cliente';
        $this->primary_key = 'id_cliente';

        $_POST = filter_input_array(INPUT_POST);

        $this->dados = array(
            'id_cliente' => (int)Input::get('id_cliente'),
            'nome' => Input::get('nome'),
            'cpf' => Input::get('cpf'),
            'email' => Input::get('email'),
            'telefone' => Input::get('telefone'),
            'data_nascimento' => Input::get('data_nascimento')
        );
    }

    public function getCliente()
    {
        $this->db->select(
            'id_cliente, nome, cpf, email, telefone,
                to_char(data_nascimento, \' - "  DD/MM/YYYY\') as data_nascimento',
            'tb_cliente',null, null, null, 'id_cliente'
        );
        return $this->db->getResultado();
    }

    public function getById($id)
    {
        $this->tabela = 'tb_cliente';
        return $this->db->get($this->tabela, "id_cliente = {$id}");
    }
}