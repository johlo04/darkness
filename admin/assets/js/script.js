/**
* Custom functions
* By: Flax Inc.
* Dependencies: Jquery, Jquery UI, Bootstrap JS, Toastr, tinymce
**/

function imagePicker(){

/*
type: the type of filemanager (1:images files 2:all files 3:video files)
fldr: the folder where i enter (the root folder remains the same). default=""
sort_by: the element to sorting (values: name,size,extension,date) default=""
descending: descending? or ascending (values=1 or 0) default="0"
lang: the language code (ex: &lang=en_EN). default="en_EN"
relative_url: should be added to the request with a value of "1" when opening RFM. Otherwise returned URL-s will be absolute. extensions: a json encoded array of available files extensions (ex: &extensions=["pdf",'doc'])
*/

}


function responsive_filemanager_callback(field_id){

	var url=$('#'+field_id).val();
	$('#'+field_id+'_preview').attr('src',url);
	//alert('update '+field_id+" with "+url);

	return false;
}
   
$('[data-toggle="tooltip"]').tooltip();

function fullEditor($selector){
	tinymce.init({
			selector: $selector, 
			height: 220,
			theme: 'modern',
			plugins: [
				'advlist autolink lists link image charmap print preview hr anchor pagebreak',
				'searchreplace wordcount visualblocks visualchars code fullscreen',
				'insertdatetime media nonbreaking save table contextmenu directionality',
				'emoticons template paste textcolor colorpicker textpattern imagetools responsivefilemanager',
			],
			toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | styleselect formatselect fontselect fontsizeselect',
			toolbar2: 'print preview media | forecolor backcolor | template',
			image_advtab: true,
			templates: [
				{ title: '9A-Visa Application NON-PEZA', description: '9A-Visa Application NON PEZA template', url: '<?php echo site_url("contracts/contracts/load_9A_Visa_Non_Peza"); ?>'},
				{ title: '9A-Visa Application PEZA', description: '9A-Visa Application PEZA Template', url: '<?php echo site_url("contracts/contracts/load_9A_Visa_Peza"); ?>'},
				{ title: '9G-Visa Downgrade NON-PEZA', description: '9G-Visa Downgrade PEZA Template', url: '<?php echo site_url("contracts/contracts/load_9G_Visa_Non_Peza"); ?>'},
				{ title: '9G-Visa Application PEZA', description: '9G-Visa Application PEZA Template', url: '<?php echo site_url("contracts/contracts/load_9G_Visa_Peza"); ?>'},
				{ title: '41(A)-Visa Application PEZA', description: '41(A)-Visa Application PEZA Template', url: '<?php echo site_url("contracts/contracts/load_41A_Visa_Peza"); ?>'},
				{ title: 'Dependent Spouse Visa NON-PEZA', description: 'Dependent Spouse PEZA Template', url: '<?php echo site_url("contracts/contracts/load_Spouse_Non_Peza"); ?>'},
				{ title: 'Dependent Spouse Visa PEZA', description: 'Dependent Spouse Visa PEZA Template', url: '<?php echo site_url("contracts/contracts/load_Spouse_Peza"); ?>'},
				{ title: 'Grace-Period Application NON-PEZA', description: 'Grace-Period Application PEZA Template', url: '<?php echo site_url("contracts/contracts/load_Grace_Period_Non_Peza"); ?>'}
			],
			content_css: [
				'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'
			],
			theme_advanced_buttons3_add : "template"
	});
}

function simpleEditor($selector){
	
	var $url_full = location.protocol+'//'+location.hostname+(location.port ? ':'+location.port: '')+'/cleancms';
	//var $url = window.location.href;
	
	tinymce.init({
			selector: $selector,
			 menu: {
				file: {title: 'File', items: 'newdocument'},
				edit: {title: 'Edit', items: 'undo redo | cut copy paste pastetext | selectall'},
				insert: {title: 'Insert', items: 'link media | template hr'},
				view: {title: 'View', items: 'visualaid'},
				//format: {title: 'Format', items: 'bold italic underline strikethrough superscript subscript | formats | removeformat'},
				table: {title: 'Table', items: 'inserttable tableprops deletetable | cell row column'},
				//tools: {title: 'Tools', items: 'spellchecker code'}
			},
			height: 220,
			theme: 'modern',
			
			plugins: [
				'advlist autolink lists link image charmap print preview hr anchor pagebreak',
				'searchreplace wordcount visualblocks visualchars code fullscreen',
				'insertdatetime media nonbreaking save table contextmenu directionality',
				'paste textcolor colorpicker textpattern imagetools responsivefilemanager',
			],
			relative_urls: false,
			toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | print preview media | forecolor backcolor |  link image responsivefilemanager',
			image_advtab: true,
			external_filemanager_path: $url_full+"/admin/assets/resources/tinymce/filemanager/", //change this
			filemanager_title: "Responsive Filemanager" ,
			external_plugins: { "filemanager" : $url_full+"/admin/assets/resources/tinymce/filemanager/plugin.min.js"}, //change this
			remove_script_host: false,
			filemanager_access_key:"admin",
			
			content_css: [
				'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'
			]
	});
}

function textEditor($selector){
	tinymce.init({
			selector: $selector, 
			height: 220,
			menubar:false,
			statusbar: false,
			theme: 'modern',
			plugins: [
				'advlist autolink lists link image charmap print preview hr anchor pagebreak',
				'searchreplace wordcount visualblocks visualchars code fullscreen',
				'insertdatetime media nonbreaking save table contextmenu directionality',
				'paste textcolor textpattern imagetools',
			],
			toolbar1: 'insertfile undo redo | link | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | preview | textcolor ',
			toolbar2: '',
			image_advtab: true,
			
			content_css: [
				'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'
			]
	});
}

function htmlLoader(id,url_path){	
	$('#'+id).load(url_path);
}

function formValidator($validate){ //must have class="error-[id-name]
	$arr = $validate.split(','); //accept string field1,field2 [id-name]
	$err= [];
	
	if($arr.length){
		for($x=0; $x<$arr.lenght; $x++){
			$val = $('#'+$arr[$x]).val();
			if($val=='' || $val ==0){
				$err.push($x);
				$('error-'+$arr[$x]).addClass('text-warning');
			}else{
				$('error-'+$arr[$x]).removeClass('text-warning');
			}
		}
	}
	
	if($err.lenght>0){
		return	true;
	}else{
		makeToast('danger','Please check the fill up the form correctly.');
		return false;
	}
	
}


function makeToast(status, message = '') {

	toastr.options = {
	  "closeButton": true,
	  "debug": false,
	  "newestOnTop": true,
	  "progressBar": true,
	  "positionClass": "toast-bottom-right",
	  "preventDuplicates": false,
	  "onclick": null,
	  "showDuration": "400",
	  "hideDuration": "1000",
	  "timeOut": "5000",
	  "extendedTimeOut": "1000",
	  "showEasing": "swing",
	  "hideEasing": "linear",
	  "showMethod": "fadeIn",
	  "hideMethod": "fadeOut"
	}

	if(status == 'success') {
		toastr.success(message);
	} else if(status == 'warning') {
		toastr.warning(message);
	} else if(status == 'danger') {
		toastr.error(message);
	} else {
		toastr.info(message);
	}

}

//secret = timestamp
function downloadProcess(id,secret,url_path) {
	makeToast('info','Preparing downloadable file.');
	var win = window.open(url_path, '_blank');
	setTimeout(win, 5000);
	//win.focus();
}


function hoursToDays($hours){
		$days = $hours/24;
		$remainder = $hours % 24;

		$text = ($days>=1)? (($days<2)? Math.round($days)+' Day ': Math.round($days)+' Days '): '';
		$text += ($remainder>0)? (($remainder==0)? $remainder+' hour ': $remainder+' hours '): '';
		
		return $text; 
}

function replaceHtmlLoader(){
	//this is css based loader
	$html  = '<div class="sk-folding-cube">';
	$html += 	'<div class="sk-cube1 sk-cube"></div>';
	$html += 	'<div class="sk-cube2 sk-cube"></div>';
	$html += 	'<div class="sk-cube4 sk-cube"></div>';
	$html += 	'<div class="sk-cube3 sk-cube"></div>';
	$html += '</div>';
return $html;
}

function refresh($name){ //if you want to load data on click or onload
	//.attr("data-id") fallback
	$('#'+$name).html('<span class="fa fa-spinner fa-spin"></span>Loading Please Wait..').load($('#'+$name).data('url'));

}

function realTime($name,$timer=10000){ // if you want to reload realtime
	refresh($name);
	setInterval(function(){
		$('#'+$name).before('<div id="realtimeloading"><span  class="fa fa-spinner fa-spin"></span>Loading Please Wait..</div>').load($('#'+$name).data('url'));
		$('#realtimeloading').remove();
	},$timer); //10secs
	
}

var $interval = [];
var $que = 1; //incrementing value

moment.tz.add('Asia/Tokyo|JCST|-90|0|');

function bid_process($id,$time,$pname,$url){

	moment.tz.add('Asia/Tokyo|JCST|-90|0|');
	
	var eventTime = moment($time);	
	var currentTime = moment().tz('Asia/Tokyo').format('YYYY-MM-DD HH:mm:ss');
	
	if((eventTime.diff(currentTime))>0){
		
		$interval[$id] = setInterval(function(){ //$que is not working.. i used $id instead
			
			var currentTime = moment().tz('Asia/Tokyo').format('YYYY-MM-DD HH:mm:ss');
			var duration = moment.duration(eventTime.diff(currentTime));
			
			if(duration.days() == 0 && duration.hours() == 0 && duration.minutes() == 0 && duration.seconds() == 0) {
				
					$('.countdown'+$id).text('Bidding ended').addClass('text-warning');
					clearInterval($interval[$id]); //stop interval
					set_closebid($id,$pname,$url);
					console.log('close '+$id);
					
			} else {
				$('.countdown'+$id).text(duration.days() + 'd:' + duration.hours() + 'h:' + duration.minutes() + 'm:' + duration.seconds() + 's');
				
			}

		},1000);
		
		$('.endtime'+$id).html(moment(eventTime).format('lll'));
		
	}else{
		console.log('no interval, curr: '+$id);
		$text = '';
		
		if(moment(eventTime).isValid()){
			//alert(1);
			$('.endtime'+$id).html(moment(eventTime).format('lll'));
			$text += moment(eventTime).tz('Asia/Tokyo').fromNow();
			$('.countdown'+$id).html('Ended / Close<br/>'+$text);
			
		}else{
			//alert(0);
			$('.countdown'+$id).html('Not set');
		}
		
	}
}
	
function set_closebid($id,$productname,$url){

	$url += '/'+$id;
	
	$.ajax({
		url: $url,
		type: 'post',
		dataType: 'json',
		error: function(){ alert('error'); },
		success: function(d){
			makeToast('success','Product Bidding:'+$productname+' just ended.');
			$('.product_status'+$id).addClass('text-success').text('* Ended / Close');
		}
	});

}

function formatCurrency(num,iscomma) {
		
		iscomma = (iscomma==1)? ',':''; // if 1 with comma
		num = num.toString().replace(/\$|\,/g,'');
		if(isNaN(num))
		num = "0";
		sign = (num == (num = Math.abs(num)));
		num = Math.floor(num*100+0.50000000001);
		cents = num%100;
		num = Math.floor(num/100).toString();
		if(cents<10)
		cents = "0" + cents;
		for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
		num = num.substring(0,num.length-(4*i+3))+iscomma+
		num.substring(num.length-(4*i+3));
		return (((sign)?'':'-') + num + '.' + cents);
}



