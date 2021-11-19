const BASE_URL = "http://localhost/automac/";
$form = $('#form').calx();

var produtos_add = [];

var result_add = false;

$counter = $('table.table').find('tbody').children().length;


if ($counter > 0) {

    $('#table_produtos tr').each(function () {

        var material = $(this).find("input.nome_material").val();

        result_add = produtos_add.includes(material);

        if (result_add == false) {

            if (typeof material !== 'undefined') {
                produtos_add.push(material);
            }
        }

    });
}

$(document).ready(function () {

    $(window).keydown(function (event) {

        if ((event.keyCode == 13)) {

            event.preventDefault();
            return false;
        }

    });

    $("#buscar_produtos").autocomplete({

        source: function (request, response) {

            $.ajax({
                url: BASE_URL + 'ajax/materiais',
                dataType: "json",
                type: 'POST',
                data: {
                    term: request.term
                },
                success: function (data) {

                    if (data.response == "false") {

                        var result = [{
                                label: 'Produto não encontrado',
                                value: response.term
                            }];
                        response(result);

                    } else {
                        response(data.message);
                    }
                },
            });
        },
        minLength: 1,
        select: function (event, ui) {

            if (ui.item.value === 'Produto não encontrado') {
                return false;
            } else {
                var id = ui.item.id;
                var nome_material = ui.item.value;
                var valor = ui.item.valor;
                var quantidade = ui.item.quantidade;
                valor = valor.replace('.', '');
                valor = valor.replace(',', '.');
                var i = ++$counter;
                var markup = '<tr>\
                    <td><input type="hidden" name="material_id[]" value="' + id + '" data-cell="A' + i + '" data-format="0" readonly></td>\
                    <td><input title="Nome" type="text" name="nome_material[]" value="' + nome_material + '" class="nome_material form-control form-control-user input-sm" data-cell="B' + i + '" readonly></td>\
                    <td><input title="Valor" name="valor_produto[]" value="' + valor + '" class="form-control form-control-user input-sm text-right money pr-1" data-cell="C' + i + '" data-format="R$ 0,0.00" readonly></td>\
                    <td><input title="Quantidade" type="text" inputmode="numeric" pattern="[-+]?[0-9]*[.,]?[0-9]+" name="quantidade_produto[]" value="" class="qty form-control form-control-user text-center" data-cell="D' + i + '" data-format="0[.]00" required></td>\
                    <td><input title="Valor total" name="valor_total[]" class="form-control form-control-user input-sm text-right pr-1" data-cell="F' + i + '" data-format="R$ 0,0.00" data-formula="D' + i + '*(C' + i + '-(C' + i + '*E' + i + '))" readonly></td>\
                    <td class="text-center"><button class="btn-remove btn btn-sm btn-danger" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">\
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>\
  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>\
</svg></button></td>\
                </tr>';

                result_add = produtos_add.includes(nome_material);

                if (result_add == true) {
                    Swal.fire({
                        icon: 'info',
                        width: 300,
                        title: 'Opss!',
                        html: 'Esse serviço já foi adicionado',
                    })
                } else {
                    $("table tbody").append(markup);
                    produtos_add.push(nome_material);
                }

                $("#qtd").keyup(function () {
                    $form.calx('calculate');
                    $("#buscar_produtos").val("");
                });

                $form.calx('update');
                $form.calx('getCell', 'G2').setFormula('SUM(F1:F' + i + ')');
            }
        }

    });

    /*Refaz o cálculo da ordem antes de cadastrá-la*/
    $('#btn_salvar').on('click', function () {
        $form.calx('calculate');
        $form.calx('getCell', 'G1').calculate();
    });

});


/*Deleta o servico da ordem*/
$('#lista_produtos').on('click', '.btn-remove', function () {

    var material_remover = $(this).closest('tr').find("input.nome_material").val();

    $(this).parent().parent().remove();

    /*Deleta do array "produtos_add" o servico já adicionado*/
    for (var aux = 0; aux < produtos_add.length; aux++) {
        if (produtos_add[aux] === material_remover) {

            produtos_add.splice(aux, 1);

        }
    }

    $form.calx('update');

});









