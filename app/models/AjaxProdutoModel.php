<?php

class AjaxProdutoModel extends Model
{

    public function gravarItem()
    {
        try {
            $this->setDadosItem();
            //var_dump($this->dados);die;
            unset($this->dados['id_produto']);
            $this->db->insert($this->tabela, $this->dados);
        } catch (Exception $e) {
            CodeFail($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
            return false;
        }
        return $this->db->first();
    }

    public function updateItem()
    {
        try {
            $this->setDadosItem();
            //var_dump($this->dados);die;
            $this->db->update($this->tabela, $this->dados, "{$this->primary_key} = {$this->dados['id_produto']}");
        } catch (Exception $e) {
            CodeFail($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
            return false;
        }
        return $this->db->first();
    }
    public function deleteItem()
    {
        $this->tabela = 'tb_produto';
        $this->primary_key = 'id_produto';

        try {
            $this->setDadosItem();
            //var_dump($this->dados);die;
            $this->db->delete($this->tabela, "{$this->primary_key} = {$this->dados['id_produto']}");
        } catch (Exception $e) {
            CodeFail($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
            return false;
        }
        return $this->db->first();
    }

    public function setDadosItem()
    {
        $this->tabela = 'tb_produto';
        $this->primary_key = 'id_produto';

        $_POST = filter_input_array(INPUT_POST);

        $this->dados = array(
            'id_produto' => (int)Input::get('id_produto'),
            'descricao' => Input::get('descricao'),
            'tamanho' => Input::get('tamanho'),
            'cor' => Input::get('cor'),
            'preco' => (double)Input::get('preco'),
            'saldo_estoque' => (int)Input::get('saldo_estoque')
        );
    }

    public function getProds()
    {
        $this->db->select(
            'id_produto, descricao, cor, saldo_estoque,
                to_char(preco,\' - "  R$"999G999G990D99\') as preco',
            'tb_produto',null, null, null, 'id_produto'
        );
        return $this->db->getResultado();
    }

    public function getById($id)
    {
        $this->tabela = 'tb_produto';
        return $this->db->get($this->tabela, "id_produto = {$id}");
    }
} 