<?php

defined('BASEPATH') or exit('Ação não permitida!');

class Relatorios extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sua sessão expirou!');
            redirect('login');
        }

        if (!$this->ion_auth->is_admin()) {

            $this->session->set_flashdata('info', 'Você não tem permissão para acessar esse menu');
            redirect('/');
        }
    }

    public function servicos()
    {

        $data = array(
            'titulo' => 'Relatório de serviços',
        );

        $data_inicial = $this->input->post('data_inicial');

        $data_final = $this->input->post('data_final');

        if ($data_inicial) {
            $this->load->model('servicos_model');

            if ($this->servicos_model->gerar_relatorio_servicos($data_inicial, $data_final)) {

                $empresa = $this->core_model->get_by_id('oficina', array('id' => 1));

                $servicos = $this->servicos_model->gerar_relatorio_servicos($data_inicial, $data_final);

                $file_name = 'Relatório de serviços';

                $html = '<html>';

                $html .= '<head>';
                $html .= '<title>' . $empresa->nome_fantasia . ' | Relatório de serviços</title>';

                $html .= '</head>';

                $html .= '<body style="font-size:12px">';

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


                if ($data_inicial && $data_final) {
                    $html .= '<p align="center" style="font-size: 12px">Relatório de servico realizados em</p>';
                    $html .= '<p align="center" style="font-size: 12px">' . formata_data_banco_sem_hora($data_inicial) . ' até ' . formata_data_banco_sem_hora($data_final) . '</p>';
                } else {
                    $html .= '<p align="center" style="font-size: 12px">Relatório de servico realizados a partir de </p>';
                    $html .= '<p align="center" style="font-size: 12px">' . formata_data_banco_sem_hora($data_inicial) . '</p>';
                }


                $html .= '<hr>';

                $html .= '<table width="100%" border: solid #ddd 1px>';

                $html .= '<tr>';

                $html .= '<th style="font-size: 16px">Número do serviço</th>';
                $html .= '<th style="font-size: 16px">Data</th>';
                $html .= '<th style="font-size: 16px">Cliente</th>';
                $html .= '<th style="font-size: 16px">Funcionário</th>';
                $html .= '<th style="font-size: 16px">Tipo de serviço</th>';
                $html .= '<th style="font-size: 16px">Valor total</th>';

                $html .= '</tr>';

                $preco_total = $this->servicos_model->gerar_valor_total($data_inicial, $data_final);
                $quantidade_total = $this->servicos_model->contar_quantidade_servicos($data_inicial, $data_final);

                foreach ($servicos as $servico) :

                    $html .= '<tr>';
                    $html .= '<td>' . $servico->id . '</td>';
                    $html .= '<td>' . formata_data_banco_sem_hora($servico->data) . '</td>';
                    $html .= '<td>' . $servico->nome . '</td>';
                    $html .= '<td>' . base64_decode($servico->nome_funcionario) . '</td>';
                    $html .= '<td>' . $servico->nome_servico . '</td>';
                    $html .= '<td>' . 'R$&nbsp;' . number_format($servico->preco, 2, ",", ".") . '</td>';
                    $html .= '</tr>';

                endforeach;

                $html .= '<th colspan="3">';

                $html .= '<td style="border-top: solid #ddd 1px"><strong>Quantidade de serviços realizados</strong></td>';
                $html .= '<td style="border-top: solid #ddd 1px">' . '&nbsp;' . $quantidade_total->id . '</td>';
                $html .= '<td style="border-top: solid #ddd 1px"><strong>Valor final</strong></td>';
                $html .= '<td style="border-top: solid #ddd 1px">' . 'R$&nbsp;' . $preco_total->preco . '</td>';

                $html .= '</th>';

                $html .= '</table>';

                $html .= '</body>';

                $html .= '<html>';


                $this->pdf->createPDF($html, $file_name, FALSE);
            } else {

                if (!empty($data_inicial) && !empty($data_final)) {

                    $this->session->set_flashdata('info', 'Não foram encontrados servico entre as datas ' . formata_data_banco_sem_hora($data_inicial) . '&nbsp;e&nbsp;' . formata_data_banco_sem_hora($data_final));
                } else {
                    $this->session->set_flashdata('info', 'Não foram encontrados servico a partir da data ' . formata_data_banco_sem_hora($data_inicial));
                }

                redirect('relatorios/servicos');
            }
        }

        $this->load->view('layout/header', $data);
        $this->load->view('relatorios/servicos');
        $this->load->view('layout/footer');
    }

    public function materiais()
    {
        $this->load->model('materiais_model');

        $data = array(
            'titulo' => 'Relatório de materiais utilizados',
        );

        $empresa = $this->core_model->get_by_id('oficina', array('id' => 1));

        $materiais = $this->materiais_model->get_all();

        $file_name = 'Relatório de materiais';

        $html = '<html>';

        $html .= '<head>';
        $html .= '<title>' . $empresa->nome_fantasia . ' | Relatório de materiais</title>';

        $html .= '</head>';

        $html .= '<body style="font-size:12px">';

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

        $data_atual = (new \DateTime())->format('d-m-Y');

        $html .= '<p align="center" style="font-size: 12px">Relatório gerado em ' . $data_atual . '</p>';

        $html .= '<hr>';

        $html .= '<table width="100%" border: solid #ddd 1px>';

        $html .= '<tr>';

        $html .= '<th style="font-size: 16px">Nome</th>';
        $html .= '<th style="font-size: 16px">Fornecedor</th>';
        $html .= '<th style="font-size: 16px">Qtd</th>';
        $html .= '<th style="font-size: 16px">Qtd mínima</th>';

        $html .= '</tr>';

        foreach ($materiais as $material) :

            $html .= '<tr>';
            $html .= '<td>' . $material->nome_material . '</td>';
            $html .= '<td>' . $material->marca . '</td>';
            $html .= '<td>' . $material->quantidade . '</td>';
            $html .= '<td>' . $material->quantidade_minima . '</td>';
            $html .= '</tr>';

        endforeach;

        $html .= '</table>';

        $html .= '</body>';

        $html .= '<html>';


        $this->pdf->createPDF($html, $file_name, FALSE);


        $this->load->view('layout/header', $data);
        $this->load->view('relatorios/materiais');
        $this->load->view('layout/footer');
    }


    public function orcamentos()
    {

        $data = array(
            'titulo' => 'Relatório de orçamentos',
        );

        $data_inicial = $this->input->post('data_inicial');

        $data_final = $this->input->post('data_final');

        if ($data_inicial) {
            $this->load->model('orcamentos_model');

            if ($this->orcamentos_model->gerar_relatorio_orcamentos($data_inicial, $data_final)) {

                $empresa = $this->core_model->get_by_id('oficina', array('id' => 1));

                $orcamentos = $this->orcamentos_model->gerar_relatorio_orcamentos($data_inicial, $data_final);

                $file_name = 'Relatório de orçamentos';

                $html = '<html>';

                $html .= '<head>';
                $html .= '<title>' . $empresa->nome_fantasia . ' | Relatório de orcamentos</title>';

                $html .= '</head>';

                $html .= '<body style="font-size:12px">';

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

                if ($data_inicial && $data_final) {
                    $html .= '<p align="center" style="font-size: 12px">Relatório de orçamentos realizados em</p>';
                    $html .= '<p align="center" style="font-size: 12px">' . formata_data_banco_sem_hora($data_inicial) . ' até ' . formata_data_banco_sem_hora($data_final) . '</p>';
                } else {
                    $html .= '<p align="center" style="font-size: 12px">Relatório de orcçmentos realizados a partir de </p>';
                    $html .= '<p align="center" style="font-size: 12px">' . formata_data_banco_sem_hora($data_inicial) . '</p>';
                }


                $html .= '<hr>';

                $html .= '<table width="100%" border: solid #ddd 1px>';

                $html .= '<tr>';

                $html .= '<th style="font-size: 16px">Responsável</th>';
                $html .= '<th style="font-size: 16px">Placa</th>';
                $html .= '<th style="font-size: 16px">Veículo</th>';
                $html .= '<th style="font-size: 16px">Data</th>';
                $html .= '<th style="font-size: 16px">Preço</th>';

                $html .= '</tr>';

                $preco_total = $this->orcamentos_model->gerar_valor_total($data_inicial, $data_final);
                $quantidade_total = $this->orcamentos_model->contar_quantidade_orcamentos($data_inicial, $data_final);

                foreach ($orcamentos as $orcamento) :

                    $html .= '<tr>';
                    $html .= '<td>' . base64_decode($orcamento->nome_funcionario) . '</td>';
                    $html .= '<td>' . $orcamento->placa . '</td>';
                    $html .= '<td>' . $orcamento->veiculo . '</td>';
                    $html .= '<td>' . formata_data_banco_sem_hora($orcamento->data) . '</td>';
                    $html .= '<td>' . 'R$&nbsp;' . number_format($orcamento->valor_total, 2, ",", ".") . '</td>';
                    $html .= '</tr>';

                endforeach;

                $html .= '<th colspan="3">';

                $html .= '<td style="border-top: solid #ddd 1px"><strong>Quantidade de orçamentos realizados</strong></td>';
                $html .= '<td style="border-top: solid #ddd 1px">' . '&nbsp;' . $quantidade_total->id . '</td>';
                $html .= '<td style="border-top: solid #ddd 1px"><strong>Valor final</strong></td>';
                $html .= '<td style="border-top: solid #ddd 1px">' . 'R$&nbsp;' . number_format($preco_total->valor_total, 2, ",", ".") . '</td>';

                $html .= '</th>';

                $html .= '</table>';

                $html .= '</body>';

                $html .= '<html>';


                $this->pdf->createPDF($html, $file_name, FALSE);
            } else {

                if (!empty($data_inicial) && !empty($data_final)) {

                    $this->session->set_flashdata('info', 'Não foram encontrados orcamentos entre as datas ' . formata_data_banco_sem_hora($data_inicial) . '&nbsp;e&nbsp;' . formata_data_banco_sem_hora($data_final));
                } else {
                    $this->session->set_flashdata('info', 'Não foram encontrados orcamentos a partir da data ' . formata_data_banco_sem_hora($data_inicial));
                }

                redirect('relatorios/orcamentos');
            }
        }

        $this->load->view('layout/header', $data);
        $this->load->view('relatorios/orcamentos');
        $this->load->view('layout/footer');
    }
}