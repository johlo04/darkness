<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Inquiry_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
	
	public function getInquiry($filter=array(),$limit_start, $per_page) {
		$sql = '1';
		
		if(!empty($filter['filter_status'])){
			$sql .= ' AND status = '.$filter['filter_status'];
		}
		
		if(!empty($filter['filter_keyword'])){
			$sql.= ' AND (subject Like "%'.$filter['filter_keyword'].'%"';
			$sql.= ' OR message Like "%'.$filter['filter_keyword'].'%" )';
		} 	
		
		$this->db->select('*');
		$this->db->order_by('date_added', 'DESC');
		
		if($limit_start){
			$this->db->limit($per_page,$limit_start);
		}else{
			$this->db->limit($per_page);
		}
		
		$this->db->from('av_inquiry'); 
		
		$query = $this->db->get();
		
		$return_data = array();
		
		if($query){
		
			foreach($query->result_array() as $value){
				$return_data[] = array(
					'id'=>$value['id'],
					'username'=>phantom_db_picker('aauth_users','name',array('id',$value['user_id'])),
					'title'=>$value['title'],
					'detail'=>$value['detail'],
					'is_urgent'=>$value['is_urgent'],
					'status'=>$value['status'],
					'unread'=>$this->getTotalInquiryReply($value['id'],1),
					'date_added'=>$value['date_added'],
					'date_modified'=>$value['date_modified']
				);
			}
			
		}
		
		return $return_data;
	}
	
	public function getTotalInquiry($filter=array()) {
		
		$this->db->select('id');
		
		//$this->db->where('parent_id',0);
		
		if(isset($filter['filter_status'])){
			$this->db->where('status',$filter['filter_status']);
		}
		
		if(!empty($filter['filter_keyword'])){
			 $this->db->like('subject',$filter['filter_keyword']);
			 $this->db->or_like('message',$filter['filter_keyword']);
		}
		
		$this->db->from('av_inquiry');
		
		return $count = $this->db->count_all_results();
	}
	
	public function getTotalInquiryReply($id,$unread=0) {
		if($unread){
			$this->db->where('is_check',0); //not check
		}
		
		$this->db->select('id');
		$this->db->where('inquiry_id',$id);
		$this->db->where('user_group','member');
		$this->db->from('av_inquiry_reply');
		
		return $count = $this->db->count_all_results();
	}
	

	public function getSingle($id=0) {
		//(select username from auction_members am where ai.user_id=am.id)
		$this->db->select('*, concat("MEMBER") as username ');
		$this->db->from('av_inquiry ai');
		
		$this->db->where('id',$id);
		
		$query = $this->db->get();
		
		return ($query) ? $query->row_array(): array();
	}
	
	public function setStatusInquiry($data,$id){
	
		$clean_data = clean_db_data('av_inquiry',$data);
		$clean_auction['is_check'] = 0;
		
		$this->db->where('id',$id);
		$status= $this->db->update('av_inquiry', $clean_data);
		return  $status;
	}
	
	public function deleteInquiry($id=0){
		$this->db->delete('av_inquiry', array('id' => $id)); 
		$this->db->delete('av_inquiry_reply', array('inquiry_id' => $id)); 
	}
	
	# REPLY FUNCTION
	public function getInquiryReply($id=0) {
	
		$this->db->select('*');
		$this->db->where('inquiry_id',$id);
		$this->db->order_by('date_added', 'DESC');
		
		$this->db->from('av_inquiry_reply'); 
		
		$query = $this->db->get();
		return ($query) ? $query->result_array(): array();
		
	}
	
	public function setInquiryReply($data){
	
		$clean_data = clean_db_data('av_inquiry_reply',$data);
		$clean_auction['is_checked'] = 0;
		//$clean_auction['is_replied'] = 1;
	
		$status= $this->db->insert('av_inquiry_reply', $clean_data);
		return  $status;
	}
	
	public function setHideInquiryReply($data,$id){
	
		$clean_data = clean_db_data('av_inquiry_reply',$data);
		//$clean_auction['is_replied'] = 1;
		
		$this->db->where('id',$id);
		$status= $this->db->update('av_inquiry_reply', $clean_data);
		return  $status;
	}

	public function deleteInquiryReply($id){
	
		$this->db->delete('av_inquiry_reply', array('id' => $id)); 
		return  true;
	}
	
	public function setReadInquiryReply($data,$id){
	
		$clean_data = clean_db_data('av_inquiry_reply',$data);
		//$clean_auction['is_replied'] = 1;
		
		$this->db->where('id',$id);
		$status= $this->db->update('av_inquiry_reply', $clean_data);
		return  $status;
	}
	
	public function get_last_timestamp($id=0,$column='date_modified',$table='') {
		
		$this->db->select($column);
		$this->db->from($table);
		$this->db->where('id',$id);
		$query = $this->db->get();
		//echo $this->db->last_query();

		$timestamp =  ($query) ? $query->row_array(): array();
		
		return $timestamp[$column];
	}

}

?>