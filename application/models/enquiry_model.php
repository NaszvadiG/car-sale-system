<?php
class Enquiry_model extends CI_Model {

	public function __construct() {
		$this->load->database();
	}
	
	public function enquiries($where = array()) {
		if (count($where) > 0) {
			$this->db->where($where); 

			$this->db->join('cars', 'cars.car_id = enquiries.car_id');
			$this->db->join('car_make', 'car_make.car_make_id = cars.car_make_id');
			$this->db->join('car_model', 'car_model.car_model_id = cars.car_model_id', 'left');
			
			$query = $this->db->get('enquiries');
			
			return $query->row();
		}
		else {
			$this->db->order_by("enquiries.created_at", "desc"); 

			$this->db->join('cars', 'cars.car_id = enquiries.car_id');
			$this->db->join('car_make', 'car_make.car_make_id = cars.car_make_id');
			$this->db->join('car_model', 'car_model.car_model_id = cars.car_model_id');

			$query = $this->db->get('enquiries');
			
			return $query->result();
		}		
	}

	public function count($where = array()) {
		// Where if array count more than 0
		if (count($where) > 0) {
			$this->db->where($where); 
		}

		// Get
		$query = $this->db->get('enquiries');

		return $query->num_rows();
	}
	
	public function insert() {
		
	}
	
	public function update($where = array()) {
		
	}
	
	public function delete($where = array()) {
		
	}
}