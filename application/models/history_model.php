<?php
class History_model extends CI_Model 
{
	public function __construct() 
	{
		$this->load->database();
	}
	

	/*
	 * results
	 */
	public function results($where = array()) 
	{
		$this->db->order_by('history_id', 'desc');
		$this->db->limit(20);

		$this->db->join('users', 'users.user_id = history.user_id');

		$query = $this->db->get('history');
			
		return $query->result();
	}


	/*
	 * insert
	 */
	public function insert($form_data = array()) {
		$this->db->insert('history', $form_data);
	}
}
?>