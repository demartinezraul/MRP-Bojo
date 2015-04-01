Home<h1>Erro!</h1>
<p>A ação para o controller requisitada não possui uma view.
    Esta deve existir como <strong>
        <?php echo ltrim(strrchr(rtrim($this->viewfile, '.php'), '/'), '/'); ?>
    </strong>.
    Por favor, crie este arquivo.
    <hr>
<?php
trigger_error('View não encontrada',E_USER_ERROR);

try {

    throw new Exception('Essa é uma exceção', E_USER_NOTICE);

} catch (Exception $e) {

    CodeFail($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
    CodeError($e->getMessage(), $e->getCode());
    CodeError($e->getMessage(), CSS_INFO);
}