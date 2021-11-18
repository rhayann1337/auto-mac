<?php

defined('BASEPATH') or exit('Ação não permitida');


class Funcionarios extends CI_Controller
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
            'funcionarios' => $this->core_model->get_all('funcionarios'),
        );

        // echo '<pre>';
        // print_r($data['usuarios']);
        // exit();


        $this->load->view('layout/header', $data);
        $this->load->view('funcionarios/index');
        $this->load->view('layout/footer');
    }

    public function edit($id = NULL)
    {
        if (!$id || !$this->core_model->get_by_id('funcionarios', array('id' => $id))) {
            $this->session->set_flashdata('error', 'Fornecedor não encontrado');
            redirect('funcionarios');
        } else {

            $this->form_validation->set_rules('nome_funcionario', '', 'trim|required');
        $this->form_validation->set_rules('sobrenome', '', 'trim|required');
        $this->form_validation->set_rules('cpf', 'CPF', 'min_length[11]|max_length[11]|cpf_check');
        $this->form_validation->set_rules('email', '', 'trim|required');
        $this->form_validation->set_rules('telefone_fixo', '', 'trim|required');
        $this->form_validation->set_rules('telefone_movel', '', 'trim|required');
        $this->form_validation->set_rules('endereco', '', 'trim|required');
        $this->form_validation->set_rules('sexo', '', 'trim|required');
        $this->form_validation->set_rules('rg', '', 'trim|required');
        $this->form_validation->set_rules('foto', '', 'trim|required');
        $this->form_validation->set_rules('cargo', '', 'trim|required');
        $this->form_validation->set_rules('data_nascimento', '', 'trim|required');

        if ($this->form_validation->run()) {

            $data = elements(
                array(
                    'nome_funcionario',
                    'sobrenome',
                    'cpf',
                    'email',
                    'telefone_fixo',
                    'telefone_movel',
                    'endereco',
                    'sexo',
                    'rg',
                    'foto',
                    'cargo',
                    'data_nascimento'
                ),
                $this->input->post()
                );

                $data = html_escape($data);

                $this->core_model->update('funcionarios', $data, array('id' => $id));

                redirect('funcionarios');
            } else {


                $data = array(
                    'titulo' => 'Atualizando funcionário',
                    'styles' => array(
                        'vendor/datatables/dataTables.bootstrap4.min.css',
                    ),

                    'scripts' => array(
                        'https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js',
                        'https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js',
                        'https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js',
                        base_url('public/vendor/mask/app.js'),
                    ),
                    'funcionario' => $this->core_model->get_by_id('funcionarios', array('id' => $id)),
                );

                $this->load->view('layout/header', $data);
                $this->load->view('funcionarios/edit');
                $this->load->view('layout/footer');
            }
        }
    }

    public function cpf_check($cpf)
    {
        $funcionario_id = $this->input->post('id');

        if ($this->core_model->get_by_id('funcionarios', array('cpf' => $cpf, 'id !=' => $funcionario_id))) {

            $this->form_validation->set_message('cpf_check', 'Esse cpf já está cadastrado');

            return FALSE;
        } else {
            return TRUE;
        }
    }


    public function add()
    {

        $this->form_validation->set_rules('nome_funcionario', '', 'trim|required');
        $this->form_validation->set_rules('sobrenome', '', 'trim|required');
        $this->form_validation->set_rules('cpf', 'CPF', 'min_length[11]|max_length[11]|cpf_check');
        $this->form_validation->set_rules('email', '', 'trim|required');
        $this->form_validation->set_rules('telefone_fixo', '', 'trim|required');
        $this->form_validation->set_rules('telefone_movel', '', 'trim|required');
        $this->form_validation->set_rules('endereco', '', 'trim|required');
        $this->form_validation->set_rules('sexo', '', 'trim|required');
        $this->form_validation->set_rules('rg', '', 'trim|required');
        $this->form_validation->set_rules('foto', '', 'trim|required');
        $this->form_validation->set_rules('cargo', '', 'trim|required');
        $this->form_validation->set_rules('data_nascimento', '', 'trim|required');

        if ($this->form_validation->run()) {

            $data = elements(
                array(
                    'nome_funcionario',
                    'sobrenome',
                    'cpf',
                    'email',
                    'telefone_fixo',
                    'telefone_movel',
                    'endereco',
                    'sexo',
                    'rg',
                    'foto',
                    'cargo',
                    'data_nascimento'
                ),
                $this->input->post()
            );

            $data = html_escape($data);

            $this->core_model->insert('funcionarios', $data);

            redirect('funcionarios');
        } else {

            $data = array(
                'titulo' => 'Cadastrar funcionario',
                'scripts' => array(
                    'https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js',
                    'https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js',
                    'https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js',
                    base_url('public/vendor/mask/app.js'),
                ),
            );

            $this->load->view('layout/header', $data);
            $this->load->view('funcionarios/add');
            $this->load->view('layout/footer');
        }
    }

    public function del($funcionario_id = NULL)
    {

        if (!$funcionario_id || !$this->ion_auth->user($funcionario_id)->row()) {
            $this->session->set_flashdata('error', 'Funcionario não encontrado');
            redirect('funcionarios');
        }

        if ($this->ion_auth->delete_user($funcionario_id)) {
            $this->session->set_flashdata('sucesso', 'Funcionario excluído com sucesso');
            redirect('funcionarios');
        } else {
            $this->session->set_flashdata('error', 'Funcionario não pode ser excluído');
            redirect('funcionarios');
        }
    }
}
