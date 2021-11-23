<?php

defined('BASEPATH') or exit('Ação não permitida');


class Clientes extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sessão expirada');
            redirect('login');
        }
    }


    public function index()
    {

        $data = array(

            'styles' => array('https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css'),
            'scripts' => array(
                'https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js',
                'https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js',
                'https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js',
                base_url('public/vendor/mask/app.js'),
                'public/vendor/datatables/app.js',
            ),
            'clientes' => $this->core_model->get_all('clientes'),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('clientes/index');
        $this->load->view('layout/footer');
    }

    public function edit($id = NULL)
    {
        if (!$id || !$this->core_model->get_by_id('clientes', array('id' => $id))) {
            $this->session->set_flashdata('error', 'Cliente não encontrado');
            redirect('clientes');
        } else {

            $this->form_validation->set_rules('nome', 'Nome', 'trim|required');
            $this->form_validation->set_rules('sobrenome', 'Sobrenome', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required');
            $this->form_validation->set_rules('telefone_fixo', 'Telefone', 'trim|required');
            $this->form_validation->set_rules('telefone_movel', 'Celular', 'trim|required');
            $this->form_validation->set_rules('endereco', 'Endereço', 'trim|required');
            $this->form_validation->set_rules('sexo', 'Sexo', 'trim|required');
            $this->form_validation->set_rules('veiculo', 'Veículo', 'trim|required');
            $this->form_validation->set_rules('placa', 'Placa', 'trim|required');

            if ($this->form_validation->run()) {


                $data = elements(
                    array(
                        'nome',
                        'sobrenome',
                        'email',
                        'telefone_fixo',
                        'telefone_movel',
                        'endereco',
                        'sexo',
                        'veiculo',
                        'placa'
                    ),
                    $this->input->post()
                );




                $this->core_model->update('clientes', $data, array('id' => $id));

                redirect('clientes');
            } else {
                $data = array(
                    'titulo' => 'Editar cliente',
                    'scripts' => array(
                        'https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js',
                        'https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js',
                        'https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js',
                        base_url('public/vendor/mask/app.js'),
                    ),
                    'cliente' => $this->core_model->get_by_id('clientes', array('id' => $id)),
                );

                // echo '<pre>';
                // print_r($this->input->post());
                // exit();

                $this->load->view('layout/header', $data);
                $this->load->view('clientes/edit');
                $this->load->view('layout/footer');
            }
        }
    }

    public function email_check($email)
    {
        $id = $this->input->post('id');

        if ($this->core_model->get_by_id('clientes', array('email' => $email, 'id !=' => $id))) {

            $this->form_validation->set_message('email_check', 'Esse cliente já está cadastrado');

            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function add()
    {

        $this->form_validation->set_rules('nome', '', 'trim|required');
        $this->form_validation->set_rules('sobrenome', '', 'trim|required');
        $this->form_validation->set_rules('email', '', 'trim|required|is_unique[clientes.email]');
        $this->form_validation->set_rules('telefone_fixo', '', 'trim|required');
        $this->form_validation->set_rules('telefone_movel', '', 'trim|required');
        $this->form_validation->set_rules('endereco', '', 'trim|required');
        $this->form_validation->set_rules('sexo', '', 'trim|required');
        $this->form_validation->set_rules('veiculo', '', 'trim|required');
        $this->form_validation->set_rules('placa', '', 'trim|required');

        if ($this->form_validation->run()) {

            $data = elements(
                array(
                    'nome',
                    'sobrenome',
                    'email',
                    'telefone_fixo',
                    'telefone_movel',
                    'endereco',
                    'sexo',
                    'veiculo',
                    'placa'
                ),
                $this->input->post()
            );

            $data = html_escape($data);

            $this->core_model->insert('clientes', $data);

            redirect('clientes');
        } else {

            $data = array(
                'titulo' => 'Cadastrar cliente',
                'scripts' => array(
                    'https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js',
                    'https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js',
                    'https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js',
                    base_url('public/vendor/mask/app.js'),

                ),
            );

            $this->load->view('layout/header', $data);
            $this->load->view('clientes/add');
            $this->load->view('layout/footer');
        }
    }

    public function del($id = NULL)
    {

        if (!$id || !$this->core_model->get_by_id('clientes', array('id' => $id))) {
            $this->session->set_flashdata('error', 'Cliente não encontrado');
            redirect('clientes');
        } else {
            $this->core_model->delete('clientes', array('id' => $id));
            $this->session->set_flashdata('sucesso', 'Cliente excluído com sucesso!');
            redirect('clientes');
        }
    }
}