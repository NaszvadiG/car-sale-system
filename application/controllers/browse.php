<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Browse extends CI_Controller 
{	
	public function __construct() {
		parent::__construct();
		
		$this->load->model('car_model');
		$this->load->model('user_model');
	}


	/*
	 * Browse
	 */	
	public function index()
	{
		// Site title data
		$data['title'] = 'Browse | ABC Car Fleet';
		
		
		// Blanks so that there wont be any errors 
		// if there isn't a value
		$where = array();
		
		$data['field_car_make'] = null;
		$data['field_car_model'] = null;
		$data['field_min_year'] = null;
		$data['field_max_year'] = null;
		$data['field_transmission'] = null;
		$data['field_car_body'] = null;
		$data['field_cylinders'] = null;
		$data['field_min_price'] = null;
		$data['field_max_price'] = null;
		$data['field_min_mileage'] = null;
		$data['field_max_mileage'] = null;
		$data['field_colour'] = null;
		
		
		// Filter cars
		if (isset($_POST) && $_POST) {
			if (!empty($this->input->post('car_make'))) {
				$where['cars.car_make_id'] = $this->input->post('car_make');
				$data['field_car_make'] = $this->input->post('car_make');
			}
			
			if (!empty($this->input->post('car_model'))) {
				$where['cars.car_model_id'] = $this->input->post('car_model');
				$data['field_car_model'] = $this->input->post('car_model');
			}
			
			if (!empty($this->input->post('min_year'))) {
				$where['cars.year >='] = $this->input->post('min_year');
				$data['field_min_year'] = $this->input->post('min_year');
			}
			
			if (!empty($this->input->post('max_year'))) {
				$where['cars.year <='] = $this->input->post('max_year');
				$data['field_max_year'] = $this->input->post('max_year');
			}
			
			if (!empty($this->input->post('transmission'))) {
				$where['cars.transmission'] = $this->input->post('transmission');
			}
			
			if (!empty($this->input->post('car_body'))) {
				$where['cars.car_body_id'] = $this->input->post('car_body');
			}
			
			if (!empty($this->input->post('cylinders'))) {
				$where['cars.car_cyl_id'] = $this->input->post('cylinders');
			}
			if (!empty($this->input->post('min_price'))) {
				$where['cars.price >='] = $this->input->post('min_price');
			}
			
			if (!empty($this->input->post('max_price'))) {
				$where['cars.price <='] = $this->input->post('max_price');
			}
			
			if (!empty($this->input->post('min_mileage'))) {
				$where['cars.mileage >='] = $this->input->post('min_mileage');
			}
			
			if (!empty($this->input->post('max_mileage'))) {
				$where['cars.mileage <='] = $this->input->post('max_mileage');
			}
			
			if (!empty($this->input->post('colour'))) {
				$where['cars.colour'] = $this->input->post('colour');
			}
		}
		
		
		// Model Data
		$data['car_makes'] = $this->car_model->car_makes();
		$data['car_bodies'] = $this->car_model->car_bodies();
		$data['car_cylinders'] = $this->car_model->car_cylinders();
		$data['cars'] = $this->car_model->cars($where);
		
		
		// logged user data
		$data['logged'] = $this->user_model->logged();
		
		
		$this->load->view('header', $data);
		$this->load->view('browse');
		$this->load->view('footer');
	}
	
	
	/*
	 * Result
	 */	
	public function car($car_id = 0) 
	{
		// Data
		$data['title'] = 'Car | ABC Car Fleet';
		$data['car'] = $this->car_model->cars(array('car_id' => $car_id));
		$data['car_images'] = $this->car_model->cars_images(array('cars_id' => $car_id));
		
		// logged user data
		$data['logged'] = $this->user_model->logged();
		
		$this->load->view('header', $data);
		$this->load->view('car');
		$this->load->view('footer');
	}
}
