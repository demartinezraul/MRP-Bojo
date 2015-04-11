<?php

$formula = $data['formula'];
$formula_form = new Formula();
$cadastrado = $formula_form->cadastra($formula); //Não cadastra na entra pois ainda não tem Token

$id_check = $data['id'];

$token = Token::generate();
?>
<div class="container">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="page-header"><?php echo $data['pagetitle']; ?>
                    <small><?php echo $data['pagesubtitle']; ?></small>
                    <?php if ($id_check): ?>
                        <!--
                        <span class="btn-panel pull-right">
                <a href="Pedido/visualizar/<?php echo $id_check; ?>" data-toggle="tooltip" data-placement="top"
                   title=""
                   class="btn btn-circle btn-lg">
                    <i class="fa fa-eye"></i>
                </a>
                <a href="Pedido/" data-toggle="tooltip" data-placement="top" title=""
                   class="btn btn-circle btn-lg">
                    <i class="fa fa-list"></i>
                </a>
            </span> -->
                    <?php endif; ?>
                </h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div>

                    <div id="TabAdicionais" class="tab-content">
                        <div class="tab-pane fade active in" id="principal">
                            <?php if ($cadastrado): ?>
                                <div class="row">
                                    <div class="jumbotron">
                                        <div class="container">
                                            <div class="col-md-8">
                                                <p>Formula Cadastrada</p>
                                                <a href="Home" class="btn btn-info" role="button">
                                                    <i class="glyphicons glyphicons-remove-2"></i> VOLTAR
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php else: ?>
                            <form id="form_formula" class="form-horizontal" method="post" action=""
                                  enctype="multipart/form-data">
                                <fieldset>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-sm-12 selectContainer">
                                                <label for="id_produto" class="control-label">Produtos</label>

                                                <select class="form-control" id="id_produto" name="id_produto">
                                                    <option value="">-- Selecione Produto</option>
                                                    <?php //echo escape(Input::get('id_cliente'));
                                                    $formula->setIdProduto($formula->getIdProduto() == '' ? Input::get('id_produto') : $formula->getIdProduto());
                                                    foreach ($data['produto'] as $produto) {

                                                        if ($produto->getIdProduto() == $formula->getIdProduto()) {
                                                            echo '<option value="' . $produto->getIdProduto() . '" selected>' . $produto->getDescricao() . '</option>';
                                                        } else {
                                                            echo '<option value="' . $produto->getIdProduto() . ' ">' . $produto->getDescricao() . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-12 selectContainer">
                                                <label for="id_materia_prima" class="control-label">Materia prima</label>

                                                <select class="form-control" id="id_materia_prima" name="id_materia_prima">
                                                    <option value="">-- Selecione Materia Prima</option>
                                                    <?php //echo escape(Input::get('id_cliente'));
                                                    $formula->setIdMateriaPrima($formula->getIdMateriaPrima() == '' ? Input::get('id_materia_prima') : $formula->getIdMateriaPrima());
                                                    foreach ($data['materiaprima'] as $materiaprima) {

                                                        if ($materiaprima->getIdMateriaPrima() == $formula->getIdMateriaPrima()) {
                                                            echo '<option value="' . $materiaprima->getIdMateriaPrima() . '" selected>' . $materiaprima->getDescricao() . '</option>';
                                                        } else {
                                                            echo '<option value="' . $materiaprima->getIdMateriaPrima() . ' ">' . $materiaprima->getDescricao() . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12 inputGroupContainer">
                                                    <label for="quantidade" class="control-label">Quantidade</label>


                                                    <input type="text" class="form-control" id="quantidade"
                                                           name="quantidade"
                                                           value="<?php echo $formula->getQuantidade() == '' ? Input::get('quantidade') : $formula->getQuantidade(); ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--
                                    <div class="col-md-6">
                                        <div class="form-group col-sm-6">

                                            <div class="col-sm-12 inputGroupContainer" id="datetimepicker">
                                                <label for="valortotal" class="control-label">Valor Pedido</label>


                                                <input type="text" class="form-control data-input"
                                                       value="< ? php echo $pedido->getValortotal() == '' ? Input::get('valortotal') : $pedido->getValortotal(); ?>"
                                                       id="valortotal"
                                                       name="valortotal">
                                            </div>
                                        </div>
                                    </div>
                                    -->
                        </div>
                        <input type="hidden" name="id_formula" value="<?php echo $data['id']; ?>">
                        <input type="hidden" name="token" value="<?php echo $token; ?>">

                        <div class="form-group">
                            <div class="col-lg-12 clearfix">
                                <a href="Formula" id="cancel"
                                   class="btn btn-default"><span
                                        class="fa fa-undo"></span> Cancelar</a>
                                <button type="submit" name="cadastrar" class="btn btn-primary"><span
                                        class="fa fa-check"></span>
                                    Salvar
                                </button>
                            </div>
                        </div>
                        </fieldset>
                        </form>
                    </div>
                </div>
            </div>
            </fieldset>
            </form>
            <?php endif; ?>
        </div>
