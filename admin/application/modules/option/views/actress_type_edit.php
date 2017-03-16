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
										
									</ul>
									
								</div><!--end .card-head -->
								<?php echo form_open($form_link, array('class' => 'form')); ?>
								<div class="card-body tab-content">
										
										<!--tab general-->
										<div id="general" class="tab-pane active">				
											
											<?php echo form_hidden('id',$rowdata['id']); ?>
											<div class="col-md-12">
													<div class="tab_content ">

														<div class="col-md-6">
															<div class="form-group <?php echo (form_error('en_keyword'))? 'has-error': ''; ?>">
																<input class="form-control" id="en_keyword" name="en_keyword" value="<?php echo set_value('en_keyword',$rowdata['en_keyword']); ?>" type="text" placeholder=""  />
																<label for="en_keyword">
																	EN Keyword<span class="text-danger">*</span> 
																</label>
																<?php echo form_error('en_keyword','<span class="help-block">','</span>'); ?>
															</div>
															
															<div class="clearfix"></div>
															
															<div class="form-group <?php echo (form_error('jp_keyword'))? 'has-error': ''; ?>">
																<input class="form-control" id="jp_keyword" name="jp_keyword" value="<?php echo set_value('jp_keyword',$rowdata['jp_keyword']); ?>" type="text" placeholder=""  />
																<label for="jp_keyword">
																	JP Keyword<span class="text-danger">*</span> 
																</label>
																<?php echo form_error('jp_keyword','<span class="help-block">','</span>'); ?>
															</div>
															
															<div class="clearfix"></div>
															
															<div class="form-group">
																<input class="form-control" id="sort_order" name="sort_order" value="<?php echo set_value('sort_order',$rowdata['sort_order']); ?>" type="text" placeholder=""  />
																<label for="sort_order">
																	Sort Order <span class="text-danger">*</span>
																</label>
																<?php echo form_error('','<span class="help-block">','</span>'); ?>
															</div>
														</div>
														
													
														
														<div class="col-md-6">
															
															<div class="form-group">
																<?php if(!in_array($rowdata['id'],array(1,2,3))){ ?>
																<select class="form-control" name="status">
																
																	<option value="1" <?php echo ($rowdata['status']==1)? 'selected="selected"': ''; ?> >Active</option>
																	<option value="0" <?php echo ($rowdata['status']==0)? 'selected="selected"': ''; ?> >Inactive</option>
																</select>
																<?php }else{ ?>
																	<div class="form-control" ><i class="md md-lock"></i> <?php echo ($rowdata['status'])? 'Active': 'Inactive'; ?></div>
																<?php } ?>
																
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
										
										<div class="clearfix"></div>
										<hr/>
										<div class="form-group col-md-12">
											<div class="text-right pull-right col-md-2">
												<input type="submit" value="Save" class="btn btn-primary" />
												<a href="<?php echo site_url('option/actresstype'); ?>"><div class="btn btn-default-bright">Back</div></a>
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