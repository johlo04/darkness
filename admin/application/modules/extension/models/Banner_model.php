<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Banner_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
	
	public function getBanner($filter=array(),$limit_start, $limit_end) {
		$sql = '1';
		
		
		//$query = $this->db->select('*')->from('auction_product p')->join('auction_product_detail pd', 'p.id = pd.product_id', 'left')->order_by("datetime_start", "asc")->order_by("status", "asc")->order_by("datetime_end", "desc")->limit(0,4);
		//$this->db->get();
		
		$query = $this->db->query('SELECT * from home_banner WHERE '.$sql.' ORDER BY sort_order ASC, date_added ASC, status DESC LIMIT '.$limit_start.','.(int)$limit_end);
		//echo $this->db->last_query(); die;
		return ($query) ? $query->result_array(): array();
		
	}
	
	public function getTotalBanner($filter=array()) {
		
		$this->db->select('id');
		$this->db->from('home_banner');
		
		return $count = $this->db->count_all_results();
	}
	

	public function getSingle($id=0) {
		
		$this->db->select('*');
		$this->db->from('home_banner');
		//$this->db->join('auction_product_detail apd', 'ap.id = apd.product_id', 'left');
		$this->db->where('id',$id);
		
		$query = $this->db->get();
		
		return ($query) ? $query->row_array(): array();
	}
	
	
	
	public function update($data, $id=''){
	
		$clean_data = clean_db_data('home_banner',$data);
		
		$clean_data['image'] = str_replace(URL_FILEMANAGER_SOURCE,'',$clean_data['image']);
		
		if(empty($id)){ //insert new
			$clean_data['date_added'] =   date('Y-m-d H:i:s');
			$this->db->insert('home_banner', $clean_data);
			$id= $this->db->insert_id();
			
		}else{
			
			$this->db->where('id',$id);
			$this->db->update('home_banner', $clean_data);
		}
		
		return $id;
		
	}
	
	public function deleteBanner($id=0){
		$this->db->delete('home_banner', array('id' => $id)); 		
	}	
}

?>