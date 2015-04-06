<?php
/**
 * Created by PhpStorm.
 * User: Raul
 * Date: 05/04/2015
 * Time: 22:52
 */

class AjaxCliente extends Controller {

    public function start()
    {
        $this->dados = array(
            'pagetitle' => '',
            'pagesubtitle' => '',
            'resultado' => (new AjaxClienteModel())->getCliente()
        );

        $this->view = new View('AjaxCliente', 'start');
        $this->view->output($this->dados);
    }

    public function saveCliente()
    {
        $this->model = new AjaxClienteModel();
        $return = $this->model->gravarItem();
        echo "<li class=\"list-group-item\" data-li_item=\"{$return['id_cliente']}\">
                <span id=\"cli_{$return['id_cliente']}\">
                    {$return['nome']} {$return['email']} {$return['telefone']}
                </span>
                <a href=\"#\" class=\"btn btn-danger btn-sm pull-right delete_cliente\" data-delprodid=\"{$return['id_cliente']}\" data-toggle=\"modal\" data-target=\"#apagaItemModal\"><i class=\"fa fa-trash-o\"></i></a>
                <a href=\"#\" class=\"btn btn-primary btn-sm pull-right update_cliente\" id=\"{$return['id_cliente']}\" data-toggle=\"modal\" data-target=\"#atualizaItemModal\"><i class=\"fa fa-edit\"></i></a>
              </li>";
    }

    public function atualizaCliente()
    {
        $this->model = new AjaxClienteModel();
        $return = $this->model->updateCliente();

        echo json_encode($return);
    }

    public function removeCliente()
    {
        $this->model = new AjaxClienteModel();
        $return = $this->model->deleteCliente();

        echo json_encode($return);
    }

    public function findCliente()
    {
        $_GET = filter_input_array(INPUT_GET);

        $id = $_GET['id_cliente'];

        $this->model = new AjaxClienteModel();
        $obj = $this->model->getById($id);

        $return = $obj->first();

        echo json_encode($return);
    }
}