<?php echo $header; ?>
<?php echo $sidebar_left; ?>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/css/theme-default/libs/bootstrap-tagsinput/bootstrap-tagsinput.css'); ?>" />
<script type="text/javascript" src="<?php echo base_url('/assets/js/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js'); ?>"></script>

<div id="content">
	<section class="style-default-light">
		
		<div class="section-header">
			<h2 class="text-primary"><?php echo isset($page_title) ? $page_title : $system_title; ?></h2>
			<?php echo $breadcrumbs; ?>
			
			<div class="clearfix"></div>
		</div>
		
		<div class="section-body">
			
			<hr />
					<div class="col-md-12">
							<div class="card">
								<div class="card-head">
									<ul data-toggle="tabs" class="nav nav-tabs ">
										<li class="active"><a href="#general">General</a></li>
										<li class=""><a href="#gallery">Gallery</a></li>
										<li class=""><a href="#comments">Comments</a></li>
										
									</ul>
									
								</div><!--end .card-head -->
								<?php echo form_open($form_link, array('class' => 'form')); ?>
								<div class="card-body tab-content">
										
										<!--tab general-->
										<div id="general" class="tab-pane active">				
											
											<?php echo form_hidden('id',''); ?>
											<div class="col-md-12">
													<div class="tab_content ">
														
														<div class="card tabs-left style-default-light">
															
															<ul class="card-head nav nav-tabs" data-toggle="tabs">
																<?php foreach($language as $lang){ ?>
																<li class="<?php echo ($lang['id']==1)? 'active': ''; ?>">
																	<a href="#lang<?php echo $lang['id']; ?>">
																		</span> <?php echo $lang['name']; ?>
																		<span class="small-txt <?php echo (form_error('description['.$lang['id'].'][name]'))? 'text-danger md md-warning': ''; ?>">
																	</a>
																</li>
																<?php } ?>
															</ul>

															<div class="card-body tab-content style-default-bright ">
																
																<?php foreach($language as $lang){ ?>
																
																<div class="tab-pane <?php echo ($lang['id']==1)? 'active': ''; ?>" id="lang<?php echo $lang['id']; ?>">
																	<div class="col-md-6">
																	
																		<div class="form-group <?php echo (form_error('description['.$lang['id'].'][name]'))? 'has-error': ''; ?>">
																			<input class="form-control" name="description[<?php echo $lang['id']; ?>][name]" value="<?php echo set_value('description['.$lang['id'].'][name]'); ?>" type="text" placeholder="Video Title"  />
																			<label for="actress_name">
																				 Actress Name:<span class="text-danger">*</span> 
																			</label>
																			<?php echo form_error('description['.$lang['id'].'][name]','<span class="help-block">','</span>'); ?>
																		</div>
																		
																		<div class="form-group">
																			<textarea class="form-control" name="description[<?php echo $lang['id']; ?>][meta_description]" type="text" placeholder="Meta Description"><?php echo set_value('description['.$lang['id'].'][meta_description]'); ?></textarea>
																			<label for="meta_description">Meta Description</label>
																		
																		</div>
																		
																		<div class="form-group">
																			<input type="text" name="description[<?php echo $lang['id']; ?>][meta_tags]" value="<?php echo set_value('description['.$lang['id'].'][meta_tags]'); ?>"  data-role="tagsinput" />
																			<label for="tags">Meta Actress Tags</label>
																			<span class="help">Note: Type a word and press [Enter] button; Will be use on how the user will search the actress</span>
																		</div>
																		
																	</div>
																		
																	<div class="col-md-6">
																	
																		<div class="form-group">
																			<textarea class="form-control tinymce" name="description[<?php echo $lang['id']; ?>][description]" type="text" placeholder="Video Detail" ><?php echo set_value('description['.$lang['id'].'][description]'); ?></textarea>
																			<label for="vid_description">Actress Detail</label>
																		</div>
															
																	</div>
																</div>
																
																<?php } ?>
															</div>
														</div><!--end of Language -->
														
														<div class="col-md-6">
															
															<div class="form-group">
																<?php  $cover_image = set_value('cover_image'); ?>
																<input class="form-control" id="cover_image" name="cover_image" value="<?php echo set_value('cover_image'); ?>" type="hidden"  />
																<br/>
																<div class="thumbnail">
																
																	<img src="<?php echo (!empty($cover_image))? $cover_image : URL_FILEMANAGER_SOURCE.'no_image.jpg'; ?>" id="cover_image_preview" class="img-responsive" style="max-height:354px">
																	
																</div>
																<div class="btn btn-default-bright btn-loading-state" data-loading-text="&lt;i class='fa fa-spinner fa-spin'&gt;&lt;/i&gt; Loading..." data-toggle="modal" data-target="#fileManagerModal" data-urlpath="<?php echo  URL_FILEMANAGER.'?type=1&akey=admin&field_id=cover_image'; ?>"><span class="md md-my-library-books"></span>Browse</div>
																	
																<label for="client_name">
																	Cover Image
																	<span class="help">
																		Click browse to change Image
																	</span>
																
																</label>
																
																<span class="help">
																	Note: <br/>Preferred max dimension: <b class="text-primary">640px × 652</b> pixels 
																</span>
																
															</div>
														</div>
														
														
														<div class="col-md-6">
														
															<div class="form-group">
																<input class="form-control" id="artist_since" name="artist_since" value="<?php echo set_value('artist_since'); ?>" type="text" placeholder=""  />
																<label for="artist_since">
																	Artist Date since:
																</label>
											
															</div>
															
															<div class="clearfix"></div>
															
															<div class="">
																<label for="client_name">
																	Actress Type
																</label>
																	<?php 
																	
																	//initalized:
																	if(!isset($category)){ //empty
																		$array_list = array(0); 
																	}elseif(is_array($category) && count($category)>0){ //atleast 1
																		$array_list = $category;
																	}else{ //string (1,2) to array
																		$array_list = explode(',',$category);
																	}

																	?>
																	<div class="card panel">
																		<div class="card-body">
																			<?php 
																			
																			$count=1; foreach($actress_category as $value){ ?>
																				
																				<label class="checkbox-styled checkbox-primary col-sm-6">
																					<input name="category[]" value="<?php echo $value['id']; ?>" <?php echo (in_array($value['id'],$array_list))? 'checked="checked"':''; ?>   data-name="<?php echo $value['en_keyword'].' | '.$value['jp_keyword']; ?>" type="checkbox"><span><?php echo $value['en_keyword'].' | '.$value['jp_keyword']; ?></span>
																				</label>
																				<?php $count++; } ?>
																				
																			<?php if($count==4){ $count=1; ?> <div class="clearfix"></div><?php } ?>
																
																		</div>
																	</div>
															</div>
															
															<div class="clearfix"></div>
															
															<div class="form-group">
																
																<select class="form-control" name="status">
																
																	<option value="1" <?php echo ($status==1)? 'selected="selected"': ''; ?> >Active</option>
																	<option value="0" <?php echo ($status==0)? 'selected="selected"': ''; ?> >Inactive</option>
																</select>
	
																<label for="client_name">
																	Status
																</label>
																
															</div>
															<div class="clearfix"></div>
															
														</div>
														
														<div class="clearfix"></div>

												</div>
											</div>
										</div>
										
										<!--tab gallery-->
										<div id="gallery" class="tab-pane" >
											<div class="col-md-12">
												<table class="table table-bordered border-top" id="gallery_table">
													<thead>
														<tr>
															<td colspan="7" class="">
																	<span class="text-primary"><i class="md md-equalizer"></i>Actress Gallery Image</span>
																	<span class="help">
																		Note: Preferred max dimension: <b class="text-primary">1280W × 720H</b> pixels  
																		Preferred min dimension: <b class="text-primary">720W × 405H</b> pixels
																	</span>
															</td>
														</tr>
														<tr>
															<td>Image</td>
															<td>Text Label</td>
															<td>Sort</td>
															<td>Status</td>
															<td>Action</td>
															
														</tr>
													</thead>
													
													<?php  $img_row = 1;  if(count($gallery)>0){  foreach($gallery as $value){ ?>
															<tbody id="gallery<?php echo $img_row; ?>">
															<?php $gallery_cover = (!empty($value['image']))? str_replace(URL_FILEMANAGER_SOURCE,'',$value['image']): 'no_image.jpg';   ?>
														
															<tr>
																<td class="text-center">
																	<img src="<?php echo URL_FILEMANAGER_SOURCE.$gallery_cover; ?>" id="gallery_img<?php echo $img_row; ?>_preview" class="img-responsive thumbnail" style="border: 1px solid #CCC; max-height: 120px; display: inline;">
																	<input type="hidden" name="gallery[<?php echo $img_row; ?>][image]" value="<?php echo $value['image']; ?>" id="gallery_img<?php echo $img_row; ?>"><br/>
																	<div class="btn btn-default-bright btn-loading-state" data-loading-text="&lt;i class='fa fa-spinner fa-spin'&gt;&lt;/i&gt; Loading..." data-toggle="modal" data-target="#fileManagerModal" data-urlpath="<?php echo  URL_FILEMANAGER.'?type=1&akey=admin&field_id='; ?>gallery_img<?php echo $img_row; ?>"><span class="md md-my-library-books"></span>Browse</div>
																</td>
																<td><input type="text" value="<?php echo $value['text_label']; ?>" name="gallery[<?php echo $img_row; ?>][text_label]"></td>
																<td><input type="text" value="<?php echo $value['sort_order']; ?>" name="gallery[<?php echo $img_row; ?>][sort_order]"></td>
																<td>
														
																	<select class="form-control" name="gallery[<?php echo $img_row; ?>][status]">
																		<option value="1" <?php echo ($value['status']==1)? 'selected="selected"': ''; ?>>Enable</option>
																		<option value="0" <?php echo ($value['status']==0)? 'selected="selected"': ''; ?>>Disable</option>
																	</select>
																
																</td>
																<td class="text-right"><span class="btn btn-icon-toggle" onclick="$('#gallery<?php echo $img_row; ?>').remove();"><i class="fa fa-trash-o"></i></span></td>
															</tr>
															</tbody>
														<?php $img_row++; }} ?>
														
														<tfoot>
															<tr>
																<td colspan="7" class="text-right"><span class="btn btn-icon-toggle btn-primary" onclick="addGallery();"><i class="fa fa-plus"></i></span></td>
															</tr>
														</tfoot>
													
												</table>
												
											<div class="clearfix"></div>
											<hr/>
											
											<script>
											
													$img_row = <?php echo $img_row; ?>; 
													
													function addGallery(){
														$html = '';
														$html+= '<tbody id="gallery'+$img_row+'">';
														$html+= '<tr>';
														
														$html += '<td class="text-center"><img src="<?php echo URL_FILEMANAGER_SOURCE.'no_image.jpg'; ?>" id="gallery_img'+$img_row+'_preview" class="img-responsive thumbnail" style="border: 1px solid #CCC; max-height: 120px; display: inline;">';
														$html += '<input type="hidden" name="gallery['+$img_row+'][image]" value="" id="gallery_img'+$img_row+'"><br/>';
														$html += '<div class="btn btn-default-bright btn-loading-state" data-loading-text="&lt;i class=\'fa fa-spinner fa-spin\'&gt;&lt;/i&gt; Loading..." data-toggle="modal" data-target="#fileManagerModal" data-urlpath="<?php echo  URL_FILEMANAGER.'?type=1&akey=admin&field_id='; ?>gallery_img'+$img_row+'"><span class="md md-my-library-books"></span>Browse</div></td>';
														$html += '<td><input type="text" value="" name="gallery['+$img_row+'][text_label]"></td>';
														$html += '<td><input type="text" value="" name="gallery['+$img_row+'][sort_order]"></td>';
														$html += '<td><select name="gallery['+$img_row+'][status]"><option type="text" value="1" >Enable</option><option type="text" value="0" >Disable</option></select></td>';
														$html += '<td class="text-right"><span class="btn btn-icon-toggle" onclick="$(\'#gallery'+$img_row+'\').remove();"><i class="fa fa-trash-o"></i></span></td>';
														$html += '</tr>';
														$html += '</tbody>';
														
														$('#gallery_table tfoot').before($html);
														
														$img_row++;
														
													}
													
											</script>
											
											</div>
										</div>
										
										<!--tab comments-->
										<div id="comments" class="tab-pane" >
										<span class="help">No comments yet for new actress post.</div>
										</div>
										
										<div class="clearfix"></div>
										<div class="form-group col-md-12">
											<div class="text-right pull-right col-md-2">
												<input type="submit" value="Save" class="btn btn-primary" />
												<a href="<?php echo site_url('option/actress'); ?>"><div class="btn btn-default-bright">Back</div></a>
											</div>
										</div>
									
								</div><!--end .card-body -->
								<?php echo form_close(); ?>		
							</div>
						</div>
					<em class="text-caption">Please fill up the required inputs.</em>

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

<script type="text/javascript" src="<?php echo  base_url('/assets/resources/tinymce/tinymce/tinymce.min.js'); ?>"></script>	
<script>
	$(document).ready(function(){
		
		moment.tz.add('Asia/Tokyo|JCST|-90|0|');
		$('#artist_since').datetimepicker({
			format: 'YYYY-MM-DD'
		});

		
		$('.scene_category').click(function(){
		
			$input=  $(this);
			
			if($input.prop( "checked" )){
				
				addScnGallery($input.data('name'),$input.val());
			}else{
				if(confirm('Unchecking this category will erase the previous scene data below, proceed?')){
					removeScnGallery($input.val());
				}else{
					return false;
				}
			}
			
		});
	
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

	textEditor('.tinymce');
	
</script>	

<?php echo $footer; ?>