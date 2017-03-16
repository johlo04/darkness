<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Inquiry extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Inquiry_model');
		$module = $this->router->fetch_module();
		$this->group_permission->is_allow_access($module);
	}

	public function index() {
		
		$data['system_name'] = 'Inquiry';
		$data['page_title'] = 'Inquiry List';
		$data['header'] = modules::run('common/header/index', $data);
		$data['sidebar_left'] = modules::run('common/sidebar_left/index', $data);
		$data['sidebar_right'] = modules::run('common/sidebar_right/index', $data);
		$data['footer'] = modules::run('common/footer/index', $data);

		$breadcrumbs = array(
			'home'	=>	site_url('users/user'),
			'Inquiry List'	=>	site_url('inquiry/inquiry/'),	
		);

		$data['breadcrumbs'] = gen_breadcrumbs($breadcrumbs);
		
		$this->load->library('pagination');
		
		$content_limit = ($this->uri->segment(3))? $this->uri->segment(3): 0;
		$config['base_url'] = site_url('inquiry/inquiry/');
		$config['uri_segment'] = 3; //page
		$config['per_page'] = 10;
		$config['reuse_query_string'] = true;
	
		$filter = array();
		
		$data['filter_status'] = $filter['filter_status'] = ($this->input->get('filter_status'))? $this->input->get('filter_status'): '';
		$data['filter_keyword']= $filter['filter_keyword'] = ($this->input->get('filter_keyword'))? $this->input->get('filter_keyword'): '';
		
		$config['total_rows'] = $this->Inquiry_model->getTotalInquiry($filter);
		
		$this->pagination->initialize($config);
	
		$data['inquiry'] = $this->Inquiry_model->getInquiry($filter,$content_limit,($content_limit+$config['per_page']));
		
		$data['styles'] = array(
		);
		
		$data['scripts'] = array(
		);

		$this->load->view('inquiry_list', $data);

	}
	
	
	public function view(){
		//validate first so it will not carry memory for $data
		$this->load->library('form_validation');
	
		$this->load->model('inquiry/Inquiry_model');
				
		$id = $this->uri->segment(4);
		$data['rowdata'] = $this->Inquiry_model->getSingle($id);
		
		$data['id'] = $id;
		$data['username'] = $this->session->userdata('name');
		
		$data['system_name'] = 'View Inquiry';
		$data['page_title'] = 'View Inquiry';
		
		$data['header'] = modules::run('common/header/index', $data);
		$data['sidebar_left'] = modules::run('common/sidebar_left/index', $data);
		$data['sidebar_right'] = modules::run('common/sidebar_right/index', $data);
		$data['footer'] = modules::run('common/footer/index', $data);
		//$data['product_form_link'] = site_url('inquiry/inquiry/view/'.$this->uri->segment(4));
		
		$breadcrumbs = array(
			'home'	=>	site_url('inquiry/inquiry'),
			'Inquiry list'	=>	site_url('inquiry/inquiry'),	
			'View Inquiry'	=>	site_url('inquiry/inquiry/view/'.$this->uri->segment(4)),	
		);

		$data['breadcrumbs'] = gen_breadcrumbs($breadcrumbs);
		
		$this->load->view('inquiry_view',$data);
	
	}
	
	public function modal(){
	
		$this->load->view('inquiry_view',$data);
	
	}
	
	
	function delete(){
		$this->load->model('inquiry/Inquiry_model');
		
		$id= $this->uri->segment(4);
		$secret= $this->uri->segment(5); //
		
		$check_timestamp = strtotime($this->Inquiry_model->get_last_timestamp($id,'date_modified','auction_product'));
		
		if($check_timestamp==$secret){
			$this->Inquiry_model->deleteInquiry($id);
			
			$this->session->set_flashdata('status_info', '<strong>Success! </strong> You have successfully deleted the product.');
			$this->session->set_flashdata('status', 'success');
		}else{
			$this->session->set_flashdata('status_info', '<strong>Failed: </strong>Inquiry may have been updated or no longer exist.');
			$this->session->set_flashdata('status', 'danger');
		}
		
		redirect(site_url('inquiry/inquiry'));
	}
	
	public function set_closebid(){
		$id = $this->uri->segment(4);
		$this->db->where('id', $id);
		$this->db->update('auction_product', array('status'=>1)); 
		
	}
	
	public function load_replies(){
		$this->load->model('inquiry/Inquiry_model');
		$id= $this->uri->segment(4);
		
		$data['reply_list'] = $this->Inquiry_model->getInquiryReply($id);
		$this->load->view('reply_list', $data, FALSE);
	
	}
	
	public function add_reply(){
		$data['inquiry_id'] = $this->uri->segment(4);
		$data['reply_detail'] = $this->input->post('message');
		$data['user_group'] = 'admin';
		$data['date_added'] = $this->input->post('date_added');
		
		$data['user_id'] = $this->session->userdata('id');
			
		if($this->Inquiry_model->setInquiryReply($data)){
			
			$json['status'] = 'success';
			$json['message'] = 'You have successfull replied to the inquiry.';
			
		}else{
		
			$json['status'] = 'danger';
			$json['message'] = 'Something went wrong please try again.';
		}
		
		echo json_encode($json);
	}
	
	public function delete_reply(){
		$id = $this->uri->segment(4);
		//$data['is_hide'] = 1;
		
		//if($this->Inquiry_model->setHideInquiryReply($data,$id)){
		if($this->Inquiry_model->deleteInquiryReply($id)){
			
			$json['status'] = 'success';
			$json['message'] = 'You have successfull remove the reply.';
			
		}else{
		
			$json['status'] = 'danger';
			$json['message'] = 'Something went wrong please try again.';
		}
		
		echo json_encode($json);
	}
	
	public function read_reply(){
		$id = $this->uri->segment(4);
		$data['is_check'] = 1;
		
		if($this->Inquiry_model->setReadInquiryReply($data,$id)){
			
			$json['status'] = 'success';
			$json['message'] = 'You have successfull update the reply list.';
			
		}else{
		
			$json['status'] = 'danger';
			$json['message'] = 'Something went wrong please try again.';
		}
		
		echo json_encode($json);
	}
	
	public function status_inquiry(){
		$id = $this->uri->segment(4);
		$data['status'] = $this->input->post('status');
		
		if($this->Inquiry_model->setStatusInquiry($data,$id)){
			
			$json['status'] = 'success';
			$json['message'] = 'You have successfull update the inquiry status.';
			
		}else{
		
			$json['status'] = 'danger';
			$json['message'] = 'Something went wrong please try again.';
		}
		
		echo json_encode($json);
	}
	
}

?>