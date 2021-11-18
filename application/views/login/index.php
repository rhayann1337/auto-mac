<div class="container">

	<div class="container-image">

		<h3>Auto-Mac </h3>
		<span>Gerenciamento de oficinas e controle para pequenos empresários.</span>
		<p>Expand your horizons.</p>

	</div>
	<div class="container-login">
		<div class="row justify-content-center" style="align-items: center; height: 100%;">

			<div class="col-xl-6 col-lg-12 col-md-9">

				<div class="card o-hidden border-0 shadow-lg my-5">
					<div class="card-body p-0">
						<div class="row">
							<div class="col-lg-12">

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

								<?php if ($message = $this->session->flashdata('info')) : ?>

									<div class="row">

										<div class="col-md-12">

											<div class="alert alert-info alert-dismissible fade show" role="alert">
												<strong><i class="fas fa-exclamation-triangle"></i>&nbsp;&nbsp;<?php echo $message ?></strong>
												<button type="button" class="close" data-dismiss="alert" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>

										</div>

									</div>

								<?php endif; ?>

								<div class="p-5">
									<div class="text-center">
										<h1 class="h4 text-gray-900 mb-4">Seja bem-vindo!</h1>
									</div>
									<form class="user" name="form_auth" method="POST" action="<?php echo base_url('login/auth'); ?>">
										<div class="form-group">
											<input type="email" name="email" class="form-control form-control-user" placeholder="Informe seu e-mail...">
										</div>
										<div class="form-group">
											<input type="password" name="password" class=" form-control form-control-user" placeholder="Informe sua senha">
										</div>

										<button type="submit" class="btn btn-primary btn-user btn-block"> Entrar </button>
									</form>

								</div>
							</div>
						</div>
					</div>
				</div>

			</div>

		</div>
	</div>
</div>

<style>
	.container {
		padding: 0;
		margin: 0;
		max-width: none;
		display: flex;
		height: 100vh;
		width: 100%;
		overflow: hidden;
		max-height: none;
	}

	.container-image {
		align-items: center;
		display: flex;
		justify-content: center;
		width: 50%;
		flex-direction: column;
		background-color: #393a3e;
          background-image: linear-gradient(180deg, #181f36 10%, #224abe 100%);
          background-size: cover;
		color: white;
		filter: blur(30);
	}

	.container-image h3 {
		font-size: 60px;
		font-weight: 700;
		font-family: 'Rampart One', cursive;
	}
	
	.container-image p{
		margin: 50px;
		font-size: 40px;
		font-weight: 400;
		font-family: 'Dancing Script', cursive;
		
		
	}
	
	.container-image span {
		font-family: 'Patua One', cursive;
		font-size: 32px;
		font-weight: 200;
		text-align: center;
		width: 70%;
	}

	.container-login {
		background-image: url('https://www.tecinco.com.br/novo/wp-content/uploads/2020/06/Imagem4.jpg');
		width: 50%;
	}


</style>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Amatic+SC&family=Dancing+Script&family=Patua+One&family=Rampart+One&display=swap" rel="stylesheet">