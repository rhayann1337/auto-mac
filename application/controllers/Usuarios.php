<?php

defined('BASEPATH') or exit('Ação não permitida');


class Usuarios extends CI_Controller
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
            'usuarios' => $this->ion_auth->users()->result(),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('usuarios/index');
        $this->load->view('layout/footer');
    }

    public function edit($user_id = NULL)
    {

        if (!$this->ion_auth->is_admin()) {
            $this->session->set_flashdata('error', 'Apenas administradores podem editar dados dos usuários.');
            redirect('usuarios');
        }

        if (!$user_id || !$this->ion_auth->user($user_id)->row()) {
            $this->session->set_flashdata('error', 'Usuário não encontrado');
            redirect('usuarios');
        } else {

            $this->form_validation->set_rules('first_name', '', 'trim|required');
            $this->form_validation->set_rules('last_name', '', 'trim|required');
            $this->form_validation->set_rules('email', '', 'trim|required|valid_email|callback_email_check');
            $this->form_validation->set_rules('username', '', 'trim|required|callback_username_check');
            $this->form_validation->set_rules('password', 'Senha', 'min_length[5] |max_length[255]');
            $this->form_validation->set_rules('confirm_password', 'Confirme', 'matches[password]');

            if ($this->form_validation->run()) {


				$data = elements(
					array(
						'first_name',
						'last_name',
						'email',
						'username',
						'active',
						'password'
					), $this->input->post()
				);

				$data = $this->security->xss_clean($data);

				$password = $this->input->post('password');

				if (!$password) {

					unset($data['password']);
				}


				if ($this->ion_auth->update($user_id, $data)) {

					$this->session->set_flashdata('sucesso', 'Dados salvos com sucesso');
				} else {
					$this->session->set_flashdata('error', 'Erro ao salvar os dados');
				}
				redirect('usuarios');
            } else {
                $data = array(
                    'titulo' => 'Editar usuário',
                    'scripts' => array(
                        'https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js',
                        'https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js',
                        'https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js',
                        'public/vendor/mask/app.js',
                    ),
                    'usuario' => $this->ion_auth->user($user_id)->row(),

                );

                $this->load->view('layout/header', $data);
                $this->load->view('usuarios/edit');
                $this->load->view('layout/footer');
            }
        }
    }

    public function email_check($email)
    {
        $usuario_id = $this->input->post('usuario_id');

        if ($this->core_model->get_by_id('users', array('email' => $email, 'id !=' => $usuario_id))) {

            $this->form_validation->set_message('email_check', 'Esse e-mail ja existe');

            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function username_check($username)
    {
        $usuario_id = $this->input->post('usuario_id');

        if ($this->core_model->get_by_id('users', array('username' => $username, 'id !=' => $usuario_id))) {

            $this->form_validation->set_message('username_check', 'Esse usuário ja existe');

            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function add()
	{

        if (!$this->ion_auth->is_admin()) {
            $this->session->set_flashdata('error', 'Apenas administradores podem cadastrar novos usuários.');
            redirect('usuarios');
        }

		$this->form_validation->set_rules('first_name', '', 'trim|required');
		$this->form_validation->set_rules('last_name', '', 'trim|required');
		$this->form_validation->set_rules('email', '', 'trim|required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('username', '', 'trim|required|is_unique[users.username]');
		$this->form_validation->set_rules('password', 'Senha', 'required|min_length[5] |max_length[255]');
		$this->form_validation->set_rules('confirm_password', 'Confirme', 'matches[password]');

		if ($this->form_validation->run()) {

			$username = $this->security->xss_clean($this->input->post('username'));
			$password = $this->security->xss_clean($this->input->post('password'));
			$email = $this->security->xss_clean($this->input->post('email'));
			$additional_data = array(
				'first_name' => $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name'),
				'username' => $this->input->post('username'),
				'active' => $this->input->post('active'),
			);
			$additional_data = $this->security->xss_clean($additional_data);

			if ($this->ion_auth->register($username, $password, $email, $additional_data)) {

				$this->session->set_flashdata('sucesso', 'Dados salvos com sucesso');

			} else {
				$this->session->set_flashdata('error', 'Erro ao salvar os dados');
			}

			redirect('usuarios');

		} else {

			$data = array(
				'titulo' => 'Cadastrar usuário',
                'scripts' => array(
                    'https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js',
                    'https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js',
                    'https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js',
                    'public/vendor/mask/app.js',
                ),
			);

			$this->load->view('layout/header', $data);
			$this->load->view('usuarios/add');
			$this->load->view('layout/footer');

		}

	}

    public function del($user_id = NULL)
    {

        if (!$this->ion_auth->is_admin()) {
            $this->session->set_flashdata('error', 'Apenas administradores podem deletar usuários.');
            redirect('usuarios');
        }

        if (!$user_id || !$this->ion_auth->user($user_id)->row()) {
            $this->session->set_flashdata('error', 'Usuário não encontrado');
            redirect('usuarios');
        }

        if ($this->ion_auth->is_admin($user_id)) {
            $this->session->set_flashdata('error', 'O administrador não pode ser excluído');
            redirect('usuarios');
        }

        if ($this->ion_auth->delete_user($user_id)) {
            $this->session->set_flashdata('sucesso', 'Usuário excluído com sucesso');
            redirect('usuarios');
        } else {
            $this->session->set_flashdata('error', 'Usuário não pode ser excluído');
            redirect('usuarios');
        }
    }
}
