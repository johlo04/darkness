<?php echo $header; ?>
<?php echo $sidebar_left; ?>
<div id="content">
	<section class="style-default-light">
		
		<div class="section-header">
			<h2 class="text-primary"><?php echo isset($page_title) ? $page_title : $system_title; ?></h2>
			<?php echo $breadcrumbs; ?>
			<div class="clearfix"></div>
		</div>

		<div class="section-body">
			
			<div class="section-body">
			
			<hr />
			
			<?php if(null !== ($this->session->flashdata('status'))){ ?> 
				<div class="row">
						<div class="col-md-12">
							<div role="alert" class="alert alert-callout alert-success">
									<?php echo $this->session->flashdata('status_info'); ?>
							</div>
					</div>
				</div>
			<?php } ?> 
		
					<div class="col-md-12">
								<div class="card">
									<div class="card-head">
										<ul data-toggle="tabs" class="nav nav-tabs">
											<li class="active"><a href="#first1">General Config</a></li>
											<li class=""><a href="#second1">Sytem Info</a></li>
											<li class=""><a href="#third1">Development Config</a></li>

										</ul>
										
									</div><!--end .card-head -->
									<div class="card-body tab-content">
										
											<div id="first1" class="tab-pane active">				
												<?php echo form_open(site_url('system/system'),  array('class' => 'form')); ?>						
												<div class="col-md-12">
													<div class="form-group">
														<label for="system_name">Website Name:</label>
														<input class="form-control" id="system_name" name="system_name" value="<?php echo set_value('system_name',$rowdata['system_name']); ?>" type="text" placeholder="My System" />
														
													</div>
												
												</div>
												
												<div class="col-md-6">
													<div class="form-group">
														<label for="owner_name">Owner Name:</label>
														<input class="form-control" id="owner_name" name="owner_name" value="<?php echo set_value('owner_name',$rowdata['owner_name']); ?>" type="text" placeholder="HDMF NO" />
														
													</div>
												
												</div>
												
												<div class="col-md-6">
													<div class="form-group">
														<label for="location">Location:</label>
														<input class="form-control" id="location" name="location" value="<?php echo set_value('location',$rowdata['location']); ?>" type="text" placeholder="HDMF NO" />
														
													</div>
												
												</div>
												
												<div class="col-md-6">
													<div class="form-group">
														<label for="record_per_page">Number of data per Page:</label>
														<input class="form-control" id="record_per_page" name="record_per_page" value="<?php echo set_value('record_per_page',$rowdata['record_per_page']); ?>" type="number" placeholder="HDMF NO" />
														
													</div>
												
												</div>
												
												<div class="col-md-6">
													<div class="form-group">
														<label for="theme">Default Theme:</label>
														<select name="theme" class="form-control">
														<option value="default" <?php echo (($rowdata['theme']=='default'))? 'selected="selected"': ''; ?>>Default</option>
														</select>
													</div>
												
												</div>
												
												<?php if(isset($rowdata['en_home_attention'])){ ?>
													<div class="col-md-6">
														<div class="form-group">
															<label for="en_home_attention">EN Home Attention:</label>
															<textarea class="form-control" name="en_home_attention"><?php echo $rowdata['en_home_attention']; ?></textarea>
														</div>
													</div>
												<?php } ?>
												
												<?php if(isset($rowdata['jp_home_attention'])){ ?>
													<div class="col-md-6">
														<div class="form-group">
															<label for="jp_home_attention">JP Home Attention:</label>
															<textarea class="form-control" name="jp_home_attention"><?php echo $rowdata['jp_home_attention']; ?></textarea>
														</div>
													</div>
												<?php } ?>
												
												<?php /* if(isset($rowdata['vr_index_banner'])){ ?>
												
												<div class="col-md-6">
															
													<div class="form-group">
																
														<?php
															$vr_index_banner =  (!empty($rowdata['vr_index_banner']))? str_replace(URL_FILEMANAGER_SOURCE,'',$rowdata['vr_index_banner']): 'no_image.jpg';
														?>
														
														<input class="form-control" id="vr_index_banner" name="vr_index_banner" value="<?php echo set_value('vr_index_banner',$vr_index_banner); ?>" type="hidden"  />
														<br/>
														<div class="thumbnail">
														
															<img src="<?php echo URL_FILEMANAGER_SOURCE.$vr_index_banner; ?>" id="vr_index_banner_preview" class="img-responsive" style="max-height:354px">
															
														</div>
														
														<div class="btn btn-default-bright btn-loading-state" data-loading-text="&lt;i class='fa fa-spinner fa-spin'&gt;&lt;/i&gt; Loading..." data-toggle="modal" data-target="#fileManagerModal" data-urlpath="<?php echo  URL_FILEMANAGER.'?type=1&akey=admin&field_id=vr_index_banner'; ?>"><span class="md md-my-library-books"></span>Browse</div>
															
														<label for="client_name">
															<span class="fa fa-play-circle"></span> Home Banner
															<span class="help">
																Click browse to change Image
															</span>
														<div class="clearfix"></div>
														</label>
														
														<span class="help">
															Note:  <br/>Preferred dimension: <b class="text-primary">960W × 662H</b> pixels
														</span>
														<div class="clearfix"></div>
													</div>
												</div>
												
												
												<?php } */ ?>
												
												<?php if(isset($rowdata['config_meta_description'])){ ?>
													<div class="col-md-6">
														<div class="form-group">
															<label for="config_meta_description">Meta Description:</label>
															<textarea class="form-control" name="config_meta_description"><?php echo $rowdata['config_meta_description']; ?></textarea>
														</div>
													</div>
												<?php } ?>
												

												
												<div class="col-md-6">
													<div class="form-group">
													
														<label for="show_notification">User Notification:</label>
														<select name="show_notification" class="form-control">
														<option value="1" <?php echo (($rowdata['show_notification']==1))? 'selected="selected"': ''; ?>>Enable</option>
														<option value="0" <?php echo (($rowdata['show_notification']==0))? 'selected="selected"': ''; ?>>Disable</option>
														</select>
													</div>
												
												</div>
										
												<div class="form-group col-md-12">
													<div class="text-right pull-right col-md-2">
														
														<input type="submit" value="Update" class="btn btn-primary btn-block" />
													</div>
												</div>
												<?php echo form_close(); ?>
												
												<?php foreach($rowdata_all as $value){ ?>
													<div class="<?php echo $value['holder_class']; ?>">
														<div class="form-group">
															<label for="config_meta_description">Meta Description:</label>
															<?php echo customField(); ?>
														</div>
													</div>
												
												<?php } ?>
												
												
												
											</div>
										
						
											
											<div id="second1" class="tab-pane">
												<div class="col-md-12">
													<div class="col-md-6">	PHP version: </div>
													<div class="col-md-6"><?php echo phpversion(); ?></div>		
												</div>
												<div class="col-md-12">
													<div class="col-md-6">	Mysql Database version: </div>
													<div class="col-md-6"><?php echo mysql_get_client_info(); ?></div>	
												
												</div>
												<div class="col-md-12">
													<div class="col-md-6">	Protocol: </div>
													<div class="col-md-6"><?php echo @mysql_get_proto_info(); ?></div>
																	
												</div>
												<div class="col-md-12">
													<div class="col-md-6">	Host Info: </div>
													<div class="col-md-6"><?php echo @mysql_get_host_info(); ?></div>	
												
												</div>
												
											</div>
											
											<div id="third1" class="tab-pane">
												<div><span class="text-primary">Add New Config </span><span class="help">(For developer use only.)</span></div>
													
												<div class="card col-md-12">
														
														<div class="card-body">
															
															<div class="col-md-3">Config Name:</div>		
															<div class="col-md-3"><input type="text" class="newConfig" name="config_name"></div>		
															<div class="col-md-3">Config Value</div>		
															<div class="col-md-3"><input type="text" class="newConfig" name="config_value"></div>
															<div class="clearfix"></div>
															<div class="col-md-3 margin-top pull-right">
																<span class="btn btn-default btn-sm btn-loading-state" data-loading-text="&lt;i class='fa fa-spinner fa-spin'&gt;&lt;/i&gt; Processing..." onclick="newConfig();">Add Config</span>
															</div>		
														</div>													
													
												</div>
												
												<div><span class="text-primary">Data Content Fixer (Tinymce:) </span><span class="help">(For developer use only.)</span></div>
													
												<div class="card col-md-12">
														
														<div class="card-body">
														
															<div class="col-md-3">
																Table Field: 
																<select id="" name="system_table_update">
																	<option></option>
																	<optgroup label="Description">
																		<option value="actress_detail.fullhd">Actress Description</option>
																		<option value="av_video_detail.fullhd">Video Description</option>
																	</optgroup>
																	
																	<optgroup label="Downloads">
																		<option value="av_video_downloads.fullhd">av_video_downloads.fullhd</option>
																		<option value="av_video_downloads.hdlite">av_video_downloads.hdlite</option>
																		<option value="av_video_downloads.mobile">av_video_downloads.mobile</option>
																		<option value="av_video_downloads.gallery_zip">av_video_downloads.gallery_zip</option>
																		<option value="av_video_downloads.scene_zip">av_video_downloads.scene_zip</option>
																		<option value="av_video_downloads.all">av_video_downloads.*</option>
																	</optgroup>
																	<optgroup label="Video Location">
																		<option value="av_video_location.clip_mp4">av_video_location.clip_mp4</option>
																		<option value="av_video_location.clip_webm">av_video_location.clip_webm</option>
																		<option value="av_video_location.clip_ogv">av_video_location.clip_ogv</option>
																		<option value="av_video_location.clip_360_vr">av_video_location.clip_360_vr</option>
																		<option value="av_video_location.full_mp4">av_video_location.full_mp4</option>
																		<option value="av_video_location.full_webm">av_video_location.full_webm</option>
																		<option value="av_video_location.full_ogv">av_video_location.full_ogv</option>
																		<option value="av_video_location.all">av_video_location.*</option>
																	</optgroup>
																</select>
																<span class="help">Select data table field</span>																
															</div>
															
															<div class="col-md-3">
																Search: <br/>
																<input type="text" name="current_keyword">
																<span class="help">Input word(s) you want to CHANGE in the data table field<br/>Please be exact to the keyword.</span>
															</div>
															
															<div class="col-md-3">
																Replace:  <br/>
																<input type="text" name="new_keyword">
																<span class="help">Input word(s) you want to REPLACE WITH in the data table field</span>
															</div>
															
															<div class="col-md-3">
																<span class="btn btn-default btn-sm btn-loading-state" data-loading-text="&lt;i class='fa fa-spinner fa-spin'&gt;&lt;/i&gt; Processing..." onclick="clean_tinymce_table();">Run script</span>
															</div>	
															
														</div>													
													
												</div>
											</div>
									
										
									</div><!--end .card-body -->
								</div>
					</div>
					<em class="text-caption">Please fill up the required inputs.</em>
			</div>
		</div>
				
	</section>
	
		<div class="modal fade" id="fileManagerModal" tabindex="-1" role="dialog" aria-labelledby="fileManagerModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
			<div class="modal-dialog modal-lg">
			<div class="modal-content">
					<div class="modal-header">
							
							<h3 class="modal-title">File Manager</h3>
						
							<div class="tools stick-top-right">
								<div class="btn-group">
									<a class="btn btn-icon-toggle btn-close" data-dismiss="modal" aria-hidden="true"><i class="md md-close"></i></a>
								</div>
							
							</div>
					
					</div>
					
					<div class="modal-body"> 
						  
					</div>
					
					<div class="modal-footer">
						<div class="col-md-12 text-right">
							<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">close</button>
						</div>
					</div>
					
				</div>
			</div>
	</div>
	
</div>

<script>
	$(document).ready(function(){
	
		$('#fileManagerModal').on('shown.bs.modal', function(event){
			var action = $(event.relatedTarget)
			var modal = $(this)
			$content = '';
			$('#meeting_save_button').removeClass('btn-warning').addClass('btn-default');
			//&akey=myPrivateKeyadmin$id = (action.data('id'))? action.data('id'): 0;
			//loads content
			//modal.find('.modal-body').html('<span class="fa fa-spinner fa-spin"></span>Loading Please Wait').load("<?php echo site_url('clients/client/view_meeting_modal'); ?>/"+$id+"/client_id/"+$client_id);
			$content=  '<iframe style="display:block; width: 100%; min-height: 450px;" src="'+action.data('urlpath')+'" frameborder="0" allowtransparency="true"></iframe>';
			
			modal.find('.modal-body').html($content);
				//modal.find('.modal-title').html('header');
				
			});
	});

</script>
<script type="text/javascript">

$('[data-toggle="tooltip"]').tooltip();

function newConfig(){
$.ajax({
	type: 'post',
	data: {config_name: $('input[name="config_name"]').val(),config_value: $('input[name="config_value"]').val()},
	url: '<?php echo site_url('system/system/addConfig'); ?>',
	dataType: 'json',
	error: function(){
		makeToast('danger','Error Processing your request');
	},
	success: function(d){
		makeToast(d.status,d.status_message);
		if(d.status=='success'){ //clear data
			$('input[name="config_name"]').val('');
			$('input[name="config_value"]').val('');
		}
	}
	
	
});

}

function clean_tinymce_table(){
if(confirm('Warning: This script should be used after installation only, \nRunning this script may destroy the content based on the inputted change you request. \nDo you wish to proceed?')){
	$.ajax({
		type: 'post',
		data: {system_table: $('select[name="system_table_update"]').val(),current_keyword: $('input[name="current_keyword"]').val(),new_keyword: $('input[name="new_keyword"]').val()},
		url: '<?php echo site_url('system/system/clean_tinymce_textarea'); ?>',
		dataType: 'json',
		error: function(){
			makeToast('danger','Error Processing your request');
		},
		success: function(d){
			makeToast(d.status,d.status_message);
			if(d.status=='success'){ //clear data
				$('input[name="new_keyword"]').val('');
			$('input[name="current_keyword"]').val('');
			}
		}
		
		
	});
}
}


</script>
<?php echo $footer; ?>