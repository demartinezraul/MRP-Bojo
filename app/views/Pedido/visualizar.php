<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3 class="page-header"><?php echo $data['pagetitle']; ?>
                <small>
                    <?php echo (isset($data['pagesubtitle'])) ? $data['pagesubtitle'] : ""; ?>
                </small>


                <!-- Botões de administração -->
                <span class="btn-panel pull-right">
                <a href="Pedido/formpedido/<?php echo $data['dados_pessoais']['id_pedido']; ?>"
                   data-toggle="tooltip" data-placement="top" title="Editar Perfil!"
                   class="btn btn-primary btn-circle btn-lg">
                    <i class="fa fa-pencil"></i>
                </a>
                <a href="Pedido/" data-toggle="tooltip" data-placement="top" title="Ver Lista!"
                   class="btn btn-default btn-circle btn-lg">
                    <i class="fa fa-list"></i>
                </a>
                <!-- Fim Botões de administração -->

            </h3>


        </div>
    </div>
</div>