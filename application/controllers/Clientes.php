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
                'public/vendor/mask/app.js',
                'public/vendor/datatables/app.js',
            ),
            'clientes' => $this->core_model->get_all('clientes'),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('clientes/index');
        $this->load->view('layout/footer');
    }

    public function edit($cliente_id = NULL)
    {

        if (!$cliente_id || !$this->ion_auth->user($cliente_id)->row()) {
            $this->session->set_flashdata('error', 'Cliente não encontrado');
            redirect('clientes');
        } else {

            $this->form_validation->set_rules('nome', '', 'trim|required');
            $this->form_validation->set_rules('sobrenome', '', 'trim|required');
            $this->form_validation->set_rules('cpf', 'Senha', 'min_length[11] |max_length[14]');
            $this->form_validation->set_rules('email', '', 'trim|required');
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
                        'cpf',
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

                $data = $this->security->xss_clean($data);

                $password = $this->input->post('password');

                if (!$password) {

                    unset($data['password']);
                }


                if ($this->ion_auth->update($cliente_id, $data)) {

                    $this->session->set_flashdata('sucesso', 'Dados salvos com sucesso');
                } else {
                    $this->session->set_flashdata('error', 'Erro ao salvar os dados');
                }
                redirect('clientes');
            } else {
                $data = array(
                    'titulo' => 'Editar cliente',
                    'scripts' => array(
                        'https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js',
                        'https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js',
                        'https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js',
                        'public/vendor/mask/app.js',
                    ),

                    'usuario' => $this->ion_auth->user($cliente_id)->row(),

                );

                $this->load->view('layout/header', $data);
                $this->load->view('clientes/edit');
                $this->load->view('layout/footer');
            }
        }
    }

    public function cpf_check($cpf)
    {
        $cliente_id = $this->input->post('cliente_id');

        if ($this->core_model->get_by_id('clientes', array('cpf' => $cpf, 'id !=' => $cliente_id))) {

            $this->form_validation->set_message('cpf_check', 'Esse cpf já está cadastrado');

            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function add()
    {

        $this->form_validation->set_rules('nome', '', 'trim|required');
        $this->form_validation->set_rules('sobrenome', '', 'trim|required');
        $this->form_validation->set_rules('cpf', 'cpf', 'min_length[11]|max_length[14]|is_unique[clientes.cpf]');
        $this->form_validation->set_rules('email', '', 'trim|required');
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
                    'cpf',
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
                    'public/vendor/mask/app.js',

                ),
            );

            $this->load->view('layout/header', $data);
            $this->load->view('clientes/add');
            $this->load->view('layout/footer');
        }
    }

    public function del($cliente_id = NULL)
    {



        if (!$cliente_id || !$this->ion_auth->user($cliente_id)->row()) {
            $this->session->set_flashdata('error', 'Cliente não encontrado');
            redirect('clientes');
        }

        if ($this->ion_auth->delete_user($cliente_id)) {
            $this->session->set_flashdata('sucesso', 'Cliente excluído com sucesso');
            redirect('clientes');
        } else {
            $this->session->set_flashdata('error', 'Cliente não pode ser excluído');
            redirect('clientes');
        }
    }
}
