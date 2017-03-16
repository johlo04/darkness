<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Videos_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
	
	public function getVideo($filter=array(),$limit_start, $per_page) {
		
		if(!empty($filter['filter_video_name'])){
			$this->db->like('avd.title',$filter['filter_video_name']);
		}

		if(!empty($filter['filter_actress'])){
			$where = "FIND_IN_SET('".$filter['filter_actress']."', av.actress)";
			$this->db->where($where);
		}
		
		if(!empty($filter['filter_status'])){
			$status= ($filter['filter_status']=='active')? 1: 0;
			$this->db->where('av.status',$status);
		}
		
		$this->db->select('DISTINCT(id) as uid,
		category, actress, banner_image, poster_image, cover_image, is_featured, status, date_added, date_modified, video_duration, view_count,
		(select title FROM `av_video_detail` lang1 where lang1.video_id=uid and language_id=1) as eng_title,
		(select title FROM `av_video_detail` lang1 where lang1.video_id=uid and language_id=2) as jap_title'
		);
		$this->db->order_by('date_added', 'DESC');
		
		if($limit_start){
			$this->db->limit($per_page,$limit_start);
		}else{
			$this->db->limit($per_page);
		}
		
		$this->db->from('av_video av'); 
		$this->db->join('av_video_detail avd', 'av.id = avd.video_id', 'left');
		
		$query = $this->db->get();
		
		$return_data = array();
		if($query){
			
			foreach($query->result_array() as $value){
				$return_data[] = array(
					'id'=>$value['uid'],
					'eng_title'=>$value['eng_title'],
					'jap_title'=>$value['jap_title'],
					'category'=> $this->collectCategory($value['category'],'main'),
					'actress'=> $this->collectActress($value['actress']),
					'banner_image'=>$value['banner_image'],
					'poster_image'=>$value['poster_image'],
					'cover_image'=>$value['cover_image'],
					'view_count'=>$value['view_count'],
					'video_duration'=>$value['video_duration'],
					'is_featured'=>$value['is_featured'],
					'status'=>$value['status'],
					'date_added'=>$value['date_added'],
					'date_modified'=>$value['date_modified']
				);
			}
			
		}
		
		return $return_data;
	}
	
	public function getTotalVideo($filter=array()) { 
		
		if(!empty($filter['filter_video_name'])){
			$this->db->like('avd.title',$filter['filter_video_name']);
		}

		if(!empty($filter['filter_actress'])){
			$where = "FIND_IN_SET('".$filter['filter_actress']."', av.actress)";
			$this->db->where($where);
		}
		
		if(!empty($filter['filter_status'])){
			$status= ($filter['filter_status']=='active')? 1: 0;
			$this->db->where('av.status',$status);
		}

		$this->db->select('DISTINCT(id)');
		$this->db->from('av_video av');

		$this->db->join('av_video_detail avd', 'av.id = avd.video_id', 'left'); 
		
		$query=$this->db->get();  
		return $query->num_rows(); 
	}
	

	public function getSingle($id=0) {
		
		$this->db->select('av.id,video_grouping,video_duration,category,theme,scene_content,actress,banner_image,poster_image,cover_image,status,
						fullhd,hdlite,mobile,vr_download,gallery_zip,scene_zip,
						clip_mp4,clip_webm,clip_ogv,clip_360_vr,full_mp4,full_webm,full_ogv,full_vr
				');
		
		$this->db->from('av_video av');
		$this->db->join('av_video_downloads avd', 'av.id = avd.video_id', 'left');
		$this->db->join('av_video_location avl', 'avd.video_id = avl.video_id', 'left');
		$this->db->where('av.id',$id);
		
		$query = $this->db->get();
		
		return ($query) ? $query->row_array(): array();
	}
	
	public function getVideoTrackingSingle($id=0) {
		
		$this->db->select('view_count,date_added,date_modified,date_last_viewed,added_by,updated_by');
		
		$this->db->from('av_video av');
		$this->db->where('id',$id);
		
		$query = $this->db->get();
		
		return ($query) ? $query->row_array(): array();
	}
	
	public function getDescription($id=0) {
		
		$this->db->select('*');
		$this->db->from('av_video_detail av');
		$this->db->where('video_id',$id);
		
		$query = $this->db->get();
		
		$return_data = array();
		if($query){
			
			foreach($query->result_array() as $value){
				$return_data[$value['language_id']] = array(
					'video_id'=>$value['video_id'],
					'language_id'=>$value['language_id'],
					'title'=>$value['title'],
					'description'=> $value['description'],
					'meta_tags'=> $value['meta_tags'],
					'meta_description'=>$value['meta_description']
				);
			}
			
		}
		
		return $return_data;
		
	}
	
	public function __getBillingSingle($id=0) {
		
		$this->db->select('billed_date, final_price, top_bidder_id, sold_to_bidder_id, billed_date, payment_date, ccbil_ref_no, is_paid, status, (SELECT count(distinct(user_id)) from av_video_bidding pbid where pbid.video_id = p.id ) as count_bidder');
		$this->db->from('av_video p');
		$this->db->where('id',$id);
		
		$query = $this->db->get();
		
		return ($query) ? $query->row_array(): array();
	}
	
	public function __getTopBillingSingle($id=0) {
		
		$this->db->select('user_id, bid_price, (SELECT count(distinct(user_id)) from av_video_bidding pbid where pbid.video_id = pt.video_id ) as count_bidder');
		$this->db->from('av_video_topbid pt');
		$this->db->where('video_id',$id);
		
		$query = $this->db->get();
		
		return ($query) ? $query->row_array(): array();
	}
	
	public function getGallery($id=0) {
		
		$this->db->select('*');
		$this->db->from('av_video_gallery av');
		$this->db->where('video_id',$id);
		
		$query = $this->db->get();
		
		return ($query) ? $query->result_array(): array();
	}

	public function getVideoScenes($id=0) {
		
		$this->db->select('*');
		$this->db->from('av_video_scenes av');
		$this->db->where('video_id',$id);
		
		$query = $this->db->get();
		
		return ($query) ? $query->result_array(): array();
	}

	private function collectCategory($data='0',$group='') {
		//echo $data.'<br/>';
		$explode = explode(',',$data);
		
		$return_data = array(); 
		if(count($explode)){
			$count_limit= 0;
			foreach($explode as $val){
				//echo '->'.$val.'<br/>';
				$return_data[$val] = $this->collectSingleCategory($val,$group='');
				
				$count_limit++;
				if($count_limit==3){
					break;
				}
			}
			
		}
		
		return $return_data;
		
	}
	
	public function collectSingleCategory($filter_id='',$group='') {
		if(!empty($filter_id)){
			 $this->db->where('id',$filter_id);
		}
		
		if(!empty($group)){
			 $this->db->where('grouping',$group);
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

	private function collectActress($data='0') {
		//echo $data.'<br/>';
		$explode = explode(',',$data);
		
		$return_data = array(); 
		if(count($explode)){
			$count_limit =0;
			foreach($explode as $val){
				//echo '->'.$val.'<br/>';
				$return_data[$val] = $this->getSingleActress($val);
			}
			$count_limit++;
			if($count_limit==3){
				break;
			}
			
		}
		
		return $return_data;
		
	}
	
	public function getSingleActress($filter_id='') {
		if(!empty($filter_id)){
			 $this->db->where('id',$filter_id);
		}
		$this->db->select('id,(select name from actress_detail ad1 where ac.id =ad1.actress_id and language_id=1) as en_name, (select name from actress_detail ad2 where ac.id =ad2.actress_id and language_id=2) as jp_name');
		$this->db->from('actress ac');
		//$this->db->where('video_id',$id);
		
		$query = $this->db->get();
		
		return ($query) ? $query->row_array(): array();
	}
	
	public function getActress() {
		
		$this->db->select('*, (select name from actress_detail ad1 where ac.id =ad1.actress_id and language_id=1) as en_name, (select name from actress_detail ad2 where ac.id =ad2.actress_id and language_id=2) as jp_name');
		$this->db->from('actress ac');
		//$this->db->where('video_id',$id);
		
		$query = $this->db->get();
		
		return ($query) ? $query->result_array(): array();
	}
	
	public function getSingleFile($data=array()) {
		
		$query = $this->db->get_where('tr_client_meeting_files',$data);
		
		return ($query) ? $query->row_array(): array();
	}
	


	public function insertSample($loop) {

		$data_array = array();
		
		for($x = 1; $x < $loop; $x++) {
			$data_array[] = array(
				'contract_id'	=>	rand(100000, 999999),
				'client_id'		=>	rand(100000, 999999),
				'client'		=>	'Sample ' . rand(10, 99),
				'officer'		=>	'Officer ' . rand(10, 99),
				'start_date'	=>	date('Y-m-d'),
				'end_date'		=>	date('Y-m-d'),
				'status'		=>	rand(0, 1)
			);
		}

		$this->db->insert_batch('tr_projects', $data_array);

	}
	
	public function update($data, $id=''){
		//single row
		$clean_video = clean_db_data('av_video',$data);
		$clean_video_download = clean_db_data('av_video_downloads',$data);
		$clean_video_location = clean_db_data('av_video_location',$data);
		
		//single images
		$clean_video['cover_image'] = str_replace(URL_FILEMANAGER_SOURCE,'',$clean_video['cover_image']);
		$clean_video['banner_image'] = str_replace(URL_FILEMANAGER_SOURCE,'',$clean_video['banner_image']);
		$clean_video['poster_image'] = str_replace(URL_FILEMANAGER_SOURCE,'',$clean_video['poster_image']);
		
		//arrays or checkbox
		$clean_video['category'] = (isset($clean_video['category']))? implode(',',$clean_video['category']): '0';
		$clean_video['theme'] = (isset( $clean_video['theme']))? implode(',',$clean_video['theme']): '0';
		$clean_video['actress'] = (isset($clean_video['actress']))? implode(',',$clean_video['actress']): '0';
		$clean_video['scene_content'] = (isset($clean_video['scene_content']))? implode(',',$clean_video['scene_content']): '0';
		
		$clean_video['date_modified'] =  date('Y-m-d H:i:s');
		$clean_video['updated_by'] = $this->session->userdata('name');
		
		if(empty($id)){ //insert new
			$clean_video['date_added'] =  $clean_video['date_modified'];
			$clean_video['added_by'] = $this->session->userdata('name');
			
			$this->db->insert('av_video', $clean_video);
			$id= $this->db->insert_id();
			
			$clean_video_download['video_id'] = $id;
			$clean_video_location['video_id'] = $id;
			
			$this->db->insert('av_video_downloads', $clean_video_download);
			$this->db->insert('av_video_location', $clean_video_location);
			
			$clean_description['video_id'] = $id;
			//language
			foreach($this->getLanguage() as $key =>$value){
				$clean_description = clean_db_data('av_video_detail',$data['description'][$value['id']]);
				$clean_description['video_id'] = $id;
				$clean_description['language_id'] = $value['id'];
			
				$this->db->insert('av_video_detail', $clean_description);
			}
			
		}else{
			
			$this->db->where('id',$id);
			$this->db->update('av_video', $clean_video);
			
			$clean_video_download['video_id'] = $id;
			$clean_video_location['video_id'] = $id;
			
			$this->db->where('video_id',$id);
			$this->db->update('av_video_downloads', $clean_video_download);
			
			$this->db->where('id',$id);
			$this->db->update('av_video_location', $clean_video_location);
			
			foreach($this->getLanguage() as $key =>$value){
			//language
				$clean_description = clean_db_data('av_video_detail',$data['description'][$value['id']]);
				$this->db->where('video_id',$id);
				$this->db->where('language_id',$value['id']);
				$this->db->update('av_video_detail', $clean_description);
			}
		}
		
		//gallery images
		$this->update_scene_gallery($id,$data['video_scenes']);
		if(isset($data['gallery'])){ $this->update_gallery($id,$data['gallery']); }
		
		return $id;
		
	}
	
	public function update_gallery($video_id=0, $data){
	
		$this->db->delete('av_video_gallery', array('video_id' => $video_id)); //delete gallery via id
		
		if(count($data)>0){ //insert new content if have
			
			foreach($data as $value){
				$value['image'] = str_replace(URL_FILEMANAGER_SOURCE,'',$value['image']); //filemanger save content with 
				$value['video_id'] = $video_id;
				$this->db->insert('av_video_gallery',$value);
			}
		
		}
		
	}
	
	public function update_scene_gallery($video_id=0, $data){
	
		$this->db->delete('av_video_scenes', array('video_id' => $video_id)); //delete gallery via id
		
		if(count($data)>0){ //insert new content if have
			
			foreach($data as $value){
				$value['image'] = str_replace(URL_FILEMANAGER_SOURCE,'',$value['image']); //filemanger save content with 
				$value['video_id'] = $video_id;
				$this->db->insert('av_video_scenes',$value);
			}
		}
		
	}
	

	public function deleteVideo($video_id=0){
		
		$this->db->delete('av_video', array('id' => $video_id)); 
		$this->db->delete('av_video_detail', array('video_id' => $video_id)); 
		$this->db->delete('av_video_downloads', array('video_id' => $video_id)); 
		$this->db->delete('av_video_gallery', array('video_id' => $video_id)); 
		$this->db->delete('av_video_location', array('video_id' => $video_id)); 
		$this->db->delete('av_video_scenes', array('video_id' => $video_id)); 
		
		$this->deleteCommentRef($video_id);
		
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
		$this->db->delete('av_review', array('ref_id' => $id,'review_type'=>'video')); //ref_id
		return true;
	}
	
	public function setVideoComment($data){
	
		$clean_data = clean_db_data('av_review',$data);
		$clean_data['date_added'] =  date('Y-m-d H:i:s');
		$clean_data['user_id'] = $this->session->userdata('id');
		$clean_data['user_group'] = 'admin';
		$clean_data['review_type'] = 'video';
		$clean_data['status'] = 1;
		
		$this->db->insert('av_review', $clean_data);
		
	}
	
	public function setCommentStatus($data,$id){
	
		$clean_data = clean_db_data('av_review',$data);
		
		$this->db->where('id',$id);
		$status= $this->db->update('av_review', $clean_data);
		return  $status;
	}
	
	public function updateFeaturedVideo($id){
	

		$this->db->where('is_featured','1');
		$this->db->update('av_video', array('is_featured'=>0));
		
		$this->db->where('id',$id);
		$this->db->update('av_video', array('is_featured'=>1));
		return true;
	}
	
	public function getComments($ref_id) {
	
		$sql = ' ref_id = '.$ref_id;
		$sql .= ' AND parent_id = 0 ';
		$sql .= ' AND review_type = "video" ';
		//$sql .= ' AND status = 0 ';
		//$nested = '(select username from auction_members am where ac.user_id=am.id) as username',
		
		$query = $this->db->query('SELECT *  FROM av_review ac WHERE
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
		$sql .= ' AND review_type = "video" ';
		
		$query = $this->db->query('SELECT * FROM av_review ac WHERE
		'.$sql.' ORDER BY date_added desc');
		//echo $this->db->last_query(); die;
		
		return ($query) ? $query->result_array(): array();
		
	}
	
	public function getAuctionBid($id) {
		$sql = ' video_id = '.$id;
		
		$query = $this->db->query('SELECT *, (select username from auction_members am where ab.user_id=am.id) as username  FROM av_video_bidding ab WHERE
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
	
}

?>