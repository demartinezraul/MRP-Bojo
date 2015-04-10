<?php

$producao = $data['producao'];
$producao_form = new Producao();
$cadastrado = $producao_form->cadastra($producao); //Não cadastra na entra pois ainda não tem Token

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
                   title="Ver Perfil!"
                   class="btn btn-circle btn-lg">
                    <i class="fa fa-eye"></i>
                </a>
                <a href="Pedido/" data-toggle="tooltip" data-placement="top" title="Ver Lista!"
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
                                                <h1 class="text-success"><span
                                                        class="" Sucesso!</h1>


                                                <a href="Producao/formproducao/" class="btn btn-info" role="button">
                                                    <i class="fa fa-arrow-circle-o-left"></i> Voltar
                                                </a>
                                                <!--
                                                <a href="Pedido/formpedido/" class="btn btn-success" role="button">
                                                    <i class="fa fa-arrow-circle-o-up"></i> Novo
                                                </a> -->

                                                <a href="Producao/formproducao<?php echo $cadastrado->getIdPedidoProduto(); ?>"
                                                   class="btn btn-danger">
                                                    FIM <i class="glyphicons glyphicons-remove-2"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php else: ?>
                            <form id="form_producao" class="form-horizontal" method="post" action=""
                                  enctype="multipart/form-data">
                                <fieldset>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-sm-12 selectContainer">
                                                <label for="id_produto" class="control-label">Nome Cliente</label>

                                                <select class="form-control" id="id_produto" name="id_produto">
                                                    <option value="">-- Selecione Produto</option>
                                                    <?php //echo escape(Input::get('id_cliente'));
                                                    $producao->setIdProduto($producao->getIdProduto() == '' ? Input::get('id_produto') : $producao->getIdProduto());
                                                    foreach ($data['produto'] as $produto) {

                                                        if ($produto->getIdProduto() == $producao->getIdProduto()) {
                                                            echo '<option value="' . $produto->getIdProduto() . '" selected>' . $produto->getDescricao() . '</option>';
                                                        } else {
                                                            echo '<option value="' . $produto->getIdProduto() . ' ">' . $produto->getDescricao() . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12 inputGroupContainer">
                                                    <label for="id_pedido" class="control-label">Pedido</label>


                                                    <input type="text" class="form-control" id="id_pedido" name="id_pedido"
                                                           value="<?php $producao->getIdPedido();?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12 inputGroupContainer">
                                                    <label for="quantidade" class="control-label">Quantidade</label>


                                                    <input type="text" class="form-control" id="quantidade" name="quantidade"
                                                           value="<?php echo $producao->getQuantidade() == '' ? Input::get('quantidade') : $producao->getQuantidade(); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12 inputGroupContainer">
                                                    <label for="valorunitario" class="control-label">Valor Unitario</label>


                                                    <input type="text" class="form-control" id="valorunitario" name="valorunitario"
                                                           value="<?php echo $producao->getValorunitario() == '' ? Input::get('valorunitario') : $producao->getValorunitario(); ?>">
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
                        <input type="hidden" name="id_pedido_produto" value="<?php echo $data['id'];?>">
                        <input type="hidden" name="token" value="<?php echo $token; ?>">

                        <div class="form-group">
                            <div class="col-lg-12 clearfix">
                                <a href="Producao" id="cancel"
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
