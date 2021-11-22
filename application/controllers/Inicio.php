<?php

defined('BASEPATH') or exit('Não é permitido.');

class Inicio extends CI_Controller
{

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

    public function index()
    {

        $data = array(
            'titulo' => 'Home',
            'valor_servicos' => $this->home_model->get_sum_valor_servicos(),
            'quantidade_servicos' => $this->home_model->contar_quantidade_servicos(),
            'quantidade_orcamentos' => $this->home_model->contar_quantidade_orcamentos(),
            'quantidade_servicos_orcamentos' => $this->home_model->contar_quantidade_servicos_orcamentos(),
            'materiais' => $this->materiais_model->get_all(),
            'contar_quantidade_de_produtos' => $this->home_model->contar_quantidade_de_produtos(),
        );

        $notificacoes = 0;

        if ($data['contar_quantidade_de_produtos']) {
            $notificacoes++;
        }

        $data['notificacoes'] = $notificacoes;

        // echo '<pre>';
        // print_r($data['contar_quantidade_de_produtos']);
        // exit();


        $this->load->view('layout/header', $data);
        $this->load->view('inicio/index');
        $this->load->view('layout/footer');
    }
}