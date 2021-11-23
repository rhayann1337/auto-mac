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
                    <a title="Cadastrar Novo Usuário" href="<?php echo base_url('usuarios/add'); ?>"
                        class="btn btn-success btn-sm float-right"><i class="fas fa-user-plus"></i>&nbsp;Novo</a>
                    <h6 class="m-0 font-weight-bold text-primary">Usuários</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tabela" class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Usuário</th>
                                    <th>Login</th>
                                    <th>Status</th>
                                    <th>Opções</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($usuarios as $user) :  ?>
                                <tr>
                                    <td><?php echo $user->id ?></td>
                                    <td><?php echo $user->username ?></td>
                                    <td><?php echo $user->email ?></td>
                                    <td class="text-center pr-4">
                                        <?php echo ($user->active == 1 ? '<span class="badge badge-info btn-sm">Ativo</span>' : '<span class="badge badge-danger btn-sm">Inativo</span>') ?>
                                    </td>
                                    <td>
                                        <a title="Editar" href="<?php echo ('usuarios/edit/' . $user->id); ?>"
                                            class="btn btn-sm btn-primary">Editar</a>
                                        <a title="Excluir " href="javascript(void)" data-toggle="modal"
                                            data-target="#user-<?php echo $user->id; ?>"
                                            class="btn btn-sm btn-danger">Excluir</a>
                                    </td>
                                </tr>


                                <div class="modal fade" id="user-<?php echo $user->id; ?>" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Tem certeza da deleção
                                                </h5>
                                                <button class="close" type="button" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">Para excluir o registro clique em
                                                <strong>Sim</strong></div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary btn-sm" type="button"
                                                    data-dismiss="modal">Não</button>
                                                <a class="btn btn-danger btn-sm"
                                                    href="<?php echo base_url('usuarios/del/' . $user->id); ?>">Sim</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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