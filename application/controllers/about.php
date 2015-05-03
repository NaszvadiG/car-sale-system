<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class About extends CI_Controller 
{	
	public function __construct() {
		parent::__construct();
		
		$this->load->model('car_model');
		$this->load->model('user_model');
	}


	/*
	 * Home
	 */	
	public function index()
	{
		// Data
		$data['title'] = 'About us | ABC Car Fleet';
		
		// logged user data
		$data['logged'] = $this->user_model->logged();
		
		$this->load->view('header', $data);
		$this->load->view('about');
		$this->load->view('footer');
	}
}
