<?php
/**
 * Created by PhpStorm.
 * User: Raul
 * Date: 06/04/2015
 * Time: 23:56
 */


// PASSANDO VALORES COMO PARAMETRO E CADASTRANDO
//$obj = new PedidoDTO();

//$obj->getIdPedido(6);
//$obj->setIdCliente(6);
//$obj->setDataPedido('06/04/2015');
//$obj->setValortotal(49.99);
//EXECUTANDO A CLASSE DAO PARA SALVAR VALORES
//$objDao = new PedidoDAO();
//$objDao->gravar($obj);
//$retorno = $objDao->fullList(); // RETORNA UM ARRAY COM TODOS OS CLIENTES
//var_dump($ob);
// UPDATE NO ID 13
//
//$obj = $objDao->getById(4);
//$obj->setNome('Rafael');
//$obj = $objDao->gravar($obj);
//$objDao->delete($obj);
//var_dump($obj);


$obj = new PedidoDTO();

//$obj->setIdCliente();
//$obj->getDataPedido();
//$obj->getValortotal(null);

$objDao = new PedidoDAO();
//$objDao->gravar();
var_dump($obj);

