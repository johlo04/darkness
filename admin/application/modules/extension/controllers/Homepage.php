<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Homepage extends MX_Controller { //why create this page? so that the admin wont go on system page and commit error
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Banner_model');
		$module = $this->router->fetch_module();
		$this->group_permission->is_allow_access($module);
	}

	public function index() {
		
		$data['system_name'] = 'Homepage Extension';
		$data['page_title'] = 'Homepage Extension';
		$data['header'] = modules::run('common/header/index', $data);
		$data['sidebar_left'] = modules::run('common/sidebar_left/index', $data);
		$data['sidebar_right'] = modules::run('common/sidebar_right/index', $data);
		$data['footer'] = modules::run('common/footer/index', $data);
		$data['form_link'] = site_url('extension/homepage');
		
		$breadcrumbs = array(
			'home'	=>	site_url('users/user'),
			'Homepage'	=>	site_url('banner/banner'),	
		);

		$data['breadcrumbs'] = gen_breadcrumbs($breadcrumbs);
		
		if($this->input->post()){ //true means there no error
			//we have assumed that the current config is fixed, if there will be new config, add it first to the database and the form.
			$record = array();
			
			foreach($this->input->post() as $key => $value){
				$value = ($key=='av_homepage_banner')? str_replace(URL_FILEMANAGER_SOURCE,'',$value) : $value; //custom
				$record[] = array('config_name' => $key,'value'=> $value);
				
			}
			
			$this->db->update_batch('system_config', $record, 'config_name');
			$this->system_config->refresh();
			
			$this->session->set_flashdata('status_info', '<strong>Success! </strong> You have modified the homepage.');
			$this->session->set_flashdata('status', 'success');
			redirect(site_url('extension/homepage'));
		}
		
		$data['styles'] = array(
		);
		
		$data['scripts'] = array(
		);

		$this->load->view('homepage', $data);

	}
	
}

?>