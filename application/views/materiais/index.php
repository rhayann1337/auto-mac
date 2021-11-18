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
  <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

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
          <a title="Cadastrar Novo Usuário" href="<?php echo base_url('materiais/add'); ?>" class="btn btn-success btn-sm float-right"><i class="fas fa-user-plus"></i>&nbsp;Novo</a>
          <h6 class="m-0 font-weight-bold text-primary">Materiais em estoque</h6>
        </div>
        <div class="card-body">
          <div class="grid-container">
            <?php foreach ($materiais as $material) : 

              ?>
              <div class="grid-item">
                <div class="container-produto">
                <img src="<?php echo $material->foto ?>" /><br />
                <h4><?php echo $material->nome ?></h4>
                <h5><?php echo $material->modelo ?></h5>
                <h5><?php echo $material->marca ?></h5>
                <h5>Qtd: <?php echo $material->quantidade ?></h5>
                <a title="Visualizar " href="javascript(void)" data-toggle="modal" data-target="#info-<?php echo $material->id; ?>" class="btn btn-sm btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                  </svg> Visualizar</a>
                  </div>
              </div>

              

              <div class="modal fade" id="info-<?php echo $material->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Informações do material</h5> <br />
                      <a title="Editar" style="margin: 0 16px;" href="<?php echo ('materiais/edit/' . $material->id); ?>" class="btn btn-sm btn-danger">Editar</a>
                      <a title="Excluir " href="javascript(void)" data-toggle="modal" data-target="#produto_excluir-<?php echo $material->id; ?>" class="btn btn-sm btn-danger">Excluir</a>
                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>
                    <div class="modal-body" style="display: flex; align-items: center; justify-content: center; flex-direction: column;">
                      <h5>Nome</h5>
                      <p><?php echo $material->nome ?> <img src="<?php echo $material->foto ?>" style="width: 48px; height: 48px" /></p>
                      <h5>Modelo</h5>
                      <p><?php echo $material->modelo ?></p>
                      <h5>Marca</h5>
                      <p><?php echo $material->marca ?></p>
                      <hr>
                      <h5>Quantidade</h5>
                      <p><?php echo $material->quantidade ?></p>
                      <hr>
                      <h5>Material</h5>
                      <p style="text-align: center;"><?php echo $material->material ?></p>
                      <hr>
                      <h5>Observações</h5>
                      <p><?php echo $material->observacoes ?></p>
                    </div>
                    <div class="modal-footer">
                      <button style="width: 100%;" class="btn btn-primary" type="button" data-dismiss="modal">Entendi</button>
                    </div>
                  </div>
                </div>
              </div>

              <div class="modal fade" id="produto_excluir-<?php echo $material->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tem certeza da deleção</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                          </div>
                          <div class="modal-body">Para excluir o registro clique em <strong>Sim</strong></div>
                          <div class="modal-footer">
                            <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Não</button>
                            <a class="btn btn-danger btn-sm" href="<?php echo base_url('materiais/del/' . $material->id); ?>">Sim</a>
                          </div>
                        </div>
                      </div>
                    </div>
            <?php endforeach; ?>
          </div>
          </table>
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

 

<style>

      .container-produto {
        background-color: rgba(0, 0, 0, 0.05);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        height: 400px;
        width: 215px;
        margin: 0;
      }

    .grid-container {
      display: grid;
      grid-template-columns: repeat(5, 300px);
      padding: 10px;
      flex-direction: column;
    }

    .grid-container img {
      width: 128px;
      height: 128px;
    }

    .grid-container p,
    h4 {
      color: black;
      font-size: 20px;
      line-height: 24px;

    }
    .grid-container h5 {
      color: black;
      font-size: 16px;
      line-height: 24px;

    }

    .grid-item {
      font-size: 30px;
      text-align: center;
    }
  </style>

</body>

</html>