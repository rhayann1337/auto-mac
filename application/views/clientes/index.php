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
    <script type="text/javascript" charset="utf8"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

</head>

<body>

    <div id="content">


        <?php

        $this->load->view('layout/navbar');

        ?>

        <div class="container-fluid">

            <?php if ($message = $this->session->flashdata('sucesso')) : ?>

            <div class="row">

                <div class="col-md-12">

                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong><i class="far fa-smile-wink"></i>&nbsp;&nbsp;<?php echo $message ?></strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                </div>

            </div>

            <?php endif; ?>


            <?php if ($message = $this->session->flashdata('error')) : ?>

            <div class="row">

                <div class="col-md-12">

                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong><i class="fas fa-exclamation-triangle"></i>&nbsp;&nbsp;<?php echo $message ?></strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                </div>

            </div>

            <?php endif; ?>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <a title="Cadastrar Novo Usuário" href="<?php echo base_url('clientes/add'); ?>"
                        class="btn btn-success btn-sm float-right"><i class="fas fa-user-plus"></i>&nbsp;Novo</a>
                    <h6 class="m-0 font-weight-bold text-primary">Clientes</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tabela" class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Celular</th>
                                    <th>Veiculo</th>
                                    <th>Placa</th>
                                    <th>Opções</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($clientes as $cliente) :  ?>
                                <tr>
                                    <td><?php echo $cliente->id ?></td>
                                    <td><?php echo $cliente->nome ?></td>
                                    <td><?php echo $cliente->email ?></td>
                                    <td class="sp_celphones"><?php echo $cliente->telefone_movel ?></td>
                                    <td><?php echo $cliente->veiculo ?></td>
                                    <td><?php echo $cliente->placa ?></td>
                                    <td>
                                        <a title="Visualizar " href="javascript(void)" data-toggle="modal"
                                            data-target="#servico_info-<?php echo $cliente->id; ?>"
                                            class="btn btn-sm btn-success">Visualizar</a>
                                        <a title="Editar" href="<?php echo ('clientes/edit/' . $cliente->id); ?>"
                                            class="btn btn-sm btn-primary">Editar</a>
                                        <a title="Excluir " href="javascript(void)" data-toggle="modal"
                                            data-target="#cliente_excluir-<?php echo $cliente->id; ?>"
                                            class="btn btn-sm btn-danger">Excluir</a>
                                    </td>
                                    <div class="modal fade" id="cliente_excluir-<?php echo $cliente->id; ?>"
                                        tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Tem certeza da
                                                        deleção</h5>
                                                    <button class="close" type="button" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">Para excluir o registro clique em
                                                    <strong>Sim</strong>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary btn-sm" type="button"
                                                        data-dismiss="modal">Não</button>
                                                    <a class="btn btn-danger btn-sm"
                                                        href="<?php echo base_url('clientes/del/' . $cliente->id); ?>">Sim</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="servico_info-<?php echo $cliente->id; ?>" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Informações do
                                                        cliente</h5>
                                                    <button class="close" type="button" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <h5>Nome</h5>
                                                    <p><?php echo $cliente->nome ?> <?php echo $cliente->sobrenome ?>
                                                    </p>
                                                    <hr>
                                                    <h5>Email</h5>
                                                    <p><?php echo $cliente->email ?></p>
                                                    <hr>
                                                    <h5>Telefone fixo</h5>
                                                    <p class="sp_celphones"><?php echo $cliente->telefone_fixo ?></p>
                                                    <hr>
                                                    <h5>Celular</h5>
                                                    <p class="sp_celphones"><?php echo $cliente->telefone_movel ?></p>
                                                    <hr>
                                                    <h5>Endereço</h5>
                                                    <p><?php echo $cliente->endereco ?></p>
                                                    <hr>
                                                    <h5>Sexo</h5>
                                                    <p><?php echo $cliente->sexo ?></p>
                                                    <hr>
                                                    <h5>Veiculo</h5>
                                                    <p><?php echo $cliente->veiculo ?></p>
                                                    <hr>
                                                    <h5>Placa</h5>
                                                    <p><?php echo $cliente->placa ?></p>
                                                </div>
                                                <div class="modal-footer"
                                                    style="display: flex; align-items: center; justify-content: center;">
                                                    <button style="width: 300px;" class="btn btn-primary" type="button"
                                                        data-dismiss="modal">Ok</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tr>


                                <?php endforeach;  ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>

    </div>

    <style>
    .modal-body {
        display: flex;
        align-items: center;
        flex-direction: column;
    }
    </style>

</body>

</html>