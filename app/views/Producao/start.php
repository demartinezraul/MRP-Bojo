<?php

// PASSANDO VALORES COMO PARAMETRO E CADASTRANDO
$obj = new ProducaoDTO();

//$obj->setIdPedido(1);
//$obj->setIdProduto(1);
//$obj->setQuantidade(10);
//$obj->setValorunitario(49.99);
//EXECUTANDO A CLASSE DAO PARA SALVAR VALORES
$objDao = new ProducaoDAO();
//$objDao->gravar($obj);
$retorno = $objDao->fullList(); // RETORNA UM ARRAY COM TODOS OS CLIENTES
var_dump($retorno);
// UPDATE NO ID 13
//
//$obj = $objDao->getById(4);
//$obj->setNome('Rafael');
//$obj = $objDao->gravar($obj);
//$objDao->delete($obj);
//var_dump($obj);
