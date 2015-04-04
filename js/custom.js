(function ($) {
    "use strict";

    $.fn.tree = function () {

        return this.each(function () {
            var btn = $(this).children("a").first();
            var menu = $(this).children(".treeview-menu").first();
            var isActive = $(this).hasClass('active');

            //initialize already active menus
            if (isActive) {
                menu.show();
                btn.children(".fa-angle-left").first().removeClass("fa-angle-left").addClass("fa-angle-down");
            }
            //Slide open or close the menu on link click
            btn.click(function (e) {
                e.preventDefault();
                if (isActive) {
                    //Slide up to close menu
                    menu.slideUp();
                    isActive = false;
                    btn.children(".fa-angle-down").first().removeClass("fa-angle-down").addClass("fa-angle-left");
                    btn.parent("li").removeClass("active");
                } else {
                    //Slide down to open menu
                    menu.slideDown();
                    isActive = true;
                    btn.children(".fa-angle-left").first().removeClass("fa-angle-left").addClass("fa-angle-down");
                    btn.parent("li").addClass("active");
                }
            });

            /* Add margins to submenu elements to give it a tree look */
            menu.find("li > a").each(function () {
                var pad = parseInt($(this).css("margin-left")) + 10;

                $(this).css({"margin-left": pad + "px"});
            });

        });

    };

}(jQuery));

$(".sidebar-menu .treeview").tree();

(function () {
    var body = $('body');
    $('.slide-bar-toggle').bind('click', function () {
        body.toggleClass('menu-open');
        return false;
    });
})();

$(document).ready(function () {

    //Check to see if the window is top if not then display button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('#toTop').fadeIn();
        } else {
            $('#toTop').fadeOut();
        }
    });

    //Click event to scroll to top
    $('#toTop').click(function () {
        $('html, body').animate({scrollTop: 0}, 400);
        return false;
    });

});

$(document).ready(function () {
    $('#cpf').inputmask("999.999.999-99");
    $('#data_nascimento').inputmask("99/99/9999");
    $('#telefone').inputmask("(99) 9999-9999");
});

$('#report').dataTable({
    "language": {
        "url": "js/datatables/js/dataTables.pt-br.lang"
    },
    responsive: true
});

/*$(function(){
 var $produtos = $('#--produtos');

 $.ajax({
 type: 'POST',
 url:'/Reportlist/returnJSON',
 success: function(produtos) {
 $produtos.append('<li>'+produtos+'</li>');
 console.log(produtos);
 }
 })
 });*/

// VALIDAÇÃO DE CAMPOS DE PRODUTOS
$('#form_produtos').bootstrapValidator({
    feedbackIcons: {
        valid: 'glyphicon glyphicon-ok',
        invalid: 'glyphicon glyphicon-remove',
        validating: 'glyphicon glyphicon-refresh'
    },
    fields: {
        descricao: {
            validators: {
                notEmpty: {
                    message: 'Informe o nome do produto.'
                }
            }
        },
        preco: {
            validators: {
                notEmpty: {
                    message: 'Informe o preço de custo.'
                },
                numeric: {
                    message: 'Preço de custo deve ser numérico.'
                }
            }
        },
        saldo_estoque: {
            validators: {
                notEmpty: {
                    message: 'Informe saldo em estoque.'
                },
                numeric: {
                    message: 'saldo estoque deve ser numérico.'
                }
            }
        }
    }
}).on('success.form.bv', function (e) {
    // Prevent form submission
    e.preventDefault();

    // Get the form instance
    var $form = $(e.target);

    // Get the BootstrapValidator instance
    var bv = $form.data('bootstrapValidator');

    // Use AjaxProduto to submit form data
    /*
     $.post($form.attr('action'), $form.serialize(), function(result) {
     // ... Process the result ...
     }, 'json');
     */

    var dados = $(this).serialize();

    $.ajax({
        type: "POST",
        url: "AjaxProduto/saveItem",
        data: dados,
        success: function (data) {
            $(data).add
            $(data).appendTo('#produtos').hide().fadeIn();

            bv.resetForm(true);
        }
    });
    return false;
});

$('#form_atualiza_prod').bootstrapValidator({
    feedbackIcons: {
        valid: 'glyphicon glyphicon-ok',
        invalid: 'glyphicon glyphicon-remove',
        validating: 'glyphicon glyphicon-refresh'
    },
    fields: {
        descricao: {
            validators: {
                notEmpty: {
                    message: 'Informe o nome do produto.'
                }
            }
        },
        preco: {
            validators: {
                notEmpty: {
                    message: 'Informe o preço de custo.'
                },
                numeric: {
                    message: 'Preço de custo deve ser numérico.'
                }
            }
        },
        saldo_estoque: {
            validators: {
                notEmpty: {
                    message: 'Informe saldo em estoque.'
                },
                numeric: {
                    message: 'saldo estoque deve ser numérico.'
                }
            }
        }
    }
}).on('success.form.bv', function (e) {
// Prevent form submission
    e.preventDefault();

    // Get the form instance
    var $form = $(e.target);

    // Get the BootstrapValidator instance
    var bv = $form.data('bootstrapValidator');

    var dados = $(this).serialize();

    $.ajax({
        type: "POST",
        url: "AjaxProduto/atualizaItem",
        data: dados,
        dataType: 'json',
        success: function (data) {
            var prod_id = '#prod_' + data.id_produto;
            var prod = $(prod_id);

            prod.html(data.descricao + ' - ' + data.cor + ' R$ ' + data.preco);

            $('#form_atualiza_prod input[name=id_produto]').val('');
            $('#form_atualiza_prod input[name=descricao]').val('');
            $('#form_atualiza_prod input[name=tamanho]').val('');
            $('#form_atualiza_prod input[name=cor]').val('');
            $('#form_atualiza_prod input[name=preco]').val('');
            $('#form_atualiza_prod input[name=saldo_estoque]').val('');

            $('#atualizaModalLabel').html('<span class="text-warning"><i class="fa fa-check"></i> Produto atualizado!</span>')
                .fadeIn();

            $form.parents('#atualizaItemModal').modal('hide');

        }
    });
    return false;
});

$('#form_apaga_prod')
    .submit(function () {

        var dados = $(this).serialize();

        $.ajax({
            type: "POST",
            url: "AjaxProduto/removeItem",
            data: dados,
            dataType: 'json',
            success: function (data) {
                $('#form_apaga_prod input[name=id_produto]').val('');
                $('#del_item_confirma').html('<span class="text-success"><i class="fa fa-check"></i> Produto ' + data.descricao + ' Apagado!</span>')
                    .hide().fadeIn();

                $('#produtos li[data-li_item=' + data.id_produto + ']').remove();
                $('#apagaItemModal').modal('hide');
            }
        });
        return false;
    });

/** Início - Botões Atualizar e Apagar */
$('#produtos').delegate('.update_prod', 'click', function () {

    var id = $(this).attr('id');

    $.ajax({
        type: "GET",
        url: "AjaxProduto/findItem?id_produto=" + id,
        data: $(this).serialize(),
        dataType: 'json',
        success: function (data) {

            $('#form_atualiza_prod input[name=id_produto]').val(data.id_produto);
            $('#form_atualiza_prod input[name=descricao]').val(data.descricao);
            $('#form_atualiza_prod input[name=tamanho]').val(data.tamanho);
            $('#form_atualiza_prod input[name=cor]').val(data.cor);
            $('#form_atualiza_prod input[name=preco]').val(data.preco);
            $('#form_atualiza_prod input[name=saldo_estoque]').val(data.saldo_estoque);

            $('#atualizaModalLabel').html('Atualizar Produto');

        }
    });
});

$('#produtos').delegate('.delete_prod', 'click', function () {

    var id = $(this).attr('data-delprodid');

    $.ajax({
        type: "GET",
        url: "AjaxProduto/findItem?id_produto=" + id,
        data: $(this).serialize(),
        dataType: 'json',
        success: function (data) {

            $('#form_apaga_prod input[name=id_produto]').val(data.id_produto);

            $('#del_item_confirma').html('<span class="text-danger"><i class="fa fa-trash-o"></i> Apagar produto ' + data.descricao + '?</span>');

        }
    });
});
/** Fim - Botões Atualizar e Apagar */

$('#atualizaItemModal').on('hide.bs.modal', function() {
    $('#form_atualiza_prod').bootstrapValidator('resetForm', true);
});

/*
#################################################################################################################
#############  VALIDAÇÃO DE MATERIA PRIMA E ENTRADA/SAIDA e UPDATE/DELETE DE MATERIA PRIMA  ##################
#################################################################################################################
 */



$('#form_materia').bootstrapValidator({
    feedbackIcons: {
        valid: 'glyphicon glyphicon-ok',
        invalid: 'glyphicon glyphicon-remove',
        validating: 'glyphicon glyphicon-refresh'
    },
    fields: {
        descricao: {
            validators: {
                notEmpty: {
                    message: 'Informe o nome da materia prima.'
                }
            }
        },
        preco: {
            validators: {
                notEmpty: {
                    message: 'Informe o preço de custo.'
                },
                numeric: {
                    message: 'Preço de custo deve ser numérico.'
                }
            }
        }
    }
}).on('success.form.bv', function (e) {
    // Prevent form submission
    e.preventDefault();

    // Get the form instance
    var $form = $(e.target);

    // Get the BootstrapValidator instance
    var bv = $form.data('bootstrapValidator');

    // Use AjaxProduto to submit form data
    /*
     $.post($form.attr('action'), $form.serialize(), function(result) {
     // ... Process the result ...
     }, 'json');
     */

    var dados = $(this).serialize();

    $.ajax({
        type: "POST",
        url: "AjaxMateriaPrima/saveItem",
        data: dados,
        success: function (data) {
            $(data).add
            $(data).appendTo('#materias').hide().fadeIn();

            bv.resetForm(true);
        }
    });
    return false;
});

$('#form_atualiza_materia').bootstrapValidator({
    feedbackIcons: {
        valid: 'glyphicon glyphicon-ok',
        invalid: 'glyphicon glyphicon-remove',
        validating: 'glyphicon glyphicon-refresh'
    },
    fields: {
        descricao: {
            validators: {
                notEmpty: {
                    message: 'Informe o nome da materia prima.'
                }
            }
        },
        preco: {
            validators: {
                notEmpty: {
                    message: 'Informe o preço de custo.'
                },
                numeric: {
                    message: 'Preço de custo deve ser numérico.'
                }
            }
        }
    }
}).on('success.form.bv', function (e) {
// Prevent form submission
    e.preventDefault();

    // Get the form instance
    var $form = $(e.target);

    // Get the BootstrapValidator instance
    var bv = $form.data('bootstrapValidator');

    var dados = $(this).serialize();

    $.ajax({
        type: "POST",
        url: "AjaxMateriaPrima/atualizaItem",
        data: dados,
        dataType: 'json',
        success: function (data) {
            var materia_id = '#materia_' + data.id_materia_prima;
            var materia = $(materia_id);

            prod.html(data.descricao  + ' R$ ' + data.preco);

            $('#form_atualiza_materia input[name=id_materia_prima]').val('');
            $('#form_atualiza_materia input[name=descricao]').val('');
            $('#form_atualiza_materia input[name=preco]').val('');
            $('#form_atualiza_materia input[name=saldo_estoque]').val('');

            $('#atualizaModalLabel').html('<span class="text-warning"><i class="fa fa-check"></i> Produto atualizado!</span>')
                .fadeIn();

            $form.parents('#atualizaItemModal').modal('hide');

        }
    });
    return false;
});

$('#form_apaga_materia')
    .submit(function () {

        var dados = $(this).serialize();

        $.ajax({
            type: "POST",
            url: "AjaxMateriaPrima/removeItem",
            data: dados,
            dataType: 'json',
            success: function (data) {
                $('#form_apaga_materia input[name=id_materia_prima]').val('');
                $('#del_item_confirma').html('<span class="text-success"><i class="fa fa-check"></i> Materia Prima ' + data.descricao + ' Apagado!</span>')
                    .hide().fadeIn();

                $('#materias li[data-li_item=' + data.id_materia_prima + ']').remove();
                $('#apagaItemModal').modal('hide');
            }
        });
        return false;
    });

/** Início - Botões Atualizar e Apagar */
$('#materias').delegate('.update_materia', 'click', function () {

    var id = $(this).attr('id');

    $.ajax({
        type: "GET",
        url: "AjaxMateriaPrima/findItem?id_materia_prima=" + id,
        data: $(this).serialize(),
        dataType: 'json',
        success: function (data) {

            $('#form_atualiza_materia input[name=id_materia_prima]').val(data.id_materia_prima);
            $('#form_atualiza_materia input[name=descricao]').val(data.descricao);
            $('#form_atualiza_materia input[name=preco]').val(data.preco);
            $('#form_atualiza_materia input[name=saldo_estoque]').val(data.saldo_estoque);

            $('#atualizaModalLabel').html('Atualizar Materia Prima');

        }
    });
});

$('#materias').delegate('.delete_materia', 'click', function () {

    var id = $(this).attr('data-delmateriaid');

    $.ajax({
        type: "GET",
        url: "AjaxMateriaPrima/findItem?id_materia_prima=" + id,
        data: $(this).serialize(),
        dataType: 'json',
        success: function (data) {

            $('#form_apaga_materia input[name=id_materia_prima]').val(data.id_materia_prima);

            $('#del_item_confirma').html('<span class="text-danger"><i class="fa fa-trash-o"></i> Apagar materia prima ' + data.descricao + '?</span>');

        }
    });
});
/** Fim - Botões Atualizar e Apagar */

$('#atualizaItemModal').on('hide.bs.modal', function() {
    $('#form_atualiza_materia').bootstrapValidator('resetForm', true);
});