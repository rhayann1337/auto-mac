<?php

defined('BASEPATH') or exit('Ação não permitida!');

class Orcamentos_model extends CI_Model
{

    public function get_all()
    {
        $this->db->select([
            'orcamentos.*',
            'clientes.nome',
            'clientes.telefone_movel',
            'clientes.placa',
            'clientes.veiculo',
            'funcionarios.nome_funcionario',
        ]);

        $this->db->join('clientes', 'orcamentos.cliente_id = clientes.id', 'INNER');
        $this->db->join('funcionarios', 'orcamentos.funcionario_id = funcionarios.id', 'INNER');

        return $this->db->get('orcamentos')->result();
    }

    public function get_by_id($id)
    {
        $this->db->select([
            'orcamentos.*',
            'clientes.nome',
            'clientes.telefone_movel',
            'clientes.email',
            'clientes.placa',
            'clientes.veiculo',
            'funcionarios.nome_funcionario',
            'funcionarios.sobrenome'
        ]);
        $this->db->where('orcamentos.id', $id);
        $this->db->join('clientes', 'orcamentos.cliente_id = clientes.id', 'INNER');
        $this->db->join('funcionarios', 'orcamentos.funcionario_id = funcionarios.id', 'INNER');

        return $this->db->get('orcamentos')->row();
    }


    public function gerar_relatorio_orcamentos($data_inicial = NULL, $data_final = NULL)
    {
        $this->db->select([
            'orcamentos.*',
            'clientes.id',
            'clientes.nome',
            'clientes.telefone_movel',
            'clientes.email',
            'funcionarios.id',
            'funcionarios.nome_funcionario',
            'funcionarios.sobrenome'
        ]);

        $this->db->join('clientes', 'orcamentos.cliente_id = clientes.id', 'LEFT');
        $this->db->join('funcionarios', 'orcamentos.funcionario_id = funcionarios.id', 'LEFT');

        if ($data_inicial && $data_final) {

            $this->db->where("SUBSTR(data, 1, 10) >= '$data_inicial' AND  SUBSTR(data, 1, 10) <= '$data_final'");
        } else {
            $this->db->where("SUBSTR(data, 1, 10) >= '$data_inicial'");
        }

        return $this->db->get('orcamentos')->result();
    }

    public function gerar_valor_total($data_inicial = NULL, $data_final = NULL)
    {
        $this->db->select([
            'FORMAT(SUM(REPLACE(valor_total, ",", "")),2) as valor_total',
        ]);

        if ($data_inicial && $data_final) {

            $this->db->where("SUBSTR(data, 1, 10) >= '$data_inicial' AND  SUBSTR(data, 1, 10) <= '$data_final'");
        } else {
            $this->db->where("SUBSTR(data, 1, 10) >= '$data_inicial'");
        }

        return $this->db->get('orcamentos')->row();
    }

    public function contar_quantidade_orcamentos($data_inicial = NULL, $data_final = NULL)
    {
        $this->db->select([
            'FORMAT(COUNT(REPLACE(id, ",", "")),0) as id',
        ]);

        if ($data_inicial && $data_final) {

            $this->db->where("SUBSTR(data, 1, 10) >= '$data_inicial' AND  SUBSTR(data, 1, 10) <= '$data_final'");
        } else {
            $this->db->where("SUBSTR(data, 1, 10) >= '$data_inicial'");
        }

        return $this->db->get('orcamentos')->row();
    }
}