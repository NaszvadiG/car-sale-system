<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller 
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
		$data['title'] = 'ABC Car Fleet';
		
		$data['car_makes'] = $this->car_model->car_makes();
		$data['cars'] = $this->car_model->cars();
		
		// logged user data
		$data['logged'] = $this->user_model->logged();
		
		$this->load->view('header', $data);
		$this->load->view('home');
		$this->load->view('footer');
	}
	
	
	/*
	 * Log in
	 */	
	public function login()
	{
		// Data
		$data['title'] = 'Log In | ABC Car Fleet';
		
		// logged user data
		$data['logged'] = $this->user_model->logged();
		
		if($_POST) {
			$email = $this->input->post('email');
			$pass  = $this->input->post('password');
			$pass2 = $this->input->post('cofirm_password');
			
			// Check user credentials against database,
			// check if form pass matches db pass
			$credentials = $this->user_model->users(array('email' => $email));
			
			// Store id in session
			if (password_verify($pass, $credentials->password)) {
				$this->session->set_userdata('user_id', $credentials->user_id);
			}
			
			// Redirect to main page
			redirect(base_url('/'),'location');
		}
		
		$this->load->view('header', $data);
		$this->load->view('login');
		$this->load->view('footer');
	}
	
	
	/*
	 * Log out
	 */	
	public function logout()
	{
		$this->session->unset_userdata('user_id');
		
		redirect(base_url('/'),'location');
	}
	
	
	/*
	 * Register
	 */	
	public function register()
	{
		// Data
		$data['title'] = 'Register | ABC Car Fleet';
		
		// logged user data
		$data['logged'] = $this->user_model->logged();
		
		if($_POST) {
			$email = $this->input->post('email');
			$pass  = $this->input->post('password');
			$pass2 = $this->input->post('cofirm_password');
			
			// Check user credentials against database
			$credentials = $this->user_model->users(array('email', $email));
			
			var_dump($credentials);
			
			// Store id in session
			
			
			// Redirect to main page
		}
		
		$this->load->view('header', $data);
		$this->load->view('register');
		$this->load->view('footer');
	}
	
	
	/*
	 * Enquire
	 */	
	public function enquire() {
		$table = 'enquiries';
		
		if ($this->user_model->logged() == true) {
			$car_id   = trim(htmlspecialchars($this->input->post('car_id')));
			$fullname = trim(htmlspecialchars($this->input->post('fullname')));
			$email    = trim(htmlspecialchars($this->input->post('email')));
			$phone    = trim(htmlspecialchars($this->input->post('phone')));
			$subject  = trim(htmlspecialchars($this->input->post('subject')));
			$message  = trim(htmlspecialchars($this->input->post('message')));
			
			$form_data = array(
				'car_id'   => $car_id,
				'fullname' => $fullname,
				'email'    => $email,
				'phone'    => $phone,
				'subject'  => $subject,
				'message'  => $message,
				'created_at' => date('Y-m-d H:i:s')
				);
			
			$this->db->insert($table, $form_data);
			
			redirect('browse/car/'.$car_id.'?message=equiry-sent', 'location');
		}
		else {
			redirect('login?message=login', 'location');
		}
	}
	
	/*
	 * Purchase
	 */	
	public function purchase($car_id = 0) {
		$car_id = trim(htmlspecialchars($car_id));
		
		$where = array('car_id' => $car_id);
		$table = 'orders';
		
		// Data
		$data['title'] = 'Purchase | ABC Car Fleet';
		$data['logged'] = $this->user_model->logged();
		$data['car'] = $this->car_model->cars($where);
			
			
		if ($this->user_model->logged() == true) 
		{
			$data['user'] = $this->user_model->users(array('users.user_id' => $data['logged']->user_id));

			
			// form submit
			if (isset($_POST) && $_POST) {
				$car_id     = $car_id;
				$first_name = trim(htmlspecialchars($this->input->post('first_name')));
				$last_name  = trim(htmlspecialchars($this->input->post('last_name')));
				$email      = trim(htmlspecialchars($this->input->post('email')));
				$phone      = trim(htmlspecialchars($this->input->post('phone')));
				$mobile_no  = trim(htmlspecialchars($this->input->post('mobile_no')));
				
				$unit_no   = trim(htmlspecialchars($this->input->post('unit_no')));
				$street_no = trim(htmlspecialchars($this->input->post('street_no')));
				$address   = trim(htmlspecialchars($this->input->post('address')));
				$city      = trim(htmlspecialchars($this->input->post('city')));
				$state     = trim(htmlspecialchars($this->input->post('state')));
				$postcode  = trim(htmlspecialchars($this->input->post('postcode')));

				$payment_type    = trim(htmlspecialchars($this->input->post('payment_type')));
				$car_holder      = trim(htmlspecialchars($this->input->post('car_holder')));
				$credit_card_no  = trim(htmlspecialchars($this->input->post('credit_card_no')));
				$csc             = trim(htmlspecialchars($this->input->post('csc')));
				
				// Form data
				$form_data = array(
					'car_id'     => $car_id,
					'first_name' => $first_name,
					'last_name'  => $last_name,
					'email'      => $email,
					'phone'      => $phone,
					'mobile_no'  => $mobile_no,
					'unit_no'    => $unit_no,
					'street_no'  => $street_no,
					'address'    => $address,
					'city'       => $city,
					'state'      => $state,
					'postcode'   => $postcode,
					'created_at' => date('Y-m-d H:i:s')
					);
				
				$this->db->insert($table, $form_data);
			
			
				$data['page_title']   = 'Success!';
				$data['page_message'] = 'Thanks, you\'re purchase has been successfully process.';

				$this->load->view('header', $data);
				$this->load->view('success', $data);
				$this->load->view('footer');
			} 
			else {
				$this->load->view('header', $data);
				$this->load->view('purchase');
				$this->load->view('footer');
			}
		} 
		else {
			redirect('login?message=login', 'location');
		}
	}
}
