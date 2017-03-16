<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Member_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
	
	public function getMember($filter=array(),$limit_start, $limit_end) {
		$sql = '1';
		
		if(!empty($filter['filter_status'])){
			$sql = ' AND status = '.$filter['filter_status'];
		}
		
		if(!empty($filter['filter_username'])){
			$sql.= '( AND username LIKE "%'.$filter['filter_username'].'%" ';
			$sql.= ' OR firstname LIKE "%'.$filter['filter_username'].'%" ';
			$sql.= ' OR lastname "%'.$filter['filter_username'].'%" ) ';
		} 	
		
		$query = $this->db->query('SELECT *  FROM auction_members WHERE
		'.$sql.' ORDER BY created_on desc LIMIT '.$limit_start.','.(int)$limit_end);
		//echo $this->db->last_query(); die;
		return ($query) ? $query->result_array(): array();
		
	}
	
	public function getTotalMember($filter=array()) {
		
		$this->db->select('id');
		
		if(!empty($filter['filter_status'])){
			$this->db->where('filter_status',$filter['filter_status']);
		}
		
		if(!empty($filter['filter_username'])){
			 $this->db->like('username',$filter['filter_username']);
			 $this->db->or_like('firstname',$filter['filter_username']);
			 $this->db->or_like('lastname',$filter['filter_username']);
		}
		
		$this->db->from('auction_members');
		
		return $count = $this->db->count_all_results();
	}
	

	public function getSingle($id=0) {
		
		$this->db->select('* ');
		$this->db->from('auction_members');
		
		$this->db->where('id',$id);
		
		$query = $this->db->get();
		
		return ($query) ? $query->row_array(): array();
	}
	
	public function getMemberSingle($id=0) {
		
		$this->db->select('billed_date, final_price, top_bidder_id, sold_to_bidder_id, billed_date, payment_date, ccbil_ref_no, is_paid, status, (SELECT count(distinct(user_id)) from auction_product_bidding pbid where pbid.product_id = p.id ) as count_bidder');
		$this->db->from('auction_members p');
		$this->db->where('id',$id);
		
		$query = $this->db->get();
		
		return ($query) ? $query->row_array(): array();
	}
	
	public function update($data, $id=''){
	
		$clean_auction = clean_db_data('auction_product',$data);
		$clean_description = clean_db_data('auction_product_detail',$data);
		
		$clean_auction['cover_image'] = str_replace(URL_FILEMANAGER_SOURCE,'',$clean_auction['cover_image']);
		$clean_auction['date_modified'] =  date('Y-m-d H:i:s');
		
		if(empty($id)){ //insert new
			$clean_auction['date_added'] =  $clean_auction['date_modified'];
			
			$this->db->insert('auction_product', $clean_auction);
			$id= $this->db->insert_id();
			
			$clean_description['product_id'] = $id;
			$this->db->insert('auction_product_detail', $clean_description);
			$this->update_gallery($id,$data['gallery']);
			
		}else{
			
			$this->db->where('id',$id);
			$this->db->update('auction_product', $clean_auction);
			
			$this->db->where('product_id',$id);
			$this->db->update('auction_product_detail', $clean_description);
			
			$this->update_gallery($id,$data['gallery']);
		}
		
		return $id;
		
	}
	
	public function update_gallery($product_id=0, $data){
	
		$this->db->delete('auction_product_gallery', array('product_id' => $product_id)); //delete gallery via id
		
		if(count($data)>0){ //insert new content if have
			
			foreach($data as $value){
				$value['image_name'] = str_replace(URL_FILEMANAGER_SOURCE,'',$value['image_name']); //filemanger save content with 
				$value['product_id'] = $product_id;
				$this->db->insert('auction_product_gallery',$value);
			}
		}
		
	}
	
	public function setStatusMember($data,$id){
	
		$clean_data = clean_db_data('auction_inquiry',$data);
		//$clean_auction['is_replied'] = 1;
		
		$this->db->where('id',$id);
		$status= $this->db->update('auction_inquiry', $clean_data);
		return  $status;
	}
	
	public function deleteMember($id=0){
		$this->db->delete('auction_inquiry', array('id' => $id)); 
		$this->db->delete('auction_inquiry', array('parent_id' => $id)); 

		
	}
	
	# REPLY FUNCTION
	public function getMemberReply($id) {
		$sql = 'parent_id = '.$id;
		$sql .= ' AND is_hide = 0 ';
		
		$query = $this->db->query('SELECT *, (select cover_image from auction_product ap where ap.id=ai.product_id) as cover_image, (select username from auction_members am where ai.user_id=am.id) as username  FROM auction_inquiry ai WHERE
		'.$sql.' ORDER BY date_added desc');
		//echo $this->db->last_query(); die;
		return ($query) ? $query->result_array(): array();
		
	}
	
	public function setMemberReply($data){
	
		$clean_data = clean_db_data('auction_inquiry',$data);
		//$clean_auction['is_replied'] = 1;
	
		$status= $this->db->insert('auction_inquiry', $clean_data);
		return  $status;
	}
	
	public function setHideMemberReply($data,$id){
	
		$clean_data = clean_db_data('auction_inquiry',$data);
		//$clean_auction['is_replied'] = 1;
		
		$this->db->where('id',$id);
		$status= $this->db->update('auction_inquiry', $clean_data);
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
	
	public function getWonAuction($id) {

		$this->db->select('*');
		$this->db->from('auction_product');
		$this->db->where('is_paid',1);
		$this->db->where('sold_to_bidder_id',$id);
		//echo $this->db->last_query(); die;
		$query = $this->db->get();
		
		return ($query) ? $query->result_array(): array();
		
	}
	
	public function getMemberInquiry($id) {

		$this->db->select('*, (select username from auction_members am where am.id=ai.user_id) as username, (select product_name from auction_product_detail ap where ap.product_id=ai.product_id) as product_name,');
		$this->db->from('auction_inquiry ai');
		$this->db->where('user_id',$id);
		$this->db->where('parent_id',0);
		//echo $this->db->last_query(); die;
		$query = $this->db->get();
		
		return ($query) ? $query->result_array(): array();
		
	}

}

?>