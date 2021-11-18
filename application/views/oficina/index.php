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
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.11.2/jquery.mask.min.js"></script>
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
				</div>

				<div class="card-body">
					<form class="system" name="form_edit" method="post">

						<div class="form-group row mb-3">

							<div class="col-md-3">
								<label>Razão social (*)</label>
								<input type="text" class="form-control form-control-user" name="razao_social" placeholder="Informe a razão social" value="<?php echo $oficina->razao_social; ?>">
								<?php echo form_error('razao_social', '<small class="form-text text-danger">', '</small>'); ?>
							</div>

							<div class="col-md-3">
								<label>Nome fantasia (*)</label>
								<input type="text" class="form-control form-control-user" name="nome_fantasia" placeholder="Nome fantasia" value="<?php echo $oficina->nome_fantasia; ?>">
								<?php echo form_error('nome_fantasia', '<small class="form-text text-danger">', '</small>'); ?>
							</div>

							<div class="col-md-3">
								<label>CNPJ (*)</label>
								<input type="text" class="form-control form-control-user cnpj" name="cnpj" placeholder="CNPJ" value="<?php echo $oficina->cnpj; ?>">
								<?php echo form_error('cnpj', '<small class="form-text text-danger">', '</small>'); ?>
							</div>

						
						</div>

						<div class="form-group row mb-3">

							<div class="col-md-3">
								<label>Telefone fixo</label>
								<input type="text" class="form-control form-control-user sp_celphones" name="telefone_fixo" placeholder="Telefone fixo" value="<?php echo $oficina->telefone_fixo; ?>">
								<?php echo form_error('telefone_fixo', '<small class="form-text text-danger">', '</small>'); ?>
							</div>

							<div class="col-md-3">
								<label>Telefone móvel (*)</label>
								<input type="text" class="form-control form-control-user sp_celphones" name="telefone_movel" placeholder="Telefone móvel" value="<?php echo $oficina->telefone_movel; ?>">
								<?php echo form_error('telefone_movel', '<small class="form-text text-danger">', '</small>'); ?>
							</div>

							<div class="col-md-3">
								<label>URL do site (*)</label>
								<input type="text" class="form-control form-control-user" name="site_url" placeholder="URL do site" value="<?php echo $oficina->site_url; ?>">
								<?php echo form_error('site_url', '<small class="form-text text-danger">', '</small>'); ?>
							</div>

							<div class="col-md-3">
								<label>E-mail de contato (*)</label>
								<input type="text" class="form-control form-control-user" name="email" placeholder="E-mail de contato" value="<?php echo $oficina->email; ?>">
								<?php echo form_error('email', '<small class="form-text text-danger">', '</small>'); ?>
							</div>
						</div>

						<div class="form-group row mb-3">

							<div class="col-md-3">
								<label>Endereço</label>
								<input type="text" class="form-control form-control-user" name="endereco" placeholder="Endereço" value="<?php echo $oficina->endereco; ?>">
								<?php echo form_error('endereco', '<small class="form-text text-danger">', '</small>'); ?>
							</div>

							<div class="col-md-2">
								<label>CEP</label>
								<input type="text" class="form-control form-control-user cep" name="cep" placeholder="CEP" value="<?php echo $oficina->cep; ?>">
								<?php echo form_error('cep', '<small class="form-text text-danger">', '</small>'); ?>
							</div>

							<div class="col-md-2">
								<label>Número</label>
								<input type="text" class="form-control form-control-user" name="numero" placeholder="Número" value="<?php echo $oficina->numero; ?>">
								<?php echo form_error('numero', '<small class="form-text text-danger">', '</small>'); ?>
							</div>

							<div class="col-md-2">
								<label>Cidade (*) </label>
								<input type="text" class="form-control form-control-user" name="cidade" placeholder="Cidade" value="<?php echo $oficina->cidade; ?>">
								<?php echo form_error('cidade', '<small class="form-text text-danger">', '</small>'); ?>
							</div>

							<div class="col-md-2">
								<label>Siga (*)</label>
								<input type="text" class="form-control form-control-user Sigla" name="estado" placeholder="Estado" value="<?php echo $oficina->estado; ?>">
								<?php echo form_error('estado', '<small class="form-text text-danger">', '</small>'); ?>
							</div>

						</div>

						<div class="form-group row mb-3">

							<div class="col-md-12">
								<label>Texto da ordem de serviço e venda</label>
								<textarea class="form-control form-control-user" name="txt_ordem_servico" placeholder="Texto da ordem de serviço e venda"><?php echo $oficina->txt_ordem_servico; ?></textarea>
								<?php echo form_error('txt_ordem_servico', '<small class="form-text text-danger">', '</small>'); ?>
							</div>

						</div>

						<button type="submit" class="btn btn-primary btn-sm">Salvar</button>
					</form>
				</div>
			</div>
		</div>
	</div>

</body>