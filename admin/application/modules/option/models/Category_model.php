<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Category_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
	
	public function getCategory($filter=array(),$limit_start, $per_page) {
		
		if(!empty($filter['filter_category_name'])){
			$this->db->group_start();
			$this->db->like('en_keyword',$filter['filter_category_name']);
			$this->db->or_like('jp_keyword',$filter['filter_category_name']);
			$this->db->group_end();
		}
		
		$this->db->where('grouping',$filter['filter_grouping']);
		
		
		/*if(!empty($filter['filter_type'])){
			$this->db->where('type',$filter['filter_type']);
		}*/
		
		
		if(!empty($filter['filter_status'])){
			$status= ($filter['filter_status']=='active')? 1: 0;
			$this->db->where('status',$status);
		}
		
		$this->db->select('*');
		$this->db->order_by('type', 'ASC');
		$this->db->order_by('en_keyword', 'ASC');
		//$this->db->limit($limit_start,$per_page);
		$this->db->from('av_category');
		
		if($limit_start){
			$this->db->limit($per_page,$limit_start);
		}else{
			$this->db->limit($per_page);
		}
		
		//$this->db->join('av_category_detail avd', 'av.id = avd.category_id', 'left'); 
		$query = $this->db->get();
		
		//echo $this->db->last_query(); die;
		
	
		return ($query) ? $query->result_array(): array();
		
	}
	
	public function getTotalCategory($filter=array()) { 
		
		if(!empty($filter['filter_category_name'])){
			$this->db->group_start();
			$this->db->like('en_keyword',$filter['filter_category_name']);
			$this->db->or_like('jp_keyword',$filter['filter_category_name']);
			$this->db->group_end();
		}
		

		if(!empty($filter['filter_type'])){
			$this->db->where('type',$filter['filter_type']);
		}
		
		$this->db->where('grouping',$filter['filter_grouping']);
		
		if(!empty($filter['filter_status'])){
			$status= ($filter['filter_status']=='active')? 1: 0;
			$this->db->where('status',$status);
		}
		
		$this->db->select('*');
		$this->db->from('av_category');
		$query=$this->db->get();  
		return $query->num_rows(); 
	}
	

	public function getSingle($id=0) {
		
		$this->db->select('*');
		$this->db->where('id',$id);
		$this->db->from('av_category');
		
		$query = $this->db->get();
		
		return ($query) ? $query->row_array(): array();
	}
	
	public function update($data, $id=''){
		//single row
		$clean_data = clean_db_data('av_category',$data);
	
		if(empty($id)){ //insert new
			
			$this->db->insert('av_category', $clean_data);
			$id= $this->db->insert_id();
			
		}else{
			
			$this->db->where('id',$id);
			$this->db->update('av_category', $clean_data);
		}
	
		return $id;
		
	}
	
	public function deleteCategory($category_id=0){
		
		$this->db->delete('av_category', array('id' => $category_id,'grouping'=>'category')); 
		
	}
	
	public function deleteTheme($category_id=0){
		
		$this->db->delete('av_category', array('id' => $category_id,'grouping'=>'theme')); 
		
	}
	
	public function deleteVidcontent($category_id=0){
		
		$this->db->delete('av_category', array('id' => $category_id,'grouping'=>'content')); 
		
	}

	public function deleteActressType($category_id=0){
		
		$this->db->delete('av_category', array('id' => $category_id,'grouping'=>'actress')); 
		
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
	
	public function getLanguage() {
		
		$this->db->from('language');
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		return ($query) ? $query->result_array(): array();
		
	}
	
}

?>