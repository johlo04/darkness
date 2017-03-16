<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Footer extends MX_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index($data = array()) {

		$data['scripts'] = array(
			//base_url('/assets/js/libs/bootbox.min.js'),
			base_url('/assets/js/libs/spin.js/spin.min.js'),
			base_url('/assets/js/libs/autosize/jquery.autosize.min.js'),
			//base_url('/assets/js/libs/flot/jquery.flot.min.js'),
			//base_url('/assets/js/libs/flot/jquery.flot.time.min.js'),
			//base_url('/assets/js/libs/flot/jquery.flot.resize.min.js'),
			//base_url('/assets/js/libs/flot/jquery.flot.orderBars.js'),
			//base_url('/assets/js/libs/flot/jquery.flot.pie.js'),
			//base_url('/assets/js/libs/flot/curvedLines.js'),
			//base_url('/assets/js/libs/jquery-knob/jquery.knob.min.js'),
			//base_url('/assets/js/libs/sparkline/jquery.sparkline.min.js'),
			base_url('/assets/js/libs/nanoscroller/jquery.nanoscroller.min.js'),
			//base_url('/assets/js/libs/d3/d3.min.js'),
			//base_url('/assets/js/libs/d3/d3.v3.js'),
			//base_url('/assets/js/libs/rickshaw/rickshaw.min.js'),
			base_url('/assets/js/core/source/App.js'),
			base_url('/assets/js/core/source/AppNavigation.js'),
			base_url('/assets/js/core/source/AppOffcanvas.js'),
			base_url('/assets/js/core/source/AppCard.js'),
			base_url('/assets/js/core/source/AppForm.js'),
			base_url('/assets/js/core/source/AppNavSearch.js'),
			base_url('/assets/js/core/source/AppVendor.js'),
			//base_url('/assets/js/core/demo/Demo.js'),
			//base_url('/assets/js/core/demo/DemoDashboard.js'),
		);
		
		$this->load->view('common/footer', $data);

	}

}

?>