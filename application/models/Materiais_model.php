<?php

defined('BASEPATH') or exit('Ação não permitida!');

class Materiais_model extends CI_Model
{

    public function get_all()
    {
        $this->db->select([
            'materiais.*',
            'fornecedores.marca',
        ]);
        $this->db->join('fornecedores', 'materiais.fornecedor_id = fornecedores.id', 'INNER');

        return $this->db->get('materiais')->result();
    }

    public function get_by_id($id)
    {
        $this->db->select([
            'materiais.*',
            'fornecedor.marca',
        ]);
        $this->db->where('orcamentos.id', $id);
        $this->db->join('fornecedores', 'materiais.fornecedor_id = fornecedores.id', 'INNER');

        return $this->db->get('materiais')->row();
    }

    public function atualizar_estoque($id, $material_utilizado)
    {
        $this->db->set('quantidade', 'quantidade - ' . $material_utilizado, FALSE);
        $this->db->where('id', $id);
        $this->db->update('materiais');
    }


    public function gerar_relatorio_materiais($data_inicial = NULL, $data_final = NULL)
    {
        $this->db->select([
            'materiais.*',
            'fornecedor.marca',
        ]);

        $this->db->join('fornecedores', 'materiais.fornecedor_id = fornecedores.id', 'INNER');


        if ($data_inicial && $data_final) {

            $this->db->where("SUBSTR(data, 1, 10) >= '$data_inicial' AND  SUBSTR(data, 1, 10) <= '$data_final'");
        } else {
            $this->db->where("SUBSTR(data, 1, 10) >= '$data_inicial'");
        }

        return $this->db->get('materiais')->result();
    }

    public function gerar_quantidade_produtos($data_inicial = NULL, $data_final = NULL)
    {
        $this->db->select([
            'FORMAT(SUM(REPLACE(quantidade, ",", "")),2) as quantidade',
        ]);

        if ($data_inicial && $data_final) {

            $this->db->where("SUBSTR(data, 1, 10) >= '$data_inicial' AND  SUBSTR(data, 1, 10) <= '$data_final'");
        } else {
            $this->db->where("SUBSTR(data, 1, 10) >= '$data_inicial'");
        }

        return $this->db->get('materiais')->row();
    }

    public function contar_quantidade_materiais_de_fornecedor_especifico($data_inicial = NULL, $data_final = NULL)
    {
        $this->db->select([
            'FORMAT(COUNT(REPLACE(quantidade, ",", "")),0) as quantidade',
        ]);

        if ($data_inicial && $data_final) {

            $this->db->where("SUBSTR(data, 1, 10) >= '$data_inicial' AND  SUBSTR(data, 1, 10) <= '$data_final'");
        } else {
            $this->db->where("SUBSTR(data, 1, 10) >= '$data_inicial'");
        }

        return $this->db->get('materiais')->row();
    }
}