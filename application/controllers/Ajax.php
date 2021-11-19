<?php

defined('BASEPATH') OR exit('Ação não permitida!');

class Ajax extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sua sessão expirou!');
            redirect('login');
        }
    }

    public function index() {
        redirect('/');
    }

    public function materiais() {
        if (!$this->input->is_ajax_request()) {
            exit('Ação não permitida');
        } else {
            $busca = $this->input->post('term');

            $data['response'] = 'false';

            $query = $this->core_model->auto_complete_buscar_materiais($busca);

            if ($query) {
                $data['response'] = 'true';
                $data['message'] = array();

                foreach ($query as $row) {

                    $data['message'][] = array(
                        'id' => $row->id,
                        'value' => $row->nome_material,
                        'quantidade' => $row->quantidade,
                        'valor' => $row->valor,
                    );
                }

                echo json_encode($data);
            } else {
                echo json_encode($data);
            }
        }
    }

}