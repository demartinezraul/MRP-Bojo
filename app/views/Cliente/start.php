<?php

// PASSANDO VALORES COMO PARAMETRO E CADASTRANDO
$obj = new ClienteDTO();

//$obj->setNome('Ju');
//$obj->setCpf('12341');
//$obj->setEmail('Ju@bol.com');
//$obj->setTelefone('1699991111');
//$obj->setDataNascimento('31/03/1979');

//EXECUTANDO A CLASSE DAO PARA SALVAR VALORES
$objDao = new ClienteDAO();

//$objDao->gravar($obj);
$retorno = $objDao->fullList(); // RETORNA UM ARRAY COM TODOS OS CLIENTES
var_dump($retorno);

// UPDATE NO ID 13
//$obj = $objDao->getById(13);
//$obj->setNome('Rafael');
//$obj = $objDao->gravar($obj);
//$objDao->delete($obj);
//var_dump($obj);








