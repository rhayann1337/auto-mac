<?php

defined('BASEPATH') or exit('Ação não permitida!');

class Home_model extends CI_Model {

    public function get_sum_valor_servicos() {
        $this->db->select([
            'FORMAT(SUM(REPLACE(preco, ",", "")),2) as preco',
        ]);

        return $this->db->get('servicos')->row();
    }

    public function contar_quantidade_servicos() {
        $this->db->select([
            'FORMAT(COUNT(REPLACE(id, ",", "")),0) as id',
        ]);
        
        return $this->db->get('servicos')->row();
    }

    public function contar_quantidade_orcamentos() {
        $this->db->select([
            'FORMAT(COUNT(REPLACE(id, ",", "")),0) as id',
        ]);
        
        return $this->db->get('orcamentos')->row();
    }

    public function contar_quantidade_clientes() {
        $this->db->select([
            'FORMAT(COUNT(REPLACE(id, ",", "")),0) as id',
        ]);
        
        return $this->db->get('clientes')->row();
    }

    public function contar_quantidade_de_produtos() {
        $this->db->select('(SELECT nome_material FROM materiais WHERE nome_material = "teste")', FALSE);
        
        return $this->db->get('materiais')->row();
    }


}