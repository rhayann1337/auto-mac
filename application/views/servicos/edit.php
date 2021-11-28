<?php

$this->load->view('layout/sidebar');

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <script data-require="jquery@*" data-semver="3.0.0"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css" />
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.js"></script>
</head>

<body>

    <div id="content">


        <?php

        $this->load->view('layout/navbar');

        ?>

        <div class="container-fluid">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <a title="Voltar" href="<?php echo base_url() . 'servicos'; ?>"
                        class="btn btn-success btn-sm float-right">Voltar</i></a>
                    <h6 class="m-0 font-weight-bold text-primary">Editar dados de serviço</h6>
                </div>
                <div class="card-body">
                    <form class="user" action="" id="form" name="form_edit" enctype="multipart/form-data" method="post"
                        accept-charset="utf-8">


                        <fieldset id="materiais" class="mt-4 border p-2">

                            <legend class="font-small"><i class="fas fa-tools"></i>&nbsp;&nbsp;Escolha os materiais
                            </legend>

                            <div class="form-group row">
                                <div class="ui-widget col-lg-12 mb-1 mt-1">
                                    <input id="buscar_produtos" class="search form-control form-control-lg col-lg-12"
                                        placeholder="Que material você está procurando?">
                                </div>
                            </div>


                            <div class="table-responsive">
                                <table id="table_produtos" class="table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th class="" style="width: 55%">Produto</th>
                                            <th class="text-right pr-2" style="width: 12%">Valor</th>
                                            <th class="text-center" style="width: 8%">Qtd</th>
                                            <th class="text-right pr-2" style="width: 15%">Total</th>
                                            <th class="" style="width: 25%"></th>
                                            <th class="" style="width: 25%"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="lista_produtos" class="">

                                        <?php if (isset($materiais)) : ?>

                                        <!-- <?php $i = 0; ?> -->

                                        <?php foreach ($materiais as $material) : ?>

                                        <?php $i++; ?>

                                        <tr>
                                            <td><input type="hidden" name="material_id[]"
                                                    value="<?php echo $material->id ?>" data-cell="A<?php echo $i; ?>"
                                                    data-format="0" readonly></td>
                                            <td><input title="Nome" type="text" name="nome_material[]"
                                                    value="<?php echo $material->nome_material ?>"
                                                    class="nome_material form-control form-control-user input-sm"
                                                    data-cell="B<?php echo $i; ?>" readonly></td>
                                            <td><input title="Valor" name="valor_produto[]"
                                                    value="<?php echo $material->valor_produto ?>"
                                                    class="form-control form-control-user input-sm text-right money pr-1"
                                                    data-cell="C<?php echo $i; ?>" data-format="R$ 0,0.00" readonly>
                                            </td>
                                            <td><input id="qtd" title="Quantidade" type="text" inputmode="numeric"
                                                    pattern="[-+]?[0-9]*[.,]?[0-9]+" name="quantidade_produto[]"
                                                    value="<?php echo $material->quantidade_produto ?>"
                                                    class="qty form-control form-control-user text-center"
                                                    data-cell="D<?php echo $i; ?>" data-format="0[.]00" required></td>
                                            <td class="text-center"><button
                                                    class="btn-remove btn btn-sm btn-danger"><svg
                                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                        <path
                                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                        <path fill-rule="evenodd"
                                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                                    </svg></button></td>
                                        </tr>


                                        <?php endforeach; ?>

                                        <?php endif; ?>

                                    </tbody>
                                    <tfoot>
                                        <tr class="">
                                            <td colspan="5" class="text-right border-0">
                                                <label class="font-weight-bold pt-1" for="total">Total a pagar:</label>
                                            </td>
                                            <td class="text-right border-0">
                                                <input type="text" name="preco"
                                                    class="form-control form-control-user text-right pr-1"
                                                    data-format="$ 0,0.00" data-cell="G2" data-formula="SUM(C1:C5)"
                                                    readonly="">
                                            </td>
                                            <td class="border-0">&nbsp;</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                        </fieldset>

                        <fieldset class="mt-4 border p-2">

                            <legend class="font-small"><i class="far fa-list-alt"></i>&nbsp;&nbsp;Informações</legend>

                            <div class="">
                                <div class="form-group row">

                                    <div class="col-sm-6 mb-1 mb-sm-0">
                                        <label class="small my-0">Escolha o cliente <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" name="cliente_id">
                                            <?php foreach ($clientes as $cliente) : ?>
                                            <option value="<?php echo $cliente->id; ?>"
                                                <?php echo ($cliente->id != NULL) ? 'selected' : ''; ?>>
                                                <?php echo $cliente->nome; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?php echo form_error('ordem_servico_cliente_id', '<div class="text-danger small">', '</div>') ?>
                                    </div>

                                    <div class="col-md-3">
                                        <label class="small my-0">Selecione o funcionário <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" name="funcionario_id">
                                            <?php foreach ($funcionarios as $funcionario) : ?>
                                            <option value="<?php echo $funcionario->id; ?>"
                                                <?php echo ($funcionario->id != NULL) ? 'selected' : ''; ?>>
                                                <?php echo base64_decode($funcionario->nome_funcionario); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                </div>

                                <div class="form-group row">

                                    <div class="col-sm-6 mb-1 mb-sm-0">
                                        <label class="small my-0">Nome do serviço <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="nome_servico"
                                            value="<?php echo $servico->nome_servico; ?>">
                                        <?php echo form_error('nome_servico', '<small class="form-text text-danger">', '</small>'); ?>
                                    </div>

                                    <div class="col-sm-3 mb-1 mb-sm-0">
                                        <label class="small my-0">Data <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="data"
                                            value="<?php echo $servico->data; ?>">
                                        <?php echo form_error('data', '<small class="form-text text-danger">', '</small>'); ?>
                                    </div>


                                    <div class="col-sm-3 mb-1 mb-sm-0">
                                        <label class="small my-0">Valor total <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="preco"
                                            value="<?php echo $servico->preco ?>">
                                        <?php echo form_error('preco', '<small class="form-text text-danger">', '</small>'); ?>
                                    </div>

                                    <div class="col-sm-3 mb-1 mb-sm-0">
                                        <label>Serviço realizado através de orçamento?</label>

                                        <select class="form-control" name="registro_orcamento">

                                            <option value="2">Sim</option>
                                            <option value="1">Não</option>

                                        </select>

                                    </div>

                                </div>


                                <div class="form-group row">

                                    <div class="col-sm-6 mb-1 mb-sm-0">
                                        <label class="small my-0">Descrição <span class="text-danger">*</span></label>
                                        <textarea class="form-control form-control-user" name="descricao"
                                            value="<?php echo $servico->descricao; ?>"></textarea>
                                        <?php echo form_error('descricao', '<small class="form-text text-danger">', '</small>'); ?>
                                    </div>

                                </div>

                            </div>

                        </fieldset>

                        <input type="hidden" name="id" value="<?php echo $servico->id ?>">

                        <button type="submit" class="btn btn-primary btn-sm" id="btn_salvar">Salvar</button>


                    </form>
                </div>
            </div>

        </div>

    </div>


</body>

</html>