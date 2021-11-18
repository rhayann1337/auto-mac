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
          <a title="Cadastrar Novo Usuário" href="<?php echo base_url('funcionarios/add'); ?>" class="btn btn-success btn-sm float-right"><i class="fas fa-user-plus"></i>&nbsp;Novo</a>
          <h6 class="m-0 font-weight-bold text-primary">Funcionários</h6>
        </div>
        <div class="containerGeral">
        <?php foreach ($funcionarios as $funcionario) : ?>
          <div class="container">
          <div class="card">
            <div class="imgBx">
              <img src="<?php echo $funcionario->foto ?>">
            </div>
            <div class="contentBx">
              <h2><?php echo $funcionario->nome_funcionario ?></h2>
              <h5><?php echo $funcionario->cargo ?></h2>
              <a title="Visualizar " href="<?php echo ('funcionarios/edit/' . $funcionario->id); ?>" >Visualizar dados</a>
            </div>
          </div>
        </div>
         
            <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>

  </div>

  <style>

@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');


*{
  font-family: 'Poppins', sans-serif;
}

.containerGeral {
  display: flex;
  flex-direction: row;
}

.container{
  position: relative;
  padding: 16px;
}

.container .card{
  position: relative;
  width: 320px;
  height: 450px;
  background: #232323;
  border-radius: 20px;
  overflow: hidden;
}

.container .card:before{
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  clip-path: circle(150px at 80% 20%);
  transition: 0.5s ease-in-out;
}

.container .card:hover:before{
  clip-path: circle(300px at 80% -20%);
}

.container .card:after{
  position: absolute;
  top: 30%;
  left: -20%;
  font-size: 12em;
  font-weight: 800;
  font-style: italic;
  color: rgba(255,255,25,0.05)
}

.container .card .imgBx{
  position: relative;
  top: 50%;
  transform: translateY(-50%);
  z-index: 10000;
  width: 100%;
  height: 220px;
  transition: 0.5s;
}

.container .card:hover .imgBx{
  top: 0%;
  transform: translateY(0%);
    
}

.container .card .imgBx img{
  position: relative;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%) rotate(0deg);
  width: 230px;
  height: 230px;
}

.container .card .contentBx{
  position: absolute;
  bottom: 0;
  width: 100%;
  height: 100px;
  text-align: center;
  transition: 1s;
  z-index: 10;
}

.container .card:hover .contentBx{
  height: 210px;
}

.container .card .contentBx h2{
  position: relative;
  font-weight: 600;
  letter-spacing: 1px;
  color: #fff;
  margin: 0;
}

.container .card .contentBx .size, .container .card .contentBx .color {
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 8px 20px;
  transition: 0.5s;opacity: 0;
  visibility: hidden;
  padding-top: 0;
  padding-bottom: 0;
}

.container .card:hover .contentBx .size{
  opacity: 1;
  visibility: visible;
  transition-delay: 0.5s;
}

.container .card:hover .contentBx .color{
  opacity: 1;
  visibility: visible;
  transition-delay: 0.6s;
}

.container .card .contentBx .size h3, .container .card .contentBx .color h3{
  color: #fff;
  font-weight: 300;
  font-size: 14px;
  text-transform: uppercase;
  letter-spacing: 2px;
  margin-right: 10px;
}

.container .card .contentBx .size span{
  width: 26px;
  height: 26px;
  text-align: center;
  line-height: 26px;
  font-size: 14px;
  display: inline-block;
  color: #111;
  background: #fff;
  margin: 0 5px;
  transition: 0.5s;
  color: #111;
  border-radius: 4px;
  cursor: pointer;
}

.container .card .contentBx .size span:hover{
  background: #9bdc28;
}

.container .card .contentBx .color span{
  width: 20px;
  height: 20px;
  background: #ff0;
  border-radius: 50%;
  margin: 0 5px;
  cursor: pointer;
}

.container .card .contentBx .color span:nth-child(2){
  background: #9bdc28;
}

.container .card .contentBx .color span:nth-child(3){
  background: #03a9f4;
}

.container .card .contentBx .color span:nth-child(4){
  background: #e91e63;
}

.container .card .contentBx a{
  display: inline-block;
  padding: 10px 20px;
  background: #fff;
  border-radius: 4px;
  margin-top: 10px;
  text-decoration: none;
  font-weight: 600;
  color: #111;
  opacity: 0;
  transform: translateY(50px);
  transition: 0.5s;
  margin-top: 0;
}

.container .card:hover .contentBx a{
  opacity: 1;
  transform: translateY(0px);
  transition-delay: 0.75s;
  
}


    .modal-body {
      display: flex;
      align-items: center;
      flex-direction: column;
    }
  </style>



  <style>
    .container-funcionario {
      background-color: rgba(0, 0, 0, 0.05);
      border-radius: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      height: 300px;
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