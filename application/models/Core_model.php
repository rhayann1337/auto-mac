<?php 

defined('BASEPATH') OR exit('Ação não permitida!');

class Core_model extends CI_Model {

    public function get_all($tabela = NULL, $condicao = NULL) {

        if($tabela) {
            if(is_array($condicao)){

                $this->db->where($condicao);

            }

            return $this->db->get($tabela)->result();
        }
        else {
            return FALSE;
        }

    }

    public function get_by_id($tabela = NULL, $condicao = NULL) {

        if($tabela && is_array($condicao)) {
            $this->db->where($condicao);
            $this->db->limit(1);

            return $this->db->get($tabela)->row();
        }
        else {
            return FALSE;
        }
    }

    public function insert($tabela = NULL, $data = NULL, $get_last_id = NULL) {
        if($tabela && is_array($data)){
            $this->db->insert($tabela, $data);

            if($get_last_id){
                $this->session->set_userdata('last_id', $this->db->insert_id);
            }

            if($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('sucesso', 'Dados salvos com sucesso!');
            }
            else {
                $this->session->set_flashdata('error', 'Erro ao salvar dados no banco.');
            }
        }
        else {
            return FALSE;
        }
    }
    
    public function update($tabela = NULL, $data = NULL, $condicao = NULL) {
        if($tabela && is_array($data) && is_array($condicao)) {
            if($this->db->update($tabela, $data, $condicao)){
                $this->session->set_flashdata('sucesso', 'Sucesso ao atualizar os dados');
            }
            else{
                $this->session->set_flashdata('error', 'Erro ao atualizar os dados');
            }
        }
        else {
            return FALSE;
        }
    }

    public function delete($tabela = null, $condicao = null){

        $this->db->db_debug = false;

        if($tabela && is_array($condicao)){
            $status = $this->db->delete($tabela, $condicao);

            $error = $this->db->error();

            if(!$status){
                foreach($error as $code){
                    if($code == 1451) {
                        $this->session->set_flashdata('error', 'Está relacionado com outra tabela, não pode ser excluído.');
                    }
                }
            }else {
                $this->session->set_flashdata('sucesso', 'Registro excluído com sucesso!');
            }

            $this->db->db_debug = true;
        }
        else {
            return FALSE;
        }
    }

    public function auto_complete_buscar_materiais($busca = NULL) {
        
        if ($busca) {
            $this->db->like('nome', $busca, 'both');
            $this->db->where('quantidade >', 0);
            return $this->db->get('materiais')->result();
            
        } else {
            
            return FALSE;
        }
    }
}