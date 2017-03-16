<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends MX_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('Aauth');
		$this->load->library('Custom_Auth');
		$module = $this->router->fetch_module();
		$this->load->model('Users_model');
		
	}

	public function index() {
		
		$data = array();
		$data['page_title'] = 'Dashboard';
		$data['header'] = modules::run('common/header/index', $data);
		$data['sidebar_left'] = modules::run('common/sidebar_left/index', $data);
		$data['sidebar_right'] = modules::run('common/sidebar_right/index', $data);
		$data['footer'] = modules::run('common/footer/index', $data);
		
		$data['breadcrumb'] = array(
			'home' => site_url('users/user'),
		);
		
		$data['new_projects'] = 0;//$this->Users_model->get_newProject();
		$data['total_projects'] = 0;//$this->Users_model->get_totalProject();
		$data['active_projects'] = 0;//$this->Users_model->get_totalProject('1');
		$data['cancelled_projects'] = 0;//$this->Users_model->get_totalProject('3');
		$data['complete_projects'] = 0;//$this->Users_model->get_totalProject('2');
		$data['projected_income'] = 0;//$this->Users_model->get_totalIncome(date('Y'));
		$data['projected_income_rate'] = 0;//$this->Users_model->getIncomeImprovement();
		
		$this->load->view('dashboard', $data);

	}
	
	
	public function trigger_event()
	{
		// Load the library.
		// You can also autoload the library by adding it to config/autoload.php
		$this->load->library('ci_pusher');
		$pusher = $this->ci_pusher->get_pusher();
		// Set message
		
		$data['message'] = 'You have notify the pusher :D';
		$data['status'] = 'success';
		
		
		// Send message
		$event = $pusher->trigger('my-channel', 'my-event', $data);
		if ($event === TRUE)
		{
			echo 'Event triggered successfully!';
		}
		else
		{
			echo 'Ouch, something happend. Could not trigger event.';
		}
	}
	
	public function trigger_event2()
	{
		// Load the library.
		// You can also autoload the library by adding it to config/autoload.php
		$this->load->library('ci_pusher');
		$pusher = $this->ci_pusher->get_pusher();
		// Set message
		
		$data['message'] = 'You have notify the pusher with a warning :D';
		$data['status'] = 'warning';
		
		
		// Send message
		$event = $pusher->trigger('my-channel2', 'my-event2', $data);
		if ($event === TRUE)
		{
			echo 'Event triggered successfully!';
		}
		else
		{
			echo 'Ouch, something happend. Could not trigger event.';
		}
	}
	
	public function user_group() {

		$data = array();
		$data['page_title'] = 'Dashboard';
		$data['header'] = modules::run('common/header/index', $data);
		$data['sidebar_left'] = modules::run('common/sidebar_left/index', $data);
		$data['sidebar_right'] = modules::run('common/sidebar_right/index', $data);
		$data['footer'] = modules::run('common/footer/index', $data);

		$data['breadcrumb'] = array(
			'home' => site_url('users/user'),
			'user group' => site_url('users/user/user_group'),
		);

		$data['user_groups'] = array();
		$groups = $this->aauth->get_all_groups();

		$data['add_group'] = site_url('users/user/create_user_group');

		if(count($groups) > 0) {
			foreach($groups as $group) {

				$data['user_groups'][] = array(
					'id' 	=>	$group['id'],
					'name'	=>	$group['name'],
					'definition'	=>	$group['definition'],
					'href'	=>	site_url('users/user/user_group_info?group_id=' . $group['id'])		
				);

			}
		}

		$this->load->view('user_group', $data);

	}

	public function add_user() {

		$data = array();
		$data['system_title'] = 'Terada - User Registration';
		$data['page_title'] = 'User Registration';
		$data['header'] = modules::run('common/header/index', $data);
		$data['sidebar_left'] = modules::run('common/sidebar_left/index', $data);
		$data['sidebar_right'] = modules::run('common/sidebar_right/index', $data);
		$data['footer'] = modules::run('common/footer/index', $data);

		$data['breadcrumb'] = array(
			'home' => site_url('users/user'),
			'user list' => site_url('users/user/user_list'),
			'user registration' => site_url('users/user/add_user'),
		);

		$data['user_groups'] = array();
		$groups = $this->aauth->get_all_groups();

		foreach($groups as $group) {
			$data['user_groups'][] = array(
				'id' 			=>	$group['id'],
				'group_name'	=>	$group['name'],
				'definition'	=>	$group['definition']
			);
		}

		$this->form_validation->set_rules('user_name', 'Username', 'required|min_length[6]|max_length[16]|is_unique[aauth_users.name]');
		$this->form_validation->set_rules('user_lastname', 'Lastname', 'required');
		$this->form_validation->set_rules('user_firstname', 'Firstname', 'required');
		$this->form_validation->set_rules('user_email', 'Email Address', 'required|valid_email|is_unique[aauth_users.email]');
		//$this->form_validation->set_rules('user_birthday', 'Birthday', 'required');
		//$this->form_validation->set_rules('user_phone1', 'Primary contact', 'required');
		//$this->form_validation->set_rules('user_address1', 'Primary address', 'required');
		$this->form_validation->set_rules('user_password1', 'Password', 'required|matches[user_password2]');
		$this->form_validation->set_rules('user_password2', 'Confirm password', 'required');
		$this->form_validation->set_rules('user_group', 'User group', 'required');

		if($this->form_validation->run() == FALSE) {
			$this->load->view('create_user', $data);
		} else {

			$info = array(
				'username'	=>	strtolower($this->input->post('user_name')),
				'lastname'	=>	ucwords($this->input->post('user_lastname')),
				'firstname'	=>	ucwords($this->input->post('user_firstname')),
				'email'		=>	strtolower($this->input->post('user_email')),
				'birthday'	=>	$this->input->post('user_birthday'),
				'contact_1'	=>	$this->input->post('user_phone1'),
				'contact_2'	=>	$this->input->post('user_phone2'),
				'address_1'	=>	$this->input->post('user_address1'),
				'address_2'	=>	$this->input->post('user_address2'),
				'password'	=>	$this->input->post('user_password1'),
				'group_id'		=>	$this->input->post('user_group')
			);

			//fp($this->input->post());
			$user_id = $this->aauth->create_user($info['email'], $info['password'], $info['username']);

			if($user_id) {

				$new_info = array_merge($info, array('user_id' => $user_id));
				$add_extra_info = $this->custom_auth->add_extra_info($new_info);

				if($add_extra_info) {
				
					$this->session->set_flashdata('status_info', '<strong>Success! </strong> User saved successfully! .');
					$this->session->set_flashdata('status', 'success');
					redirect(site_url('users/user/user_list'));
				} else {
					$this->session->set_flashdata('status_info', 'User info could not save!');
					$this->session->set_flashdata('status', 'danger');
					redirect(site_url('users/user/user_list'));
				}

			} else {
				$this->session->set_flashdata('status_info', 'User did not save successfully!');
				$this->session->set_flashdata('status', 'danger');
				redirect(site_url('users/user/add_user'));
			}

		}	
	
	}

	public function load_group_list() {

		$json['user_groups'] = array();
		$groups = $this->aauth->get_all_groups();

		if(count($groups) > 0) {
			foreach($groups as $group) {

				$json['user_groups'][] = array(
					'id' 	=>	$group['id'],
					'name'	=>	$group['name'],
					'definition'	=>	$group['definition'],
					'href'	=>	site_url('users/user/user_group_info?group_id=' . $group['id'])		
				);

			}
		}

		json_header();
		echo json_encode($json);

	}

	public function user_list() {

		$data = array();
		$data['system_title'] = 'Terada - Account List';
		$data['page_title'] = 'Account List Management';
		$data['header'] = modules::run('common/header/index', $data);
		$data['sidebar_left'] = modules::run('common/sidebar_left/index', $data);
		$data['sidebar_right'] = modules::run('common/sidebar_right/index', $data);
		$data['footer'] = modules::run('common/footer/index', $data);

		$breadcrumbs = array(
			'home' => site_url('users/user'),
			'account list' => site_url('users/user/user_list'),
		);

		$data['breadcrumbs'] = gen_breadcrumbs($breadcrumbs);

		$data['user_list'] = array();
		$userlist = convert_stdobject($this->aauth->list_users()); //convert stdobject array in array

		//fd($userlist);

		foreach($userlist as $users) {

			$par = array(
				'user_id'	=>	$users['id']
			);

			$group = $this->aauth->get_user_group_name($users['id']);

			$data['user_list'][] = array(
				'id'	=>	$users['id'],
				'name'	=>	$users['name'],
				'email'	=>	$users['email'],
				'group' =>	convert_stdobject($group['name']),
				'href'	=>	generate_url('users/user/user_info', $par)
			);
		}

		$this->load->view('user_list', $data);

    }

	public function user_info() {
		
		$user_id = $this->input->get('user_id');
		$user_info = convert_stdobject($this->aauth->get_user($user_id));

		$par = array(
			'user_id' => 1,
			'pos' => 'desc'
		);

		$test_url = generate_url('users/user/user_info', $par);

		echo $test_url . "<br />" ;
		echo $this->input->get('user_id');
		echo $this->input->get('pos');
		
	}

	public function edit_user() {
		
		$user_id = $this->input->get('user_id');
		$this->user_lib->validate_user_update($user_id); //validate if user is editing other pages. Only admin can do that
	
		$data = array();
		$data['system_title'] = 'Terada - Update User';
		$data['page_title'] = 'Update User';
		$data['header'] = modules::run('common/header/index', $data);
		$data['sidebar_left'] = modules::run('common/sidebar_left/index', $data);
		$data['sidebar_right'] = modules::run('common/sidebar_right/index', $data);
		$data['footer'] = modules::run('common/footer/index', $data);

		$data['breadcrumb'] = array(
			'home' => site_url('users/user'),
			//'user list' => site_url('users/user/user_list'),
			'update user' => site_url('users/user/edit_user?user_id=' . $user_id),
		);

		$data['user_groups'] = array();
		$groups = $this->aauth->get_all_groups();

		foreach($groups as $group) {
			$data['user_groups'][] = array(
				'id' 			=>	$group['id'],
				'group_name'	=>	$group['name'],
				'definition'	=>	$group['definition']
			);
		}

		$data['action'] = site_url('users/user/edit_user?user_id=' . $user_id);

		$data['user_info'] = array();

		$user_info = convert_stdobject($this->aauth->get_user($user_id));
		$user_other_info = convert_stdobject($this->custom_auth->get_extra_info($user_id));
		$user_group_id = $this->custom_auth->get_user_group($user_id);

		$data['user_info'] = array(
			'username'	=>	$user_info['name'],
			'email'		=>	$user_info['email'],
			'firstname'	=>	$user_other_info['firstname'],
			'lastname'	=>	$user_other_info['lastname'],
			'birthday'	=>	$user_other_info['birthday'],
			'contact_1'	=>	$user_other_info['contact_1'],
			'contact_2'	=>	$user_other_info['contact_2'],
			'address_1'	=>	$user_other_info['address_1'],
			'address_2'	=>	$user_other_info['address_2'],
			'status'	=>	$user_other_info['status'],
			'group_id'	=>	$user_group_id['group_id']
		);

		//fp($data['user_info']);

		$this->form_validation->set_rules('user_name', 'Username', 'required|min_length[6]|max_length[16]|callback_check_username');
		$this->form_validation->set_rules('user_lastname', 'Lastname', 'required');
		$this->form_validation->set_rules('user_firstname', 'Firstname', 'required');
		$this->form_validation->set_rules('user_email', 'Email Address', 'required|valid_email|callback_check_email');
		//$this->form_validation->set_rules('user_birthday', 'Birthday', 'required');
		//$this->form_validation->set_rules('user_phone1', 'Primary contact', 'required');
		//$this->form_validation->set_rules('user_address1', 'Primary address', 'required');
		$this->form_validation->set_rules('user_group', 'User group', 'required');

		if($this->form_validation->run($this) == FALSE) {

			$this->load->view('edit_user', $data);

		} else {

			$info = array(
				'user_id'	=>	$user_id,
				'username'	=>	strtolower($this->input->post('user_name')),
				'lastname'	=>	ucwords($this->input->post('user_lastname')),
				'firstname'	=>	ucwords($this->input->post('user_firstname')),
				'email'		=>	strtolower($this->input->post('user_email')),
				'birthday'	=>	$this->input->post('user_birthday'),
				'contact_1'	=>	$this->input->post('user_phone1'),
				'contact_2'	=>	$this->input->post('user_phone2'),
				'address_1'	=>	$this->input->post('user_address1'),
				'address_2'	=>	$this->input->post('user_address2'),
				'group_id'	=>	$this->input->post('user_group'),
				'status'	=>	$this->input->post('user_status')	
			);

			//fd($info);

			$user_update = $this->custom_auth->update_user_info($info);

			if($user_update) {
				$this->session->set_flashdata('status_info', 'User updated successfully!');
				$this->session->set_flashdata('status', 'success');
				redirect(site_url('users/user/edit_user?user_id=' . $user_id));
			} else {
				$this->session->set_flashdata('status_info', 'User did not update successfully!');
				$this->session->set_flashdata('status', 'danger');
				redirect(site_url('users/user/edit_user?user_id=' . $user_id));
			}

		}	

	}

	public function check_username($str) {
		
		$id = $this->input->get('user_id');
		$checkifSame = $this->custom_auth->check_if_username_same($id, $str);

		if($checkifSame) {
			return TRUE;
		} else {
			
			$is_exist = $this->custom_auth->check_if_username_exist($str);
			if($is_exist == 1) {
				$this->form_validation->set_message('check_username', 'The {field} is already taken!');
				return FALSE;
			} else {
				return TRUE;
			}

		}

	}

	public function check_email($str) {

		$id = $this->input->get('user_id');
		$checkifSame = $this->custom_auth->check_if_email_same($id, $str);

		if($checkifSame) {
			return TRUE;
		} else {
			
			$is_exist = $this->custom_auth->check_if_email_exist($str);
			if($is_exist == 1) {
				$this->form_validation->set_message('check_email', 'The {field} is already existed!');
				return FALSE;
			} else {
				return TRUE;
			}

		}


	}

	public function deleteUser() {

		$user_id = $this->input->post('user_id');
		$delete_user = $this->aauth->delete_user($user_id);

		$json = array();
		
		if($delete_user) {
			$this->session->set_flashdata('status_info', 'User has been removed successfully');
			$this->session->set_flashdata('status', 'success');
			$json['status'] = true;
		} else {
			$this->session->set_flashdata('status', 'danger');
			$this->session->set_flashdata('toast_info', 'User could not remove!');
			
			$json['status'] = true;
		}

		json_header();
		echo json_encode($json);

	}

	public function reset_password() {
		
		$user_id = $this->input->post('user_id');
		$generate_password = rand(100000, 999999);

		$json = array();
		$hash_password = $this->aauth->hash_password($generate_password, $user_id);
		$json['generated'] = $generate_password;
		$json['hash'] = $hash_password;

		$status = $this->custom_auth->reset_user_password($user_id, $json['hash']);

		if($status) {
			$json['status'] = true;
			$json['message'] = "Password has been updated successfully!";
		} else {
			$json['status'] = false;
			$json['message'] = "Password could not update!";
		}

		json_header();
		echo json_encode($json);

	}
	
	/* Dashboard */
	
	public function xload_bidding_today() {
		$this->load->model('users/Users_model');
		
		if($this->session->userdata('id')){
			$type= $this->uri->segment(4);
			$all = $this->uri->segment(5);
			
			if($type=='MTD'){
				$search= date('Y-m');
			}else{
				$search= date('Y');
			}

			$row= $this->Users_model->get_userProject($data['id'], $data['client']);
			
			$data['id']= $row['id'];
			$data['client_id']= isset($row['client_id'])? $row['client_id']: $data['client'];
			$data['contact_group']= ($row['contact_group'])? $row['contact_group']: 1;
			$data['contact_name']= $row['contact_name'];
			$data['contact_email']= $row['contact_email'];
			$data['contact_mobile']= $row['contact_mobile'];
			$data['contact_timestamp']= strtotime($row['date_modified']); //convert to timestamp

			//echo json_encode($data);
			$this->load->view('contact_view', $data, FALSE); 
		}else{
			$this->load->view('empty', $data, FALSE); 
		}
		
	}
	
	public function load_bidding_today(){
		$this->load->model('users/Users_model');
		
		$data['product'] = $this->Users_model->getBiddingProduct();
		//$data['product'] =array();
		$this->load->view('bidding_today_view', $data, FALSE);
	
	}
	
	public function load_hot_product(){
		$this->load->model('users/Users_model');
		
		$data['product'] = $this->Users_model->getHotProduct();
		$this->load->view('hot_product_view', $data, FALSE);
	
	}
	
	public function load_waiting_payment(){
		$this->load->model('users/Users_model');
		
		$data['product'] = $this->Users_model->getWaitingPayment();
		$this->load->view('waiting_payment_view', $data, FALSE);
	
	}
	
	public function load_client_inquiry(){
		$this->load->model('users/Users_model');
		
		$data['inquiry'] = $this->Users_model->getClientInquiry();
		$this->load->view('client_inquiry_view', $data, FALSE);
	
	}
}

?>