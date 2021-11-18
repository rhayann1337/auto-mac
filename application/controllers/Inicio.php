<?php

defined('BASEPATH') OR exit('Não é permitido.');

class Inicio extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if (!$this->ion_auth->logged_in()) {
			$this->session->set_flashdata('info', 'Sessão expirada');
			redirect('login');
		}

        $this->load->model('home_model');
        $this->load->model('materiais_model');
	}

	public function index() {

        $data = array(
            'titulo' => 'Home',
            'valor_servicos' => $this->home_model->get_sum_valor_servicos(),
            'quantidade_servicos' => $this->home_model->contar_quantidade_servicos(),
            'quantidade_orcamentos' => $this->home_model->contar_quantidade_orcamentos(),
            'quantidade_clientes' => $this->home_model->contar_quantidade_clientes(),
            'controle_de_estoque' => $this->home_model->contar_quantidade_de_produtos(),
            'materiais' => $this->materiais_model->get_all(),
        );

        $notificacoes = 0;

        if($this->home_model->contar_quantidade_de_produtos()){
            $notificacoes ++;
        }

        $data ['notificacoes'] = $notificacoes; 


        $this->load->view('layout/header', $data);
        $this->load->view('inicio/index');
        $this->load->view('layout/footer');
    }
}
