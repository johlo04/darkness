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
								
									<div class="col-md-12">
											<div class="tab_content ">
										
												<div class="col-md-6">
												
														<div class="form-group">
															<label for="en_home_attention">
																	EN Attention Description<span class="text-danger">*</span> 
															</label>
															
															<?php if($this->system_config->getConfig('en_home_attention')){ ?>
																<textarea class="form-control height-4" style="height:165px" id="en_home_attention" name="en_home_attention" type="text" placeholder="" ><?php echo set_value('en_home_attention',$this->system_config->getConfig('en_home_attention')); ?></textarea>
															<?php }else{ ?>
																<div class="form-control"><span class="text-danger md md-warning"></span> Please add the config: <i>en_home_attention</i> </div>
															<?php } ?>
														</div>
													
														<div class="form-group">
															<label for="jp_home_attention">
																JP Keyword<span class="text-danger">*</span> 
															</label>
															
															<?php if($this->system_config->getConfig('jp_home_attention')){ ?>
															<textarea class="form-control height-4" style="height:165px" id="jp_home_attention" name="jp_home_attention" type="text" placeholder=""  ><?php echo set_value('jp_home_attention',$this->system_config->getConfig('jp_home_attention')); ?></textarea>
															<?php }else{ ?>
																<div class="form-control"><span class="text-danger md md-warning"></span> Please add the config: jp_home_attention</i> </div>
															<?php } ?>
															
														</div>
													
													<div class="clearfix"></div>
												
												</div>
												
												
												
												
												<div class="col-md-6">
															
													<div class="form-group">
														<?php  if(null !== $this->system_config->getConfig('av_homepage_banner')){ ?>		
														<?php
															$av_homepage_banner =  (null !==($this->system_config->getConfig('av_homepage_banner')))? str_replace(URL_FILEMANAGER_SOURCE,'',$this->system_config->getConfig('av_homepage_banner')): 'no_image.jpg';
														?>
														
														<input class="form-control" id="av_homepage_banner" name="av_homepage_banner" value="<?php echo set_value('av_homepage_banner',$av_homepage_banner); ?>" type="hidden"  />
														<br/>
														<div class="thumbnail">
														
															<img src="<?php echo URL_FILEMANAGER_SOURCE.$av_homepage_banner; ?>" id="av_homepage_banner_preview" class="img-responsive" style="max-height:354px">
															
														</div>
														
														<div class="btn btn-default-bright btn-loading-state" data-loading-text="&lt;i class='fa fa-spinner fa-spin'&gt;&lt;/i&gt; Loading..." data-toggle="modal" data-target="#fileManagerModal" data-urlpath="<?php echo  URL_FILEMANAGER.'?type=1&akey=admin&field_id=av_homepage_banner'; ?>"><span class="md md-my-library-books"></span>Browse</div>
															
														<label for="client_name">
															<span class="fa fa-play-circle"></span> Home Banner
															<span class="help">
																Click browse to change Image
															</span>
														<div class="clearfix"></div>
														</label>
														
														<span class="help">
																Note: <br/>Preferred max dimension: <b class="text-primary">1280W × 720H</b> pixels 
																<br/>Preferred min dimension: <b class="text-primary">720W × 405H</b> pixels
														</span>
														<div class="clearfix"></div>
													</div>
													<?php }else{ ?>
														<span><span class="text-danger md md-warning"></span> Please add the config: av_homepage_banner</i> </span>
													<?php } ?>
												</div>
												
												
												
												
										</div>
									</div>
								</div>
								
								<div class="clearfix"></div>
								<hr/>
								<div class="form-group col-md-12">
									<div class="text-right pull-right col-md-2">
										<input type="submit" value="Save" class="btn btn-primary" />
										
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