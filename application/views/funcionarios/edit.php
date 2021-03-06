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

        <div class="container-fluid" style="max-width: 1048px;">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <a title="Voltar" href="<?php echo base_url() . 'funcionarios'; ?>"
                        class="btn btn-success btn-sm float-right">Voltar</i></a>
                    <h6 class="m-0 font-weight-bold text-primary">Editar dados do funcionário
                        <?php echo base64_decode($funcionario->nome_funcionario); ?>
                        <?php echo base64_decode($funcionario->sobrenome); ?></h6>
                </div>
                <div class="card-body">
                    <style>
                    .container {
                        display: flex;

                    }

                    .containerImg {
                        max-width: 300px;
                        max-height: 300px;
                    }

                    .containerImg input[type='file'] {
                        display: none
                    }

                    .containerImg label {
                        background-color: #3498db;
                        border-radius: 5px;
                        color: #fff;
                        cursor: pointer;
                        margin: 10px;
                        padding: 6px 20px
                    }

                    .containerDados {
                        margin: 32px 0 32px 32px;
                        ;
                    }

                    .containerDadosRight {
                        margin: 32px;

                    }


                    .button {
                        display: flex;
                        align-items: flex-end;
                        justify-content: center;
                        width: 100%;
                    }

                    .button button {
                        width: 100px;
                        height: 32px;
                    }

                    .containerInput {
                        display: flex;
                        margin: 16px 0;
                    }

                    .containerInput a {
                        display: flex;
                        align-items: center;
                        margin: 0 16px;
                    }

                    .containerInput select {
                        margin: 8px;
                    }
                    </style>
                    <form method="POST" name="form_funcionario" enctype="multipart/form-data">

                        <div class="form-group row">

                            <div class="container">

                                <div class="containerImg">
                                    <img src="<?php echo $funcionario->foto ?>" style="width: 300px; height: 300px;" />

                                    <div class="col-md-4" style="margin-top: 48px;">
                                        <label for='foto'>Selecionar uma foto &#187;</label>
                                        <input type="file" name="foto" id="foto" />
                                        <?php echo form_error('foto', '<small class="form-text text-danger">', '</small>'); ?>

                                    </div>
                                </div>

                                <div class="containerDados">

                                    <div class="containerInput">
                                        <a>Nome</a><input type="text" class="form-control" name="nome_funcionario"
                                            placeholder="Nome"
                                            value="<?php echo base64_decode($funcionario->nome_funcionario); ?>">
                                        <?php echo form_error('nome_funcionario', '<small class="form-text text-danger">', '</small>'); ?>
                                    </div>
                                    <div class="containerInput">
                                        <a>Sobrenome</a><input type="text" class="form-control" name="sobrenome"
                                            placeholder="Sobrenome"
                                            value="<?php echo base64_decode($funcionario->sobrenome); ?>">
                                        <?php echo form_error('sobrenome', '<small class="form-text text-danger">', '</small>'); ?>
                                    </div>
                                    <div class="containerInput">
                                        <a>CPF</a><input type="text" class="form-control cpf" name="cpf"
                                            placeholder="Cpf" value="<?php echo base64_decode($funcionario->cpf); ?>">
                                        <?php echo form_error('cpf', '<small class="form-text text-danger">', '</small>'); ?>
                                    </div>
                                    <div class="containerInput" style="width: 300px;">
                                        <a>Email</a><input type="email" class="form-control" name="email"
                                            placeholder="Email"
                                            value="<?php echo base64_decode($funcionario->email); ?>">
                                        <?php echo form_error('email', '<small class="form-text text-danger">', '</small>'); ?>
                                    </div>
                                    <div class="containerInput" style="width: 300px;">
                                        <a>Endereço</a><input type="text" class="form-control" name="endereco"
                                            placeholder="Endereço"
                                            value="<?php echo base64_decode($funcionario->endereco); ?>">
                                        <?php echo form_error('endereco', '<small class="form-text text-danger">', '</small>'); ?>
                                    </div>
                                    <div class="containerInput">
                                        <a>Telefone</a><input type="text" class="form-control sp_celphones"
                                            name="telefone_fixo" placeholder="Telefone"
                                            value="<?php echo base64_decode($funcionario->telefone_fixo); ?>">
                                        <?php echo form_error('telefone_fixo', '<small class="form-text text-danger">', '</small>'); ?>
                                    </div>

                                </div>
                                <div class="containerDadosRight" style="margin-right: 16px;">
                                    <div class="containerInput">
                                        <a>Celular</a><input type="text" class="form-control sp_celphones"
                                            name="telefone_movel" placeholder="Celular"
                                            value="<?php echo base64_decode($funcionario->telefone_movel); ?>">
                                        <?php echo form_error('telefone_movel', '<small class="form-text text-danger">', '</small>'); ?>
                                    </div>
                                    <div class="containerInput">
                                        <a>RG</a><input type="text" class="form-control rg" name="rg" placeholder="RG"
                                            value="<?php echo base64_decode($funcionario->rg); ?>">
                                        <?php echo form_error('rg', '<small class="form-text text-danger">', '</small>'); ?>
                                    </div>
                                    <div class="containerInput">
                                        <a>Cargo</a><input type="text" class="form-control" name="cargo"
                                            placeholder="cargo"
                                            value="<?php echo base64_decode($funcionario->cargo); ?>">
                                        <?php echo form_error('cargo', '<small class="form-text text-danger">', '</small>'); ?>
                                    </div>
                                    <div class="containerInput">
                                        <label class="small my-0">Data de nascimento</label>
                                        <input type="date" class="form-control form-control-user-date"
                                            name="data_nascimento"
                                            value="<?php echo base64_decode($funcionario->data_nascimento); ?>">
                                    </div>
                                    <div class="containerInput">
                                        <a>Sexo</a>
                                        <select class="form-control" name="sexo">
                                            <option value="Masculino">Masculino</option>
                                            <option value="Feminino">Feminino</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="button">

                                <button type="submit" class="btn btn-primary btn-sm">Salvar</button>

                            </div>
                    </form>
                </div>
            </div>

        </div>

    </div>

</body>

</html>