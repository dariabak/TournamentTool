<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule_Controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Schedule_Model');
			$this->load->helper('url');
	}
	public function index()
	{  
		foreach($this->input->post() as $key => $value){
			     
			$scheduleData[$key] = $value; 
		}
		
		$data['schedule'] = $this->Schedule_Model->createSchedule($scheduleData);
		$this->load->view('schedule', $data);
	}

}