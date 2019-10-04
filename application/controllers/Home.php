<?php 

 class Home extends CI_Controller {
 	public function __construct() {
 		parent::__construct();
 		$this->load->model('Channel_model', 'model');
 	}

 	public function index() {
 		$data['header'] = 'Yousupe';
 		$data['keyword'] = $this->model->findChannel();

 		$this->load->view('templates/header', $data);
 		$this->load->view('home/index', $data);
 		$this->load->view('templates/footer');
 	}
 }