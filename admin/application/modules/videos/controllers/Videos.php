<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Videos extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Videos_model');
		$this->module = $this->router->fetch_module();
		$this->group_permission->is_allow_access($this->module);
	}

	public function index() {
		
		$data['system_name'] = 'Videos';
		$data['page_title'] = 'Video List';
		$data['header'] = modules::run('common/header/index', $data);
		$data['sidebar_left'] = modules::run('common/sidebar_left/index', $data);
		$data['sidebar_right'] = modules::run('common/sidebar_right/index', $data);
		$data['footer'] = modules::run('common/footer/index', $data);

		$breadcrumbs = array(
			'home'	=>	site_url('users/user'),
			'Video List'	=>	site_url('videos/videos'),	
		);

		$data['breadcrumbs'] = gen_breadcrumbs($breadcrumbs);
		
		$this->load->library('pagination');
		
		$content_limit = ($this->uri->segment(3))? $this->uri->segment(3): 0;
		$config['base_url'] = site_url('videos/videos');
		$config['uri_segment'] = 3; //page
		$config['per_page'] = 10;
		$config['reuse_query_string'] = true;
		
		$filter = array();
		
		$data['filter_actress'] = $filter['filter_actress'] = ($this->input->get('filter_actress'))? $this->input->get('filter_actress'): '';
		$data['filter_video_name']= $filter['filter_video_name'] = ($this->input->get('filter_video_name'))? $this->input->get('filter_video_name'): '';
		$data['filter_status']= $filter['filter_status'] = ($this->input->get('filter_status'))? $this->input->get('filter_status'): '';
		
		$config['total_rows'] = $this->Videos_model->getTotalVideo($filter); 
		$data['actress_list'] = $this->Videos_model->getActress();
	
		$this->pagination->initialize($config);
	
		$data['videos'] = $this->Videos_model->getVideo($filter,$content_limit,$config['per_page']);
		
		$data['styles'] = array(
		);
		
		$data['scripts'] = array(
		);

		$this->load->view('video_list', $data);

	}
	
	public function add(){
		
		//validate first so it will not carry memory for $data
		$this->load->library('form_validation');
		
		//$data['language'] foreach this in future.
		$this->form_validation->set_rules('description[1][title]', 'English Video Title', 'required|min_length[3]|max_length[225]');
		$this->form_validation->set_rules('description[2][title]', 'Japanese Video Title', 'required|min_length[2]|max_length[225]');
		$this->form_validation->set_rules('category[0]', 'Main Category', 'required|empty_select_check');
		
		$this->form_validation->set_rules('video_duration', 'Video duration', 'required|video_duration_check');
		
		
		if($this->input->post() && $this->form_validation->run($this)==true){ //true means there no error
			$this->load->model('videos/videos_model');
			
			$id = $this->Videos_model->update($this->input->post(), $this->input->post('id'));
			$this->session->set_flashdata('status_info', '<strong>Success! </strong> You have successfully added a videos');
			$this->session->set_flashdata('status', 'success');
			
			redirect(site_url('videos/videos/edit/'.$id));
		}else{
		
			//checkbox,radio,select inputs
			$data['category'] = $this->input->post('category');
			$data['theme'] = $this->input->post('theme');
			$data['actress'] = $this->input->post('actress');
			$data['scene_content'] = $this->input->post('scene_content');
			$data['video_scenes'] = $this->input->post('video_scenes');
			$data['gallery'] = $this->input->post('gallery');
			$data['status'] = 1;//$this->input->post('status'); set default active
			
			if($this->input->post() && $this->form_validation->run($this)==false){
				//fd($this->input->post());
				$data['status'] = $this->input->post('status');
				$this->session->set_flashdata('status_info', '<strong>Error! </strong> Please fill up the form correctly');
				$this->session->set_flashdata('status', 'danger');
			}
			
		}
		
		$data['language']= $this->Videos_model->getLanguage();
		$data['main_category']= $this->Videos_model->getCategory('category','main');
		//$data['sub_category']= $this->Videos_model->getCategory('category','sub');
		$data['theme_category']= $this->Videos_model->getCategory('theme');
		$data['scene_category']= $this->Videos_model->getCategory('content'); //scene content
		$data['actress_list'] = $this->Videos_model->getActress();
		
		$data['system_name'] = 'Add Video';
		$data['page_title'] = 'Add Video Form';
		
		$data['header'] = modules::run('common/header/index', $data);
		$data['sidebar_left'] = modules::run('common/sidebar_left/index', $data);
		$data['sidebar_right'] = modules::run('common/sidebar_right/index', $data);
		$data['footer'] = modules::run('common/footer/index', $data);
		$data['form_link'] = site_url('videos/videos/add');
		
		//generate BrdCrmb
		$breadcrumbs = array(
			'home'	=>	site_url('videos/videos'),
			'videos list'	=>	site_url('videos/videos'),	
			'Add Video'	=>	site_url('videos/videos/add'),	
		);

		$data['breadcrumbs'] = gen_breadcrumbs($breadcrumbs);
		
		$this->load->view('video_add',$data);
	
	}
	
	public function edit(){
		//validate first so it will not carry memory for $data
		$this->load->library('form_validation');
		$this->form_validation->set_rules('description[1][title]', 'English Video Title', 'required|min_length[3]|max_length[225]');
		$this->form_validation->set_rules('description[2][title]', 'Japanese Video Title', 'required|min_length[2]|max_length[225]');
		$this->form_validation->set_rules('category[0]', 'Main Category', 'required|empty_select_check');
		
		$this->load->model('videos/Videos_model');
		
		$data['rowdata'] =array();
		
		$id = $this->uri->segment(4);
		
		if($this->input->post() && $this->form_validation->run()==true){ //means there no error
			
			$id = $this->Videos_model->update($this->input->post(), $this->input->post('id'));
			$this->session->set_flashdata('status_info', '<strong>Success! </strong> You have modified the videos detail .');
			$this->session->set_flashdata('status', 'success');
			
			$data['rowdata'] = $this->Videos_model->getSingle($id); //include: video, category, actress, scene_content, location, downloads, video file location
			
			$data['theme'] = $data['rowdata']['theme'];
			$data['actress'] = $data['rowdata']['actress'];
			$data['scene_content'] = $data['rowdata']['scene_content'];
			$data['description'] = $this->Videos_model->getDescription($id);
			$data['status'] = $data['rowdata']['status'];
			
			$data['gallery'] = $this->Videos_model->getGallery($id);
			$data['video_scenes'] = $this->Videos_model->getVideoScenes($id);
			
			redirect(site_url('videos/videos/edit/'.$id));
		
		}else if($this->input->post() && $this->form_validation->run()==false){
			
			$data['rowdata'] = $this->input->post();
			$data['description'] = $this->input->post('description');
			
			//checkbox,radio,select inputs
			$data['category'] = $this->input->post('category');
			$data['theme'] = $this->input->post('theme');
			$data['actress'] = $this->input->post('actress');
			$data['scene_content'] = $this->input->post('scene_content');
			$data['video_scenes'] = $this->input->post('video_scenes');
			$data['gallery'] = $this->input->post('gallery');
			$data['status'] = $this->input->post('status');
			
			$this->session->set_flashdata('status_info', '<strong>Error! </strong> Please fill up the form correctly');
			$this->session->set_flashdata('status', 'danger');
		
		}else{
		
			$data['rowdata'] = $this->Videos_model->getSingle($id); //include: video, category, actress, scene_content, location, downloads, video file location
			
			$data['category'] = $data['rowdata']['category'];
			$data['theme'] = $data['rowdata']['theme'];
			$data['actress'] = $data['rowdata']['actress'];
			$data['scene_content'] = $data['rowdata']['scene_content'];
			$data['description'] = $this->Videos_model->getDescription($id);
			$data['status'] = $data['rowdata']['status'];
			
			$data['gallery'] = $this->Videos_model->getGallery($id);
			$data['video_scenes'] = $this->Videos_model->getVideoScenes($id);
			
		}
	
		$data['id'] = $id;
		$data['username'] = $this->session->userdata('name');
		$data['language']= $this->Videos_model->getLanguage();
		$data['vidtracking']= $this->Videos_model->getVideoTrackingSingle($id);
		
		$data['main_category']= $this->Videos_model->getCategory('category','main');
		//$data['sub_category']= $this->Videos_model->getCategory('category','sub');
		$data['theme_category']= $this->Videos_model->getCategory('theme');
		$data['scene_category']= $this->Videos_model->getCategory('content'); //scene content
		$data['actress_list'] = $this->Videos_model->getActress();
		
		$data['system_name'] = 'Edit Video';
		$data['page_title'] = 'Edit Video Form';
		
		$data['header'] = modules::run('common/header/index', $data);
		$data['sidebar_left'] = modules::run('common/sidebar_left/index', $data);
		$data['sidebar_right'] = modules::run('common/sidebar_right/index', $data);
		$data['footer'] = modules::run('common/footer/index', $data);
		$data['form_link'] = site_url('videos/videos/edit/'.$this->uri->segment(4));
		
		$breadcrumbs = array(
			'home'	=>	site_url('videos/videos'),
			'Videos list'	=>	site_url('videos/videos'),	
			'Edit Video'	=>	site_url('videos/videos/edit'),	
		);

		$data['breadcrumbs'] = gen_breadcrumbs($breadcrumbs);
		
		$this->load->view('video_edit',$data);
	
	}
	
	function delete(){
		$this->load->model('videos/Videos_model');
		
		$id= $this->uri->segment(4);
		$secret= $this->uri->segment(5); //
		
		$check_timestamp = strtotime($this->Videos_model->get_last_timestamp($id,'date_modified','av_video'));
		
		if($check_timestamp==$secret){
			$this->Videos_model->deleteVideo($id);
			
			$this->session->set_flashdata('status_info', '<strong>Success! </strong> You have successfully deleted the videos.');
			$this->session->set_flashdata('status', 'success');
		}else{
			$this->session->set_flashdata('status_info', '<strong>Failed: </strong>Video may have been updated or no longer exist.');
			$this->session->set_flashdata('status', 'danger');
		}
		
		redirect(site_url('videos/videos'));
	}
	
	public function set_featured(){
		$id = $this->uri->segment(4);
		
		if($this->Videos_model->updateFeaturedVideo($id)){
		
			$this->session->set_flashdata('status_info', '<strong>Success! </strong> You have successfully updated the featured video.');
			$this->session->set_flashdata('status', 'success');
		}else{
			$this->session->set_flashdata('status_info', '<strong>Failed: </strong>Video may have been updated or no longer exist.');
			$this->session->set_flashdata('status', 'danger');
		}
	}
	
	public function ___load_auction_tracking(){
		$this->load->model('videos/Videos_model');
		$id = $this->uri->segment(4);
		$data['bidding_info'] = $this->Videos_model->getTopBillingSingle($id);
		//$data['videos'] =array();
		$this->load->view('auction_tracking', $data, FALSE);
	
	}
	
	public function ___load_bid_tracking(){
		$this->load->model('videos/Videos_model');
		$id = $this->uri->segment(4);
		$data['bidding_info'] = $this->Videos_model->getBid($id);
		//$data['videos'] =array();
		$this->load->view('bid_tracking', $data, FALSE);
	
	}
	
	public function load_comment_list(){
		$this->load->model('videos/Videos_model');
		$id = $this->uri->segment(4);
		$data['comments'] = $this->Videos_model->getComments($id);
	
		$this->load->view('comment_list', $data, FALSE);
	
	}

	public function comment_form(){ //form modal
		$this->load->model('videos/Videos_model');
		$data['parent_id'] = $this->uri->segment(4); //comment_id
		$data['ref_id'] = $this->uri->segment(5);//video_id
		$data['username'] = $this->uri->segment(6); //Username who posted
		
		//$data['current_comment'] = '';//$this->Videos_model->getComments($id); if my approched on current is unsafe use this. 
		$data['current_comment'] = phantom_db_picker('av_review','review_description',array('id'=>$data['parent_id']));
		
		$this->load->view('comment_reply', $data, FALSE);
	
	}
	
	public function post_comment(){
		$this->load->model('videos/Videos_model');
		
		if($this->input->post('comment_option')==1){ //1 means reply to comment
			$data['parent_id'] = $this->uri->segment(5);
		}else{ //new comment
			//nothing
		}
		
		$data['review_description'] = $this->input->post('review_description'); //review_description
		$data['ref_id'] = $this->uri->segment(4); //video id
		
		//$data['comments'] = '';//$this->Videos_model->getComments($id);
		if($this->group_permission->is_allow_modify($this->module)){
			
			if($this->Videos_model->setVideoComment($data)){ 
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
			
			if($this->Videos_model->deleteComment($id)){
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
			
			if($this->Videos_model->setCommentStatus($data,$id)){
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
	
	
}

?>