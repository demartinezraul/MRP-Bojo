<?php

class AjaxLab extends Controller
{

    public function start()
    {
        $this->dados = array(
            'pagetitle' => 'AjaxLab Testando',
            'pagesubtitle' => '',
            'resultado' => (new AjaxLabModel())->getProds()
        );

        $this->view = new View('AjaxLab', 'start');
        $this->view->output($this->dados);
    }

    public function saveItem()
    {
        $this->model = new AjaxLabModel();
        $return = $this->model->gravarItem();
        echo "<li class=\"list-group-item\" data-li_item=\"{$return['id_produto']}\">
                <span id=\"prod_{$return['id_produto']}\">
                    {$return['descricao']} {$return['cor']}  - R$  {$return['preco']}
                </span>
                <a href=\"#\" class=\"btn btn-warning btn-sm pull-right delete_prod\" data-delprodid=\"{$return['id_produto']}\" data-toggle=\"modal\" data-target=\"#apagaItemModal\"><i class=\"fa fa-trash-o\"></i></a>
                <a href=\"#\" class=\"btn btn-primary btn-sm pull-right update_prod\" id=\"{$return['id_produto']}\" data-toggle=\"modal\" data-target=\"#atualizaItemModal\"><i class=\"fa fa-edit\"></i></a>
              </li>";
    }

    public function atualizaItem()
    {
        $this->model = new AjaxLabModel();
        $return = $this->model->updateItem();

        echo json_encode($return);
    }

    public function removeItem()
    {
        $this->model = new AjaxLabModel();
        $return = $this->model->deleteItem();

        echo json_encode($return);
    }

    public function findItem()
    {
        $_GET = filter_input_array(INPUT_GET);

        $id = $_GET['id_produto'];

        $this->model = new AjaxLabModel();
        $obj = $this->model->getById($id);

        $return = $obj->first();

        echo json_encode($return);
    }
} 