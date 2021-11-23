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
                    <a title="Voltar" href="<?php echo base_url() . 'fornecedores'; ?>"
                        class="btn btn-success btn-sm float-right">Voltar</i></a>
                    <h6 class="m-0 font-weight-bold text-primary">Registrar fornecedor</h6>
                </div>
                <div class="card-body">
                    <form method="POST" name="form_add_fornecedor" enctype="multipart/form-data">

                        <div class="form-group row">

                            <div class="col-md-4">
                                <label>Marca</label>
                                <input type="text" class="form-control" name="marca"
                                    value="<?php echo set_value('marca'); ?>">
                                <?php echo form_error('marca', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>

                            <div class="col-md-4">
                                <label>Nome do contato</label>
                                <input type="text" class="form-control" name="contato"
                                    value="<?php echo set_value('contato'); ?>">
                                <?php echo form_error('contato', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>

                            <div class="col-md-4">
                                <label>Telefone</label>
                                <input type="text" class="form-control sp_celphones" name="telefone"
                                    value="<?php echo set_value('telefone'); ?>">
                                <?php echo form_error('telefone', '<small class="form-text text-danger">', '</small>'); ?>

                            </div>

                            <div class="col-md-4">
                                <label>Endereço</label>
                                <input type="text" class="form-control" name="endereco"
                                    value="<?php echo set_value('endereco'); ?>">
                                <?php echo form_error('endereco', '<small class="form-text text-danger">', '</small>'); ?>

                                <label>CEP</label>
                                <input type="text" class="form-control cep" name="cep"
                                    value="<?php echo set_value('cep'); ?>">
                                <?php echo form_error('cep', '<small class="form-text text-danger">', '</small>'); ?>

                                <label>Estado</label>
                                <input type="text" class="form-control" name="estado"
                                    value="<?php echo set_value('estado'); ?>">
                                <?php echo form_error('estado', '<small class="form-text text-danger">', '</small>'); ?>


                            </div>

                            <div class="col-md-4">
                                <label>Email</label>
                                <input type="text" class="form-control" name="email"
                                    value="<?php echo set_value('email'); ?>">
                                <?php echo form_error('email', '<small class="form-text text-danger">', '</small>'); ?>

                                <label>Cidade</label>
                                <input type="text" class="form-control" name="cidade"
                                    value="<?php echo set_value('cidade'); ?>">
                                <?php echo form_error('cidade', '<small class="form-text text-danger">', '</small>'); ?>

                                <label>Bairro</label>
                                <input type="text" class="form-control" name="bairro"
                                    value="<?php echo set_value('bairro'); ?>">
                                <?php echo form_error('bairro', '<small class="form-text text-danger">', '</small>'); ?>

                            </div>

                            <div class="col-md-4" style="margin-top: 48px;">
                                <label>Imagem</label>
                                <input type="file" name="foto" />
                                <?php echo form_error('foto', '<small class="form-text text-danger">', '</small>'); ?>

                            </div>

                            <div class="col-md-4">
                                <label>Observações</label>
                                <textarea class="form-control form-control-user" name="descricao"
                                    value="<?php echo set_value('descricao'); ?>"></textarea>
                                <?php echo form_error('descricao', '<small class="form-text text-danger">', '</small>'); ?>

                            </div>

                        </div>

                        <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
                    </form>
                </div>
            </div>

        </div>

    </div>



</body>

</html>