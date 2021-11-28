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

        echo '<pre>';
        print_r($data);
        exit();

        $this->load->view('layout/header', $data);
        $this->load->view('materiais/index');
        $this->load->view('layout/footer');
    }

    public function edit($id = NULL)
    {
        $this->load->library('upload');

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
            $this->form_validation->set_rules('observacoes', 'Material', 'trim');

            if ($this->form_validation->run()) {

                $config['upload_path'] = "assets/imagens/materiais/";
                $config['max_size'] = 2048;
                $config["allowed_types"] = "gif|jpg|jpeg|png|svg|jfif";

                $this->upload->initialize($config);

                $contem_foto = $this->upload->do_upload('foto');

                $this->upload->do_upload('foto');

                $arquivo = $this->upload->data('file_name');

                $url_imagem = base_url($config['upload_path'] . $arquivo);

                $nome_material = $this->input->post('nome_material');
                $valor = $this->input->post('valor');
                $fornecedor_id = $this->input->post('fornecedor_id');
                $quantidade = $this->input->post('quantidade');
                $quantidade_minima = $this->input->post('quantidade_minima');
                $modelo = $this->input->post('modelo');
                $material = $this->input->post('material');
                $observacoes = $this->input->post('observacoes');

                $data =
                    array(
                        'nome_material' => $nome_material,
                        'valor' => $valor,
                        'fornecedor_id' => $fornecedor_id,
                        'quantidade' => $quantidade,
                        'quantidade_minima' => $quantidade_minima,
                        'modelo' => $modelo,
                        'material' => $material,
                        'observacoes' => $observacoes,
                        'foto' => $url_imagem
                    );

                $data = html_escape($data);

                if (!$contem_foto) {

                    unset($data['foto']);
                }

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
        $this->load->library('upload');

        $this->form_validation->set_rules('nome_material', 'Nome do produto', 'trim|required');
        $this->form_validation->set_rules('valor', 'Valor do produto', 'trim|required');
        $this->form_validation->set_rules('fornecedor_id', 'fornecedor', 'trim|required');
        $this->form_validation->set_rules('quantidade', 'Quantide do produto', 'trim|required');
        $this->form_validation->set_rules('quantidade_minima', 'Quantide minima estocada do produto', 'trim|required');
        $this->form_validation->set_rules('modelo', 'Modelo', 'trim|required');
        $this->form_validation->set_rules('material', 'Material', 'trim|required');
        $this->form_validation->set_rules('observacoes', 'Observações', 'trim');

        if ($this->form_validation->run()) {

            $config['upload_path'] = "assets/imagens/materiais/";
            $config['max_size'] = 2048;
            $config["allowed_types"] = "gif|jpg|jpeg|png|svg|jfif";

            $this->upload->initialize($config);

            $this->upload->do_upload('foto');

            $arquivo = $this->upload->data('file_name');

            $url_imagem = base_url($config['upload_path'] . $arquivo);

            $nome_material = $this->input->post('nome_material');
            $valor = $this->input->post('valor');
            $fornecedor_id = $this->input->post('fornecedor_id');
            $quantidade = $this->input->post('quantidade');
            $quantidade_minima = $this->input->post('quantidade_minima');
            $modelo = $this->input->post('modelo');
            $material = $this->input->post('material');
            $observacoes = $this->input->post('observacoes');

            $data =
                array(
                    'nome_material' => $nome_material,
                    'valor' => $valor,
                    'fornecedor_id' => $fornecedor_id,
                    'quantidade' => $quantidade,
                    'quantidade_minima' => $quantidade_minima,
                    'modelo' => $modelo,
                    'material' => $material,
                    'observacoes' => $observacoes,
                    'foto' => $url_imagem
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