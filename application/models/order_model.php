<?php
class Order_model extends CI_Model {

	public function __construct() {
		$this->load->database();
	}
	

	/*
	 * Results
	 */
	public function orders($where = array()) {
		if (count($where) > 0) {
			$this->db->where($where); 

			$this->db->join('cars', 'cars.car_id = orders.car_id');
			$this->db->join('car_make', 'car_make.car_make_id = cars.car_make_id');
			$this->db->join('car_model', 'car_model.car_model_id = cars.car_model_id', 'left');
			$this->db->join('car_body', 'car_body.car_body_id = cars.car_body_id', 'left');
			$this->db->join('car_cylinders', 'car_cylinders.car_cyl_id = cars.car_cyl_id','left');
			
			$query = $this->db->get('orders');
			
			return $query->row();
		}
		else {
			$this->db->order_by("orders.created_at", "desc"); 

			$this->db->join('cars', 'cars.car_id = orders.car_id');
			$this->db->join('car_make', 'car_make.car_make_id = cars.car_make_id');
			$this->db->join('car_model', 'car_model.car_model_id = cars.car_model_id', 'left');
			$this->db->join('car_body', 'car_body.car_body_id = cars.car_body_id', 'left');
			$this->db->join('car_cylinders', 'car_cylinders.car_cyl_id = cars.car_cyl_id','left');

			$query = $this->db->get('orders');
			
			return $query->result();
		}		
	}


	/*
	 * Count rows
	 */
	public function count($where = array()) {
		// Where if array count more than 0
		if (count($where) > 0) {
			$this->db->where($where); 
		}

		// Get
		$query = $this->db->get('orders');

		return $query->num_rows();
	}
	

	/*
	 * Insert
	 */
	public function insert() {
		
	}
	

	/*
	 * Update
	 */
	public function update($where = array(), $form_data = array()) {
		$this->db->where($where);
		$this->db->update('orders', $form_data);
	}
	

	/*
	 * Delete
	 */
	public function delete($where = array()) {
		
	}
}