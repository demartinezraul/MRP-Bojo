<?php
/**
 * Created by PhpStorm.
 * User: Raul
 * Date: 02/04/2015
 * Time: 13:32
 */

class AjaxMateriaPrimaModel extends Model
{

    public function gravarItem()
    {
        try {
            $this->setDadosItem();
            //var_dump($this->dados);die;
            unset($this->dados['id_materia_prima']);
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
            $this->db->update($this->tabela, $this->dados, "{$this->primary_key} = {$this->dados['id_materia_prima']}");
        } catch (Exception $e) {
            CodeFail($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
            return false;
        }
        return $this->db->first();
    }
    public function deleteItem()
    {
        $this->tabela = 'tb_materia_prima';
        $this->primary_key = 'id_materia_prima';

        try {
            $this->setDadosItem();
            //var_dump($this->dados);die;
            $this->db->delete($this->tabela, "{$this->primary_key} = {$this->dados['id_materia_prima']}");
        } catch (Exception $e) {
            CodeFail($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
            return false;
        }
        return $this->db->first();
    }

    public function setDadosItem()
    {
        $this->tabela = 'tb_materia_prima';
        $this->primary_key = 'id_materia_prima';

        $_POST = filter_input_array(INPUT_POST);

        $this->dados = array(
            'id_materia_prima' => (int)Input::get('id_materia_prima'),
            'descricao' => Input::get('descricao'),
            'preco' => (double)Input::get('preco'),
            'saldoEstoque' => (int)Input::get('saldoEstoque')
        );
    }

    public function getMateriaPrima()
    {
        $this->db->select(
            'id_materia_prima, descricao, saldoEstoque,
                to_char(preco, \' - "  R$"999G999G990D99\') as preco',
            'tb_materia_prima',null, null, null, 'id_materia_prima'
        );
        return $this->db->getResultado();
    }

    public function getById($id)
    {
        $this->tabela = 'tb_materia_prima';
        return $this->db->get($this->tabela, "id_materia_prima = {$id}");
    }
}