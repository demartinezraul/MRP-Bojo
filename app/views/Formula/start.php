<?php

$obj = new FormulaDTO();

$obj->setIdProduto(2);
$obj->setIdMateriaPrima(2);
$obj->setQuantidade(10);

$objDao = new FormulaDAO();
$objDao->gravar($obj);
$retorna = $objDao->fullList();
var_dump($retorna);

