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
		// Passed data
		$data['title'] = 'Browse | ABC Car Fleet';
		
		// Blanks so that there wont be any errors 
		// if there isn't a value
		$get      = array();
		$where    = array();
		$min_year = null;
		$get_uri  = null;

		$specs = array(
			'car_make_id'  => 'car_make_id',
			'car_model_id' => 'car_model_id',
			'car_body_id'  => 'car_body_id',
			'car_cyl_id'   => 'car_cyl_id',
			'transmission' => 'transmission',
			'min_mileage'  => 'mileage >=',
			'max_mileage'  => 'mileage <=',
			'min_price'    => 'price >=',
			'max_price'    => 'price <=',
			'min_year'     => 'year >=',
			'max_year'     => 'year <=',
			'colour'       => 'colour'
			);

		// blank pass data
		foreach ($specs as $key => $val) {
			$data[$key] = null;
		}


		// Get
		foreach ($specs as $key => $val) 
		{
			if (!empty($this->input->get($key))) 
			{
				$where['cars.'.$val] = $this->input->get($key);

				$data[$key] = $this->input->get($key);
			}
		}


		// Post	
		if (isset($_POST) && $_POST) 
		{
			foreach ($specs as $key => $val) 
			{
				if (!empty($this->input->post($key))) {
					$get[$key] = $this->input->post($key);
				}
			}


			$count = 1;

			foreach ($get as $key => $val) {
				if ($count == 1) {
					$get_uri .= '?'.$key.'='.$val;
				} else {
					$get_uri .= '&'.$key.'='.$val;
				}

				$count++;
			}

			redirect(base_url('browse').$get_uri, 'location');
		}
		
		
		// Model Data
		$data['car_makes']     = $this->car_model->car_makes();
		$data['car_bodies']    = $this->car_model->car_bodies();
		$data['car_cylinders'] = $this->car_model->car_cylinders();
		$data['cars']          = $this->car_model->cars($where);


		// car make dropdown
		$make_options['" disabled selected style="display: none;'] = 'Select make';
		$make_options['0'] = 'All makes';

		foreach($data['car_makes'] as $make) {
			$make_options[$make->car_make_id] = $make->make_name;
		}

		$data['select_make'] = form_dropdown('car_make_id', $make_options, $data['car_make_id'], 'class="form-control" id="car_make"');


		// cyl dropdown
		$cylinder_options['" disabled selected style="display: none;'] = 'Cylinders';
		$cylinder_options['0'] = 'All cylinders';

		foreach($data['car_cylinders'] as $cyl) {
			$cylinder_options[$cyl->car_cyl_id] = $cyl->cylinders;
		}

		$data['select_cylinders'] = form_dropdown('car_cyl_id', $cylinder_options, $data['car_cyl_id'], 'class="form-control"');


		// body dropdown
		$body_options['" disabled selected style="display: none;'] = 'Body type';
		$body_options['0'] = 'All body types';

		foreach($data['car_bodies'] as $body) {
			$body_options[$body->car_body_id] = $body->body_name;
		}

		$data['select_bodies'] = form_dropdown('car_body_id', $body_options, $data['car_body_id'], 'class="form-control"');


		// transmission dropdown
		$option_transmission = array(
			'" disabled selected style="display: none;' => 'Transmission',
			'0'         => 'All transmissions',
			'automatic' => 'Automatic',
			'manual'    => 'Manual',
			);

		$data['select_transmission'] = form_dropdown('transmission', $option_transmission, $data['transmission'], 'class="form-control"');
		
		
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
