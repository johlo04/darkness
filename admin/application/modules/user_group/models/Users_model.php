<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	/* Dashboard */
	public function get_userProject(){
		$user_id = $this->session->userdata('id');
		$list = $this->db->query('SELECT * FROM tr_contracts c LEFT JOIN tr_contract_relation_officer cro on (c.id = cro.cid) 
									WHERE c.contract_id = cro.contract_id
									AND c.contract_ext= cro.contract_ext
									AND (main_jp_officer = '.$user_id.' OR asst_jp_officer = '.$user_id.' OR main_local_officer = '.$user_id.' OR asst_local_officer = '.$user_id.') 
								');
		
		return ($list) ? $list->result() : array();
	
	}
	
	public function get_ROProjectCount($year=''){
		$year = ($year)? $year: date('Y');
		$sql = ' AND date_added like "'.$year.'%" '; 
	
		$list = $this->db->query('SELECT aui.firstname, aui.lastname, (SELECT count(*) FROM tr_contracts c LEFT JOIN tr_contract_relation_officer cro on (c.id = cro.cid) 
										WHERE c.contract_id = cro.contract_id
										AND c.contract_ext= cro.contract_ext
										AND (main_jp_officer = aui.user_id 
										OR asst_jp_officer = aui.user_id 
										OR main_local_officer = aui.user_id 
										OR asst_local_officer = aui.user_id 
									'.$sql .'
									)) as counter
									FROM aauth_users_info aui order by counter DESC
		');

		return ($list) ? $list->result_array() : array();
	
	}
	
	public function get_totalProject($status=''){ //if empty count all
		
		if(!empty($status)){
				$this->db->where('status',$status);
		}
		
		$this->db->from('tr_contracts');
		
		
		return $this->db->count_all_results();
	
	}

	public function get_newProject(){ //if empty count all
		
	
		$this->db->where(array('status'=>1));
		$this->db->like('date_added',date('Y-m'));
		$this->db->from('tr_contracts');
		
	
		return $this->db->count_all_results();
	
	}
	
	public function get_totalIncome($year=''){ //if empty current year
	
		$query= $this->db->query('SELECT sum(total_contract_price) as total FROM tr_contract_term_period  tp left join tr_contracts ct on (ct.id=tp.CID) where status in (1,3) and term_from LIKE "'.$year.'%" ');
		$row = $query->row_array();
	
		return ( $row['total']) ?  $row['total'] : 0;
		
	}
	
	public function getIncomeImprovement(){ 
	
		$date= date('Y');
		$now = $this->get_totalIncome($date);
		$lastyear = $this->get_totalIncome($date-1);
		
		
		if($lastyear){
			$result = (($now-$lastyear)/ $lastyear * 100);
			$data['percentage'] =number_format($result,2);
		}else{ //100% percentage
			$result = 100; 
			$data['percentage'] =number_format(100,2);
		}
		
		$data['status'] = ($result>=0)? 'success':'danger';
		$data['icon'] = ($result>=0)? 'up':'down';
		
		return $data;
		
	}
	
	public function get_TopClient($year='',$strict=0){ //set 1 if all
		
		$year = ($year)? $year: date('Y');
		
		$sql = ' date_added like "'.$year.'%" '; 
		$limit = ($strict==0) ? ' LIMIT 0, '.$this->system_config->getConfig('ranking_limit'): '';
		
		$query = $this->db->query('SELECT client_name, (select count(*) FROM tr_contracts tco where '.$sql.' AND tco.client_id= tcl.id ) as counter
						FROM tr_client tcl order by counter DESC, client_name ASC '.$limit);
		
		return ($query) ? $query->result_array() : array();
	}

	public function get_TopCategory($year='',$strict=0){ //set 1 if all
		
		$year = ($year)? $year: date('Y');
		
		$sql = ' tco.date_added like "'.$year.'%" '; 
		$limit = ($strict==0) ? ' LIMIT 0, '.$this->system_config->getConfig('ranking_limit'): '';
		
		$query = $this->db->query('SELECT tps.name as service_name, tsc.name as category_name, (select count(*) FROM tr_contract_description tcd left join  tr_contracts tco on (tco.id=tcd.cid) where '.$sql.' AND FIND_IN_SET(tps.id, tcd.service_id) ) as counter
						FROM tr_project_services tps LEFT JOIN tr_service_category  tsc on (tps.category_id= tsc.id) order by counter DESC, service_name ASC '.$limit);
		
		return ($query) ? $query->result_array() : array();
	}

}

?>