<?php
class Car_model extends CI_Model {
	
	public $transmission = array(
		'automatic' => 'Automatic',
		'manual' => 'Manual');
		

	public function __construct()
	{
		$this->load->database();
	}
	
	public function car_makes($where = array(), $form_data = false) {
		$this->db->select('car_make.car_make_id, car_make.make_name, count(cars.car_id) AS count');
		$this->db->join('cars', 'cars.car_make_id = car_make.car_make_id', 'left');
		$this->db->order_by('car_make.make_name', 'asc');
		$this->db->group_by('car_make.make_name');
		
		$query = $this->db->get('car_make');
		
		$dropdown = array();
		
		if ($form_data == true) {
			$dropdown['0" disabled selected style="display: none;'] = 'Select make';
			
			foreach ($query->result() as $row) {
				$dropdown[$row->car_make_id] = $row->make_name;
			}
			
			return $dropdown;
		} else {
			return $query->result();
		}
	}
	
	public function car_models($car_make = 0) {
		$this->db->select('car_model.car_model_id, car_model.model_name, count(cars.car_id) AS count');
		$this->db->join('cars', 'cars.car_model_id = car_model.car_model_id', 'left');
		$this->db->group_by('car_model.model_name');

		if ($car_make > 0) {
			$this->db->where('car_model.car_make_id', $car_make); 
		}
		
		$this->db->order_by('car_model.model_name', 'asc');
		
		$query = $this->db->get('car_model');
		
		return $query->result();
	}
	
	public function car_bodies($where = array(), $form_data = false) {
		$this->db->order_by('body_name', 'asc');
		
		$query = $this->db->get('car_body');
		
		$dropdown = array();
		
		if ($form_data == true) {
			$dropdown['0" disabled selected style="display: none;'] = 'Select body type';
			
			foreach ($query->result() as $row) {
				$dropdown[$row->car_body_id] = $row->body_name;
			}
			
			return $dropdown;
		} else {
			return $query->result();
		}
	}
	
	public function car_cylinders($where = array(), $form_data = false) {
		$query = $this->db->get('car_cylinders');
		
		$dropdown = array();
		
		if ($form_data == true) {
			$dropdown['0" disabled selected style="display: none;'] = 'Select cylinders';
			
			foreach ($query->result() as $row) {
				$dropdown[$row->car_cyl_id] = $row->cylinders;
			}
			
			return $dropdown;
		} else {
			return $query->result();
		}
	}

	public function count($where = array()) {
		// Where if array count more than 0
		if (count($where) > 0) {
			$this->db->where($where); 
		}

		// Get
		$query = $this->db->get('cars');

		return $query->num_rows();
	}
	
	public function cars($where = array(), $data_type = null) {
		$this->db->join('car_make', 'car_make.car_make_id = cars.car_make_id');
		$this->db->join('car_model', 'car_model.car_model_id = cars.car_model_id', 'left');
		$this->db->join('car_body', 'car_body.car_body_id = cars.car_body_id', 'left');
		$this->db->join('car_cylinders', 'car_cylinders.car_cyl_id = cars.car_cyl_id','left');
		$this->db->join('cars_images', 'cars_images.cars_id = cars.car_id', 'left');
		
		
		if (isset($where) && array_key_exists('car_id', $where)) {
			$this->db->where($where); 
			$this->db->group_by("cars.car_id"); 
			
			$query = $this->db->get('cars');
			
			return ($data_type == 'array') ? $query->row_array() : $query->row();
		}
		else {
			if (isset($where) && count($where) > 0) {
				$this->db->where($where); 
			}
			
			$this->db->group_by("cars.car_id"); 
			
			$query = $this->db->get('cars');
			
			return $query->result();
		}
	}
	
	public function cars_images($where = array(), $data_type = null) {
		$this->db->where($where);
		
		$query = $this->db->get('cars_images');
		
		return ($data_type == 'array') ? $query->result_array() : $query->result();		
	}
	
	public function car_transmissions() {
		$transmissions = array(
			'Automatic' => 'automatic',
			'Manual'    => 'manual'
		);
		
		return $transmissions;
	}
	
	public function insert_car($data) {
		$this->db->insert('cars', $data); 
		
		return true;
	}
	
	public function update_car($car_id = 0) {
		
	}
	
	public function delete_car($car_id = 0) {
		
	}
}