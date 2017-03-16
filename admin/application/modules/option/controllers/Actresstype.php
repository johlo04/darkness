<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Actresstype extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Category_model');
		$this->module = $this->router->fetch_module();
		$this->group_permission->is_allow_access($this->module);
	}

	public function index() {
		
		$data['system_name'] = 'Actress Type';
		$data['page_title'] = 'Actress Type List';
		$data['header'] = modules::run('common/header/index', $data);
		$data['sidebar_left'] = modules::run('common/sidebar_left/index', $data);
		$data['sidebar_right'] = modules::run('common/sidebar_right/index', $data);
		$data['footer'] = modules::run('common/footer/index', $data);

		$breadcrumbs = array(
			'home'	=>	site_url('users/user'),
			'Actress Type List'	=>	site_url('option/actresstype'),	
		);

		$data['breadcrumbs'] = gen_breadcrumbs($breadcrumbs);
		
		$this->load->library('pagination');
		
		$content_limit = ($this->uri->segment(3))? $this->uri->segment(3): 0;
		$config['base_url'] = site_url('option/actresstype');
		$config['uri_segment'] = 3; //page
		$config['per_page'] = 10;
		$config['reuse_query_string'] = true;
		

		$filter = array();
		
		$data['filter_category_name'] = $filter['filter_category_name'] = ($this->input->get('filter_category_name'))? $this->input->get('filter_category_name'): '';
		$data['filter_type']= $filter['filter_type'] = ($this->input->get('filter_type'))? $this->input->get('filter_type'): '';
		$data['filter_status']= $filter['filter_status'] = ($this->input->get('filter_status'))? $this->input->get('filter_status'): '';
		$filter['filter_grouping']= 'actress'; //fixed
		
		$config['total_rows'] = $this->Category_model->getTotalCategory($filter); 
	
		$this->pagination->initialize($config);
	
		$data['category'] = $this->Category_model->getCategory($filter,$content_limit,($config['per_page']));
		
		$data['styles'] = array(
		);
		
		$data['scripts'] = array(
		);

		$this->load->view('actress_type_list', $data);

	}
	
	public function add(){
		
		//validate first so it will not carry memory for $data
		$this->load->library('form_validation');
		
		//$data['language'] foreach this in future.
		$this->form_validation->set_rules('en_keyword', 'English Keyword', 'required|min_length[3]|max_length[225]');
		$this->form_validation->set_rules('jp_keyword', 'Japanese Keyword', 'required|min_length[2]|max_length[225]');
		
		
		if($this->input->post() && $this->form_validation->run($this)==true){ //true means there no error
			$this->load->model('option/category_model');
			$post_category = $this->input->post();
			$post_category['grouping'] = 'actress';
			
			$id = $this->Category_model->update($post_category, $this->input->post('id'));
			$this->session->set_flashdata('status_info', '<strong>Success! </strong> You have successfully added a Actress Type');
			$this->session->set_flashdata('status', 'success');
			
			redirect(site_url('option/actresstype/edit/'.$id));
		}else{
		
			//checkbox,radio,select inputs
			$data['status'] = 1;//$this->input->post('status'); set default active
			//$data['type'] = 'sub';//$this->input->post('type'); set default sub
			
			if($this->input->post() && $this->form_validation->run($this)==false){
				//fd($this->input->post());
				$data['status'] = $this->input->post('status');
				//$data['type'] = $this->input->post('type');
				$this->session->set_flashdata('status_info', '<strong>Error! </strong> Please fill up the form correctly');
				$this->session->set_flashdata('status', 'danger');
			}
			
		}
		
		$data['language']= $this->Category_model->getLanguage();
		
		$data['system_name'] = 'Add Actress Type';
		$data['page_title'] = 'Add Actress Type Form';
		
		$data['header'] = modules::run('common/header/index', $data);
		$data['sidebar_left'] = modules::run('common/sidebar_left/index', $data);
		$data['sidebar_right'] = modules::run('common/sidebar_right/index', $data);
		$data['footer'] = modules::run('common/footer/index', $data);
		$data['form_link'] = site_url('option/actresstype/add');
		
		//generate BrdCrmb
		$breadcrumbs = array(
			'home'	=>	site_url('user/user'),
			'Actress Type list'	=>	site_url('option/actresstype'),	
			'Add Actress Type'	=>	site_url('option/actresstype/add'),	
		);

		$data['breadcrumbs'] = gen_breadcrumbs($breadcrumbs);
		
		$this->load->view('actress_type_add',$data);
	
	}
	
	public function edit(){
		//validate first so it will not carry memory for $data
		$this->load->library('form_validation');
		$this->form_validation->set_rules('en_keyword', 'English Keyword', 'required|min_length[3]|max_length[225]');
		$this->form_validation->set_rules('jp_keyword', 'Japanese Keyword', 'required|min_length[2]|max_length[225]');
		
		$this->load->model('option/category_model');
		
		$data['rowdata'] =array();
		
		$id = $this->uri->segment(4);
		
		if($this->input->post() && $this->form_validation->run()==true){ //means there no error
			
			$post_category = $this->input->post();
			$post_category['grouping'] = 'actress';
			
			$id = $this->Category_model->update($post_category, $this->input->post('id'));
			$this->session->set_flashdata('status_info', '<strong>Success! </strong> You have modified the Actress Type detail .');
			$this->session->set_flashdata('status', 'success');
			
			$data['rowdata'] = $this->Category_model->getSingle($id); //include: video, category, actress, scene_content, location, downloads, video file location
			$data['status'] = $data['rowdata']['status'];
			//$data['type'] = $data['rowdata']['type'];
			
		
			redirect(site_url('option/actresstype/edit/'.$id));
		
		}else if($this->input->post() && $this->form_validation->run()==false){
			
			//checkbox,radio,select inputs
			$data['rowdata'] = $this->input->post();
			$data['status'] = $this->input->post('status');
			//$data['type'] = $this->input->post('type');
			
			$this->session->set_flashdata('status_info', '<strong>Error! </strong> Please fill up the form correctly');
			$this->session->set_flashdata('status', 'danger');
		
		}else{
		
			$data['rowdata'] = $this->Category_model->getSingle($id);
			$data['status'] = $this->input->post('status');
			//$data['type'] = $this->input->post('type');
			
		}
	
		$data['id'] = $id;
		$data['username'] = $this->session->userdata('name');
		$data['language']= $this->Category_model->getLanguage();
		
		$data['system_name'] = 'Edit Actress Type';
		$data['page_title'] = 'Edit Actress Type Form';
		
		$data['header'] = modules::run('common/header/index', $data);
		$data['sidebar_left'] = modules::run('common/sidebar_left/index', $data);
		$data['sidebar_right'] = modules::run('common/sidebar_right/index', $data);
		$data['footer'] = modules::run('common/footer/index', $data);
		$data['form_link'] = site_url('option/actresstype/edit/'.$this->uri->segment(4));
		
		$breadcrumbs = array(
			'home'	=>	site_url('option/actresstype'),
			'Actress Type list'	=>	site_url('option/actresstype'),	
			'Edit Actress Type'	=>	site_url('option/actresstype/edit'),	
		);

		$data['breadcrumbs'] = gen_breadcrumbs($breadcrumbs);
		
		$this->load->view('actress_type_edit',$data);
	
	}
	
	function delete(){
		$this->load->model('option/category_model');
		
		$id= $this->uri->segment(4);
		//$secret= $this->uri->segment(5); //
		
		//$check_timestamp = strtotime($this->Category_model->get_last_timestamp($id,'date_modified','av_video'));
		
		if($id){
			$this->Category_model->deleteActressType($id);
			
			$this->session->set_flashdata('status_info', '<strong>Success! </strong> You have successfully deleted the Actress Type.');
			$this->session->set_flashdata('status', 'success');
		}else{
			$this->session->set_flashdata('status_info', '<strong>Failed: </strong>Actress Type may have been updated or no longer exist.');
			$this->session->set_flashdata('status', 'danger');
		}
		
		redirect(site_url('option/actresstype'));
	}
	
}

?>