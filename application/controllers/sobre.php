<?php

defined('BASEPATH') OR exit('Não é permitido.');

class Sobre extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('aboutUs/index');
	}
}
