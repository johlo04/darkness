<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Filemanager extends MX_Controller {

	public function __construct() {
		parent::__construct();
		
		
	}

	public function index() {
		$data['system_name'] = 'File Manager';
		$data['page_title'] = 'File Manager';
		
		$data['header'] = modules::run('common/header/index', $data);
		$data['sidebar_left'] = modules::run('common/sidebar_left/index', $data);
		$data['sidebar_right'] = modules::run('common/sidebar_right/index', $data);
		$data['footer'] = modules::run('common/footer/index', $data);

		$breadcrumbs = array(
			'home' => site_url('users/user'),
			'general setting' => site_url('system'),
		);
		
		
		$this->load->view('filemanager', $data);
	}

}

?>