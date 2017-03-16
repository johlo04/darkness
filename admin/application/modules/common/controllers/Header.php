<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Header extends MX_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->language('common', 'english');
		$this->load->library('User_Lib');
		
		$this->load->library('Aauth');
		$this->load->library('Auction');
		//$this->load->model('contracts/Contracts_model');
	}

	public function index($data = array()) {

		$userid = $this->session->userdata('id');

		$group_name = $this->aauth->get_user_group_name();

		$data['system_title'] = isset($data['system_name'])? $data['system_name']. ' | '.$this->system_config->getConfig('system_name') : $this->system_config->getConfig('system_name');
		$data['page_title'] = isset($data['page_title'])? $data['page_title'] : $this->system_config->getConfig('system_name');
		
		
		$data['header_title'] = titleHeader($this->system_config->getConfig('system_name'));
		
		$data['admin_name'] = $this->session->userdata('name');
		$data['user_group'] = $group_name['name'];

		$data['profile'] = site_url('users/user/edit_user?user_id=' . $userid);
		$data['homepage'] = str_replace('/admin','',base_url());
		
		$data['notification'] = array();
		//$officer_assigned_status = $this->Contracts_model->officer_assigned($this->session->userdata('id'), date('Y-m-d'));
		
		$stat_count = $this->notification->getCountNewNotication($this->session->userdata('id'));
		$officer_assigned_status = $this->notification->getNotification($this->session->userdata('id')); 

		if($officer_assigned_status && count($officer_assigned_status) > 0) {
			$data['notification']= $officer_assigned_status;
		}
		
		$data['notify_counter'] = $stat_count;
		//fp($data['notification']);
	
		$data['styles'] = array(
			'http://fonts.googleapis.com/css?family=Roboto:300italic,400italic,300,400,500,700,900',
			base_url('/assets/css/theme-cleancms/bootstrap.css?1422792965'),
			//base_url('/assets/css/theme-cleancms/libs/bootstrap-datepicker/datepicker3.css'),
			base_url('/assets/css/theme-cleancms/libs/bootstrap-datetimepicker/bootstrap-datetimepicker.css'),
			base_url('/assets/css/theme-cleancms/materialadmin.css?1425466319'),
			base_url('/assets/css/theme-cleancms/font-awesome.min.css?1422529194'),
			base_url('/assets/css/theme-cleancms/material-design-iconic-font.min.css?1421434286'),
			base_url('/assets/css/theme-cleancms/animate.css'),

			// base_url('/assets/css/theme-cleancms/libs/DataTables/jquery.DataTables.css'),
			// base_url('/assets/css/theme-cleancms/libs/DataTables/extensions/DataTables.tableTools.css'),
			// base_url('/assets/css/theme-cleancms/libs/DataTables/extensions/DataTables.colVis.css'),
			//base_url('/assets/resources/DataTables/datatables.min.css'),
			//base_url('/assets/resources/DataTables/Responsive-2.0.2/css/responsive.bootstrap.css'),

			//base_url('/assets/css/theme-cleancms/libs/dropzone/dropzone-theme.css?1424887864'),
			base_url('/assets/css/theme-cleancms/libs/toastr/toastr.css'),
			base_url('/assets/css/theme-cleancms/libs/bootstrap-tagsinput/bootstrap-tagsinput.css'),
			base_url('/assets/css/theme-cleancms/libs/multi-select/multi-select.css'),
			base_url('/assets/css/theme-cleancms/libs/select2/select2.css'),
			base_url('/assets/css/theme-cleancms/libs/select2/select2.css'),
			//base_url('/assets/css/theme-cleancms/libs/animsition/animsition.min.css'),
			base_url('/assets/css/styles.css')
		);

		$data['scripts'] = array(
			base_url('/assets/js/libs/jquery/jquery-1.11.2.min.js'),
			base_url('/assets/js/libs/jquery-ui/jquery-ui.min.js'),
			base_url('/assets/js/libs/jquery-ui/jquery.confirm.min.js'),
			base_url('/assets/js/libs/jquery/jquery-migrate-1.2.1.min.js'),
			base_url('/assets/js/libs/bootstrap/bootstrap.min.js'),
			//base_url('/assets/js/libs/bootstrap-datepicker/bootstrap-datepicker.js'),
			//base_url('/assets/js/libs/moment/moment.js'),
			base_url('/assets/js/libs/moment/moment.js'),
			base_url('/assets/js/libs/moment-timezone/moment-timezone.js'),
			//base_url('/assets/js/libs/moment/moment-timezone-with-data-2020.min.js'), would cause error on edit/add page
			base_url('/assets/js/libs/countdownjs/countdown.min.js'),
			base_url('/assets/js/libs/moment-countdown/dist/moment-countdown.min.js'),
			
			//base_url('/assets/js/libs/moment/moment-countdown.js'),
			//base_url('/assets/js/libs/moment/moment-with-locales.min.js'),

			base_url('/assets/js/libs/bootstrap-datetimepicker/bootstrap-datetimepicker.js'),
			//base_url('/assets/js/libs/dropzone/dropzone.min.js'),
			//base_url('/assets/js/libs/DataTables/jquery.DataTables.min.js'),
			//base_url('/assets/resources/DataTables/datatables.min.js'),

			base_url('/assets/js/libs/toastr/toastr.js'),
			base_url('/assets/js/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js'),
			base_url('/assets/js/libs/multi-select/jquery.multi-select.js'),
			base_url('/assets/js/libs/select2/select2.js'),
			//base_url('/assets/js/libs/animsition/animsition.min.js'),
			base_url('/assets/js/script.js')
		);

		$this->load->view('common/header', $data);

	}

}

?>