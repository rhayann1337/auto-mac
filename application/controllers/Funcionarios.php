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
        $this->load->library('upload');

        if (!$id || !$this->core_model->get_by_id('funcionarios', array('id' => $id))) {
            $this->session->set_flashdata('error', 'Fornecedor não encontrado');
            redirect('funcionarios');
        } else {

            $this->load->library('upload');

            $this->form_validation->set_rules('nome_funcionario', 'Nome', 'trim|required');
            $this->form_validation->set_rules('sobrenome', 'SobrenomeS', 'trim|required');
            $this->form_validation->set_rules('cpf', 'CPF', 'min_length[11]|max_length[14]');
            $this->form_validation->set_rules('email', 'Email', 'trim|required');
            $this->form_validation->set_rules('telefone_fixo', 'Telefone fixo', 'trim|required');
            $this->form_validation->set_rules('telefone_movel', 'Telefone Celular', 'trim|required');
            $this->form_validation->set_rules('endereco', 'Endereço', 'trim|required');
            $this->form_validation->set_rules('sexo', 'Sexo', 'trim|required');
            $this->form_validation->set_rules('rg', 'RG', 'trim|required');
            $this->form_validation->set_rules('cargo', 'Cargo', 'trim|required');
            $this->form_validation->set_rules('data_nascimento', 'Data de nascimento', 'trim|required');



            if ($this->form_validation->run()) {

                $config['upload_path'] = "assets/imagens/funcionarios/";
                $config['max_size'] = 2048;
                $config["allowed_types"] = "gif|jpg|jpeg|png|svg";

                $this->upload->initialize($config);

                $contem_foto = $this->upload->do_upload('foto');

                $this->upload->do_upload('foto');

                $arquivo = $this->upload->data('file_name');

                $url_imagem = base_url($config['upload_path'] . $arquivo);

                $nome = base64_encode($this->input->post('nome_funcionario'));
                $sobrenome = base64_encode($this->input->post('sobrenome'));

                $cpf = base64_encode($this->input->post('cpf'));
                $email = base64_encode($this->input->post('email'));
                $telefone_fixo = base64_encode($this->input->post('telefone_fixo'));
                $telefone_movel = base64_encode($this->input->post('telefone_movel'));
                $endereco = base64_encode($this->input->post('endereco'));
                $sexo = $this->input->post('sexo');
                $rg = base64_encode($this->input->post('rg'));
                $cargo = $this->input->post('cargo');
                $data_nascimento = base64_encode($this->input->post('data_nascimento'));

                $data =
                    array(
                        'nome_funcionario' => $nome,
                        'sobrenome' => $sobrenome,
                        'cpf' => $cpf,
                        'email' => $email,
                        'telefone_fixo' => $telefone_fixo,
                        'telefone_movel' => $telefone_movel,
                        'endereco' => $endereco,
                        'sexo' => $sexo,
                        'rg' => $rg,
                        'cargo' => $cargo,
                        'data_nascimento' => $data_nascimento,
                        'foto' => $url_imagem,
                    );

                $data = html_escape($data);

                if (!$contem_foto) {

                    unset($data['foto']);
                }

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

                // echo '<pre>';
                // print_r($this->input->post());
                // exit();

                $this->load->view('layout/header', $data);
                $this->load->view('funcionarios/edit');
                $this->load->view('layout/footer');
            }
        }
    }

    public function add()
    {
        $this->load->library('upload');

        $this->form_validation->set_rules('nome_funcionario', 'Nome', 'trim|required');
        $this->form_validation->set_rules('sobrenome', 'SobrenomeS', 'trim|required');
        $this->form_validation->set_rules('cpf', 'CPF', 'min_length[11]|max_length[14]|is_unique[funcionarios.cpf]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('telefone_fixo', 'Telefone fixo', 'trim|required');
        $this->form_validation->set_rules('telefone_movel', 'Telefone Celular', 'trim|required');
        $this->form_validation->set_rules('endereco', 'Endereço', 'trim|required');
        $this->form_validation->set_rules('sexo', 'Sexo', 'trim|required');
        $this->form_validation->set_rules('rg', 'RG', 'trim|required');
        $this->form_validation->set_rules('cargo', 'Cargo', 'trim|required');
        $this->form_validation->set_rules('data_nascimento', 'Data de nascimento', 'trim|required');



        if ($this->form_validation->run()) {

            $config['upload_path'] = "assets/imagens/funcionarios/";
            $config['max_size'] = 2048;
            $config["allowed_types"] = "gif|jpg|jpeg|png|svg";

            $this->upload->initialize($config);

            $this->upload->do_upload('foto');

            $arquivo = $this->upload->data('file_name');

            $url_imagem = base_url($config['upload_path'] . $arquivo);

            $nome = base64_encode($this->input->post('nome_funcionario'));
            $sobrenome = base64_encode($this->input->post('sobrenome'));
            $cpf = base64_encode($this->input->post('cpf'));
            $email = base64_encode($this->input->post('email'));
            $telefone_fixo = base64_encode($this->input->post('telefone_fixo'));
            $telefone_movel = base64_encode($this->input->post('telefone_movel'));
            $endereco = base64_encode($this->input->post('endereco'));
            $sexo = $this->input->post('sexo');
            $rg = base64_encode($this->input->post('rg'));
            $cargo = $this->input->post('cargo');
            $data_nascimento = base64_encode($this->input->post('data_nascimento'));

            $data =
                array(
                    'nome_funcionario' => $nome,
                    'sobrenome' => $sobrenome,
                    'cpf' => $cpf,
                    'email' => $email,
                    'telefone_fixo' => $telefone_fixo,
                    'telefone_movel' => $telefone_movel,
                    'endereco' => $endereco,
                    'sexo' => $sexo,
                    'rg' => $rg,
                    'cargo' => $cargo,
                    'data_nascimento' => $data_nascimento,
                    'foto' => $url_imagem
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