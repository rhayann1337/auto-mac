<?php

defined('BASEPATH') or exit('Ação não permitida');


class materiais extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sessão expirada');
            redirect('login');
        }
        $this->load->model('materiais_model');
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
            'materiais' => $this->materiais_model->get_all(),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('materiais/index');
        $this->load->view('layout/footer');
    }

    public function edit($id = NULL)
    {
        if (!$id || !$this->core_model->get_by_id('materiais', array('id' => $id))) {
            $this->session->set_flashdata('error', 'Produto não encontrado');
            redirect('materiais');
        } else {

            $this->form_validation->set_rules('nome_material', 'Nome do produto', 'trim|required');
            $this->form_validation->set_rules('valor', 'Valor do produto', 'trim|required');
            $this->form_validation->set_rules('fornecedor_id', 'Funcionario', 'trim|required');
            $this->form_validation->set_rules('quantidade', 'Quantide do produto', 'trim|required');
            $this->form_validation->set_rules('quantidade_minima', 'Quantide minima estocada do produto', 'trim|required');
            $this->form_validation->set_rules('modelo', 'Modelo', 'trim|required');
            $this->form_validation->set_rules('material', 'Material', 'trim|required');
            $this->form_validation->set_rules('observacoes', 'Material', 'trim|required');
            $this->form_validation->set_rules('foto', 'Imagem', 'trim|required');

            if ($this->form_validation->run()) {

                $data = elements(
                    array(
                        'nome_material',
                        'valor',
                        'quantidade',
                        'quantidade_minima',
                        'fornecedor_id',
                        'modelo',
                        'material',
                        'foto',
                        'observacoes',
                    ),
                    $this->input->post()
                );

                $data = html_escape($data);

                $this->core_model->update('materiais', $data, array('id' => $id));

                redirect('materiais');
            } else {


                $data = array(
                    'titulo' => 'Atualizando dados do produto',
                    'styles' => array(
                        'vendor/datatables/dataTables.bootstrap4.min.css',
                    ),
                    'scripts' => array(
                        'https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js',
                        'https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js',
                        'https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js',
                        'public/vendor/mask/app.js',
                    ),
                    'fornecedores' => $this->core_model->get_all('fornecedores'),
                    'material' => $this->core_model->get_by_id('materiais', array('id' => $id)),
                );

                $this->load->view('layout/header', $data);
                $this->load->view('materiais/edit');
                $this->load->view('layout/footer');
            }
        }
    }

    public function add()
    {

        $this->form_validation->set_rules('nome_material', 'Nome do produto', 'trim|required');
        $this->form_validation->set_rules('valor', 'Valor do produto', 'trim|required');
        $this->form_validation->set_rules('fornecedor_id', 'fornecedor', 'trim|required');
        $this->form_validation->set_rules('quantidade', 'Quantide do produto', 'trim|required');
        $this->form_validation->set_rules('quantidade_minima', 'Quantide minima estocada do produto', 'trim|required');
        $this->form_validation->set_rules('modelo', 'Modelo', 'trim|required');
        $this->form_validation->set_rules('material', 'Material', 'trim|required');
        $this->form_validation->set_rules('observacoes', 'Observações', 'trim|required');
        $this->form_validation->set_rules('foto', 'Imagem', 'trim|required');

        if ($this->form_validation->run()) {

            $data = elements(
                array(
                    'nome_material',
                    'valor',
                    'quantidade',
                    'quantidade_minima',
                    'fornecedor_id',
                    'modelo',
                    'material',
                    'foto',
                    'observacoes'
                ),
                $this->input->post()
            );

            $data = html_escape($data);

            $this->core_model->insert('materiais', $data, TRUE);

            redirect('materiais');
        } else {

            $data = array(
                'titulo' => 'Cadastrar material de estoque',
                'scripts' => array(
                    'https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js',
                    'https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js',
                    'https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js',
                    'public/vendor/mask/app.js',
                ),
                'fornecedores' => $this->core_model->get_all('fornecedores'),
            );

            $this->load->view('layout/header', $data);
            $this->load->view('materiais/add');
            $this->load->view('layout/footer');
        }
    }

    public function del($id = NULL)
    {
        if (!$id || !$this->core_model->get_by_id('materiais', array('id' => $id))) {
            $this->session->set_flashdata('error', 'Produto não encontrado');
            redirect('materiais');
        } else {
            $this->core_model->delete('materiais', array('id' => $id));
            redirect('materiais');
        }
    }
}