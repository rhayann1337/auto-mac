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
                    <h6 class="m-0 font-weight-bold text-primary">Editar serviço</h6>
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

                                    </tbody>
                                    <tfoot>
                                        <tr class="">
                                            <td colspan="5" class="text-right border-0">
                                                <label class="font-weight-bold pt-1" for="total">Total a pagar:</label>
                                            </td>
                                            <td class="text-right border-0">
                                                <input type="text" name="valor_total"
                                                    class="form-control form-control-user text-right pr-1"
                                                    data-format="$ 0,0.00" data-cell="G2" data-formula="SUM(F1:F5)"
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
                                        <?php echo form_error('cliente_id', '<div class="text-danger small">', '</div>') ?>
                                    </div>

                                    <div class="col-md-3">
                                        <label class="small my-0">Selecione o funcionário <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" name="funcionario_id">
                                            <?php foreach ($funcionarios as $funcionario) : ?>
                                            <option value="<?php echo $funcionario->id; ?>"
                                                <?php echo ($funcionario->id != NULL) ? 'selected' : ''; ?>>
                                                <?php echo $funcionario->nome_funcionario; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                </div>

                                <div class="form-group row">

                                    <div class="col-sm-6 smb-1 mb-sm-0">
                                        <label class="small my-0">Nome do serviço <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="nome_servico"
                                            value="<?php echo set_value('nome_servico'); ?>">
                                        <?php echo form_error('nome_servico', '<small class="form-text text-danger">', '</small>'); ?>
                                    </div>

                                    <div class="col-sm-3 mb-1 mb-sm-0">
                                        <label class="small my-0">Data <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="data"
                                            value="<?php echo set_value('data'); ?>">
                                        <?php echo form_error('data', '<small class="form-text text-danger">', '</small>'); ?>
                                    </div>

                                    <div class="col-sm-3 mb-1 mb-sm-0">
                                        <label class="small my-0">Valor total <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control money" name="preco"
                                            value="<?php echo set_value('preco'); ?>">
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
                                            value="<<?php echo set_value('descricao'); ?>"></textarea>
                                        <?php echo form_error('descricao', '<small class="form-text text-danger">', '</small>'); ?>
                                    </div>

                                </div>

                            </div>

                        </fieldset>

                        <button type="submit" class="btn btn-primary btn-sm" id="btn_salvar">Salvar</button>


                    </form>
                </div>
            </div>

        </div>

    </div>


</body>

</html>