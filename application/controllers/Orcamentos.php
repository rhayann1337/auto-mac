<?php

defined('BASEPATH') or exit('Ação não permitida');


class Orcamentos extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sessão expirada');
            redirect('login');
        }

        $this->load->model('orcamentos_model');
    }


    public function index()
    {

        $data = array(
            'titulo' => 'Orçamentos Realizados',
            'styles' => array('https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css'),
            'scripts' => array(
                'https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js',
                'https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js',
                'https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js',
                'public/vendor/mask/app.js',
                'public/vendor/datatables/app.js',
            ),
            'orcamentos' => $this->orcamentos_model->get_all(),
            'clientes' => $this->core_model->get_all('clientes'),
            'funcionarios' => $this->core_model->get_all('funcionarios'),
        );

        // echo '<pre>';
        // print_r($data['orcamentos']);
        // exit();

        $this->load->view('layout/header', $data);
        $this->load->view('orcamentos/index');
        $this->load->view('layout/footer');
    }

    public function edit($orcamento_id = NULL)
    {
        if (!$orcamento_id || !$this->core_model->get_by_id('orcamentos', array('id' => $orcamento_id))) {
            $this->session->set_flashdata('error', 'Orçamento não encontrado');
            redirect('orcamentos');
        } else {


            $this->form_validation->set_rules('cliente_id', 'Cliente', 'required');
            $this->form_validation->set_rules('funcionario_id', 'Funcionario', 'required');
            $this->form_validation->set_rules('valor_total', 'Valor', 'required');
            $this->form_validation->set_rules('descricao', 'Texto da descrição de serviço', 'max_length[1000]');


            if ($this->form_validation->run()) {

                $data = elements(
                    array(
                        'cliente_id',
                        'funcionario_id',
                        'valor_total',
                        'descricao',
                    ),
                    $this->input->post()
                );

                $data = html_escape($data);

                $this->core_model->update('orcamentos', $data, array('id' => $orcamento_id));


                redirect('orcamentos');
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
                        base_url('public/vendor/mask/app.js'),
                    ),
                    'clientes' => $this->core_model->get_all('clientes'),
                    'funcionarios' => $this->core_model->get_all('funcionarios'),
                    'orcamento' => $this->core_model->get_by_id('orcamentos', array('id' => $orcamento_id)),
                );

                // echo '<pre>';
                // print_r($data['orcamento']);
                // exit();

                $this->load->view('layout/header', $data);
                $this->load->view('orcamentos/edit');
                $this->load->view('layout/footer');
            }
        }
    }

    public function add()
    {

        $this->form_validation->set_rules('cliente_id', 'Cliente', 'required');
        $this->form_validation->set_rules('funcionario_id', 'Funcionario', 'required');
        $this->form_validation->set_rules('valor_total', 'Valor', 'required');
        $this->form_validation->set_rules('descricao', 'Texto da descrição de orçamentos', 'max_length[1000]');




        if ($this->form_validation->run()) {

            $data = elements(
                array(
                    'cliente_id',
                    'funcionario_id',
                    'valor_total',
                    'descricao',
                ),
                $this->input->post()
            );

            $data = html_escape($data);

            $this->core_model->insert('orcamentos', $data, TRUE);

            redirect('orcamentos');
        } else {

            $data = array(
                'titulo' => 'Cadastrar Orçamento',
                'scripts' => array(
                    'https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js',
                    'https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js',
                    'https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js',
                    base_url('public/vendor/mask/app.js'),
                ),
                'clientes' => $this->core_model->get_all('clientes'),
                'funcionarios' => $this->core_model->get_all('funcionarios'),
            );


            $this->load->view('layout/header', $data);
            $this->load->view('orcamentos/add');
            $this->load->view('layout/footer');
        }
    }

    public function del($id = NULL)
    {
        if (!$id || !$this->core_model->get_by_id('orcamentos', array('id' => $id))) {
            $this->session->set_flashdata('error', 'Orçamento não encontrado');
            redirect('orcamentos');
        } else {
            $this->core_model->delete('orcamentos', array('id' => $id));
            redirect('orcamentos');
        }
    }

    public function imprimir($id = NULL)
    {
        if (!$id || !$this->core_model->get_by_id('orcamentos', array('id' => $id))) {

            $this->session->set_flashdata('error', 'Orçamento não encontrado');
            redirect('servicos');
        } else {
            $empresa = $this->core_model->get_by_id('oficina', array('id' => 1));


            $orcamento = $this->orcamentos_model->get_by_id($id);

            $file_name = 'Orçamento realizado Nº' . $orcamento->id;

            $html = '<html>';

            $html .= '<head>';
            $html .= '<title>' . $empresa->nome_fantasia . ' | Impressão de orçamento</title>';



            $html .= '</head>';

            $html .= '<body style="font-size:16px">';

            $html .= '<h4 align="center">
            ' . $empresa->nome_fantasia . '<br/>
                ' . $empresa->razao_social . '<br/>
                ' . 'CNPJ: ' . $empresa->cnpj . '<br/>
                ' . $empresa->endereco . ',&nbsp;' . $empresa->numero . '<br/>
                ' . 'CEP: ' . $empresa->cep . ',&nbsp;' . $empresa->cidade . ',&nbsp;' . $empresa->estado . '<br/>
                ' . 'Telefone: ' . $empresa->telefone_fixo . '<br/>
                ' . 'E-mail: ' . $empresa->email . '<br/>
                </h4>';

            $html .= '<hr>';


            $html .= '<p align="right" style="font-size: 20px">Código de identificação do orçamento: ' . $orcamento->id . '</p>' . '<br/>';

            $html .= '<p style="font-size: 20px">'
                . '<strong>Nome do cliente: </strong>' . $orcamento->nome . '<br/>' . '<br/>'
                . '<strong>Nome de quem realizou o orçamento: </strong>' . $orcamento->nome_funcionario . '<br/>' . '<br/>'
                . '<strong>Placa do veículo: </strong>' . $orcamento->placa . '<br/>' . '<br/>'
                . '<strong>Modelo do veículo: </strong>' . $orcamento->veiculo . '<br/>' . '<br/>'
                . '<strong>Celular: </strong>' . $orcamento->telefone_movel . '<br/>' . '<br/>'
                . '<strong>Data: </strong>' . formata_data_banco_sem_hora($orcamento->data) . '<br/>' . '<br/>'
                . '<strong>Preço: </strong>R$' . $orcamento->valor_total . '<br/>' . '<br/>'
                . '<strong>Descrição do serviço: </strong>' . $orcamento->descricao . '<br/>'
                . '</p>';


            $html .= '<hr>';

            $html .= '</body>';

            $html .= '<html>';

            $this->pdf->createPDF($html, $file_name, FALSE);
        }
    }
}