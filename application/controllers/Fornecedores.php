<?php

defined('BASEPATH') or exit('Ação não permitida');


class Fornecedores extends CI_Controller
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
            'titulo' => 'Fornecedores',
            'styles' => array('https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css'),
            'scripts' => array(
                'https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js',
                'https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js',
                'https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js',
                'public/vendor/mask/app.js',
                'public/vendor/datatables/app.js',
            ),
            'fornecedores' => $this->core_model->get_all('fornecedores'),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('fornecedores/index');
        $this->load->view('layout/footer');
    }

    public function edit($id = NULL)
    {
        if (!$id || !$this->core_model->get_by_id('fornecedores', array('id' => $id))) {
            $this->session->set_flashdata('error', 'Fornecedor não encontrado');
            redirect('fornecedores');
        } else {

            $this->form_validation->set_rules('marca', 'Marca', 'required|min_length[5]|max_length[145]');
            $this->form_validation->set_rules('contato', 'Responsável', 'max_length[25]');
            $this->form_validation->set_rules('telefone', 'Telefone', 'required|max_length[25]');
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('cep', 'CEP', 'required');
            $this->form_validation->set_rules('endereco', 'Endereço', 'required');
            $this->form_validation->set_rules('bairro', 'Novo Mundo', 'required');
            $this->form_validation->set_rules('cidade', 'Curitiba', 'required');
            $this->form_validation->set_rules('estado', 'PR', 'required');
            $this->form_validation->set_rules('descricao', 'Observações', 'max_length[1000]');
            $this->form_validation->set_rules('foto', 'Foto', 'max_length[1000]');

            if ($this->form_validation->run()) {

                $data = elements(
                    array(
                        'marca',
                        'contato',
                        'endereco',
                        'telefone',
                        'email',
                        'cep',
                        'estado',
                        'descricao',
                        'bairro',
                        'cidade',
                        'foto',
                    ),
                    $this->input->post()
                );

                $data = html_escape($data);

                $this->core_model->update('fornecedores', $data, array('id' => $id));

                redirect('fornecedores');
            } else {


                $data = array(
                    'titulo' => 'Atualizar Serviço',
                    'styles' => array(
                        'vendor/datatables/dataTables.bootstrap4.min.css',
                    ),

                    'scripts' => array(
                        'https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js',
                        'https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js',
                        'https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js',
                        'public/vendor/mask/app.js',
                    ),
                    'fornecedor' => $this->core_model->get_by_id('fornecedores', array('id' => $id)),
                );

                $this->load->view('layout/header', $data);
                $this->load->view('fornecedores/edit');
                $this->load->view('layout/footer');
            }
        }
    }
    public function add()
    {
        $this->form_validation->set_rules('marca', 'Marca', 'required|min_length[3]');
        $this->form_validation->set_rules('contato', 'Responsável', 'max_length[25]');
        $this->form_validation->set_rules('telefone', 'Telefone', 'required|max_length[25]');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('cep', 'CEP', 'required');
        $this->form_validation->set_rules('endereco', 'Endereço', 'required');
        $this->form_validation->set_rules('bairro', 'Novo Mundo', 'required');
        $this->form_validation->set_rules('cidade', 'Curitiba', 'required');
        $this->form_validation->set_rules('estado', 'PR', 'required');
        $this->form_validation->set_rules('descricao', 'Observações', 'max_length[1000]');


        if ($this->form_validation->run()) {

            $data = elements(
                array(
                    'marca',
                    'contato',
                    'endereco',
                    'telefone',
                    'email',
                    'cep',
                    'estado',
                    'descricao',
                    'bairro',
                    'cidade',
                ),
                $this->input->post()
            );

            $data = html_escape($data);

            $this->core_model->insert('fornecedores', $data);

            redirect('fornecedores');
        } else {

            $data = array(
                'titulo' => 'Cadastrar fornecedor',
                'scripts' => array(
                    'https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js',
                    'https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js',
                    'https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js',
                    'public/vendor/mask/app.js',
                ),
            );

            $this->load->view('layout/header', $data);
            $this->load->view('fornecedores/add');
            $this->load->view('layout/footer');
        }
    }
}
