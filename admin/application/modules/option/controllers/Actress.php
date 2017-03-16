<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Actress extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Actress_model');
		$this->module = $this->router->fetch_module();
		$this->group_permission->is_allow_access($this->module);
	}

	public function index() {
		
		$data['system_name'] = 'Actress';
		$data['page_title'] = 'Actress List';
		$data['header'] = modules::run('common/header/index', $data);
		$data['sidebar_left'] = modules::run('common/sidebar_left/index', $data);
		$data['sidebar_right'] = modules::run('common/sidebar_right/index', $data);
		$data['footer'] = modules::run('common/footer/index', $data);

		$breadcrumbs = array(
			'home'	=>	site_url('users/user'),
			'Actress List'	=>	site_url('option/actress'),	
		);

		$data['breadcrumbs'] = gen_breadcrumbs($breadcrumbs);
		
		$this->load->library('pagination');
		
		$content_limit = ($this->uri->segment(3))? $this->uri->segment(3): 0;
		$config['base_url'] = site_url('option/actress');
		$config['uri_segment'] = 3; //page
		$config['per_page'] = 10;
		$config['reuse_query_string'] = true;
		

		$filter = array();
		
		$data['filter_actress'] = $filter['filter_actress'] = ($this->input->get('filter_actress'))? $this->input->get('filter_actress'): '';
		$data['filter_actress_name']= $filter['filter_actress_name'] = ($this->input->get('filter_actress_name'))? $this->input->get('filter_actress_name'): '';
		$data['filter_status']= $filter['filter_status'] = ($this->input->get('filter_status'))? $this->input->get('filter_status'): '';
		
		$config['total_rows'] = $this->Actress_model->getTotalActress($filter); 
	
		$this->pagination->initialize($config);
	
		$data['actress'] = $this->Actress_model->getActress($filter,$content_limit,$config['per_page']);

		$data['styles'] = array(
		);
		
		$data['scripts'] = array(
		);

		$this->load->view('actress_list', $data);

	}
	
	public function add(){
		
		//validate first so it will not carry memory for $data
		$this->load->library('form_validation');
		
		//$data['language'] foreach this in future.
		$this->form_validation->set_rules('description[1][name]', 'English Actress Title', 'required|min_length[3]|max_length[225]');
		$this->form_validation->set_rules('description[2][name]', 'Japanese Actress Title', 'required|min_length[2]|max_length[225]');
		
		if($this->input->post() && $this->form_validation->run($this)==true){ //true means there no error
			$this->load->model('option/actress_model');
			
			$id = $this->Actress_model->update($this->input->post(), $this->input->post('id'));
			$this->session->set_flashdata('status_info', '<strong>Success! </strong> You have successfully added a videos');
			$this->session->set_flashdata('status', 'success');
			
			redirect(site_url('option/actress/edit/'.$id));
		}else{
		
			//checkbox,radio,select inputs
			$data['category'] = $this->input->post('category');
			$data['gallery'] = $this->input->post('gallery');
			$data['status'] = 1;//$this->input->post('status'); set default active
			
			if($this->input->post() && $this->form_validation->run($this)==false){
				//fd($this->input->post());
				$data['status'] = $this->input->post('status');
				$this->session->set_flashdata('status_info', '<strong>Error! </strong> Please fill up the form correctly');
				$this->session->set_flashdata('status', 'danger');
			}
			
		}
		
		$data['language']= $this->Actress_model->getLanguage();
		
		$data['system_name'] = 'Add Actress';
		$data['page_title'] = 'Add Actress Form';
		$data['actress_category']= $this->Actress_model->getCategory('actress');
		
		$data['header'] = modules::run('common/header/index', $data);
		$data['sidebar_left'] = modules::run('common/sidebar_left/index', $data);
		$data['sidebar_right'] = modules::run('common/sidebar_right/index', $data);
		$data['footer'] = modules::run('common/footer/index', $data);
		$data['form_link'] = site_url('option/actress/add');
		
		
		//generate BrdCrmb
		$breadcrumbs = array(
			'home'	=>	site_url('option/actress'),
			'actress list'	=>	site_url('option/actress'),	
			'Add Actress'	=>	site_url('option/actress/add'),	
		);

		$data['breadcrumbs'] = gen_breadcrumbs($breadcrumbs);
		
		$this->load->view('actress_add',$data);
	
	}
	
	public function edit(){
		//validate first so it will not carry memory for $data
		$this->load->library('form_validation');
		$this->form_validation->set_rules('description[1][name]', 'English Actress Title', 'required|min_length[3]|max_length[225]');
		$this->form_validation->set_rules('description[2][name]', 'Japanese Actress Title', 'required|min_length[2]|max_length[225]');
		
		$this->load->model('videos/Actress_model');
		
		$data['rowdata'] =array();
		
		$id = $this->uri->segment(4);
		
		if($this->input->post() && $this->form_validation->run()==true){ //means there no error
			
			$id = $this->Actress_model->update($this->input->post(), $this->input->post('id'));
			$this->session->set_flashdata('status_info', '<strong>Success! </strong> You have modified the videos detail .');
			$this->session->set_flashdata('status', 'success');
			
			$data['rowdata'] = $this->Actress_model->getSingle($id); //include: video, category, actress, scene_content, location, downloads, video file location
			
			$data['description'] = $this->Actress_model->getDescription($id);
			$data['status'] = $data['rowdata']['status'];
			$data['category'] = $data['rowdata']['category'];
			
			$data['gallery'] = $this->Actress_model->getGallery($id);
			
			redirect(site_url('option/actress/edit/'.$id));
		
		}else if($this->input->post() && $this->form_validation->run()==false){
			
			$data['rowdata'] = $this->input->post();
			$data['description'] = $this->input->post('description');
			
			//checkbox,radio,select inputs
			$data['gallery'] = $this->input->post('gallery');
			$data['category'] = $this->input->post('category');
			$data['status'] = $this->input->post('status');
			
			$this->session->set_flashdata('status_info', '<strong>Error! </strong> Please fill up the form correctly');
			$this->session->set_flashdata('status', 'danger');
		
		}else{
		
			$data['rowdata'] = $this->Actress_model->getSingle($id); //include: video, category, actress, scene_content, location, downloads, video file location
			
			$data['description'] = $this->Actress_model->getDescription($id);
			$data['status'] = $data['rowdata']['status'];
			$data['gallery'] = $this->Actress_model->getGallery($id);
			$data['category'] = $data['rowdata']['category'];
			
		}
	
		$data['id'] = $id;
		$data['username'] = $this->session->userdata('name');
		$data['language']= $this->Actress_model->getLanguage();
		$data['vidtracking']= $this->Actress_model->getActressTrackingSingle($id);
		
		$data['system_name'] = 'Edit Actress';
		$data['page_title'] = 'Edit Actress Form';
		$data['actress_category']= $this->Actress_model->getCategory('actress');
		
		
		$data['header'] = modules::run('common/header/index', $data);
		$data['sidebar_left'] = modules::run('common/sidebar_left/index', $data);
		$data['sidebar_right'] = modules::run('common/sidebar_right/index', $data);
		$data['footer'] = modules::run('common/footer/index', $data);
		$data['form_link'] = site_url('option/actress/edit/'.$this->uri->segment(4));
		
		$breadcrumbs = array(
			'home'	=>	site_url('option/actress'),
			'Actress list'	=>	site_url('option/actress'),	
			'Edit Actress'	=>	site_url('option/actress/edit'),	
		);

		$data['breadcrumbs'] = gen_breadcrumbs($breadcrumbs);
		
		$this->load->view('actress_edit',$data);
	
	}
	
	function delete(){
		$this->load->model('videos/Actress_model');
		
		$id= $this->uri->segment(4);
		$secret= $this->uri->segment(5); //
		
		$check_timestamp = strtotime($this->Actress_model->get_last_timestamp($id,'date_modified','av_video'));
		
		if($check_timestamp==$secret){
			$this->Actress_model->deleteActress($id);
			
			$this->session->set_flashdata('status_info', '<strong>Success! </strong> You have successfully deleted the actress.');
			$this->session->set_flashdata('status', 'success');
		}else{
			$this->session->set_flashdata('status_info', '<strong>Failed: </strong>Actress may have been updated or no longer exist.');
			$this->session->set_flashdata('status', 'danger');
		}
		
		redirect(site_url('option/actress'));
	}
	
	public function load_comment_list(){
		$this->load->model('videos/Actress_model');
		$id = $this->uri->segment(4);
		$data['comments'] = $this->Actress_model->getComments($id);
	
		$this->load->view('comment_list', $data, FALSE);
	
	}

	public function comment_form(){ //form modal
		$this->load->model('videos/Actress_model');
		$data['parent_id'] = $this->uri->segment(4); //comment_id
		$data['ref_id'] = $this->uri->segment(5);//actress_id
		$data['username'] = $this->uri->segment(6); //Username who posted
		
		//$data['current_comment'] = '';//$this->Actress_model->getComments($id); if my approched on current is unsafe use this. 
		$data['current_comment'] = phantom_db_picker('av_review','review_description',array('id'=>$data['parent_id']));
		
		$this->load->view('comment_reply', $data, FALSE);
	
	}
	
	public function post_comment(){
		$this->load->model('videos/Actress_model');
		
		if($this->input->post('comment_option')==1){ //1 means reply to comment
			$data['parent_id'] = $this->uri->segment(5);
		}else{ //new comment
			//nothing
		}
		
		$data['review_description'] = $this->input->post('review_description'); //review_description
		$data['ref_id'] = $this->uri->segment(4); //video id
		
		//$data['comments'] = '';//$this->Actress_model->getComments($id);
		if($this->group_permission->is_allow_modify($this->module)){
			
			if($this->Actress_model->setActressComment($data)){ 
				$json['status'] = 'success';
				$json['message'] = 'You have successfully posted a comment/reply.';
			}else{
				$json['status'] = 'danger';
				$json['message'] = 'Something went wrong. Please refresh or try again';
			}
			
		}else{
			$json['status'] = 'danger';
			$json['message'] = 'You dont have permission to delete.';
		}
		
		echo json_encode($json);
	
	}
	
	public function delete_comment(){
		$id = $this->uri->segment(4);
	
		if($this->group_permission->is_allow_delete($this->module)){
			
			if($this->Actress_model->deleteComment($id)){
				$json['status'] = 'success';
				$json['message'] = 'You have successfully delete the comment.';
			}else{
				$json['status'] = 'danger';
				$json['message'] = 'Something went wrong. Please refresh or try again';
			}
			
		}else{
			$json['status'] = 'danger';
			$json['message'] = 'You dont have permission to delete.';
		}
		
		echo json_encode($json);
	}
	
	public function status_comment(){
		$id = $this->uri->segment(4);
		$data['status'] = ($this->uri->segment(5)==1)? 0:1; //if on => off, viceversa
		
		if($this->group_permission->is_allow_special($this->module)){
			
			if($this->Actress_model->setCommentStatus($data,$id)){
				$json['status'] = 'success';
				$json['message'] = 'You have successfully <b>'.(($data['status'])? 'ACTIVATE': 'HIDE').'</b> the comment.';
			}else{
				$json['status'] = 'danger';
				$json['message'] = 'Something went wrong. Please refresh or try again';
			}
			
		}else{
			$json['status'] = 'danger';
			$json['message'] = 'You dont have permission to process this action.';
		}
		
	
		echo json_encode($json);
		
	}
	
	public function set_featured(){
		$id = $this->uri->segment(4);
		
		if($this->Actress_model->updateFeaturedActress($id)){
		
			$this->session->set_flashdata('status_info', '<strong>Success! </strong> You have successfully updated the featured actress.');
			$this->session->set_flashdata('status', 'success');
		}else{
			$this->session->set_flashdata('status_info', '<strong>Failed: </strong>Video may have been updated or no longer exist.');
			$this->session->set_flashdata('status', 'danger');
		}
	}
	
}

?>