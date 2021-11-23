<?php

defined('BASEPATH') or exit('Ação não permitida');


class Servicos extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sessão expirada');
            redirect('login');
        }

        $this->load->model('servicos_model');
        $this->load->model('materiais_model');
    }


    public function index()
    {
        $data = array(
            'titulo' => 'Serviços Realizados',
            'styles' => array('https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css'),
            'scripts' => array(
                'public/vendor/datatables/jquery.dataTables.js',
                'https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js',
                'https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js',
                'public/vendor/mask/app.js',
                'public/vendor/datatables/app.js',
            ),
            'servicos' => $this->servicos_model->get_all_current_time('servicos'),
            'clientes' => $this->core_model->get_all('clientes'),
            'funcionarios' => $this->core_model->get_all('funcionarios'),

        );

        // echo '<pre>';
        // print_r($data['materiais']);
        // exit();

        $this->load->view('layout/header', $data);
        $this->load->view('servicos/index');
        $this->load->view('layout/footer');
    }

    public function geral()
    {
        $data = array(
            'titulo' => 'Serviços Realizados',
            'styles' => array('https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css'),
            'scripts' => array(
                base_url('public/vendor/datatables/jquery.dataTables.js'),
                'https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js',
                'https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js',
                base_url('public/vendor/mask/app.js'),
                base_url('public/vendor/datatables/app.js'),
            ),
            'servicos' => $this->servicos_model->get_all('servicos'),
            'clientes' => $this->core_model->get_all('clientes'),
            'funcionarios' => $this->core_model->get_all('funcionarios'),

        );

        // echo '<pre>';
        // print_r($data['materiais']);
        // exit();

        $this->load->view('layout/header', $data);
        $this->load->view('servicos/geral');
        $this->load->view('layout/footer');
    }

    public function edit($id = NULL)
    {
        if (!$id || !$this->core_model->get_by_id('servicos', array('id' => $id))) {
            $this->session->set_flashdata('error', 'Serviço não encontrado');
            redirect('servicos');
        } else {


            $this->form_validation->set_rules('funcionario_id', 'Nome de quem realizou', 'required');
            $this->form_validation->set_rules('nome_servico', 'Nome do serviço', 'required|min_length[5]|max_length[145]');
            $this->form_validation->set_rules('cliente_id', 'Nome do cliente', 'required');
            $this->form_validation->set_rules('registro_orcamento', 'Orçamento', 'required');
            $this->form_validation->set_rules('data', 'Data do serviço', 'required');
            $this->form_validation->set_rules('preco', 'Preço', 'required');
            $this->form_validation->set_rules('descricao', 'Texto da ordem de serviço e venda', 'max_length[1000]');


            if ($this->form_validation->run()) {

                $data = elements(
                    array(
                        'funcionario_id',
                        'nome_servico',
                        'cliente_id',
                        'registro_orcamento',
                        'data',
                        'preco',
                        'descricao'
                    ),
                    $this->input->post()
                );

                $data = html_escape($data);

                $this->core_model->update('servicos', $data, array('id' => $id));

                $id_teste = $id;

                $this->servicos_model->deletar_materiais($id);

                $material_id = $this->input->post('material_id');

                $material_quantidade = $this->input->post('quantidade_produto');

                $material_preco = str_replace('R$', '', $this->input->post('valor_produto'));

                $qty_servico = count($material_id);

                // $servico = $this->input->post('id');

                for ($i = 0; $i < $qty_servico; $i++) {

                    $data = array(
                        'servico_id' => $id_teste,
                        'material_id' => $material_id[$i],
                        'quantidade_produto' => $material_quantidade[$i],
                        'valor_produto' => $material_preco[$i],
                    );

                    $data = html_escape($data);

                    $this->core_model->insert('servicos_produtos', $data);

                    $quantidade = 0;
                    $quantidade += intval($material_quantidade[$i]);

                    $materiais = array(
                        'quantidade' => $quantidade,
                    );
                    $this->materiais_model->atualizar_estoque($material_id[$i], $quantidade);
                }


                // echo '<pre>';
                // print_r($this->input->post());
                // exit();

                redirect('servicos');
            } else {


                $data = array(
                    'titulo' => 'Atualizar Serviço',
                    'styles' => array(
                        base_url('public/vendor/select2/select2.min.css'),
                        base_url('public/vendor/autocomplete/jquery-ui.css'),
                        base_url('public/vendor/autocomplete/style.css'),
                    ),
                    'scripts' => array(
                        base_url('public/vendor/autocomplete/jquery-migrate.js'),
                        base_url('public/vendor/calcx/jquery-calx-sample-2.2.8.min.js'),
                        base_url('public/vendor/calcx/materiais.js'),
                        base_url('public/vendor/select2/select2.min.js'),
                        base_url('public/vendor/select2/app.js'),
                        base_url('public/vendor/sweetalert2/sweetalert2.js'),
                        base_url('public/vendor/autocomplete/jquery-ui.js'),
                        base_url('public/vendor/mask/app.js'),
                    ),
                    'servico' => $this->servicos_model->get_by_id($id),
                    'materiais' => $this->servicos_model->get_all_materiais_by_servicos($id),
                    'clientes' => $this->core_model->get_all('clientes'),
                    'funcionarios' => $this->core_model->get_all('funcionarios'),
                );

                $servico = $data['servicos'] = $this->servicos_model->get_by_id($id);

                // echo '<pre>';
                // print_r($this->input->post());
                // exit();

                $this->load->view('layout/header', $data);
                $this->load->view('servicos/edit');
                $this->load->view('layout/footer');
            }
        }
    }

    public function add()
    {

        $this->form_validation->set_rules('funcionario_id', 'Nome de quem realizou', 'required');
        $this->form_validation->set_rules('nome_servico', 'Nome do serviço', 'required|min_length[5]|max_length[145]');
        $this->form_validation->set_rules('cliente_id', 'Nome do cliente', 'required');
        $this->form_validation->set_rules('registro_orcamento', 'Orçamento', 'required');
        $this->form_validation->set_rules('data', 'Data do serviço', 'required');
        $this->form_validation->set_rules('preco', 'Preço', 'required');
        $this->form_validation->set_rules('descricao', 'Texto da ordem de serviço e venda', 'max_length[1000]');


        if ($this->form_validation->run()) {

            $data = elements(
                array(
                    'funcionario_id',
                    'nome_servico',
                    'cliente_id',
                    'registro_orcamento',
                    'data',
                    'preco',
                    'descricao'
                ),
                $this->input->post()
            );

            $data = html_escape($data);

            $this->core_model->insert('servicos', $data, TRUE);

            $servico = $this->session->userdata('last_id');

            $id_servico = $servico;

            $material_id = $this->input->post('material_id');

            $material_quantidade = $this->input->post('quantidade_produto');

            $material_preco = str_replace('R$', '', $this->input->post('valor_produto'));

            $qty_servico = count($material_id);

            for ($i = 0; $i < $qty_servico; $i++) {

                $data = array(
                    'servico_id' => $id_servico,
                    'material_id' => $material_id[$i],
                    'quantidade_produto' => $material_quantidade[$i],
                    'valor_produto' => $material_preco[$i],
                );

                $data = html_escape($data);


                $this->core_model->insert('servicos_produtos', $data);

                $quantidade = 0;
                $quantidade += intval($material_quantidade[$i]);

                $materiais = array(
                    'quantidade' => $quantidade,
                );
                $this->materiais_model->atualizar_estoque($material_id[$i], $quantidade);
            }


            // echo '<pre>';
            // print_r($this->input->post());
            // exit();

            redirect('servicos');
        } else {


            $data = array(
                'titulo' => 'Registro de serviços',
                'styles' => array(
                    base_url('public/vendor/select2/select2.min.css'),
                    base_url('public/vendor/autocomplete/jquery-ui.css'),
                    base_url('public/vendor/autocomplete/style.css'),
                ),
                'scripts' => array(
                    base_url('public/vendor/autocomplete/jquery-migrate.js'),
                    base_url('public/vendor/calcx/jquery-calx-sample-2.2.8.min.js'),
                    base_url('public/vendor/calcx/materiais.js'),
                    base_url('public/vendor/select2/select2.min.js'),
                    base_url('public/vendor/select2/app.js'),
                    base_url('public/vendor/sweetalert2/sweetalert2.js'),
                    base_url('public/vendor/autocomplete/jquery-ui.js'),
                    base_url('public/vendor/mask/app.js'),
                ),
                'materiais' => $this->servicos_model->get_all('materiais'),
                'clientes' => $this->core_model->get_all('clientes'),
                'funcionarios' => $this->core_model->get_all('funcionarios'),
            );

            // echo '<pre>';
            // print_r($data['materiais']);
            // exit();

            $this->load->view('layout/header', $data);
            $this->load->view('servicos/add');
            $this->load->view('layout/footer');
        }
    }

    public function del($id = NULL)
    {
        if (!$id || !$this->core_model->get_by_id('servicos', array('id' => $id))) {
            $this->session->set_flashdata('error', 'Serviço não encontrado');
            redirect('servicos');
        } else {
            $this->core_model->delete('servicos', array('id' => $id));
            redirect('servicos');
        }
    }


    public function imprimir($id = NULL)
    {
        if (!$id || !$this->core_model->get_by_id('servicos', array('id' => $id))) {

            $this->session->set_flashdata('error', 'Serviço não encontrado');
            redirect('servicos');
        } else {
            $empresa = $this->core_model->get_by_id('oficina', array('id' => 1));



            $servico = $this->servicos_model->get_by_id($id);

            $file_name = 'Serviço realizado Nº' . $servico->id;

            $html = '<html>';

            $html .= '<head>';
            $html .= '<title>' . $empresa->nome_fantasia . ' | Impressão de serviço</title>';



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


            $html .= '<p align="right" style="font-size: 20px">Código de identificação do serviço: ' . $servico->id . '</p>' . '<br/>';

            $html .= '<p style="font-size: 20px">'
                . '<strong>Nome do cliente: </strong>' . $servico->nome . '<br/>' . '<br/>'
                . '<strong>Nome de quem realizou o serviço: </strong>' . $servico->nome_funcionario . '<br/>' . '<br/>'
                . '<strong>Tipo de serviço: </strong>' . $servico->nome_servico . '<br/>' . '<br/>'
                . '<strong>Placa do veículo: </strong>' . $servico->placa . '<br/>' . '<br/>'
                . '<strong>Veículo: </strong>' . $servico->veiculo . '<br/>' . '<br/>'
                . '<strong>Celular: </strong>' . $servico->telefone_movel . '<br/>' . '<br/>'
                . '<strong>Data: </strong>' . formata_data_banco_sem_hora($servico->data) . '<br/>' . '<br/>'
                . '<strong>Preço: </strong>R$' . number_format($servico->preco, 2, ",", ".") . '<br/>' . '<br/>'
                . '<strong>Descrição do serviço: </strong>' . $servico->descricao . '<br/>'
                . '</p>';


            $html .= '<hr>';

            $html .= '<table width="100%" border: solid #ddd 1px>';

            $html .= '<tr>';

            $html .= '<th>id</th>';
            $html .= '<th>Material</th>';
            $html .= '<th style="text-align: center;">Quantidade</th>';
            $html .= '<th>Valor unitário</th>';

            $html .= '</tr>';

            $material_id = $servico->id;

            $materiais = $this->servicos_model->get_all_materiais_by_servicos($material_id);

            foreach ($materiais as $key => $material) :

                $html .= '<tr>';
                $html .= '<td>' . intval($key + 1) . '</td>';
                $html .= '<td>' . $material->nome_material . '</td>';
                $html .= '<td style="text-align: center;">' . $material->quantidade_produto . '</td>';
                $html .= '<td>' . 'R$&nbsp;' . number_format($material->valor, 2, ",", ".") . '</td>';
                $html .= '</tr>';

            endforeach;

            $html .= '<th colspan="4">';

            $html .= '<td style="border-top: solid #ddd 1px"><strong>Valor final</strong></td>';
            $html .= '<td style="border-top: solid #ddd 1px">' . 'R$&nbsp;' . number_format($servico->preco, 2, ",", ".") . '</td>';

            $html .= '</th>';

            $html .= '</table>';

            $html .= '</body>';

            $html .= '<html>';

            $this->pdf->createPDF($html, $file_name, FALSE);
        }
    }
}