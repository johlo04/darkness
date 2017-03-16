<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class System extends MX_Controller {

	public function __construct() {
		parent::__construct();
		
	}

	public function index() {
		$data['system_name'] = 'System Management';
		$data['page_title'] = 'System Management';
		
		$data['header'] = modules::run('common/header/index', $data);
		$data['sidebar_left'] = modules::run('common/sidebar_left/index', $data);
		$data['sidebar_right'] = modules::run('common/sidebar_right/index', $data);
		$data['footer'] = modules::run('common/footer/index', $data);

		$breadcrumbs = array(
			'home' => site_url('users/user'),
			'general setting' => site_url('system'),
		);
		
		//validate first so it will not carry memory for $data

		if($this->input->post()){ //true means there no error
			//we have assumed that the current config is fixed, if there will be new config, add it first to the database and the form.
			$record = array();
			
			foreach($this->input->post() as $key => $value) {
				$value = ($key=='av_homepage_banner')? str_replace(URL_FILEMANAGER_SOURCE,'',$value) : $value; //custom
				$record[] = array('config_name' => $key,'value'=> $value);
			}
			
			$this->db->update_batch('system_config', $record, 'config_name');
			$this->system_config->refresh();
			
			$this->session->set_flashdata('status_info', '<strong>Success! </strong> You have modified the system config.');
			$this->session->set_flashdata('status', 'success');
			redirect(site_url('system/system'));
		}

		$data['breadcrumbs'] = gen_breadcrumbs($breadcrumbs);
		$data['rowdata'] = $this->system_config->getConfig();
		
		$data['rowdata_all'] = $this->system_config->getConfigAll();
		
		$this->load->view('general_view', $data);
	}
	
	//can be accessed thru ajax json
	public function addConfig(){
		
		$config['config_name'] = $this->input->post('config_name');
		$config['value'] = $this->input->post('config_value');
		
		$this->db->where('config_name', $config['config_name']);
		$this->db->from('system_config');
		
		$count= $this->db->count_all_results();
		if(empty($config['config_name']) || empty($config['value'])){
			$json['status']= 'danger';
			$json['status_message']= 'Config name or config value is empty!';
		}elseif($count>0){
			$json['status']= 'danger';
			$json['status_message']= 'Config: "'.$config['config_name']. '" already exist.';
		}else{ // add new
			$this->db->insert('system_config',$config);
			$json['status']= 'success';
			$json['status_message']= 'New Config: "'.$config['config_name']. '" has been added.';
		}
		
		echo json_encode($json);
	}
	
	//can be accessed thru ajax json
	public function clean_tinymce_textarea(){ //this is a dangerous one.
		$post_cols= explode('.',$this->input->post('system_table'));
		$column = $post_cols[1];
		$table = $post_cols[0];
		$current_keyword = $this->input->post('current_keyword'); //'http://10.0.0.223/avjunky/auction/'; //refers to anything but this will be use for url
		$new_keyword= $this->input->post('new_keyword'); //'http://av-junky.tv/auction/'; //refers to anything but this will be use for new url
		
		$json= array();
		if($this->clean_tinymce_url($column,$table,$current_keyword,$new_keyword)){
		
			$json['status'] = 'success';
			$json['status_message'] = 'You have successfully updated the system data.';

		}else{
			$json['status'] = 'danger';
			$json['status_message'] = 'Something went wrong. You are not allowed to make this update.';
		}
		
		json_header();
		echo json_encode($json);
	}
	
	private function clean_tinymce_url($column,$table,$current_keyword,$new_keyword){
		
		$allowed_columns = array('fullhd','hdlite','mobile','gallery_zip','scene_zip', 'clip_mp4','clip_webm','clip_ogv','clip_360_vr','full_mp4','full_webm','full_ogv','description'); //not fully controlled
		
		if(in_array($column,$allowed_columns)){
			$this->db->set($column, 'REPLACE('.$column.', \''.$current_keyword.'\' , \''.$new_keyword.'\' )', FALSE);
			$this->db->update($table);
			return true;
		}elseif($column=='all'){
		
			if($table=='av_video_downloads'){
				$allowed_columns = array('fullhd','hdlite','mobile','gallery_zip','scene_zip');
				for($x=0; $x<count($allowed_columns); $x++){
					$this->db->set($allowed_columns[$x], 'REPLACE('.$allowed_columns[$x].', \''.$current_keyword.'\' , \''.$new_keyword.'\' )', FALSE);
				}
				$this->db->update($table);
				return true;
			}
			
			if($table=='av_video_location'){
				$allowed_columns = array('clip_mp4','clip_webm','clip_ogv','clip_360_vr','full_mp4','full_webm','full_ogv');
				for($x=0; $x<count($allowed_columns); $x++){
					$this->db->set($allowed_columns[$x], 'REPLACE('.$allowed_columns[$x].', \''.$current_keyword.'\' , \''.$new_keyword.'\' )', FALSE);
				}
				$this->db->update($table);
				return true;
			}
			
			return false;
			
		}else{
		
			return false;
		}
	}

}

?>