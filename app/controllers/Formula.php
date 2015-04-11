<?php
/**
 * Created by PhpStorm.
 * User: Raul
 * Date: 10/04/2015
 * Time: 18:12
 */

class Formula extends Controller{

    /** @var \FormulaModel */
    private $FormulaModel;

    public function __construct()
    { //o método é herdado da classe pai 'Controller'
        $this->setModel(new FormulaDAO());
        $this->FormulaModel = new FormulaModel();
    }

    public function start()
    { //Pega a lista completa de perfis
        $formula_list = (array)$this->model->fullList();
        $dados = array(
            'pagesubtitle' => '',
            'pagetitle' => 'Formula',
            'list' => $formula_list
        );

        $this->view = new View('Formula', 'start');
        $this->view->output($dados);
    }

    public function getFullJSON()
    {
        $result = (array)$this->model->fullList();
        $count = count($result);

        $lista = array();
        if ($count > 0) {
            foreach ($result as $formula) {
                $lista[] = $this->formulaModel->setDTO($formula)->getArrayDados();
            }
        }

        $return = array(
            'iTotalRecords' => $count,
            'iTotalDisplayRecords' => 10,
            'sEcho' => 10,
            'aaData' => $lista
        );

        echo json_encode($return, JSON_PRETTY_PRINT);
    }

    public function formformula($id = null)
    {
        $produto = (new ProdutoDAO())->fullList();
        $materiaprima = (new MateriaPrimaDAO())->fullList();



        if ($id) {
            /** @var PedidoDTO */
            $formulaarr = $this->findById($id);

            $dados = array(
                'pagetitle' => '',
                'pagesubtitle' => '',
                'produto' => $produto,
                'materiaprima' => $materiaprima,
                'id' => $id,
                'formula' => $formulaarr,
            );

        } else {
            $formula = new FormulaDTO();
            $dados = array(
                'pagetitle' => 'Cadastro de Formula',
                'pagesubtitle' => '',
                'produto' => $produto,
                'materiaprima' => $materiaprima,
                'id' => null,
                'formula' => $formula
            );
        }

        $this->view = new View('Formula', 'formformula');
        $this->view->output($dados);
    }

    /**
     * @todo Sanitizar entrada de dados
     */
    public function cadastra()
    {
        if (Input::exists()) {
            if (Token::check(Input::get('token'))) {

                $formula = $this->setDados();

                try {
                    $obj = $this->model->gravar($formula);
                    return $obj;
                } catch (Exception $e) {
                    CodeFail((int)$e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
                }
                return false;
            }
        }
    }

    private function setDados()
    {
        $dto = new FormulaDTO();

        $dto->setIdFormula(Input::get('id_formula'))
            ->setIdProduto(Input::get('id_produto'))
            ->setIdMateriaPrima(Input::get('id_materia_prima'))
            ->setQuantidade(Input::get('quantidade'));

        return $dto;
    }

    public function removerFormula(FormulaDTO $dto)
    {
        if (Input::exists()) {

            if (Token::check(Input::get('token'))) {

                $this->model->delete($dto);

            }
        }
    }

    protected function findById($id)
    {
        if (!$obj = $this->model->getById($id)) {
            /** Envia mensagem */
            Session::flash('fail', 'Cadastro não encontrado', 'danger');
            /** Redireciona para página de lista de Perfis */
            Redirect::to(SITE_URL . get_called_class());
        }
        return $obj;
    }
}