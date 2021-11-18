<?php
defined('BASEPATH') or exit('Ação não permitida');

class Oficina extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		if (!$this->ion_auth->logged_in()) {
			redirect('login');
		}
	}

	public function index()
	{

		if (!$this->ion_auth->is_admin()) {
            $this->session->set_flashdata('error', 'Apenas administradores podem acessar configurações da oficina.');
            redirect();
        }

		$data = array(
			'titulo' => 'Editar informações do sistema',
			'oficina' => $this->core_model->get_by_id('oficina', array('id' => 1)),
			'scripts' => array(
                'https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js',
                'https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js',
                'https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js',
                'public/vendor/mask/app.js',
            ), 
		);

		$this->form_validation->set_rules('razao_social', 'Razão social', 'required|min_length[10]|max_length[145]');
		$this->form_validation->set_rules('nome_fantasia', 'Nome fantasia', 'required|min_length[5]|max_length[145]');
		$this->form_validation->set_rules('cnpj', '', 'required');
		$this->form_validation->set_rules('telefone_fixo', '', 'max_length[25]');
		$this->form_validation->set_rules('telefone_movel', '', 'required|max_length[25]');
		$this->form_validation->set_rules('email', '', 'required|valid_email');
		$this->form_validation->set_rules('site_url', 'URL do site', 'required|valid_url|max_length[100]');
		$this->form_validation->set_rules('cep', 'CEP', 'max_length[145]');
		$this->form_validation->set_rules('endereco', 'Endereço', 'max_length[25]');
		$this->form_validation->set_rules('numero', 'Número', 'max_length[25]');
		$this->form_validation->set_rules('cidade', 'Cidade', 'required|max_length[45]');
		$this->form_validation->set_rules('estado', 'Sigla', 'required|max_length[2]');
		$this->form_validation->set_rules('txt_ordem_servico', 'Texto da ordem de serviço e venda', 'max_length[500]');

		if ($this->form_validation->run()) {

			$data = elements(
				array(
					'razao_social',
					'nome_fantasia',
					'cnpj',
					'telefone_fixo',
					'telefone_movel',
					'site_url',
					'email',
					'endereco',
					'cep',
					'numero',
					'cidade',
					'estado',
					'txt_ordem_servico',

				), $this->input->post()
			);
			$data = $this->security->xss_clean($data);

			$this->core_model->update('oficina', $data, array('id' => 1));

			redirect('oficina');

		} else {
			$this->load->view('layout/header', $data);
			$this->load->view('oficina/index');
			$this->load->view('layout/footer');
		}

	}
}