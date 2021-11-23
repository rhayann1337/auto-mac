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
                    <a title="Cadastrar novo orçamento" href="<?php echo base_url('orcamentos/add'); ?>"
                        class="btn btn-success btn-sm float-right"><i class="fas fa-user-plus"></i>&nbsp;Novo</a>
                    <h6 class="m-0 font-weight-bold text-primary">Orçamentos</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tabela" class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nome do cliente</th>
                                    <th>Quem realizou o orçamento</th>
                                    <th>Data</th>
                                    <th>Valor</th>
                                    <th>Veículo</th>
                                    <th>Placa</th>
                                    <th>Opções</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($orcamentos as $orcamento) :  ?>
                                <tr>
                                    <td><?php echo $orcamento->id ?></td>
                                    <td><?php echo $orcamento->nome ?></td>
                                    <td><?php echo $orcamento->nome_funcionario ?></td>
                                    <td><?php echo formata_data_banco_com_hora($orcamento->data); ?></td>
                                    <td>R$ <?php echo number_format($orcamento->valor_total, 2, ",", "."); ?></td>
                                    <td><?php echo $orcamento->veiculo ?></td>
                                    <td><?php echo $orcamento->placa ?></td>
                                    <td>
                                        <a title="Visualizar " href="javascript(void)" data-toggle="modal"
                                            data-target="#info-<?php echo $orcamento->id; ?>"
                                            class="btn btn-sm btn-success">Visualizar</a>
                                        <a title="Editar" href="<?php echo ('orcamentos/edit/' . $orcamento->id); ?>"
                                            class="btn btn-sm btn-primary">Editar</a>
                                        <a title="Excluir " href="javascript(void)" data-toggle="modal"
                                            data-target="#excluir-<?php echo $orcamento->id; ?>"
                                            class="btn btn-sm btn-danger">Excluir</a>
                                        <a title="Imprimir"
                                            href="<?php echo base_url('orcamentos/imprimir/' . $orcamento->id); ?>"
                                            class="btn btn-sm btn-dark"><i class="fas fa-print"></i></a>
                                    </td>
                                    <div class="modal fade" id="excluir-<?php echo $orcamento->id; ?>" tabindex="-1"
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
                                                        href="<?php echo base_url('orcamentos/del/' . $orcamento->id); ?>">Sim</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="info-<?php echo $orcamento->id; ?>" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Orçamento número
                                                        <?php echo $orcamento->id ?></h5>
                                                    <button class="close" type="button" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <h5>Nome do funcionário responsável</h5>
                                                    <p><?php echo $orcamento->nome_funcionario ?></p>
                                                    <hr>
                                                    <h5>Nome do cliente</h5>
                                                    <p><?php echo $orcamento->nome ?></p>
                                                    <hr>
                                                    <h5>Telefone do cliente</h5>
                                                    <p class="sp_celphones"><?php echo $orcamento->telefone_movel ?></p>
                                                    <hr>
                                                    <h5>Placa - veículo</h5>
                                                    <p><?php echo $orcamento->placa ?> -
                                                        <?php echo $orcamento->veiculo ?>
                                                    </p>
                                                    <hr>
                                                    <h5>Data</h5>
                                                    <p><?php echo formata_data_banco_com_hora($orcamento->data); ?></p>
                                                    <hr>
                                                    <h5>Valor</h5>
                                                    <p>R$
                                                        <?php echo number_format($orcamento->valor_total, 2, ",", "."); ?>
                                                    </p>
                                                    <hr>
                                                    <h5>Descrição do serviço</h5>
                                                    <p><?php echo $orcamento->descricao ?></p>
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