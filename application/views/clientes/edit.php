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
                    <a title="Voltar" href="<?php echo base_url() . 'clientes'; ?>"
                        class="btn btn-success btn-sm float-right">Voltar</i></a>
                    <h6 class="m-0 font-weight-bold text-primary">Editar dados do cliente <?php echo $cliente->nome ?>
                    </h6>
                </div>
                <div class="card-body">
                    <form method="POST" name="form_cliente">

                        <div class="form-group row">

                            <div class="col-md-4">
                                <label>Nome</label>
                                <input type="text" class="form-control" name="nome" placeholder="Nome"
                                    value="<?php echo $cliente->nome ?>">
                                <?php echo form_error('nome', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>

                            <div class="col-md-4">
                                <label>Sobrenome</label>
                                <input type="text" class="form-control" name="sobrenome" placeholder="Sobrenome"
                                    value="<?php echo $cliente->sobrenome ?>">
                                <?php echo form_error('sobrenome', '<small class="form-text text-danger">', '</small>'); ?>

                            </div>

                            <div class="col-md-4">
                                <label>CPF</label>
                                <input type="text" class="form-control cpf" name="cpf" placeholder="Cpf"
                                    value="<?php echo $cliente->cpf ?>">
                                <?php echo form_error('cpf', '<small class="form-text text-danger">', '</small>'); ?>

                            </div>

                            <div class="col-md-4">
                                <label>E-mail </label>
                                <input type="email" class="form-control" name="email" placeholder="Email"
                                    value="<?php echo $cliente->email ?>">
                                <?php echo form_error('email', '<small class="form-text text-danger">', '</small>'); ?>

                            </div>

                        </div>


                        <div class="form-group row">

                            <div class="col-md-4">
                                <label>Telefone Fixo</label>
                                <input type="text" class="form-control sp_celphones" name="telefone_fixo"
                                    placeholder="Telefone" value="<?php echo $cliente->telefone_fixo ?>">
                                <?php echo form_error('telefone_fixo', '<small class="form-text text-danger">', '</small>'); ?>

                            </div>

                            <div class="col-md-4">
                                <label>Celular</label>
                                <input type="text" class="form-control sp_celphones" name="telefone_movel"
                                    placeholder="Celular" value="<?php echo $cliente->telefone_movel ?>">
                                <?php echo form_error('telefone_movel', '<small class="form-text text-danger">', '</small>'); ?>

                            </div>

                            <div class="col-md-4">

                                <label>Sexo</label>

                                <select class="form-control" name="active">

                                    <option value="0">Masculino</option>
                                    <option value="1">Feminino</option>

                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Veiculo - Informações completas </label>
                                <input type="text" class="form-control" name="veiculo" placeholder="Veiculo"
                                    value="<?php echo $cliente->veiculo ?>">
                                <?php echo form_error('veiculo', '<small class="form-text text-danger">', '</small>'); ?>

                            </div>

                            <div class="col-md-4">
                                <label>Placa</label>
                                <input type="text" class="form-control" name="placa" placeholder="Placa"
                                    value="<?php echo $cliente->placa ?>">
                                <?php echo form_error('placa', '<small class="form-text text-danger">', '</small>'); ?>

                            </div>

                            <div class="col-md-4">
                                <label>Endereço</label>
                                <input type="text" class="form-control" name="endereco" placeholder="Endereço"
                                    value="<?php echo $cliente->endereco ?>">
                                <?php echo form_error('endereco', '<small class="form-text text-danger">', '</small>'); ?>

                            </div>

                        </div>

                        <input type="hidden" name="id" value="<?php echo $cliente->id ?>">
                        <div class="containerButton"
                            style="display: flex; align-items: center; justify-content: center;">
                            <button type="submit" class="btn btn-primary btn" style="width: 150px;">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </div>



</body>

</html>