<?php
/**
 * Created by PhpStorm.
 * User: Raul
 * Date: 02/04/2015
 * Time: 13:30
 */

class AjaxMateriaPrima extends Controller
{

    public function start()
    {
        $this->dados = array(
            'pagetitle' => '',
            'pagesubtitle' => '',
            'resultado' => (new AjaxMateriaPrimaModel())->getMateriaPrima()
        );

        $this->view = new View('AjaxMateriaPrima', 'start');
        $this->view->output($this->dados);
    }

    public function saveItem()
    {
        $this->model = new AjaxMateriaPrimaModel();
        $return = $this->model->gravarItem();
        echo "<li class=\"list-group-item\" data-li_item=\"{$return['id_materia_prima']}\">
                <span id=\"materia_{$return['id_materia_prima']}\">
                    {$return['descricao']}  - R$  {$return['preco']}
                </span>
                <a href=\"#\" class=\"btn btn-danger btn-sm pull-right delete_materia\" data-delprodid=\"{$return['id_materia_prima']}\" data-toggle=\"modal\" data-target=\"#apagaItemModal\"><i class=\"fa fa-trash-o\"></i></a>
                <a href=\"#\" class=\"btn btn-primary btn-sm pull-right update_materia\" id=\"{$return['id_materia_prima']}\" data-toggle=\"modal\" data-target=\"#atualizaItemModal\"><i class=\"fa fa-edit\"></i></a>
              </li>";
    }

    public function atualizaItem()
    {
        $this->model = new AjaxMateriaPrimaModel();
        $return = $this->model->updateItem();

        echo json_encode($return);
    }

    public function removeItem()
    {
        $this->model = new AjaxMateriaPrimaModel();
        $return = $this->model->deleteItem();

        echo json_encode($return);
    }

    public function findItem()
    {
        $_GET = filter_input_array(INPUT_GET);

        $id = $_GET['id_materia_prima'];

        $this->model = new AjaxMateriaPrimaModel();
        $obj = $this->model->getById($id);

        $return = $obj->first();

        echo json_encode($return);
    }
}