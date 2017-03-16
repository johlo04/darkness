<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	/* Dashboard */
	public function getBiddingProduct($type=0){ //id 0 today, 1 within the month
		$date = date('Y-m-d');
		
		$this->db->select('p.id, datetime_end, product_name, status');
		$this->db->like('datetime_end',$date,'match', 'after');
		$this->db->from('auction_product p');
		$this->db->join('auction_product_detail pd', 'p.id = pd.product_id', 'left');
		//$this->db->join('auction_product_topbid pt', 'p.id = pt.product_id', 'left');
		$query = $this->db->get();
		//echo  $this->db->last_query();	
		$data= ($query) ? $query->result_array() : array();

		$return = array();
		foreach($data as $value){
			
			$return[] = array(
				'id'=> $value['id'],
				'datetime_end'=> $value['datetime_end'],
				'product_name'=> $value['product_name'],
				'status'=> $value['status'],
				'lastbid'=> $this->getLastBidderInfo($value['id'])
			);
		}
		return $return;
	}

	public function getHotProduct($type=1){ //id 0 today, 1 within the month
		$date = date('Y-m');
		
				
		$this->db->select('p.id, is_hot, starting_price, datetime_end, product_name, status, 
		(SELECT count(distinct(user_id)) from auction_product_bidding pbid where pbid.product_id = p.id ) as count_bidder');
		$this->db->where('is_hot >=',10);
		$this->db->where('status',0);
		$this->db->like('datetime_end',$date,'match', 'after');
		$this->db->from('auction_product p');
		$this->db->join('auction_product_detail pd', 'p.id = pd.product_id', 'left');
		//$this->db->join('auction_product_topbid pt', 'p.id = pt.product_id', 'left');
		$query = $this->db->get();
		//echo  $this->db->last_query();
		$data= ($query) ? $query->result_array() : array();

		$return = array();
		foreach($data as $value){
			
			$return[] = array(
				'id'=> $value['id'],
				'is_hot'=> $value['is_hot'],
				'starting_price'=> $value['starting_price'],
				'datetime_end'=> $value['datetime_end'],
				'product_name'=> $value['product_name'],
				'status'=> $value['status'],
				'count_bidder'=> $value['count_bidder'],
				'lastbid'=> $this->getLastBidderInfo($value['id'])
			);
		
		}
		return $return;
	}
	
	public function getWaitingPayment($type=1){ //id 0 today, 1 within the month
		$date = date('Y-m');
		
		$this->db->select('p.id, datetime_end,billed_date, final_price, product_name,status');
		$this->db->where('status',1);
		$this->db->where('is_paid',0);
		$this->db->like('datetime_end',$date,'match', 'after');
		$this->db->from('auction_product p');
		$this->db->join('auction_product_detail pd', 'p.id = pd.product_id', 'left');
		//$this->db->join('auction_product_topbid pt', 'p.id = pt.product_id', 'left');
		$query = $this->db->get();
		//echo  $this->db->last_query();
		$data= ($query) ? $query->result_array() : array();

		$return = array();
		
		foreach($data as $value){
			
			$return[] = array(
				'id'=> $value['id'],
				'billed_date'=> $value['billed_date'],
				'final_price'=> $value['final_price'],
				'datetime_end'=> $value['datetime_end'],
				'product_name'=> $value['product_name'],
				'status'=> $value['status'],
				'lastbid'=> $this->getLastBidderInfo($value['id'])
			);
		
		}
		
		return $return;
	
	}
	
	public function getClientInquiry($type=1){ //id 0 today, 1 within the month
		$date = date('Y-m');
		
		$this->db->select('*,(SELECT count(xs.id) from auction_inquiry_reply xs where xs.inquiry_id = ai.id and is_checked= 0 and reply_type="member") as totalcount, (SELECT product_name from auction_product_detail pd where ai.inquiry_ref = pd.product_id ) as product_name, (select username from auction_members am where ai.user_id=am.id) as username');
		//$this->db->where('parent_id ',0);
		$this->db->where('status ',0);
		//$this->db->or_where('is_replied',1);
		$this->db->from('auction_inquiry_main ai');
		$this->db->order_by("is_urgent", "desc"); 
		$this->db->order_by("date_added", "desc"); 
		//echo $this->db->last_query(); 
		$query = $this->db->get();
	
		return ($query) ? $query->result_array() : array();
	
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
	
	public function getLastBidderInfo($id){
		$query= $this->db->query('SELECT bidding_price, (SELECT username FROM auction_members AS am where am.id=ap.user_id ) as username FROM auction_product_bidding AS ap WHERE product_id ='.$id.' ORDER BY bidding_date DESC LIMIT 0,1');
		
		return ($query) ? $query->row_array() : array();
	}
	
	public function get_username($year=''){ //if empty current year
	
		$query= $this->db->query('SELECT sum(total_contract_price) as total FROM tr_contract_term_period  tp left join tr_contracts ct on (ct.id=tp.CID) where status in (1,3) and term_from LIKE "'.$year.'%" ');
		$row = $query->row_array();
	
		return ( $row['total']) ?  $row['total'] : 0;
		
	}
	
	
}

?>