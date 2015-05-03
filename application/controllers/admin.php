<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class admin extends CI_Controller 
{
	// Upload path (images)
	private $upload_path = './assets/uploads/';
	
	
	/*
	 * __construct
	 */
	public function __construct() 
	{
		parent::__construct();
		

		// load models for methods
		$this->load->model('car_model');
		$this->load->model('user_model');
		$this->load->model('enquiry_model');
		$this->load->model('order_model');
		$this->load->model('history_model');

		
		// If user isnt logged in, redirect to main page
		$logged = $this->user_model->logged();
		
		if ($logged == false || $logged->role_id > 2) {
			redirect(base_url(), 'location');
		}
	}

	
	/*
	 * Dashboard
	 */
	public function index()
	{
		// Logged user
		$data['logged'] = $this->user_model->logged();


		// Passed data
		$data['title'] = 'Dashboard';
		$data['breadcrumb'] = array(
			'Dashboard' => base_url('admin')
		);

		$data['date_before'] = '';
		$where = array('created_at >' => date('Y-m-d'));

		$post_date = 0;


		// Dated results
		if (isset($_POST) && $_POST) {
			$post_date  = trim(htmlspecialchars($this->input->post('date')));
			$set_day    = ($post_date > 0) ? '-'.$post_date.' days' : 0;
			$date_today = date('Y-m-d');

			if ($set_day == 0) {
				$date_before = $date_today;
			} 
			else {
				$date_before = date('Y-m-d', strtotime($set_day, strtotime($date_today)));
			}

			$where = array('created_at >' => $date_before);

			$data['date_before'] = date('d, M Y', strtotime($date_before));
		}


		// Drop down pass to view
		$date_options = array(
                  '0' => 'Today',
                  '1' => '1 day',
                  '2' => '2 days',
                  '3' => '3 days',
                  '4' => '4 days',
                  '5' => '5 days',
                  '6' => '6 days',
                  '6' => '7 days',
                );

		$data['date_select'] = form_dropdown('date', $date_options, $post_date, 'class="form-control"');


		// Results
		$data['total_enquiry_rows'] = $this->enquiry_model->count($where);
		$data['total_order_rows'] = $this->order_model->count($where);
		$data['total_user_rows'] = $this->user_model->count($where);
		$data['total_car_rows'] = $this->car_model->count($where);
		$data['history'] = $this->history_model->results();
		
		$this->load->view('admin/header', $data);
		$this->load->view('admin/dashboard', $data);
		$this->load->view('admin/footer', $data);
	}
	

	/*
	 * Cars
	 */
	public function cars() 
	{
		// Logged user
		$data['logged'] = $this->user_model->logged();


		// Passed data
		$data['title'] = 'Cars';
		$data['breadcrumb'] = array(
			'Dashboard' => base_url('admin'),
			'Cars'      => base_url('admin/cars'),
			);
		$data['total_rows'] = $this->car_model->count();


		// Pagination
		$page     = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$per_page = 10;

		$config['base_url']    = base_url('admin/cars');
		$config['total_rows']  = $data['total_rows'];
		$config['per_page']    = $per_page; 
		$config['uri_segment'] = 3; 

		$this->pagination->initialize($config); 

		$data['links'] = $this->pagination->create_links();	

		$this->db->limit($per_page, $page);

			
		// Queries
		$data['cars'] = $this->car_model->cars(array(), array());


		// Views	
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/car_manage', $data);		
		$this->load->view('admin/footer', $data);		
	}
	
	
	/*
	 * Add or edit car
	 */
	public function car_form($car_id = 0) 
	{
		// Created at
		$created_at = date('Y-m-d H:i:s');

		// Logged user
		$data['logged'] = $this->user_model->logged();

		// Data
		$data['title'] = 'Cars';
		$data['car'] = array();
		$data['car_images'] = array();
		
		$data['transmission'] = array_merge(
			array('0" disabled selected style="display: none;' => 'Select transmission'), 
			$this->car_model->transmission
			);


		// Pass form message
		$data['form_message'] = null;
			
			
		// Table data
		$data['car_makes'] = $this->car_model->car_makes(array(), true);
		$data['car_models'] = $this->car_model->car_models();
		$data['car_bodies'] = $this->car_model->car_bodies(array(), true);
		$data['car_cylinders'] = $this->car_model->car_cylinders(array(), true);
		
		
		// Post
		if (isset($_POST) && $_POST)
		{		
			// Form data
			$form_data = array(
				'title'        => $this->input->post('title'),
				'description'  => htmlspecialchars($this->input->post('description')),
				'car_make_id'  => $this->input->post('car_make'),
				'car_model_id' => $this->input->post('car_model'),
				'car_body_id'  => $this->input->post('car_body'),
				'car_cyl_id'   => $this->input->post('car_cyl'),
				'transmission' => $this->input->post('transmission'),
				'mileage'      => $this->input->post('mileage'),
				'price'        => $this->input->post('price'),
				'year'         => $this->input->post('year'),
				'condition'    => $this->input->post('condition'),
				'colour'       => $this->input->post('colour'),
				'created_at'   => $created_at,
			);
			
			
			// Insert and get new id or update data
			if ($car_id > 0) {
				$this->db->where('car_id', $car_id);
				$this->db->update('cars', $form_data);


				// History insert
				$history_data = array(
					'user_id' => $data['logged']->user_id, 
					'history_action' => 'Updated car #'.$car_id,
					'created_at' => $created_at);

				$this->history_model->insert($history_data);


				// Form message
				$data['form_message'] = 'Information successfully updated.';
			} 
			else {
				$this->car_model->insert_car($form_data);
				
				$car_id = $this->db->insert_id();


				// History insert
				$history_data = array(
					'user_id' => $data['logged']->user_id, 
					'history_action' => 'Added car #'.$car_id,
					'created_at' => $created_at);

				$this->history_model->insert($history_data);


				// Form message
				$data['form_message'] = 'Information successfully added.';
			}
			
			
			// Image upload
			$config['upload_path'] = $this->upload_path;
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '0';

			$this->load->library('upload', $config);			
			
			for ($i = 1; $i <= 3; $i++) 
			{
				$field_name = 'image_'.$i;

				// do upload
				if($this->upload->do_upload($field_name))
				{		
					$upload_data = $this->upload->data();
					
					// manipulate image 
					$config['source_image']	= $this->upload_path.$upload_data['file_name'];
					$config['width']  = 470;
					$config['height'] = 310;
					$config['maintain_ratio'] = true;
					
					$this->load->library('image_lib', $config);
					
					
					// If image is larger than width or height, then resize
					if ($upload_data['image_width'] > 470 || $upload_data['image_height'] > 310) 
					{
						$this->image_lib->resize();
					}
					

					// insert data in table
					$table_data = array(
						'cars_id' => $car_id, 
						'file'    => $upload_data['file_name']
					);
					
					$this->db->insert('cars_images', $table_data); 

					$this->image_lib->clear();
				}
			}
		}


		// Added or updating
		if($car_id > 0) {
			$data['breadcrumb'] = array(
				'Dashboard' => base_url('admin'),
				'Cars'      => base_url('admin/cars'),
				'Edit Car'   => base_url('admin/car/'.$car_id),
				);
				
				$data['car'] = $this->car_model->cars(array('car_id' => $car_id));
				$data['car_images'] = $this->car_model->cars_images(array('cars_id' => $car_id));
		} else {
			$data['breadcrumb'] = array(
				'Dashboard' => base_url('admin'),
				'Cars'      => base_url('admin/cars'),
				'Add Car'   => base_url('admin/add_car'),
				);
		}


		// Views
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/car_form', $data);		
		$this->load->view('admin/footer', $data);		
	}
	
	
	/*
	 * remove car
	 */
	public function remove_car($id) 
	{
		// Created at
		$created_at = date('Y-m-d H:i:s');

		// Logged user
		$data['logged'] = $this->user_model->logged();


		// Car
		$id = trim(htmlspecialchars($id));
		$table = 'cars';
		$where = array('car_id' => $id);
		
		$this->db->from($table)->where($where)->limit(1);
		
		$query = $this->db->get();

		
		// If record exists, then delete
		if ($query->num_rows() > 0) {
			// remove car
			$this->db->delete($table, $where);
			
			// remove car's images
			$this->db->delete('cars_images', array('cars_id' => $id));

			// History insert
			$history_data = array(
				'user_id'        => $data['logged']->user_id, 
				'history_action' => 'Removed car #'.$id,
				'created_at'     => $created_at);

			$this->history_model->insert($history_data);
		}
		
		redirect('admin/cars', 'location');
	}
	
	
	/*
	 * Get models
	 */
	public function get_models($make_id = 0) 
	{
		$models = (array)$this->car_model->car_models($make_id);
			
		echo json_encode($models);
	}
	

	/*
	 * Remove image
	 */
	public function remove_image($image_id = 0) 
	{
		// Image
		$image_id = trim(htmlspecialchars($image_id));
		
		$table = 'cars_images';
		$where = array('cars_images_id' => $image_id);
		
		$this->db->from($table)->where($where)->limit(1);
		
		$query = $this->db->get();
		$row   = $query->row();
		$image = $this->upload_path.$row->file;
		
		// If row exists and user is logged in, then perform action
		// Otherwise send response 'false'
		if ($query->num_rows() > 0) {
			if($this->db->delete($table, $where)) {
				unlink($image);
				
				echo json_encode(array('response' => 'true'));
			} 
		} 
		else {
			echo json_encode(array('response' => 'false'));
		}
	}
	
	
	/*
	 * Users
	 */
	public function users() 
	{
		// Logged user
		$data['logged'] = $this->user_model->logged();


		// Passed data
		$data['title'] = 'Users';
		$data['breadcrumb'] = array(
			'Dashboard' => base_url('admin'),
			'Users'      => base_url('admin/users'),
			);
		$data['total_rows'] = $this->user_model->count();
			
		// Queries
		$data['users'] = $this->user_model->users();
		
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/user_manage', $data);		
		$this->load->view('admin/footer', $data);	
	}
	
	
	/*
	 * Users form (for adding or editing)
	 */
	public function user_form($user_id = 0) 
	{
		// Created at
		$created_at = date('Y-m-d H:i:s');

		// Logged user
		$data['logged'] = $this->user_model->logged();


		// Data
		$data['title'] = 'Add User';
		$data['roles'] = $this->user_model->user_roles();
		$data['is_user'] = ($user_id > 0) ? true : false;
		$data['user'] = array();

		$data['form_message'] = null;


		// Drop down pass to view
		$role_options = $this->user_model->user_roles(true);


		// If post, process data
		if (isset($_POST) && $_POST) 
		{
			// Form data
			$password = trim(htmlspecialchars($this->input->post('password')));
			$date = date('Y-m-d H:i:s');

			$form_data = array(
				'email'        => trim(htmlspecialchars($this->input->post('email'))),
				'password'     => password_hash($password, PASSWORD_BCRYPT),
				'role_id'      => trim(htmlspecialchars($this->input->post('role_id'))),
				'created_at'   => $date
			);
			
			// insert or update
			if ($user_id > 0) 
			{
				$data['form_message'] = 'Information successfully updated.';

				$profile_data = array(
					'first_name' => trim(htmlspecialchars($this->input->post('first_name'))),
					'last_name'  => trim(htmlspecialchars($this->input->post('last_name'))),
					'phone'      => trim(htmlspecialchars($this->input->post('phone'))),
					'mobile_no'  => trim(htmlspecialchars($this->input->post('mobile_no'))),
					'unit_no'    => trim(htmlspecialchars($this->input->post('unit_no'))),
					'street_no'  => trim(htmlspecialchars($this->input->post('street_no'))),
					'address'    => trim(htmlspecialchars($this->input->post('address'))),
					'city'       => trim(htmlspecialchars($this->input->post('city'))),
					'state'      => trim(htmlspecialchars($this->input->post('state'))),
					'postcode'   => trim(htmlspecialchars($this->input->post('postcode'))),
				);

				$this->user_model->update_profile(array('user_id' => $user_id), $profile_data);

				// History insert
				$history_data = array(
					'user_id'        => $data['logged']->user_id, 
					'history_action' => 'Updated user #'.$user_id,
					'created_at'     => $created_at);

				$this->history_model->insert($history_data);
			} 
			else {
				$data['form_message'] = 'Information successfully added.';

				$this->user_model->insert($form_data);

				$user_id = $this->db->insert_id();

				// History insert
				$history_data = array(
					'user_id'        => $data['logged']->user_id, 
					'history_action' => 'Added user #'.$user_id,
					'created_at'     => $created_at);

				$this->history_model->insert($history_data);
			}
		}


		// Show form
		if ($user_id > 0) {
			$data['title'] = 'Edit User';
			
			$data['breadcrumb'] = array(
				'Dashboard' => base_url('admin'),
				'Users'     => base_url('admin/users'),
				'Edit User' => base_url('admin/user/'.$user_id),
				);		

			$data['user'] = $this->user_model->users(array('users.user_id' => $user_id));


			// redirect user if user is lower than user being modified
			if ($data['user']->role_id < $data['logged']->role_id) {
				redirect('admin/restricted', 'location');
			}


			// role select
			if ($this->user_model->is_role(1)) {
				$data['role_select'] = form_dropdown('role_id', $role_options, $data['user']->role_id, 'class="form-control"');
			} else {
				unset($role_options[1]);

				$data['role_select'] = form_dropdown('role_id', $role_options, $data['user']->role_id, 'class="form-control"');
			}
		}
		else {
			$data['breadcrumb'] = array(
				'Dashboard' => base_url('admin'),
				'Users'     => base_url('admin/users'),
				'Add User'  => base_url('admin/add_user'),
				);	


			// role select
			if ($this->user_model->is_role(1)) {
				$data['role_select'] = form_dropdown('role_id', $role_options, '', 'class="form-control"');
			} else {
				unset($role_options[1]);

				$data['role_select'] = form_dropdown('role_id', $role_options, '', 'class="form-control"');
			}
		}


		// Views
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/user_form', $data);		
		$this->load->view('admin/footer', $data);
	}


	/*
	 * remove user
	 */
	public function remove_user($id) 
	{
		// Created at
		$created_at = date('Y-m-d H:i:s');

		// Logged user
		$data['logged'] = $this->user_model->logged();

		if ($this->user_model->is_role(1) == false) {
			redirect('admin/restricted', 'location');
		}


		// Table data
		$id    = trim(htmlspecialchars($id));
		$table = 'users';
		$where = array('user_id' => $id);
		
		$this->db->from($table)->where($where)->limit(1);
		$query = $this->db->get();
		

		// Check if record exists and remove
		if ($query->num_rows() > 0) {
			$this->db->delete($table, $where);
			$this->db->delete('user_profile', $where);


			// History insert
			$history_data = array(
				'user_id'        => $data['logged']->user_id, 
				'history_action' => 'Removed user #'.$id,
				'created_at'     => $created_at);

			$this->history_model->insert($history_data);
		}
		
		redirect('admin/users', 'location');
	}
	
	
	/*
	 * Enquiries
	 */
	public function enquiries() 
	{
		// Logged user
		$data['logged'] = $this->user_model->logged();


		// Passed data
		$data['title'] = 'Users';
		$data['breadcrumb'] = array(
			'Dashboard' => base_url('admin'),
			'Enquiries'      => base_url('admin/enquiries'),
			);
		$data['total_rows'] = $this->enquiry_model->count();


		// Queries
		$data['enquiries'] = $this->enquiry_model->enquiries();
		
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/enquiry_manage', $data);		
		$this->load->view('admin/footer', $data);	
	}


	/*
	 * Enquiry
	 */
	public function enquiry($enquiry_id = 0) 
	{
		// Logged user
		$data['logged'] = $this->user_model->logged();


		// Passed data
		$data['title'] = 'enquiry';
		$data['breadcrumb'] = array(
			'Dashboard'  => base_url('admin'),
			'Enquiries'  => base_url('admin/enquiries'),
			'Enquiry #'.$enquiry_id => base_url('admin/enquiry/'.$enquiry_id),
			);
			
		// Queries
		$data['enquiry'] = $this->enquiry_model->enquiries(array('enquiry_id' => $enquiry_id));
		
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/enquiry_form', $data);
		$this->load->view('admin/footer', $data);	
	}


	/*
	 * remove enquiry
	 */
	public function remove_enquiry($id) 
	{
		// Created at
		$created_at = date('Y-m-d H:i:s');
		
		// Logged user
		$data['logged'] = $this->user_model->logged();

		
		// Table data
		$id    = trim(htmlspecialchars($id));
		$table = 'enquiries';
		$where = array('enquiry_id' => $id);
		
		$this->db->from($table)->where($where)->limit(1);
		$query = $this->db->get();
		

		// Check if record exists and remove
		if ($query->num_rows() > 0) {
			$this->db->delete($table, $where);

			// History insert
			$history_data = array(
				'user_id'        => $data['logged']->user_id, 
				'history_action' => 'Removed enquiry #'.$id,
				'created_at'     => $created_at);

			$this->history_model->insert($history_data);
		}
		
		redirect('admin/enquiries', 'location');
	}
	
	
	/*
	 * Orders
	 */
	public function orders() 
	{
		// Logged user
		$data['logged'] = $this->user_model->logged();


		// Passed data
		$data['title'] = 'Orders';
		$data['breadcrumb'] = array(
			'Dashboard' => base_url('admin'),
			'Orders'    => base_url('admin/orders'),
			);
		$data['total_rows'] = $this->order_model->count();
			

		// Table data
		$data['orders'] = $this->order_model->orders();
		

		// Views
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/order_manage', $data);		
		$this->load->view('admin/footer', $data);	
	}


	/*
	 * Order
	 */
	public function order($order_id = 0) 
	{
		// Created at
		$created_at = date('Y-m-d H:i:s');

		// Logged user
		$data['logged'] = $this->user_model->logged();


		// Passed data
		$data['title'] = 'Order';
		$data['breadcrumb'] = array(
			'Dashboard' => base_url('admin'),
			'Orders'    => base_url('admin/orders'),
			'Order #'.$order_id => base_url('admin/order/'.$order_id),
			);

		$data['form_message'] = null;


		// Update
		if (isset($_POST) && $_POST) {
			$first_name = $this->input->post('first_name');
			$last_name  = $this->input->post('last_name');
			$phone      = $this->input->post('phone');
			$mobile_no  = $this->input->post('mobile_no');
			$email      = $this->input->post('email');
			$unit_no    = $this->input->post('unit_no');
			$street_no  = $this->input->post('street_no');
			$address    = $this->input->post('address');
			$city       = $this->input->post('city');
			$state      = $this->input->post('state');
			$postcode   = $this->input->post('postcode');

			$form_data = array(
				'first_name' => $first_name,
				'last_name'  => $last_name,
				'phone'      => $phone,
				'mobile_no'  => $mobile_no,
				'email'      => $email,
				'unit_no'    => $unit_no,
				'street_no'  => $street_no,
				'address'    => $address,
				'city'       => $city,
				'state'      => $state,
				'postcode'   => $postcode
				);

			$this->order_model->update(array('order_id' => $order_id), $form_data);


			// History insert
			$history_data = array(
				'user_id'        => $data['logged']->user_id, 
				'history_action' => 'Updated order #'.$order_id,
				'created_at'     => $created_at);

			$this->history_model->insert($history_data);


			// pass message
			$data['form_message'] = 'Information successfully updated.';
		}


		// Table data
		$data['order'] = $this->order_model->orders(array('order_id' => $order_id));
		$data['car']   = $this->car_model->cars(array('car_id' => $data['order']->car_id));


		// Views
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/order_form', $data);		
		$this->load->view('admin/footer', $data);	
	}


	/*
	 * remove order
	 */
	public function remove_order($id) 
	{
		// Created at
		$created_at = date('Y-m-d H:i:s');
		
		// Logged user
		$data['logged'] = $this->user_model->logged();
		
		// Table data
		$id    = trim(htmlspecialchars($id));
		$table = 'orders';
		$where = array('order_id' => $id);
		
		$this->db->from($table)->where($where)->limit(1);
		$query = $this->db->get();
		
		// Check if record exists and remove
		if ($query->num_rows() > 0) {
			$this->db->delete($table, $where);


			// History insert
			$history_data = array(
				'user_id'        => $data['logged']->user_id, 
				'history_action' => 'Removed order #'.$id,
				'created_at'     => $created_at);

			$this->history_model->insert($history_data);
		}
		
		redirect('admin/orders', 'location');
	}


	/*
	 * Restricted
	 */
	public function restricted() 
	{
		// Logged user
		$data['logged'] = $this->user_model->logged();

		$data['breadcrumb'] = array(
			'Dashboard' => base_url('admin'),
			'Restricted'    => base_url('admin/restricted'),
			);


		// Views
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/restricted', $data);		
		$this->load->view('admin/footer', $data);	
	}
}
