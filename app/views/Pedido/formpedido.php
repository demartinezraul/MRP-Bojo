<?php

$pedido = $data['pedido'];
$pedido_form = new Pedido();
$cadastrado = $pedido_form->cadastra($pedido); //Não cadastra na entra pois ainda não tem Token

$id_check = $data['id'];

$token = Token::generate();
?>
<div class="container">
    <div class="row">
            <div class="col-md-12">
                <h3 class="page-header"><?php echo $data['pagetitle']; ?>
                    <small><?php echo $data['pagesubtitle']; ?></small>
                    <?php if ($id_check): ?>
                        <span class="btn-panel pull-right">
                        <a href="Pedido/visualizar/<?php echo $id_check; ?>" data-toggle="tooltip" data-placement="top"
                           title="Ver Pedido!"
                           class="btn btn-circle btn-lg">
                           <i class="fa fa-eye"></i>
                        </a>
                        <a href="Pedido/" data-toggle="tooltip" data-placement="top" title="Ver Lista!"
                           class="btn btn-circle btn-lg">
                           <i class="fa fa-list"></i>
                        </a>
                        </span>
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

                                            <p>Clique em avançar para adicionar dados a Pedido Produto
                                                <strong><?php $cadastrado->getIdPedido();?></strong>?
                                            </p>
                                            <!--
                                            <a href="Pedido/formpedido" class="btn btn-info" role="button">
                                                <i class="fa fa-arrow-circle-o-left"></i> Voltar
                                            </a>
                                            <a href="Pedido/formpedido/" class="btn btn-success" role="button">
                                                <i class="fa fa-arrow-circle-o-up"></i> Novo
                                            </a> -->

                                            <a href="Producao/formproducao/"
                                               class="btn btn-primary">
                                                Avançar <i class="fa fa-arrow-circle-o-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <form id="form_pedido" class="form-horizontal" method="post" action=""
                                  enctype="multipart/form-data">
                                <fieldset>
                                    <div class="col-md-6">
                                        <div class="form-group col-sm-6">

                                            <div class="col-sm-12 inputGroupContainer" id="datetimepicker">
                                                <label for="data_pedido" class="control-label">Data Pedido</label>


                                                <input type="text" class="form-control data-input"
                                                       value="<?php echo $pedido->getDataPedido() == '' ? Input::get('data_pedido') : $pedido->getDataPedido(); ?>"
                                                       id="data_pedido"
                                                       name="data_pedido" placeholder="___/___/____">
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
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="col-sm-12 selectContainer">
                                    <label for="id_cliente" class="control-label">Nome Cliente</label>

                                    <select class="form-control" id="id_cliente" name="id_cliente">
                                        <option value="">-- Selecione cliente</option>
                                        <?php //echo escape(Input::get('id_cliente'));
                                        $pedido->setIdCliente($pedido->getIdCliente() == '' ? Input::get('id_cliente') : $pedido->getIdCliete());
                                        foreach ($data['cliente'] as $empresa) {

                                            if ($empresa->getIdCliente() == $pedido->getIdCliente()) {
                                                echo '<option value="' . $empresa->getIdCliente() . '" selected>' . $empresa->getNome() . '</option>';
                                            } else {
                                                echo '<option value="' . $empresa->getIdCliente() . ' ">' . $empresa->getNome() . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="id_pedido" value="<?php echo $data['id']; ?>">
                        <input type="hidden" name="token" value="<?php echo $token; ?>">

                        <div class="form-group">
                            <div class="col-lg-12 clearfix">
                                <a href="Pedido" id="cancel"
                                   class="btn btn-default"><span
                                        class="fa fa-undo"></span> Cancelar</a>
                                <button type="submit" name="cadastrar" class="btn btn-primary"><span
                                        class="fa fa-check"></span>
                                    Salvar
                                </button>
                            </div>
                        </div>
                    </div>
            <?php endif; ?>
        </div>
    </div>

