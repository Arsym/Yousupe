<?php 

 class Playlist extends CI_Controller {
 	public function __construct() {
 		parent::__construct();
 		$this->load->model('Channel_model', 'model');
 	}

 	public function index() {
 		$data['header'] = 'Yousupe';
 		$data['keyword'] = $this->model->findChannel();

 		$this->load->view('templates/header', $data);
 		$this->load->view('playlist/index', $data);
 	}
 	public function item($id) {
 		$data['header'] = 'Yousupe';
 		$data['id'] = $id;

 		$this->load->view('templates/header', $data);
 		$this->load->view('playlist/item', $data);
 		$this->load->view('templates/footer');
 	}
 }