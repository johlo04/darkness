<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Banner extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Banner_model');
		$module = $this->router->fetch_module();
		$this->group_permission->is_allow_access($module);
	}

	public function index() {
		
		$data['system_name'] = 'Banner';
		$data['page_title'] = 'Auction Banner List';
		$data['header'] = modules::run('common/header/index', $data);
		$data['sidebar_left'] = modules::run('common/sidebar_left/index', $data);
		$data['sidebar_right'] = modules::run('common/sidebar_right/index', $data);
		$data['footer'] = modules::run('common/footer/index', $data);

		$breadcrumbs = array(
			'home'	=>	site_url('users/user'),
			'Banner List'	=>	site_url('banner/banner'),	
		);

		$data['breadcrumbs'] = gen_breadcrumbs($breadcrumbs);
		
		$this->load->library('pagination');
		
		$content_limit = ($this->uri->segment(3))? $this->uri->segment(3): 0;
		$config['base_url'] = site_url('banner/banner');
		$config['uri_segment'] = 3; //page
		$config['per_page'] = 10;
		$config['reuse_query_string'] = true;
		

		$filter = array();
		
		$data['filter_status'] = $filter['filter_status'] = ($this->input->get('filter_status'))? $this->input->get('filter_status'): 'all';
		$data['filter_banner_name']= $filter['filter_banner_name'] = ($this->input->get('filter_banner_name'))? $this->input->get('filter_banner_name'): '';
		
		$config['total_rows'] = $this->Banner_model->getTotalBanner($filter);
		
		$this->pagination->initialize($config);
	
		$data['banner'] = $this->Banner_model->getBanner($filter,$content_limit,($content_limit+$config['per_page']));
		
		
		$data['styles'] = array(
		);
		
		$data['scripts'] = array(
		);

		$this->load->view('banner_list', $data);

	}
	
	public function add(){
		
		//validate first so it will not carry memory for $data
		$this->load->library('form_validation');
		$this->form_validation->set_rules('image', 'Banner', 'required');
		
		
		if($this->input->post() && $this->form_validation->run()==true){ //true means there no error
			$this->load->model('banner/Banner_model');
			
			$id = $this->Banner_model->update($this->input->post(), $this->input->post('id'));
			$this->session->set_flashdata('status_info', '<strong>Success! </strong> You have successfully added a banner');
			$this->session->set_flashdata('status', 'success');
			
			redirect(site_url('extension/banner/edit/'.$id));
		}else{
			
			if($this->input->post() && $this->form_validation->run()==false){
				$this->session->set_flashdata('status_info', '<strong>Error! </strong> Please fill up the form correctly');
				$this->session->set_flashdata('status', 'danger');
			}
		}
		
		$data['system_name'] = 'Add Banner';
		$data['page_title'] = 'Add Banner Form';
		
		$data['header'] = modules::run('common/header/index', $data);
		$data['sidebar_left'] = modules::run('common/sidebar_left/index', $data);
		$data['sidebar_right'] = modules::run('common/sidebar_right/index', $data);
		$data['footer'] = modules::run('common/footer/index', $data);
		$data['banner_form_link'] = site_url('extension/banner/add');
		
		//generate BrdCrmb
		$breadcrumbs = array(
			'home'	=>	site_url('banner/banner'),
			'banner list'	=>	site_url('banner/banner'),	
			'Add Banner'	=>	site_url('extension/banner/add'),	
		);

		$data['breadcrumbs'] = gen_breadcrumbs($breadcrumbs);
		
		$this->load->view('banner_add',$data);
	
	}
	
	public function edit(){
		//validate first so it will not carry memory for $data
		$this->load->library('form_validation');
		$this->form_validation->set_rules('image', 'Banner', 'required');
		
		$this->load->model('banner/Banner_model');
		
		$data['rowdata'] =array();
		
		if($this->input->post() && $this->form_validation->run()==true){ //true means there no error
			$id = $this->Banner_model->update($this->input->post(), $this->input->post('id'));
			
			$this->session->set_flashdata('status_info', '<strong>Success! </strong> You have modified the banner detail .');
			$this->session->set_flashdata('status', 'success');
			$data['rowdata'] = $this->Banner_model->getSingle($id);
			
			$this->session->set_flashdata('status_info', '<strong>Success! </strong> You have successfully edit banner detail');
			$this->session->set_flashdata('status', 'success');
			
			redirect(site_url('extension/banner/edit/'.$id));
		
		}else if($this->input->post() && $this->form_validation->run()==false){
		
			$id = $this->uri->segment(4);
			$data['rowdata']= $this->input->post();//$this->input->post();
			
			$this->session->set_flashdata('status_info', '<strong>Error! </strong> Please fill up the form correctly');
			$this->session->set_flashdata('status', 'danger');
		
		}else{
		
			$id = $this->uri->segment(4);
			$data['rowdata'] = $this->Banner_model->getSingle($id);
			
		}
	
		$data['id'] = $id;
		$data['username'] = $this->session->userdata('name');
		
		$data['system_name'] = 'Edit Banner';
		$data['page_title'] = 'Edit Banner Form';
		
		$data['header'] = modules::run('common/header/index', $data);
		$data['sidebar_left'] = modules::run('common/sidebar_left/index', $data);
		$data['sidebar_right'] = modules::run('common/sidebar_right/index', $data);
		$data['footer'] = modules::run('common/footer/index', $data);
		$data['banner_form_link'] = site_url('extension/banner/edit/'.$this->uri->segment(4));
		
		$breadcrumbs = array(
			'home'	=>	site_url('banner/banner'),
			'Banner list'	=>	site_url('banner/banner'),	
			'Edit Banner'	=>	site_url('extension/banner/edit'),	
		);

		$data['breadcrumbs'] = gen_breadcrumbs($breadcrumbs);
		
		$this->load->view('banner_edit',$data);
	
	}
	
	function delete(){
		$this->load->model('banner/Banner_model');
		
		$id= $this->uri->segment(4);
		
		//$check_timestamp = strtotime($this->Banner_model->get_last_timestamp($id,'date_modified','auction_banner'));
	
		$this->Banner_model->deleteBanner($id);
		
		$this->session->set_flashdata('status_info', '<strong>Success! </strong> You have successfully deleted the banner.');
		$this->session->set_flashdata('status', 'success');
		
		redirect(site_url('extension/banner'));
	}
	
	
}

?>