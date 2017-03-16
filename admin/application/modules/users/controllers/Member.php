<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Member extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Member_model');
		$module = $this->router->fetch_module();
		$this->group_permission->is_allow_access($module);
	}

	public function index() {
		
		$data['system_name'] = 'Member';
		$data['page_title'] = 'Member List';
		$data['header'] = modules::run('common/header/index', $data);
		$data['sidebar_left'] = modules::run('common/sidebar_left/index', $data);
		$data['sidebar_right'] = modules::run('common/sidebar_right/index', $data);
		$data['footer'] = modules::run('common/footer/index', $data);

		$breadcrumbs = array(
			'home'	=>	site_url('users/user'),
			'Member List'	=>	site_url('users/member'),	
		);

		$data['breadcrumbs'] = gen_breadcrumbs($breadcrumbs);
		
		$this->load->library('pagination');
		
		$content_limit = ($this->uri->segment(3))? $this->uri->segment(3): 0;
		$config['base_url'] = site_url('users/member');
		$config['uri_segment'] = 3; //page
		$config['per_page'] = 10;
		$config['reuse_query_string'] = true;
	
		$filter = array();
		$data['filter_status'] = $filter['filter_status'] = ($this->input->get('filter_status'))? $this->input->get('filter_status'): '';
		$data['filter_keyword']= $filter['filter_keyword'] = ($this->input->get('filter_keyword'))? $this->input->get('filter_keyword'): '';
		
		$config['total_rows'] = $this->Member_model->getTotalMember($filter);
		
		$this->pagination->initialize($config);
	
		$data['members'] = $this->Member_model->getMember($filter,$content_limit,($content_limit+$config['per_page']));
		
		$data['styles'] = array(
		);
		
		$data['scripts'] = array(
		);

		$this->load->view('member_list', $data);

	}
	
	
	public function view(){
		//validate first so it will not carry memory for $data
		$this->load->library('form_validation');
	
		$this->load->model('users/Member_model');
				
		$id = $this->uri->segment(4);
		$data['rowdata'] = $this->Member_model->getSingle($id);
		
		$data['system_name'] = 'View -';
		$data['page_title'] = 'View Member';
		
		$data['header'] = modules::run('common/header/index', $data);
		$data['sidebar_left'] = modules::run('common/sidebar_left/index', $data);
		$data['sidebar_right'] = modules::run('common/sidebar_right/index', $data);
		$data['footer'] = modules::run('common/footer/index', $data);
		//$data['product_form_link'] = site_url('member/member/view/'.$this->uri->segment(4));
		
		$breadcrumbs = array(
			'home'	=>	site_url('users/user'),
			'Member list'	=>	site_url('users/member'),	
			'View Member'	=>	site_url('users/member/view/'.$this->uri->segment(4)),	
		);

		$data['breadcrumbs'] = gen_breadcrumbs($breadcrumbs);
		
		$this->load->view('member_view',$data);
	
	}
	
	public function modal(){
	
		$this->load->view('member_view',$data);
	
	}
	
	
	function delete(){
	
	}
	
	public function load_auction_won(){
		$this->load->model('users/Member_model');
		$id= $this->uri->segment(4);
		$data['product'] = $this->Member_model->getWonAuction($id);
		$this->load->view('member_won_auction', $data, FALSE);
	
	}
	
	public function load_member_inquiry(){
		$this->load->model('users/Member_model');
		$id= $this->uri->segment(4);
		
		$data['inquiry'] = $this->Member_model->getMemberInquiry($id);
		$this->load->view('member_inquiry_list', $data, FALSE);
	
	}
	
}

?>