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
                    <a title="Voltar" href="<?php echo base_url() . 'materiais'; ?>"
                        class="btn btn-success btn-sm float-right">Voltar</i></a>
                    <h6 class="m-0 font-weight-bold text-primary">Cadastrar materiais no estoque</h6>
                </div>
                <div class="card-body">
                    <form method="POST" name="form_materiais" enctype="multipart/form-data">

                        <div class="form-group row">

                            <div class="col-md-4">
                                <label>Nome</label>
                                <input type="text" class="form-control" name="nome_material" placeholder="Nome"
                                    value="<?php echo set_value('nome_material'); ?>">
                                <?php echo form_error('nome_material', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>

                            <div class="col-md-4">
                                <label>Quantidade</label>
                                <input type="number" class="form-control" name="quantidade" placeholder="Quantidade"
                                    value="<?php echo set_value('quantidade'); ?>">
                                <?php echo form_error('quantidade', '<small class="form-text text-danger">', '</small>'); ?>

                            </div>

                            <div class="col-md-4">
                                <label>Quantidade mínima no estoque permitida</label>
                                <input type="number" class="form-control" name="quantidade_minima"
                                    placeholder="Quantidade mínima"
                                    value="<?php echo set_value('quantidade_minima'); ?>">
                                <?php echo form_error('quantidade_minima', '<small class="form-text text-danger">', '</small>'); ?>

                            </div>

                            <div class="col-md-4">
                                <label>Valor</label>
                                <input type="number" class="form-control" name="valor" placeholder="Valor"
                                    value="<?php echo set_value('valor'); ?>">
                                <?php echo form_error('valor', '<small class="form-text text-danger">', '</small>'); ?>

                            </div>

                            <div class="col-md-4">
                                <label>Selecione o fornecedor do produto </label>
                                <select class="form-control" name="fornecedor_id">
                                    <?php foreach ($fornecedores as $fornecedor) : ?>
                                    <option value="<?php echo $fornecedor->id; ?>"
                                        <?php echo ($fornecedor->id != NULL) ? 'selected' : ''; ?>>
                                        <?php echo $fornecedor->marca; ?></option>
                                    <?php endforeach; ?>
                                </select>

                            </div>

                            <div class="col-md-4">
                                <label>Modelo</label>
                                <input type="text" class="form-control" name="modelo"
                                    placeholder="Modelo. Ex: Gol 2008 v16" value="<?php echo set_value('modelo'); ?>">
                                <?php echo form_error('modelo', '<small class="form-text text-danger">', '</small>'); ?>

                            </div>

                            <div class="col-md-4">

                                <label>Material</label>
                                <select class="form-control" name="material">
                                    <option value="plastico">Plástico</option>
                                    <option value="carbono">Carbono</option>
                                    <option value="ferro">Ferro</option>
                                    <option value="outro">Outro</option>
                                </select>

                            </div>

                        </div>




                        <div class="form-group row mb-3">

                            <div class="col-md-12">
                                <label>Observações do produto</label>
                                <textarea class="form-control form-control-user" style="width: 500px;"
                                    name="observacoes" value="<?php echo set_value('observacoes'); ?>"></textarea>
                                <?php echo form_error('observacoes', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>

                        </div>

                        <div class="form-group row mb-3">

                            <div class="col-md-4" style="margin-top: 48px;">
                                <label>Imagem</label>
                                <input type="file" name="foto" />
                                <?php echo form_error('foto', '<small class="form-text text-danger">', '</small>'); ?>

                            </div>

                        </div>

                        <button type="submit" class="btn btn-primary btn-sm">Registrar</button>
                    </form>
                </div>
            </div>

        </div>

    </div>

    <style>
    .col-md-4 {
        padding: 16px;
    }
    </style>
</body>

</html>