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
                    <a title="Voltar" href="<?php echo base_url() . 'materiais'; ?>"
                        class="btn btn-success btn-sm float-right">Voltar</i></a>
                    <h6 class="m-0 font-weight-bold text-primary">Editar dados do produto
                </div>

                <form method="POST" name="form_material" enctype="multipart/form-data">

                    <div class="form-group row">

                        <div class="container">

                            <div class="containerImg">
                                <img src="<?php echo $material->foto ?>" style="width: 300px; height: 300px;" />

                                <div class="col-md-4" style="margin-top: 48px;">
                                    <label for='foto'>Selecionar uma imagem &#187;</label>
                                    <input type="file" name="foto" id="foto" />
                                    <?php echo form_error('foto', '<small class="form-text text-danger">', '</small>'); ?>

                                </div>
                            </div>

                            <div class=" containerDados">

                                <div class="containerInput">
                                    <a>Nome</a>
                                    <input type="text" class="form-control" name="nome_material" placeholder="Nome"
                                        value="<?php echo $material->nome_material ?>">
                                    <?php echo form_error('nome_material', '<small class="form-text text-danger">', '</small>'); ?>
                                </div>
                                <div class="containerInput">
                                    <a>Quantidade</a><input type="number" class="form-control" name="quantidade"
                                        placeholder="Quantidade" value="<?php echo $material->quantidade ?>">
                                    <?php echo form_error('quantidade', '<small class="form-text text-danger">', '</small>'); ?>
                                </div>
                                <div class="containerInput">
                                    <a>Qtd mínima</a><input type="number" class="form-control" name="quantidade_minima"
                                        placeholder="Quantidade mínima"
                                        value="<?php echo $material->quantidade_minima ?>">
                                    <?php echo form_error('quantidade_minima', '<small class="form-text text-danger">', '</small>'); ?>
                                </div>
                                <div class="containerInput" style="width: 300px;">
                                    <a>Valor</a><input type="number" class="form-control" name="valor"
                                        placeholder="Valor" value="<?php echo $material->valor ?>">
                                    <?php echo form_error('valor', '<small class="form-text text-danger">', '</small>'); ?>
                                </div>
                                <div class="containerInput" style="width: 300px;">
                                    <a>Funcionário</a><select class="form-control" name="fornecedor_id">
                                        <?php foreach ($fornecedores as $fornecedor) : ?>
                                        <option value="<?php echo $fornecedor->id; ?>"
                                            <?php echo ($fornecedor->id != NULL) ? 'selected' : ''; ?>>
                                            <?php echo $fornecedor->marca; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="containerInput">
                                    <a>Material</a><select class="form-control" name="material">
                                        <option value="plastico">Plástico</option>
                                        <option value="carbono">Carbono</option>
                                        <option value="ferro">Ferro</option>
                                        <option value="outro">Outro</option>
                                    </select>
                                </div>

                            </div>
                            <div class="containerDadosRight" style="margin-right: 16px;">
                                <div class="containerInput">
                                    <a>Modelo</a><input type="text" class="form-control" name="modelo"
                                        placeholder="Modelo. Ex: Gol 2008 v16" value="<?php echo $material->modelo ?>">
                                    <?php echo form_error('modelo', '<small class="form-text text-danger">', '</small>'); ?>
                                </div>
                                <div class="containerInput">
                                    <a>Observações</a><textarea class="form-control form-control-user"
                                        name="observacoes" value="<?php echo $material->observacoes ?>"></textarea>
                                    <?php echo form_error('observacoes', '<small class="form-text text-danger">', '</small>'); ?>
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
            padding: 6px 20px;
            width: 200px;
        }

        .containerImg img {
            margin: 16px;
            max-width: 150px;
            max-height: 150px;
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

</body>

</html>