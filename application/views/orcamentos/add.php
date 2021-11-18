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
          <a title="Voltar" href="<?php echo base_url() . 'orcamentos'; ?>" class="btn btn-success btn-sm float-right">Voltar</i></a>
          <h6 class="m-0 font-weight-bold text-primary">Registrar serviço realizado</h6>
        </div>
        <div class="card-body">
          <form method="POST" name="form_add_orcamento">

            <div class="form-group row">

              <div class="col-md-4">
                <label>Selecione o cliente </label>
                <select class="form-control" name="cliente_id"> 
                  <?php foreach ($clientes as $cliente) : ?>
                    <option value="<?php echo $cliente->id; ?>" <?php echo ($cliente->id != NULL) ? 'selected' : ''; ?>><?php echo $cliente->nome; ?></option>
                  <?php endforeach; ?>
                </select>
                <label>OBS: Caso não encontre o cliente ou não esteja cadastrado, clique para cadastrar. <a title="Cadastrar cliente" href="<?php echo base_url() . 'clientes/add'; ?>" class="btn btn-danger btn-sm">Cadastrar</i></a></label>
               
              </div>

              <div class="col-md-4">
                <label>Selecione o funcionário que realizou o orçamento </label>
                <select class="form-control" name="funcionario_id">
                  <?php foreach ($funcionarios as $funcionario) : ?>
                    <option value="<?php echo $funcionario->id; ?>" <?php echo ($funcionario->id != NULL) ? 'selected' : ''; ?>><?php echo $funcionario->nome_funcionario; ?> <?php echo $funcionario->sobrenome; ?></option>
                  <?php endforeach; ?>
                </select>

              </div>

              <div class="col-md-4">
                <label>Valor total</label>
                <input type="number" class="form-control" name="valor_total" value="<?php echo set_value('valor_total'); ?>">
                <?php echo form_error('valor_total', '<small class="form-text text-danger">', '</small>'); ?>

              </div>

              <div class="col-md-4">
                <label>Carro e modelo</label>
                <input type="text" class="form-control" name="carro" value="<?php echo set_value('carro'); ?>">
                <?php echo form_error('carro', '<small class="form-text text-danger">', '</small>'); ?>
              </div>

              <div class="col-md-4">
                <label>Placa</label>
                <input type="text" class="form-control" name="placa" value="<?php echo set_value('placa'); ?>">
                <?php echo form_error('placa', '<small class="form-text text-danger">', '</small>'); ?>
              </div>


            </div>


            <div class="form-group row mb-3">

              <div class="col-md-12">
                <label>Descrição do serviço realizado e valores</label>
                <textarea class="form-control form-control-user" name="descricao" value="<?php echo set_value('descricao'); ?>"></textarea>
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