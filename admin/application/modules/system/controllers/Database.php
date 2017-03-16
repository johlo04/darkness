<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Database extends MX_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->dbutil();
	}

	public function index() {
		$data['system_name'] = 'Database Management';
		$data['page_title'] = 'Database Management';
		
		$data['header'] = modules::run('common/header/index', $data);
		$data['sidebar_left'] = modules::run('common/sidebar_left/index', $data);
		$data['sidebar_right'] = modules::run('common/sidebar_right/index', $data);
		$data['footer'] = modules::run('common/footer/index', $data);

		$breadcrumbs = array(
			'home' => site_url('users/user'),
			'Database Management' => site_url('database'),
		);
		
		
		$table = $this->db->query("SHOW TABLES FROM `" .$this->db->database  . "`");
		$data['tables'] = $table->result_array();
		//fd($data['tables']);
		$data['breadcrumbs'] = gen_breadcrumbs($breadcrumbs);
		
		$this->load->view('database_view', $data);
	}
	
	public function backup(){
			
			$isDownloadable =($this->uri->segment(4))? $this->uri->segment(4): 0; //if 0 not gonna get a download link
		
			$tables = ($this->input->post('table'))? $this->input->post('table'): array();
			
			$prefs = array(
					'tables'      => array_values($tables),
					'format'      => 'zip',             
					'filename'    => 'avauction_db_backup.sql'
			  );
			
			$backup = $this->dbutil->backup($prefs); 
			$timetrack = date("Y-m-d-H-i-s");
			$name = $this->input->post('filename');
			$db_name = (count($tables)>0)? 'part-': 'full-';
			$db_name .= (empty($name))? 'backup-on-'.$timetrack.'.zip' : $name.'.zip';
			$path= str_replace('admin/','', (FCPATH));
			$save = $path.'databases/backup/'.$db_name;
			
			$this->load->helper('file');
			write_file($save, $backup); 
			
		
			$json['status'] = 'success';
			$json['message'] = 'You have successfull created a backup file.';
			
			if($isDownloadable){ 
			
				$json['downloadlink'] = $db_name;
				
				$this->writeTrack('Backup:'.' | '.$timetrack.' | '.$this->session->userdata('name').' |'.$db_name);
			}else{
				$json['downloadlink'] = '';
			}
			
			echo json_encode($json);
	}
	
	public function download(){
		$this->load->helper('download');
		
		$timetrack = date("Y-m-d-H-i-s");
		
		if($this->session->userdata('id')) { //login user only

			$data['file_name'] = $this->uri->segment(4);
			$path= str_replace('admin/','', (FCPATH));
			$content = file_get_contents($path.'databases/backup/'.$data['file_name']); // Read the file's contents
				
			$this->writeTrack('Download:'.' | '.$timetrack.' |'.$this->session->userdata('name').' | '.$data['file_name']);
			
			force_download($data['file_name'],$content);
			
			
		}else{
			$this->writeTrack('Unauthorized download from: '.' | '.$timetrack.' '.$_SERVER['REMOTE_ADDR']);
		}
	}
	
	private function writeTrack($data){
		$this->load->helper('file');
		$file_name = 'track-for-'. date("Y-m") .'.txt';
		$path= './databases/track/'.$file_name;
		
		write_file($path, $data."\r\n", 'a+');
		
	}
	
	public function repair(){
		$timetrack = date("Y-m-d-H-i-s");
		$tables = ($this->input->post('table'))? $this->input->post('table'): array();
		
		if (count($tables)>0){
			$error = 0;
			foreach($tables as $key => $value ){
				
				if ($this->dbutil->repair_table($value)){
					//do nothing
					
				}else{
					$this->writeTrack('Failed to repair table: '.$value.' | '.$timetrack.' ');
					$error = 1;
				}
			}
			$json['status'] = ($error)? 'danger':'success'; 
			$json['message'] = ($error)? 'There are some problem with repairing table': 'Successfully repair the database table.';
			
		}else{
			$json['status'] = 'danger';
			$json['message'] = 'No table to repair.';
		}
		
		echo json_encode($json);
	}

	public function optimized(){
		$timetrack = date("Y-m-d-H-i-s");
		
		$tables = ($this->input->post('table'))? $this->input->post('table'): array();
		
		if (count($tables)>0){
			
			$error = 0;
			foreach($tables as $key => $value ){
				
				if ($this->dbutil->optimize_table($value)){
					//do nothing
					
				}else{
					$this->writeTrack('Failed to optimize table: '.$value.' | '.$timetrack.' ');
					$error = 1;
				}
			}
			$json['status'] = ($error)? 'danger':'success'; 
			$json['message'] = ($error)? 'There are some problem with optimizing table': 'Successfully optimize the database table.';
			
		}else{
		
			$result= $this->dbutil->optimize_database();
			
			$json['status'] = ($result)? 'danger':'success'; 
			$json['message'] = ($result)? 'There are some problem with optimizing the database': 'Successfully optimize the database.';
		}
		
		echo json_encode($json);
	}
	
	public function excelExport(){
		
		$this->load->helper('download');
		
		$timetrack = date("Y-m-d-H-i-s");
		
		$this->load->dbutil();
        $query = $this->db->query("SELECT * FROM av_video");
        $csv = $this->dbutil->csv_from_result($query);
        $this->load->helper('download');
        force_download('tester.csv', $csv);
		
		/*if($this->session->userdata('id')) { //login user only
		
			$data['file_name'] = $this->uri->segment(4);
			$path= str_replace('admin/','', (FCPATH));
			$content = file_get_contents($path.'databases/backup/'.$data['file_name']); // Read the file's contents
				
			$this->writeTrack('Download:'.' | '.$timetrack.' |'.$this->session->userdata('name').' | '.$data['file_name']);
			
			force_download($data['file_name'],$content);
			
			
		}else{
			$this->writeTrack('Unauthorized download from: '.' | '.$timetrack.' '.$_SERVER['REMOTE_ADDR']);
		}
		*/	
	}
	

}

?>