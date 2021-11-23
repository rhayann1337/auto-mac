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
                    <a title="Voltar" href="<?php echo base_url() . 'orcamentos'; ?>"
                        class="btn btn-success btn-sm float-right">Voltar</i></a>
                    <h6 class="m-0 font-weight-bold text-primary">Editar orçamento</h6>
                </div>
                <div class="card-body">

                    <form method="POST" name="form_orcamento_add">

                        <div class="form-group row">

                            <div class="container">

                                <div class="containerImg">
                                    <img
                                        src="http://3.bp.blogspot.com/-6pQMewtzRmM/UmILecKciqI/AAAAAAAAZ1U/UMbKsJsviJ4/s1600/Ferramenta-em-pnr-queroimagem-Cei%C3%A7a-Crispim.png" />
                                </div>

                                <div class="containerDados">

                                    <div class="containerInput">
                                        <a>Cliente</a>
                                        <select class="form-control" name="cliente_id">
                                            <?php foreach ($clientes as $cliente) : ?>
                                            <option value="<?php echo $cliente->id; ?>"
                                                <?php echo ($cliente->id != NULL) ? 'selected' : ''; ?>>
                                                <?php echo $cliente->nome; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="containerInput">
                                        <a>Funcionario</a>
                                        <select class="form-control" name="funcionario_id">
                                            <?php foreach ($funcionarios as $funcionario) : ?>
                                            <option value="<?php echo $funcionario->id; ?>"
                                                <?php echo ($funcionario->id != NULL) ? 'selected' : ''; ?>>
                                                <?php echo $funcionario->nome_funcionario; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="containerInput">
                                        <a>Valor total</a><input type="text" class="form-control" name="valor_total"
                                            value="<?php echo number_format($orcamento->valor_total, 2, ",", "."); ?>">
                                        <?php echo form_error('valor_total', '<small class="form-text text-danger">', '</small>'); ?>
                                    </div>

                                    <div class="containerInput">
                                        <label>Descrição do serviço realizado e valores</label>
                                        <textarea class="form-control form-control-user" name="descricao"
                                            value="<?php echo $orcamento->descricao; ?>"></textarea>
                                        <?php echo form_error('descricao', '<small class="form-text text-danger">', '</small>'); ?>
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


    <style>
    .container {
        display: flex;

    }

    .container img {
        max-width: 300px;
        max-height: 300px;
    }

    .containerDados {
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
        margin: 8px 16px;
    }

    .container textarea {
        max-width: 300px;
        height: 300px;
    }

    .containerInput select {
        margin: 8px;
    }
    </style>

</body>

</html>