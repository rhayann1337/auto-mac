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
                    <a title="Cadastrar Novo Usuário" href="<?php echo base_url('servicos/add'); ?>"
                        class="btn btn-success btn-sm float-right"><i class="fas fa-user-plus"></i>&nbsp;Novo</a>
                    <a style="margin: 0 16px 0 0;" title="Listagem simplificada"
                        href="<?php echo base_url('servicos'); ?>" class="btn btn-danger btn-sm float-right"><i
                            class="fas fa-user-plus"></i>&nbsp;Listagem simplificada</a>
                    <a title="Cadastrar Novo Usuário" style="margin: 0 16px;"
                        href="<?php echo base_url('relatorios/servicos'); ?>"
                        class="btn btn-warning btn-sm float-right"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                            height="16" fill="currentColor" class="bi bi-bar-chart" viewBox="0 0 16 16">
                            <path
                                d="M4 11H2v3h2v-3zm5-4H7v7h2V7zm5-5v12h-2V2h2zm-2-1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1h-2zM6 7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7zm-5 4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-3z" />
                        </svg>&nbsp;Gerar relatório</a>
                    <h6 class="m-0 font-weight-bold text-primary">Serviços</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tabela" class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Serviço</th>
                                    <th>Nome do responsável</th>
                                    <th>Nome do cliente</th>
                                    <th>Telefone</th>
                                    <th>Placa</th>
                                    <th>Veículo</th>
                                    <th>Opções</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($servicos as $servico) :  ?>
                                <tr>
                                    <td><?php echo $servico->id ?></td>
                                    <td><?php echo $servico->nome_servico ?></td>
                                    <td><?php echo $servico->nome_funcionario ?></td>
                                    <td><?php echo $servico->nome ?></td>
                                    <td class="sp_celphones"><?php echo $servico->telefone_movel ?></td>
                                    <td><?php echo $servico->placa ?></td>
                                    <td><?php echo $servico->veiculo ?></td>
                                    <td>
                                        <a title="Visualizar " href="javascript(void)" data-toggle="modal"
                                            data-target="#info-<?php echo $servico->id; ?>"
                                            class="btn btn-sm btn-success">Visualizar</a>
                                        <a title="Editar" href="<?php echo ('servicos/edit/' . $servico->id); ?>"
                                            class="btn btn-sm btn-primary">Editar</a>
                                        <a title="Excluir " href="javascript(void)" data-toggle="modal"
                                            data-target="#excluir-<?php echo $servico->id; ?>"
                                            class="btn btn-sm btn-danger">Excluir</a>
                                        <a title="Imprimir"
                                            href="<?php echo base_url('servicos/imprimir/' . $servico->id); ?>"
                                            class="btn btn-sm btn-dark"><i class="fas fa-print"></i></a>
                                    </td>
                                    <div class="modal fade" id="excluir-<?php echo $servico->id; ?>" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                        href="<?php echo base_url('servicos/del/' . $servico->id); ?>">Sim</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="info-<?php echo $servico->id; ?>" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Informações do
                                                        serviço</h5>
                                                    <button class="close" type="button" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <h5>Ordem de serviço</h5>
                                                    <p><?php echo $servico->id ?></p>
                                                    <hr>
                                                    <h5>Nome do serviço</h5>
                                                    <p><?php echo $servico->nome_servico ?></p>
                                                    <hr>
                                                    <h5>Nome do responsável</h5>
                                                    <p><?php echo $servico->nome_funcionario ?></p>
                                                    <hr>
                                                    <h5>Nome do cliente</h5>
                                                    <p><?php echo $servico->nome ?></p>
                                                    <hr>
                                                    <h5>Telefone do cliente</h5>
                                                    <p class="sp_celphones"><?php echo $servico->telefone_movel ?></p>
                                                    <hr>
                                                    <h5>Placa do veículo</h5>
                                                    <p><?php echo $servico->placa ?> - <?php echo $servico->veiculo ?>
                                                    </p>
                                                    <hr>
                                                    <h5>Valor</h5>
                                                    <p class="money">R$ <?php echo $servico->preco ?></p>
                                                    <hr>
                                                    <h5>Descrição do serviço</h5>
                                                    <p><?php echo $servico->descricao ?></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button"
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

</body>

</html>