<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * 
 * @property Login_control $Login_control
 * @property Aauth $aauth Description
 * @version 1.0
 */
class Auth extends MX_Controller {

    public function __construct() {
        parent::__construct();
        // Your own constructor code
	
        $this->load->library("Aauth");
    }

    public function index() {
		
		$data['system_title'] = titleHeader($this->system_config->getConfig('system_name'));
		$data['page_title'] = $this->system_config->getConfig('system_name').' Login';
		
		$data['styles'] = array(
			'http://fonts.googleapis.com/css?family=Roboto:300italic,400italic,300,400,500,700,900',
			base_url('/assets/css/theme-cleancms/bootstrap.css?1422792965'),
			base_url('/assets/css/theme-cleancms/materialadmin.css?1425466319'),
			base_url('/assets/css/theme-cleancms/font-awesome.min.css?1422529194'),
			base_url('/assets/css/theme-auction/material-design-iconic-font.min.css?1421434286'),
			base_url('/assets/css/styles.css')
		);

		$data['scripts'] = array(
			base_url('/assets/js/libs/jquery/jquery-1.11.2.min.js'),
			base_url('/assets/js/libs/jquery/jquery-migrate-1.2.1.min.js'),
			base_url('/assets/js/libs/bootstrap/bootstrap.min.js')
		);
		
		
        if($this->aauth->is_loggedin()) {
            redirect('users/user');
        } else {
            $data['page_header'] = 'Login Form';
            $this->load->view('users/login', $data);
        }

    }

	public function login() {
		
		$data['styles'] = array(
			'http://fonts.googleapis.com/css?family=Roboto:300italic,400italic,300,400,500,700,900',
			base_url('/assets/css/theme-cleancms/bootstrap.css?1422792965'),
			base_url('/assets/css/theme-cleancms/materialadmin.css?1425466319'),
			base_url('/assets/css/theme-cleancms/font-awesome.min.css?1422529194'),
			base_url('/assets/css/theme-cleancms/libs/select2/select2.css'),
			base_url('/assets/css/styles.css')
		);

		$data['scripts'] = array(
			base_url('/assets/js/libs/jquery/jquery-1.11.2.min.js'),
			base_url('/assets/js/libs/jquery/jquery-migrate-1.2.1.min.js'),
			base_url('/assets/js/libs/bootstrap/bootstrap.min.js')
		);

		$data['system_title'] = titleHeader($this->system_config->getConfig('system_name'));
		$data['page_title'] = $this->system_config->getConfig('system_name').' Login';
		
		
        $identifier = $this->input->post('username');
        $password = $this->input->post('password');
		
		
        if ($this->aauth->login($identifier, $password, true)){
            redirect('users/user');
        } else {
            $note = $this->aauth->get_errors_array();
            $this->session->set_flashdata('note', $note[0]);

            $data['page_header'] = 'Login Form';
            $this->load->view('users/login', $data);

        }

    }

	public function create_user() {

        if ( $this->aauth->create_user('rochellecanale11@gmail.com','1qaz2wsx','rochellecanale') ){
             echo 'OK. Succesful register';
        } else {
            echo 'Please fix the issues below';
            print_r($this->aauth->get_errors_array());
        }            
    }

    public function allow() {

        $this->aauth->allow_group('public', 'read_comment');
        $this->aauth->allow_group('mods', 'delete_comment');

    }

    public function logout() {
        $this->aauth->logout();
        $this->session->set_userdata('note', 'Account has been successfully logged out.');

        redirect('users/auth');
    }

}