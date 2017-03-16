<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_Group extends MX_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('Aauth');
		$module = $this->router->fetch_module();
		$this->group_permission->is_allow_access($module);
		
		$this->load->model('Users_model');
	}

	public function index() {

		$data = array();
		$data['system_title'] = 'Terada - User Group';
		$data['page_title'] = 'User Groups Management';
		$data['header'] = modules::run('common/header/index', $data);
		$data['sidebar_left'] = modules::run('common/sidebar_left/index', $data);
		$data['sidebar_right'] = modules::run('common/sidebar_right/index', $data);
		$data['footer'] = modules::run('common/footer/index', $data);

		$data['breadcrumb'] = array(
			'home' => site_url('users/user'),
			'user group' => site_url('user_groups/user_groups'),
		);

		$data['user_groups'] = array();
		$groups = $this->aauth->get_all_groups();

		$data['add_group'] = site_url('user_group/user_group/edit');

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
	
	public function edit() {
		
		$data = array();
		$data['system_title'] = 'Terada - User Group Form';
		$data['page_title'] = 'User Group';
		$data['header'] = modules::run('common/header/index', $data);
		$data['sidebar_left'] = modules::run('common/sidebar_left/index', $data);
		$data['sidebar_right'] = modules::run('common/sidebar_right/index', $data);
		$data['footer'] = modules::run('common/footer/index', $data);
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Group Name', 'required|min_length[3]|max_length[225]');
		
		if($this->input->post() && $this->form_validation->run()==true){ //true means there no error
			
			$id = $this->group_permission->set_permission($this->input->post(), $this->input->post('id'));
			
			$rowdata = $this->group_permission->get_permission($id);
			
			/*
			$data['rowdata']['id'] = $id;
			$data['rowdata']['name'] = $rowdata['name'];
			$data['rowdata']['definition'] = $rowdata['definition'];
			$data['rowdata']['view_privilege'] = (!empty($rowdata['view_privilege']))? explode(',',$rowdata['view_privilege']) : 0;
			$data['rowdata']['modify_privilege'] = (!empty($rowdata['modify_privilege']))? explode(',',$rowdata['modify_privilege']) :  0;
			$data['rowdata']['delete_privilege'] = (!empty($rowdata['delete_privilege']))?  explode(',',$rowdata['delete_privilege']) :  0;
			$data['rowdata']['special_privilege'] = (!empty($rowdata['special_privilege']))? explode(',',$rowdata['special_privilege']) :  0;
			*/
			$this->session->set_flashdata('status_info', '<strong>Success! </strong> You have modified the user group.');
			$this->session->set_flashdata('status', 'success');
			
			redirect(site_url('user_group/user_group/edit/'.$id));
			
		}else if($this->input->post() && $this->form_validation->run()==false){
			$id = $this->uri->segment(4);
			
			$data['rowdata']['id'] = $this->input->post('id');
			$data['rowdata']['name'] = $this->input->post('name');
			$data['rowdata']['definition'] = $this->input->post('definition');
			$data['rowdata']['view_privilege'] = (null !==$this->input->post('view_privilege'))?  $this->input->post('view_privilege') :  array();
			$data['rowdata']['modify_privilege'] =  (null !==$this->input->post('modify_privilege'))?  $this->input->post('modify_privilege') :  array(); 
			$data['rowdata']['delete_privilege'] = (null !==$this->input->post('delete_privilege'))?  $this->input->post('delete_privilege') :  array();
			$data['rowdata']['special_privilege'] = (null !==$this->input->post('special_privilege'))?  $this->input->post('special_privilege') :  array(); 
			$data['form_user_group_link'] = site_url('user_group/user_group/edit/'.$id);
			
			$this->session->set_flashdata('status_info', '<strong>Error! </strong> Please fill up the form carefully.');
			$this->session->set_flashdata('status', 'danger');
		}else{ //new or from db
			$id = $this->uri->segment(4);
			$rowdata = $this->group_permission->get_permission($id);
			
			$data['rowdata']['id'] = $rowdata['id'];
			$data['rowdata']['name'] = $rowdata['name'];
			$data['rowdata']['definition'] = $rowdata['definition'];
			$data['rowdata']['view_privilege'] = (!empty($rowdata['view_privilege']))? explode(',',$rowdata['view_privilege']) : array();
			$data['rowdata']['modify_privilege'] = (!empty($rowdata['modify_privilege']))? explode(',',$rowdata['modify_privilege']) :  array();
			$data['rowdata']['delete_privilege'] = (!empty($rowdata['delete_privilege']))?  explode(',',$rowdata['delete_privilege']) :  array();
			$data['rowdata']['special_privilege'] = (!empty($rowdata['special_privilege']))? explode(',',$rowdata['special_privilege']) :  array();
			$data['form_user_group_link'] = site_url('user_group/user_group/edit/'.$id);
			
			
		}
		
		$data['path'] = $this->group_permission->getFilePath();
		
		$data['breadcrumb'] = array(
			'home' => site_url('user/user'),
			'user group' =>	site_url('user_group/user_group'),
		);

		$this->form_validation->set_rules('group_name', 'Group Name', 'required', TRUE);
		$this->form_validation->set_rules('group_definition', 'Definition', 'required', TRUE);

		$this->load->view('user_group_form', $data);

	}
	
	public function remove_user_group() {
	
		$json = array();
		$group_id = $this->input->post('group_id');
		$remove_group = $this->group_permission->delete_group($group_id);

		$json = array();

		if($remove_group == 1) {
			$json['status'] = 'success';
			$json['status_info'] = 'User Group has been successfully removed!';
		} else {
			$json['status'] = 'danger';
			$json['status_info'] = 'User Group caould not removed. Error found!';
		}

		json_header();
		echo json_encode($json);

	}
	

}

?>