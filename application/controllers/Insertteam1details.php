<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Insertteam1details extends CI_Controller {



	public function __construct()
	{
		parent::__construct();
		$this->load->model('Insertteam1details_model');
			$this->load->helper('url');
	}
	public function index()
	{

		$this->load->view('insertteam1details');
	}

}
