<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Actress_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
	
	public function getActress($filter=array(),$limit_start, $per_page) {
		
		if(!empty($filter['filter_actress'])){
			$this->db->like('ad.name',$filter['filter_actress']);
		}
	
		if(!empty($filter['filter_status'])){
			$status= ($filter['filter_status']=='active')? 1: 0;
			$this->db->where('a.status',$status);
		}
		
		$this->db->select('DISTINCT(id) as uid,
		artist_since, ranking, view_count, status, artist_since, is_featured, date_added, date_modified, cover_image,
		(select name FROM `actress_detail` lang1 where lang1.actress_id=uid and language_id=1) as eng_name,
		(select name FROM `actress_detail` lang1 where lang1.actress_id=uid and language_id=2) as jap_name'
		);
		
		$this->db->order_by('view_count', 'DESC');
		$this->db->order_by('date_added', 'DESC');
		
		
		if($limit_start){
			$this->db->limit($per_page,$limit_start);
		}else{
			$this->db->limit($per_page);
		}
		
		$this->db->from('actress a');
		$this->db->join('actress_detail ad', 'a.id = ad.actress_id', 'left'); 
		
		
		$query = $this->db->get();
		
		$return_data = array();
		if($query){
			
			foreach($query->result_array() as $value){
				$return_data[] = array(
					'id'=>$value['uid'],
					'eng_name'=>$value['eng_name'],
					'jap_name'=>$value['jap_name'],
					'cover_image'=>$value['cover_image'],
					'is_featured'=>$value['is_featured'],
					'view_count'=>$value['view_count'],
					'status'=>$value['status'],
					'artist_since'=>$value['artist_since'],
					'date_added'=>$value['date_added'],
					'date_modified'=>$value['date_modified']
				);
			}
			
		}
		
		return $return_data;
	}
	
	public function getTotalActress($filter=array()) {
		
		if(!empty($filter['filter_actress'])){
			$this->db->like('ad.name',$filter['filter_actress']);
		}
	
		if(!empty($filter['filter_status'])){
			$status= ($filter['filter_status']=='active')? 1: 0;
			$this->db->where('a.status',$status);
		}

		$this->db->select('DISTINCT(id)');
		$this->db->from('actress a');

		$this->db->join('actress_detail ad', 'a.id = ad.actress_id', 'left'); 
		
		$query=$this->db->get();  
		return $query->num_rows(); 
	}
	

	public function getSingle($id=0) {
		
		$this->db->select('*');
		
		$this->db->from('actress');
		$this->db->where('id',$id);
		
		$query = $this->db->get();
		
		return ($query) ? $query->row_array(): array();
	}
	
	public function getActressTrackingSingle($id=0) {
		
		$this->db->select('view_count,date_added,date_modified,ranking');
		
		$this->db->from('actress a');
		$this->db->where('id',$id);
		
		$query = $this->db->get();
		
		return ($query) ? $query->row_array(): array();
		
	}
	
	public function getDescription($id=0) {
		
		$this->db->select('*');
		$this->db->from('actress_detail a');
		$this->db->where('actress_id',$id);
		
		$query = $this->db->get();
		
		$return_data = array();
		if($query){
			
			foreach($query->result_array() as $value){
				$return_data[$value['language_id']] = array(
					'actress_id'=>$value['actress_id'],
					'language_id'=>$value['language_id'],
					'name'=>$value['name'],
					'description'=> $value['description'],
					'meta_tags'=> $value['meta_tags'],
					'meta_description'=>$value['meta_description']
				);
			}
			
		}
		
		return $return_data;
		
	}
	
	public function getGallery($id=0) {
		
		$this->db->select('*');
		$this->db->from('actress_gallery a');
		$this->db->where('actress_id',$id);
		
		$query = $this->db->get();
		
		return ($query) ? $query->result_array(): array();
	}

	public function update($data, $id=''){
		//single row
		$clean_data = clean_db_data('actress',$data);
		
		//single images
		$clean_data['cover_image'] = str_replace(URL_FILEMANAGER_SOURCE,'',$clean_data['cover_image']);
		$clean_data['category'] = (isset($data['category']))? implode(',',$data['category']): '0';
		
		$clean_data['date_modified'] =  date('Y-m-d H:i:s');
		//$clean_data['updated_by'] = $this->session->userdata('name');
		
		if(empty($id)){ //insert new
			$clean_data['date_added'] =  $clean_data['date_modified'];
			//$clean_data['added_by'] = $this->session->userdata('name');
			
			$this->db->insert('actress', $clean_data);
			$id= $this->db->insert_id();
		
			//language
			foreach($this->getLanguage() as $key =>$value){
				$clean_description = clean_db_data('actress_detail',$data['description'][$value['id']]);
				$clean_description['actress_id'] = $id;
				$clean_description['language_id'] = $value['id'];
			
				$this->db->insert('actress_detail', $clean_description);
			}
			
		}else{
			
			$this->db->where('id',$id);
			$this->db->update('actress', $clean_data);
			
			foreach($this->getLanguage() as $key =>$value){
			//language
				$clean_description = clean_db_data('actress_detail',$data['description'][$value['id']]);
				$this->db->where('actress_id',$id);
				$this->db->where('language_id',$value['id']);
				$this->db->update('actress_detail', $clean_description);
			}
		}
		
		//gallery images
		$this->update_gallery($id,$data['gallery']);
	
		return $id;
		
	}
	
	private function collectCategory($data='0') {
		//echo $data.'<br/>';
		$explode = explode(',',$data);
		
		$return_data = array(); 
		if(count($explode)){
			$count_limit= 0;
			foreach($explode as $val){
				//echo '->'.$val.'<br/>';
				$return_data[$val] = $this->collectSingleCategory($val);
				
				$count_limit++;
				if($count_limit==3){
					break;
				}
			}
			
		}
		
		return $return_data;
		
	}
	
	public function collectSingleCategory($filter_id='') {
		if(!empty($filter_id)){
			 $this->db->where('id',$filter_id);
		}
		
		$this->db->select('*');
		$this->db->from('av_category ac');
		//$this->db->where('video_id',$id);
		
		$query = $this->db->get();
		
		return ($query) ? $query->row_array(): array();
	}
	
	public function getCategory($group='content', $type='') {
		if(!empty($group)){
			 $this->db->where('grouping',$group);
		}
		
		if(!empty($type)){
			 $this->db->where('type',$type);
		}
		
		$this->db->select('*');
		$this->db->from('av_category ac');
		
		//$this->db->where('video_id',$id);
		
		$query = $this->db->get();
		
		return ($query) ? $query->result_array(): array();
	}
	
	public function update_gallery($actress_id=0, $data){
	
		$this->db->delete('actress_gallery', array('actress_id' => $actress_id)); //delete gallery via id
		
		if(count($data)>0){ //insert new content if hae
			
			foreach($data as $value){
				$value['image'] = str_replace(URL_FILEMANAGER_SOURCE,'',$value['image']); //filemanger sae content with 
				$value['actress_id'] = $actress_id;
				$this->db->insert('actress_gallery',$value);
			}
		
		}
		
	}


	public function deleteActress($actress_id=0){
		
		$this->db->delete('actress', array('id' => $actress_id)); 
		$this->db->delete('actress_detail', array('actress_id' => $actress_id)); 
		$this->db->delete('actress_gallery', array('actress_id' => $actress_id)); 
		
		$this->deleteCommentRef($actress_id);
		
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
	
	public function deleteComment($id=0){
		$this->db->delete('av_review', array('id' => $id)); //main
		$this->db->delete('av_review', array('parent_id' => $id)); //sub
		return true;
	}
	
	public function deleteCommentRef($id=0){
		$this->db->delete('av_review', array('ref_id' => $id,'review_type'=>'actress')); //ref_id
		return true;
	}
	
	public function setActressComment($data){
	
		$clean_data = clean_db_data('av_review',$data);
		$clean_data['date_added'] =  date('Y-m-d H:i:s');
		$clean_data['user_id'] = $this->session->userdata('id');
		$clean_data['user_group'] = 'admin';
		$clean_data['review_type'] = 'actress';
		$clean_data['status'] = 1;
		
		$this->db->insert('av_review', $clean_data);
		
	}
	
	public function setCommentStatus($data,$id){
	
		$clean_data = clean_db_data('av_review',$data);
		
		$this->db->where('id',$id);
		$status= $this->db->update('av_review', $clean_data);
		return  $status;
	}
	
	public function getComments($ref_id) {
	
		$sql = ' ref_id = '.$ref_id;
		$sql .= ' AND parent_id = 0 ';
		$sql .= ' AND review_type = "actress" ';
		//$sql .= ' AND status = 0 ';
		//$nested = '(select username from auction_members am where ac.user_id=am.id) as username',
		
		$query = $this->db->query('SELECT *  FROM av_review ar WHERE
		'.$sql.' ORDER BY date_added desc');
		//echo $this->db->last_query(); die;
	
		$return_data = array();
		if($query){
			
			foreach($query->result_array() as $value){
				$return_data[] = array(
					'id'=>$value['id'],
					'ref_id'=>$value['ref_id'],
					'user_id'=>$value['user_id'],
					'user_group'=>$value['user_group'],
					'username'=>$value['username'],
					'title'=>$value['title'],
					'review_description'=>$value['review_description'],
					'status'=>$value['status'],
					'date_added'=>$value['date_added'],
					'subcomment'=> $this->getSubComments($ref_id,$value['id'])
				);
			}
		}
		return $return_data;
		
	}
	
	public function getSubComments($ref_id,$parent) {
	
		$sql = ' ref_id = '.$ref_id;
		$sql .= ' AND parent_id = '.$parent;
		$sql .= ' AND review_type = "actress" ';
		
		$query = $this->db->query('SELECT * FROM av_review ar WHERE
		'.$sql.' ORDER BY date_added desc');
		//echo $this->db->last_query(); die;
		
		return ($query) ? $query->result_array(): array();
		
	}
	
	public function getAuctionBid($id) {
		$sql = ' actress_id = '.$id;
		
		$query = $this->db->query('SELECT *, (select username from auction_members am where ab.user_id=am.id) as username  FROM actress_bidding ab WHERE
		'.$sql.' ORDER BY bidding_date desc');
		//echo $this->db->last_query(); die;
		return ($query) ? $query->result_array(): array();
		
	}
	
	public function getLanguage() {
		
		$this->db->from('language');
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		return ($query) ? $query->result_array(): array();
		
	}
	
	public function updateFeaturedActress($id){

		$this->db->where('is_featured','1');
		$this->db->update('actress', array('is_featured'=>0));
		
		$this->db->where('id',$id);
		$this->db->update('actress', array('is_featured'=>1));
		return true;
	}
	
}

?>