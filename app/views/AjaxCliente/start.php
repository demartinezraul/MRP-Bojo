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
        <h3>Cadastro de Clientes</h3>

        <form class="form-horizontal" id="form_cliente">
            <fieldset>

                <div class="form-group col-sm-12">
                    <label for="nome" class="control-label"> Nome</label>

                    <div>
                        <input name="nome" class="form-control" type="text" id="nome">
                    </div>
                </div>
                <div class="form-group form-group col-sm-6">
                    <label for="cpf" class="control-label"> Cpf</label>

                    <div>
                        <input name="cpf" class="form-control" type="text"
                               id="cpf">
                    </div>
                </div>
                <div class="form-group form-group col-sm-6">
                    <label for="email" class="control-label"> Email</label>

                    <div>
                        <input name="email" class="form-control" type="text"
                               id="email">
                    </div>
                </div>
                <div class="form-group col-sm-6">
                    <label for="telefone" class="control-label"> Telefone</label>

                    <div>
                        <input name="telefone" class="form-control" type="text"
                               id="telefone">
                    </div>
                </div>
                <div class="form-group col-sm-6">
                    <label for="data_nascimento" class="control-label"> Data Nascimento</label>

                    <div>
                        <input name="data_nascimento" class="form-control" type="text"
                               id="data_nascimento">
                    </div>
                </div>
                <div class="form-group col-sm-12">
                    <input type="reset" name="reset" class="btn btn-success" id="reset" value="Limpar">
                    <input type="submit" name="cadastrar" class="btn btn-primary" id="cadastrar" value="Cadastrar">
                    <input type="hidden" name="token" value="">
                </div>
            </fieldset>
        </form>
    </div>

    <div class="col-sm-6">
        <h3>Clientes</h3>
        <ul id="clientes" class="list-group">
            <?php
            foreach ($data['resultado'] as $cliente) {
                echo "<li class=\"list-group-item\" data-li_cliente=\"{$cliente['id_cliente']}\">
                        <span id=\"cli_{$cliente['id_cliente']}\">
                            {$cliente['nome']} {$cliente['email']}  {$cliente['telefone']}
                        </span>
                        <a href=\"#\" class=\"btn btn-danger btn-sm pull-right delete_cliente\" data-delclienteid=\"{$cliente['id_cliente']}\" data-toggle=\"modal\" data-target=\"#apagaItemModal\"><i class=\"fa fa-trash-o\"></i></a>
                        <a href=\"#\" class=\"btn btn-primary btn-sm pull-right update_cliente\" id=\"{$cliente['id_cliente']}\" data-toggle=\"modal\" data-target=\"#atualizaItemModal\"><i class=\"fa fa-edit\"></i></a>
                     </li>";
                //var_dump($data);
            }
            ?>
        </ul>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="atualizaItemModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">

        <div class="modal-content">
            <form class="form-horizontal" id="form_atualiza_cliente">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                            aria-hidden="true">&times;</span><span
                            class="sr-only">Fechar</span></button>
                    <h4 class="modal-title" id="atualizaModalLabel">Atualizar Cliente</h4>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12">
                        <div class="form-group col-sm-12">
                            <label for="nome" class="control-label"> Nome</label>

                            <div>
                                <input name="nome" class="form-control" type="text" id="nome">
                            </div>
                        </div>
                        <div class="form-group form-group col-sm-6">
                            <label for="cpf" class="control-label"> Cpf</label>

                            <div>
                                <input name="cpf" class="form-control" type="text"
                                       id="cpf">
                            </div>
                        </div>
                        <div class="form-group form-group col-sm-6">
                            <label for="email" class="control-label"> Email</label>

                            <div>
                                <input name="email" class="form-control" type="text"
                                       id="email">
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="telefone" class="control-label"> Telefone</label>

                            <div>
                                <input name="telefone" class="form-control" type="text"
                                       id="telefone">
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="data_nascimento" class="control-label"> Data Nascimento</label>

                            <div>
                                <input name="data_nascimento" class="form-control" type="text"
                                       id="data_nascimento">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <input type="submit" class="btn btn-primary col-xs-offset-2" name="enviar" value="Enviar"/>
                </div>

                <input type="hidden" name="id_cliente" value="">
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="apagaItemModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">

        <div class="modal-content">
            <form class="form-horizontal" id="form_apaga_cliente">
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

                <input type="hidden" name="id_cliente" value="">
            </form>
        </div>
    </div>
</div>