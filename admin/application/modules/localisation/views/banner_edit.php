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
			
			<hr />
					<div class="col-md-12">
							<div class="card">
								
								<?php echo form_open($banner_form_link, array('class' => 'form')); ?>
								<div class="card-body tab-content">
									
										<div id="general" class="tab-pane active">				
									
											<div class="col-md-12">
												
													<div id="general" class="tab_content">
														
														<?php echo form_hidden('id',$rowdata['id']); ?>
														
														<div class="col-md-6">
															<div class="form-group">
																<input class="form-control" id="text_label" name="text_label" value="<?php echo set_value('text_label',$rowdata['text_label']); ?>" type="text" placeholder="Banner Label"  />
																<label for="text_label">
																	 Banner Text
																</label>
															</div>
														
															<div class="form-group">
																<input class="form-control" id="link" name="link" value="<?php echo set_value('link',$rowdata['link']); ?>" type="text" placeholder="Link"  />
																<label for="link">
																	Link
																</label>
															</div>
															
															<div class="form-group">
																<input class="form-control" id="sort_order" name="sort_order" value="<?php echo set_value('sort_order',$rowdata['sort_order']); ?>" type="number" min="0" placeholder="Sort Order"  />
																<label for="sort_order">
																	Sort order
																</label>
															</div>
															
															
															<div class="form-group">
															
																<select class="form-control" name="status">
																	<option value="1" <?php echo ($rowdata['status']==1)? 'selected="selected"': ''; ?>>Enable</option>
																	<option value="0" <?php echo ($rowdata['status']==0)? 'selected="selected"': ''; ?>>Disable</option>
																</select>
														
																<label for="client_name">
																	Auction Status
																</label>
																
															</div>
														
															
														</div>
														
														
														<div class="col-md-6">
														
															<div class="form-group <?php echo (form_error('image'))? 'has-error': ''; ?>">
																	<?php  $image = set_value('image',$rowdata['image']); ?>
																	<input class="form-control" id="banner_image" name="image" value="<?php echo set_value('image',$rowdata['image']); ?>" type="hidden"  />
																	<br/>
																	<div class="thumbnail">
																	
																		<img src="	<?php echo URL_FILEMANAGER_SOURCE; ?><?php echo (!empty($image))? $image : 'no_image.jpg'; ?>" id="banner_image_preview" class="img-responsive" style="max-height:354px">
																		
																	</div>
																	<div class="btn btn-default-bright btn-loading-state" data-loading-text="&lt;i class='fa fa-spinner fa-spin'&gt;&lt;/i&gt; Loading..." data-toggle="modal" data-target="#simpleModal" data-urlpath="<?php echo  URL_FILEMANAGER.'?type=1&akey=admin&field_id=banner_image'; ?>"><span class="md md-my-library-books"></span>Browse</div>
																		
																	<label for="client_name">
																		Banner Image
																		<span class="help">
																			Click browse to change Image
																		</span>
																	
																	</label>
																	<?php echo form_error('image','<span class="help-block">','</span>'); ?>
																	
															</div>
															
															<span class="help">
															Note: <br/>Preferred max dimension: <b class="text-primary">1280W × 720H</b> pixels 
															      <br/>Preferred min dimension: <b class="text-primary">720W × 405H</b> pixels
															</span>
															
														</div>
														
														
														
													</div>
											</div>	
										</div>
										
										<div class="clearfix"></div>
										<div class="form-group col-md-12">
											<div class="text-right pull-right col-md-2">
												<input type="submit" value="Save" class="btn btn-primary" />
												<a href="<?php echo site_url('extension/banner'); ?>"><div class="btn btn-default-bright">Back</div></a>
											</div>
										</div>
									
								</div><!--end .card-body -->
								<?php echo form_close(); ?>		
							</div>
						</div>
					<em class="text-caption">Please fill up the required inputs.</em>

			</div>
					
	</section>
	
	<div class="modal fade" id="simpleModal" tabindex="-1" role="dialog" aria-labelledby="simpleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
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
		$('#simpleModal').on('shown.bs.modal', function(event){
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