<?php

$this->load->view('layout/sidebar');

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <script data-require="jquery@*" data-semver="3.0.0" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.js"></script>
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
          <a title="Voltar" href="<?php echo base_url() . 'usuarios'; ?>" class="btn btn-success btn-sm float-right">Voltar</i></a>
          <h6 class="m-0 font-weight-bold text-primary">Registrar usuário</h6>
        </div>
        <div class="card-body">
          <form method="POST" name="form_edit">

            <div class="form-group row">

              <div class="col-md-4">
                <label>Nome</label>
                <input type="text" class="form-control" name="first_name" placeholder="Seu nome" value="<?php echo set_value('first_name'); ?>">
                <?php echo form_error('first_name', '<small class="form-text text-danger">', '</small>'); ?>
              </div>

              <div class="col-md-4">
                <label>Sobrenome</label>
                <input type="text" class="form-control" name="last_name" placeholder="Seu sobrenome" value="<?php echo set_value('last_name'); ?>">
                <?php echo form_error('last_name', '<small class="form-text text-danger">', '</small>'); ?>

              </div>

              <div class="col-md-4">
                <label>E-mail &nbsp;(Login)</label>
                <input type="email" class="form-control" name="email" placeholder="Seu email" value="<?php echo set_value('email'); ?>">
                <?php echo form_error('email', '<small class="form-text text-danger">', '</small>'); ?>

              </div>

            </div>


            <div class="form-group row">

              <div class="col-md-4">
                <label>Usuário</label>
                <input type="text" class="form-control" name="username" placeholder="Seu usuário" value="<?php echo set_value('username'); ?>">
                <?php echo form_error('username', '<small class="form-text text-danger">', '</small>'); ?>

              </div>

              <div class="col-md-4">
                <label>Perfil de acesso</label>

                <select class="form-control" name="tipo_usuario">

                  <option value="2">Suporte</option>
                  <option value="1">Administrador</option>

                </select>

              </div>

            </div>


            <div class="form-group row">

              <div class="col-md-6">
                <label>Senha</label>
                <input type="password" class="form-control" name="password" placeholder="Sua senha">
                <?php echo form_error('password', '<small class="form-text text-danger">', '</small>'); ?>

              </div>


              <div class="col-md-6">
                <label>Confirme</label>
                <input type="password" class="form-control" name="confirm_password" placeholder="Confirme sua senha">
                <?php echo form_error('confirm_password', '<small class="form-text text-danger">', '</small>'); ?>

              </div>

            </div>

            <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
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