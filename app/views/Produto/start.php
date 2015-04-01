<div class="row">
    <div class="col-md-8">
        <h3><?php echo $data['pagetitle']; ?></h3>

        <p>
            <?php echo $data['pagesubtitle']; ?>
        </p>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <h3>Cadastro de Produtos</h3>

        <form class="form-horizontal" id="form_produtos">
            <fieldset>

                <div class="form-group col-sm-12">
                    <label for="descricao" class="control-label"> Nome</label>

                    <div>
                        <input name="descricao" class="form-control" type="text" id="descricao">
                    </div>
                </div>
                <div class="form-group col-sm-6">
                    <label for="preco_custo" class="control-label"> Preço de Custo</label>

                    <div>
                        <input name="preco_custo" class="form-control" type="text"
                               id="preco_custo">
                    </div>
                </div>
                <div class="form-group form-group col-sm-6">
                    <label for="preco_venda" class="control-label"> Preço de Venda</label>

                    <div>
                        <input name="preco_venda" class="form-control" type="text"
                               id="preco_venda">
                    </div>
                </div>
                <div class="form-group col-sm-12">
                    <input type="reset" name="reset" class="btn btn-success" id="reset" value="Limpar">
                    <input type="submit" name="cadastrar" class="btn btn-primary" id="cadastrar" value="Cadastrar">
                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                </div>
            </fieldset>
        </form>
    </div>

    <div class="col-sm-6">
        <h3>Produtos</h3>
        <ul id="produto" class="list-group">
            <?php
            foreach ($data['list'] as $produto) {
                echo "<li class=\"list-group-item\" data-li_item=\"{$produto['id_produto']}\">
                        <span id=\"prod_{$produto['id_produto']}\">
                            {$produto['descricao']} {$produto['preco']}
                        </span>
                        <a href=\"#\" class=\"btn btn-warning btn-sm pull-right delete_prod\" data-delprodid=\"{$produto['id_produto']}\" data-toggle=\"modal\" data-target=\"#apagaItemModal\"><i class=\"fa fa-trash-o\"></i></a>
                        <a href=\"#\" class=\"btn btn-primary btn-sm pull-right update_prod\" id=\"{$produto['id_produto']}\" data-toggle=\"modal\" data-target=\"#atualizaItemModal\"><i class=\"fa fa-edit\"></i></a>
                     </li>";
            }
            var_dump($data);
            ?>
        </ul>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="atualizaItemModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">

        <div class="modal-content">
            <form class="form-horizontal" id="form_atualiza_prod">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                            aria-hidden="true">&times;</span><span
                            class="sr-only">Fechar</span></button>
                    <h4 class="modal-title" id="atualizaModalLabel">Atualizar Produto</h4>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12">
                        <div class="form-group col-sm-12">
                            <label for="ds_produto" class="control-label"> Nome</label>

                            <div>
                                <input name="ds_produto" class="form-control" type="text" id="ds_produto">
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="preco_custo" class="control-label"> Preço de Custo</label>

                            <div>
                                <input name="preco_custo" class="form-control" type="text"
                                       id="preco_custo">
                            </div>
                        </div>
                        <div class="form-group form-group col-sm-6">
                            <label for="preco_venda" class="control-label"> Preço de Venda</label>

                            <div>
                                <input name="preco_venda" class="form-control" type="text"
                                       id="preco_venda">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <input type="submit" class="btn btn-primary col-xs-offset-2" name="enviar" value="Enviar"/>
                </div>

                <input type="hidden" name="id_prod" value="">
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="apagaItemModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">

        <div class="modal-content">
            <form class="form-horizontal" id="form_apaga_prod">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                            aria-hidden="true">&times;</span><span
                            class="sr-only">Fechar</span></button>

                    <span class="modal-title" id="deletaModalLabel"></span>

                </div>
                <div class="modal-body">

                    <div class="col-sm-12 center">

                        <h5 id="del_item_confirma"></h5>

                        <p></p>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <input type="submit" class="btn btn-danger col-xs-offset-2" name="deletar" value="Deletar"/>
                </div>

                <input type="hidden" name="id_prod" value="">
            </form>
        </div>
    </div>
</div>
