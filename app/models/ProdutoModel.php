<?php
/**
 * Created by PhpStorm.
 * User: Raul
 * Date: 31/03/2015
 * Time: 00:36
 */

class ProdutoModel extends Model{

    /** @var  ProdutoDTO */
    private $dto;
    /** @var  ProdutoDAO */
    private $dao;

    /**
     *
     */
    public function __construct()
    {
        $this->dao = new ProdutoDAO();
    }

    public function getArrayDados()
    {
        return array(
            'id_produto' => $this->dto->getIdProduto(),
            'descricao' => $this->dto->getDescricao(),
            'tamanho' => $this->dto->getTamanho(),
            'cor' => $this->dto->getCor(),
            'preco' => $this->dto->getPreco(),
            'saldo_estoque' => $this->dto->getSaldoEstoque()
        );
    }

    public function getProduto()
    {
        $_POST = filter_input_array(INPUT_POST);
        $nome = Input::get('nome');
        $pessoas = $this->dao->get("nome ilike '%{$nome}%' order by nome limit 5");

        $resultado = array();

        foreach ($pessoas as $pessoa) {
            $resultado[] = $this->setDTO($pessoa)->getBasicInfo();
        }

        return $resultado;
    }

    public function getBasicInfo()
    {
        return array(
            'id' => $this->dto->getIdProduto(),
            'descricao' => $this->dto->getDescricao(),
            'tamanho' => $this->dto->getTamanho(),
            'cor' => $this->dto->getCor(),
            'preco' => $this->dto->getPreco(),
            'saldo_estoque' => $this->dto->getSaldoEstoque()
        );
    }

    public function getDAO()
    {
        return $this->dao;
    }

    public function setDTO(ProdutoDTO $dto)
    {
        $this->dto = $dto;
        return $this;
    }

}