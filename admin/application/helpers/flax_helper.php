<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('clean_db_data')) { //jolo
    function clean_db_data($table,$content = array()) {
    
		$CI =&get_instance();
		$CI->load->database();
		
		$query = $CI->db->list_fields($table);
		$arr = array();
		
		if(count($query)>0){
		
			foreach($query as $column){
				
				if(isset($content[$column])){
					$arr[$column] = $content[$column];
				}
			}
		}
		
		return  $arr;
			
		
    }   
}

if (!function_exists('phantom_db_picker')) { //jolo
    function phantom_db_picker($table,$column,$where=array()) { //single column only
    
		$CI =&get_instance();
		$CI->load->database();
		
		$CI->db->select($column);
		$CI->db->where($where);
		$CI->db->from($table);
		
		$query = $CI->db->get();
		//echo $this->db->last_query();

		$data =  ($query) ? $query->row_array(): array();
		
		
		return  $data[$column];
    }   
}



/** print out array and objects and variables **/
if (!function_exists('fp')) {
    function fp($array = array()) {
    	echo "<pre style='background: #000000; color: #ff0000'>";
    	print_r($array);
    	echo "</pre>";
    }   
}

/** print out array and objects and variables and exit**/
if (!function_exists('fd')) {
    function fd($array = array()) {
    	echo "<pre style='background: #000000; color: #ff0000'>";
    	print_r($array);
    	echo "</pre>";
    	die();
    }   
}

/** returns array **/
if (!function_exists('convert_stdobject')) {
    function convert_stdobject($stdobject = '') {
    	return json_decode(json_encode($stdobject), TRUE);
    }   
}

/** generate URL **/
if (!function_exists('generate_url')) {
    function generate_url($path = '', $args = array()) {
    	
    	if((count($args) > 0) && (!empty($path))) {

    		$argu = '';

    		foreach($args as $var => $val) {
    			$argu .= '&' . $var . '=' . $val;
    		}
    		
    		return site_url($path . '?' . $argu);

    	}

    }   
}

/** random date **/
if (!function_exists('randomDate')) {
    function randomDate($start_date, $end_date) {
        // Convert to timetamps
        $min = strtotime($start_date);
        $max = strtotime($end_date);

        // Generate random number using above bounds
        $val = rand($min, $max);

        // Convert back to desired date format
        return date('Y-m-d', $val);
    }
}

/** breadcrumbs **/
if (!function_exists('gen_breadcrumbs')) {
    function gen_breadcrumbs($data_array = array()) {


        if(count($data_array) > 0) {

            end($data_array);
            $last_key = key($data_array); 

            $html  = "<ol class='breadcrumb'>";
            foreach($data_array as $name => $link) {
                $class = ($name == $last_key) ? 'active' : '';
                $html .= "<li class='" . $class . "'><a href='" . $link . "'>" . $name . "</a></li>";
            }
            $html .= "</ol>";

            return $html;

        } else {
            return array();
        }

    }   
}

/** json encoder header **/

if (!function_exists('json_header')) {
    function json_header() {
        header('Access-Control-Allow-Origin: *');
        header("Content-Type: application/json");
    }
}

/** sort multidimensional array with its index. If index is not in order you can use this **/
if (!function_exists('array_sort')) {
    function array_sort($array, $on, $order=SORT_ASC){

        $new_array = array();
        $sortable_array = array();

        if (count($array) > 0) {
            foreach ($array as $k => $v) {
                if (is_array($v)) {
                    foreach ($v as $k2 => $v2) {
                        if ($k2 == $on) {
                            $sortable_array[$k] = $v2;
                        }
                    }
                } else {
                    $sortable_array[$k] = $v;
                }
            }

            switch ($order) {
                case SORT_ASC:
                    asort($sortable_array);
                    break;
                case SORT_DESC:
                    arsort($sortable_array);
                    break;
            }

            foreach ($sortable_array as $k => $v) {
                $new_array[$k] = $array[$k];
            }
        }

        return $new_array;
        
    }
}

if (!function_exists('format_mysql_time')) {
    function format_mysql_time($date, $format) {
        $convert = strtotime($date);
        return date($format, $convert);
    }
}

if (!function_exists('short_number')) {
    function short_number($n) {
    	// first strip any formatting;
    	$n = (0+str_replace(",", "", $n));

    	// is this a number?
    	if (!is_numeric($n)) return false;

    	// now filter it;
    	if ($n > 999999999999) return round(($n/1000000000000), 2).' T';
    	elseif ($n > 999999999) return round(($n/1000000000), 2).' B';
    	elseif ($n > 999999) return round(($n/1000000), 2).' M';
    	elseif ($n > 1000) return round(($n/1000), 2).' K';

    	return number_format($n);
    }
}

if(!function_exists('month_name')) {
    function month_name($int_month) {
        $month_array = array(
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December'
        );
        return $month_array[$int_month];
    }
}

if(!function_exists('monthDropdown')) {
    function monthDropdown($name="month", $selected=null) {
            $dd = '<select name="'.$name.'" id="'.$name.'" class="form-control input_white form_control_outline input-sm">';

            $months = array(
                    1 => 'January',
                    2 => 'February',
                    3 => 'March',
                    4 => 'April',
                    5 => 'May',
                    6 => 'June',
                    7 => 'July',
                    8 => 'August',
                    9 => 'September',
                    10 => 'October',
                    11 => 'November',
                    12 => 'December');

            /*** the current month ***/
            $selected = is_null($selected) ? date('n', time()) : $selected;

            //$dd .= '<option value="" selected="selected"> -- Select Month -- </option>';

            for ($i = 1; $i <= 12; $i++)
            {
                    $dd .= '<option value="'.$i.'"';
                    if ($i == $selected)
                    {
                            $dd .= ' selected';
                    }
                    /*** get the month ***/
                    $dd .= '>'.$months[$i].' , ' . date('Y') . '</option>';
            }
            $dd .= '</select>';
            return $dd;
    }
}

if(!function_exists('hoursToDays')) {
	function hoursToDays($hours,$hid=24){
		$days = $hours/$hid;
		$remainder = $hours % $hid;
		
		$text = ($days>=1)? (($days<2)? round($days).' Day ': round($days).' Days '): '';
		$text .= ($remainder>0)? (($remainder==1)? $remainder.' hour ': $remainder.' hours '): '';
		
		return $text; 
		
	}

}

if(!function_exists('readMore')) {
	
	function readMore($string='',$url='',$maxlenght=250,$position='left',$class='text-primary',$label='Read more'){
		$string = strip_tags($string);

		if (strlen($string) > $maxlenght) {

			// truncate string
			$stringCut = substr($string, 0, $maxlenght);

			// make sure it ends in a word so assassinate doesn't become ass...
			$string = substr($stringCut, 0, strrpos($stringCut, ' ')).'... <a href="'.$url.'" class="'.$position.' '.$class.'">'.$label.'</a>'; 
		}
		return $string;
	}

}

if(!function_exists('readMoreJS')) {
	
	function readMoreJS($string='',$action='',$maxlenght=250,$position='left',$class='text-primary',$label='Read more'){
		$string = strip_tags($string);

		if (strlen($string) > $maxlenght) {

			// truncate string
			$stringCut = substr($string, 0, $maxlenght);

			// make sure it ends in a word so assassinate doesn't become ass...
			$string = substr($stringCut, 0, strrpos($stringCut, ' ')).'... <a onclick="'.$action.'"  data-target="" class="'.$position.' '.$class.'">'.$label.'</a>'; 
		}
		return $string;
	}

}

if(!function_exists('readMoreModal')) {
	
	function readMoreModal($string='',$action='',$maxlenght=250,$position='left',$class='text-primary',$label='Read more'){
		$string = strip_tags($string);

		if (strlen($string) > $maxlenght) {

			// truncate string
			$stringCut = substr($string, 0, $maxlenght);

			// make sure it ends in a word so assassinate doesn't become ass...
			$string = substr($stringCut, 0, strrpos($stringCut, ' ')).'... <span data-target="#simpleModal" data-toggle="modal" class="'.$position.' '.$class.'">'.$label.'</span>'; 
		}
		return $string;
	}

}

if(!function_exists('titleHeader')) {
	
	function titleHeader($string=''){
		
		$title= explode(' ',$string,3); //limit of 3 only
	
		if(count($title)==3){
			return '<div class="text-lg text-bold "><span class="text-default ">'.$title[0].'<span class="text-primary ">'.$title[1].'<span class="text-default ">'.$title[2].'</span></div>'; //$this->system_config->getConfig('system_name');
		}else{
			return '<span class="text-lg text-bold text-default ">'.$title[0].'<span class="text-primary">'.$title[1].'</span></span>'; //$this->system_config->getConfig('system_name');
		}
	}

}

if(!function_exists('configNameCleaner')) {
	
	function configNameCleaner($name = ''){
		$text= ucwords(str_replace('_',' ',str_replace('-',' ',$name)));
		return $text;
	}
}

if(!function_exists('customField')) {
	/*
		fix input type list 'input','textarea','texteditor-simple','texteditor-full','radio','checkbox','select','file','date','time','datetime','color'
	*/
	
	function customField($type='input', $name='', $value='', $data_opt= array()){
		$content = '';
		
		switch($type){
			
			case 'input':
				$content = '<input class="form-control" id="'.$name.'" name="'.$name.'" value="'.set_value($name,$value).'" type="text" placeholder="" />';
			break;
			
			case 'textarea':
				$content = '<textarea class="form-control white_textbox" id="'.$name.'" name="'.$name.'">'.$value.'</textarea>';
			break;
			
			case 'texteditor':
				$content = '<textarea class="form-control tinymce" id="'.$name.'" name="'.$name.'">'.$value.'</textarea>';
				
			break;
			
			case 'texteditor-simple':
				$content = '<textarea class="form-control simpleEditor" id="'.$name.'" name="'.$name.'">'.$value.'</textarea>';
				
			break;
			
			case 'texteditor-full':
				$content = '<textarea class="form-control" id="'.$name.'" name="'.$name.'">'.$value.'</textarea>';
			break;
			
			case 'radio':
				
				if(count($data_opt)>0){
					foreach($data_opt as $data){
						
						$content .= '<div><label class="radio-styled radio-primary col-sm-1">';
						$content .= '<input name="'.$name.'" '.(($value==$data['id'])? 'checked="checked"': '').' value="'.$data['id'].'" type="radio"><span>'.$data['value'].'</span>';
						$content .= '</label></div>';
					
					}
					$content .=	'<div class="clearfix"></div>';
				}
				
			break; 
			
			case 'checkbox':
					
					if(count($data_opt)>0){
						foreach($data_opt as $data){
						
						$content .= '<div><label class="checkbox-styled checkbox-primary col-xs-6 col-sm-3">';
						$content .= '<input name="'.$name.'[]" '.((in_array($data['id'],explode(',',$value)))? 'checked="checked"': '').' value="'.$data['id'].'" type="checkbox"><span>'.$data['value'].'</span>';
						$content .= '</label></div>';
					
						}
					}
					
					$content .=	'<div class="clearfix"></div>';
					
			break; 
			
			case 'select':
					
					$content .= '<select name="'.$name.'" class="form-control" name="status">';
					$content .= '<option></option>';
					
					if(count($data_opt)>0){
						foreach($data_opt as $data){
							$content .= '<option value="1" '.(($value==$data['id'])? 'selected="selected"': '').'>'.$data['value'].'</option>';
						}
					}
					
					$content .= '</select>';
					
			break;
			
			case 'file':
				$content = '<input class="form-control" id="'.$name.'" name="'.$name.'[]" value="'.$value.'" type="file" placeholder="" />';
			break;
			
			case 'image':
				//$content = '<input class="form-control" id="'.$name.'" name="'.$name.'[]" value="'.$value.'" type="file" placeholder="" />';
				
				$cover_image =  (!empty($value))? str_replace(URL_FILEMANAGER_SOURCE,'',$value): 'no_image.jpg';
															
				$content .= '<input class="form-control" id="img_'.$name.'" name="'.$name.'" value="'.$value.'" type="hidden"  />';
				$content .= '<br/>';
				$content .= '<div class="thumbnail">';
				$content .= '<img src="'.URL_FILEMANAGER_SOURCE.$cover_image.'" id="img_'.$name.'_preview" class="img-responsive" style="max-height:400px">';
				$content .= '</div>';
																	
				$content .= '<div class="col-xs-12 col-sm-6 col-md-6">';
				$content .= '<div class="btn btn-default-bright btn-loading-state" data-loading-text="&lt;i class=\'fa fa-spinner fa-spin\'&gt;&lt;/i&gt; Loading..." data-toggle="modal" data-target="#fileManagerModal" data-urlpath="'.URL_FILEMANAGER.'?type=1&akey=admin&field_id=img_'.$name.'"><span class="md md-my-library-books"></span>Browse</div>';
				$content .= '</div>';
												
				$content .=	'<div class="col-xs-12 col-sm-6 col-md-6"><span class="help">';
				$content .=	'Note:<br/> Preferred max dimension: <b class="text-primary">640px × 652</b> pixels ';
				$content .=	'</span>';
				$content .= '<span class="help">';
				$content .=	'Click browse to change Image';
				$content .=	'</span>';									
				$content .=	'</div><div class="clearfix"></div>';
				
				
			break;
			
			case 'date':
				$content = '<input class="form-control" id="'.$name.'" name="'.$name.'" value="'.$value.'" type="text" placeholder="" />';
			break;
			
			case 'time':
				$content = '<input class="form-control" id="'.$name.'" name="'.$name.'" value="'.$value.'" type="text" placeholder="" />';
			break;
			
			case 'datetime':
				$content = '<input class="form-control" id="'.$name.'" name="'.$name.'" value="'.$value.'" type="text" placeholder="" />';
			break;
			
			case 'color':
				$content = '<input class="form-control" id="'.$name.'" name="'.$name.'" value="'.$value.'" type="color" placeholder="" />';
			break; 
			
			case 'number':
				$content = '<input class="form-control" id="'.$name.'" name="'.$name.'" value="'.$value.'" type="number" placeholder="" />';
			break;
			
			default:
				$content = $name.' : '.$value;
			break; 
	
		}
		
		return $content;
	}

}




