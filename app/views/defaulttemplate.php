<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!--        Guarda endereço padrão dos arquivos para ser usado com URLs relativas-->
    <base href="<?php echo SITE_URL; ?>" target="_self"/>
    <meta charset="utf-8">
    <title><?php echo APP_NAME . ' - ' . (isset($data['pagetitle']) ? $data['pagetitle'] : ''); ?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!--<link rel="icon" type="image/png" href="favicon.ico" />-->
    <link rel="stylesheet" href="css/bootstrap.css" media="screen">
    <link rel="stylesheet" href="js/datatables/css/jquery.dataTables.min.css" media="screen">
    <link rel="stylesheet" href="js/datatables/css/dataTables.bootstrap.css" media="screen">
    <link rel="stylesheet" href="js/datatables/css/dataTables.responsive.css" media="screen">
    <link rel="stylesheet" href="css/bootstrapValidator.min.css" media="screen">


    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/custom.css">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>
<body class="menu">
<!-- top-bar start -->
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a href="Home" class="navbar-brand"><?php echo APP_NAME; ?></a>
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
                <i class="fa  fa-angle-double-down"></i>

            </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes">Cadastros <span class="caret"></span></a>
                    <ul class="dropdown-menu" aria-labelledby="themes">
                        <li><a href="Cliente">Clientes</a></li>
                        <li class="divider"></li>
                        <li><a href="AjaxProduto">Produtos</a></li>
                        <li class="divider"></li>
                        <li><a href="AjaxMateriaPrima">Materia prima</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes">Formularios <span class="caret"></span></a>
                    <ul class="dropdown-menu" aria-labelledby="themes">
                        <li><a href="#">Cadastrar Cliente</a></li>
                        <li><a href="#">Cadastrar Produto</a></li>
                        <li><a href="#">Cadastrar Materia prima</a></li>
                        <li><a href="#">Cadastrar Pedido</a></li>
                        <li><a href="#">Cadastrar Formula do pedido</a></li>
                    </ul>
                </li>
                <li>
                    <a href="Home/">Sobre</a>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li><a href="http://getbootstrap.com/" target="_blank">Bootstrap</a></li>
                <li><a href="Home/test">Help</a></li>
                <li>

        </div>
    </div>
</div>

<div class="container"><!-- container start -->

    <?php require($this->viewfile); ?>


    <footer>
        <div class="row">
            <div class="col-lg-12">
                <br/>
                <br/>
                <br/>
                <p>Desenvolvedores:</p>
                <p>Raul Martinez</a>.  #Contato <a href="mailto:demartinezraul@gmail.com">demartinezraul@gmail.com</a><br/>
                Rafael Silveira</a>.   #Contato <a href="mailto:@gmail.com">rafaelsilveira@gmail.com</a></p>
                <p>Baseado no <a href="http://getbootstrap.com" rel="nofollow">Bootstrap</a>. Ícones <a href="http://fortawesome.github.io/Font-Awesome/" rel="nofollow">Font Awesome</a>. Web fonts <a href="http://www.google.com/webfonts" rel="nofollow">Google</a>.</p>

            </div>
        </div>
    </footer>

</div><!-- container end -->

<script src="js/jquery-1.10.2.min.js"></script>
<script src="js/jquery.inputmask.bundle.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/datatables/js/jquery.dataTables.js"></script>
<script src="js/datatables/js/dataTables.bootstrap.js"></script>
<script src="js/datatables/js/dataTables.responsive.min.js"></script>
<script src="js/bootstrapValidator.min.js"></script>
<script src="js/custom.js"></script>
<script src="js/bootbox.min.js"></script>

<a id="toTop" href="#"><span id="toTopHover"></span><img width="65" height="65" alt="" src="img/to-top.png"></a>

</body>
</html>