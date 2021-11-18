<?php $this->load->view('layout/sidebar'); ?>


<div id="content">

  <?php $this->load->view('layout/navbar'); ?>

  <div class="container-fluid">

    <?php if ($this->session->flashdata('success')) : $message = $this->session->flashdata('success') ?>
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
    <?php if ($this->session->flashdata('info')) : $message = $this->session->flashdata('info') ?>
      <div class="row">
        <div class="col-md-12">
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong><i class="fas fa-exclamation-triangle"></i>&nbsp;&nbsp;<?php echo $message ?></strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        </div>
      </div>
    <?php endif; ?>


    <div class="row">

      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total de valores de serviços realizados</div>
                <div class="h5 mb-0 font-weight-bold text-success"><?php echo 'R$&nbsp;' . ($valor_servicos->preco == NULL ? '0,00' : $valor_servicos->preco); ?></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-shopping-cart fa-3x text-success"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Quantidade de serviços realizados</div>
                <div class="h5 mb-0 font-weight-bold text-success"><?php echo '&nbsp;' . ($quantidade_servicos->id == NULL ? '0,00' : $quantidade_servicos->id); ?></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-wrench fa-3x text-success"></i>

              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Quantidade de orçamentos realizados</div>
                <div class="row no-gutters align-items-center">
                  <div class="col-auto">
                    <div class="h5 mb-0 mr-3 font-weight-bold text-danger"><?php echo '&nbsp;' . ($quantidade_orcamentos->id == NULL ? '0,00' : $quantidade_orcamentos->id); ?></div>
                  </div>
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-money-bill-alt fa-3x text-danger"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Quantidade de clientes</div>
                <div class="row no-gutters align-items-center">
                  <div class="col-auto">
                    <div class="h5 mb-0 mr-3 font-weight-bold text-warning"><?php echo '&nbsp;' . ($quantidade_clientes->id == NULL ? '0,00' : $quantidade_clientes->id); ?></div>
                  </div>
                </div>
              </div>
              <div class="col-auto">
                <i class="far fa-user-circle fa-3x text-warning"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

    <div class="container">
      <div class="card">
        <div class="imgBx">
          <img src="http://3.bp.blogspot.com/-6pQMewtzRmM/UmILecKciqI/AAAAAAAAZ1U/UMbKsJsviJ4/s1600/Ferramenta-em-pnr-queroimagem-Cei%C3%A7a-Crispim.png">
        </div>
        <div class="contentBx">
          <h2>Serviços</h2>
          <a href="<?php echo base_url('servicos'); ?>">Visualizar</a>
        </div>
      </div>

      <div class="card">
        <div class="imgBx">
          <img src="https://cdn.pixabay.com/photo/2017/07/04/08/22/iphone-2470313_960_720.png">
        </div>
        <div class="contentBx">
          <h2>Orçamentos</h2>
          <a href="<?php echo base_url('orcamentos'); ?>">Visualizar</a>
        </div>
      </div>

      <div class="card">
        <div class="imgBx">
          <img src="https://img.comunidades.net/ult/ultra-design/ftbu.png">
        </div>
        <div class="contentBx">
          <h2>Clientes</h2>
          <a href="<?php echo base_url('clientes'); ?>">Visualizar</a>
        </div>
      </div>

      
    </div>

  </div>

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');


*{
  font-family: 'Poppins', sans-serif;
}



.container{
  position: relative;
  display: flex;
}

.container .card{
  margin: 0 16px;
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
  background: #9bdc28;
  clip-path: circle(150px at 80% 20%);
  transition: 0.5s ease-in-out;
}

.container .card:hover:before{
  clip-path: circle(300px at 80% -20%);
  background: #38CCE7;
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
  position: absolute;
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
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%) rotate(0deg);
  width: 270px;
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
  margin-top: 16px;
}

.container .card:hover .contentBx a{
  opacity: 1;
  transform: translateY(0px);
  transition-delay: 0.75s;
  
}

  </style>

</div>