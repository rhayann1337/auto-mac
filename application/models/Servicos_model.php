<?php

defined('BASEPATH') or exit('Ação não permitida!');

class Servicos_model extends CI_Model
{

    public function get_all()
    {
        $this->db->select([
            'servicos.*',
            'clientes.nome',
            'clientes.sobrenome',
            'clientes.telefone_movel',
            'clientes.email',
            'clientes.placa',
            'clientes.veiculo',
            'funcionarios.nome_funcionario',
            'funcionarios.sobrenome'
        ]);

        $this->db->join('clientes', 'servicos.cliente_id = clientes.id', 'LEFT');
        $this->db->join('funcionarios', 'servicos.funcionario_id = funcionarios.id', 'LEFT');

        return $this->db->get('servicos')->result();
    }

    public function get_all_current_time($data_atual = NULL)
    {
        $this->db->select([
            'servicos.*',
            'clientes.nome',
            'clientes.sobrenome',
            'clientes.telefone_movel',
            'clientes.email',
            'clientes.placa',
            'clientes.veiculo',
            'funcionarios.nome_funcionario',
            'funcionarios.sobrenome'
        ]);
        $this->db->join('clientes', 'servicos.cliente_id = clientes.id', 'LEFT');
        $this->db->join('funcionarios', 'servicos.funcionario_id = funcionarios.id', 'LEFT');

        $data_atual = date_create('-1 month')->format('Y-m-d');

        $this->db->where("SUBSTR(data, 1, 10) > '$data_atual'");

        return $this->db->get('servicos')->result();
    }

    public function get_all_materiais_by_servicos($id = NULL)
    {
        if ($id) {
            $this->db->select([
                'servicos_produtos.*',
                'materiais.nome_material',
                'materiais.valor',
            ]);
            $this->db->join('materiais', 'material_id = materiais.id', 'LEFT');

            $this->db->where('servico_id', $id);

            return $this->db->get('servicos_produtos')->result();
        }
    }

    public function deletar_materiais($id = NULL)
    {
        if ($id) {
            $this->db->delete('servicos_produtos', array('servico_id' => $id));
        }
    }

    public function get_all_servicos($id = NULL)
    {
        if ($id) {
            $this->db->select([
                'servicos_produtos.*',
                'FORMAT(SUM(REPLACE(valor_produto, ",", "")),2) as valor_produto',
                'FORMAT(SUM(REPLACE(valor_total, ",", "")),2) as valor_total',
                'materiais.nome',
            ]);
            $this->db->join('materiais', 'id = material_id', 'LEFT');
            $this->db->where('servico_id', $id);

            $this->db->group_by('servico_id');

            return $this->db->get('servicos_produtos')->result();
        }
    }

    public function gerar_relatorio_servicos($data_inicial = NULL, $data_final = NULL)
    {
        $this->db->select([
            'servicos.*',
        ]);

        if ($data_inicial && $data_final) {

            $this->db->where("SUBSTR(data, 1, 10) >= '$data_inicial' AND  SUBSTR(data, 1, 10) <= '$data_final'");
        } else {
            $this->db->where("SUBSTR(data, 1, 10) >= '$data_inicial'");
        }

        return $this->db->get('servicos')->result();
    }

    public function gerar_valor_total($data_inicial = NULL, $data_final = NULL)
    {
        $this->db->select([
            'FORMAT(SUM(REPLACE(preco, ",", "")),2) as preco',
        ]);

        if ($data_inicial && $data_final) {

            $this->db->where("SUBSTR(data, 1, 10) >= '$data_inicial' AND  SUBSTR(data, 1, 10) <= '$data_final'");
        } else {
            $this->db->where("SUBSTR(data, 1, 10) >= '$data_inicial'");
        }

        return $this->db->get('servicos')->row();
    }

    public function contar_quantidade_servicos($data_inicial = NULL, $data_final = NULL)
    {
        $this->db->select([
            'FORMAT(COUNT(REPLACE(id, ",", "")),0) as id',
        ]);

        if ($data_inicial && $data_final) {

            $this->db->where("SUBSTR(data, 1, 10) >= '$data_inicial' AND  SUBSTR(data, 1, 10) <= '$data_final'");
        } else {
            $this->db->where("SUBSTR(data, 1, 10) >= '$data_inicial'");
        }

        return $this->db->get('servicos')->row();
    }

    public function get_by_id($id = NULL)
    {

        $this->db->select([
            'servicos.*',
            'clientes.nome',
            'clientes.telefone_movel',
            'clientes.email',
            'clientes.placa',
            'clientes.veiculo',
            'funcionarios.nome_funcionario',
            'funcionarios.sobrenome'
        ]);
        $this->db->where('servicos.id', $id);
        $this->db->join('clientes', 'servicos.cliente_id = clientes.id', 'LEFT');
        $this->db->join('funcionarios', 'servicos.funcionario_id = funcionarios.id', 'LEFT');

        return $this->db->get('servicos')->row();
    }
}