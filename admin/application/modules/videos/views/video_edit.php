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
										<li class=""><a href="#video">Video</a></li>										
										<li class=""><a href="#vcontent">Video Image Scene </a></li>
										<li class=""><a href="#gallery">Gallery</a></li>
										<li class=""><a href="#comments" id="comment_tab">Comments</a></li>
										
									</ul>
									
								</div><!--end .card-head -->
								<?php echo form_open($form_link, array('class' => 'form')); ?>
								<div class="card-body tab-content">
										
										<!--tab general-->
										<div id="general" class="tab-pane active">				
											
											<?php echo form_hidden('id',$rowdata['id']); ?>
											<div class="col-md-12">
													<div class="tab_content ">
														
														<div class="card tabs-left style-default-light">
															
															<ul class="card-head nav nav-tabs" data-toggle="tabs">
																<?php foreach($language as $lang){ ?>
																<li class="<?php echo ($lang['id']==1)? 'active': ''; ?>">
																	<a href="#lang<?php echo $lang['id']; ?>">
																		</span> <?php echo $lang['name']; ?>
																		<span class="small-txt <?php echo (form_error('description['.$lang['id'].'][title]'))? 'text-danger md md-warning': ''; ?>">
																	</a>
																</li>
																<?php } ?>
															</ul>

															<div class="card-body tab-content style-default-bright ">
																
																<?php foreach($language as $lang){ ?>
																
																<div class="tab-pane <?php echo ($lang['id']==1)? 'active': ''; ?>" id="lang<?php echo $lang['id']; ?>">
																	<div class="col-md-6">
																	
																		<div class="form-group <?php echo (form_error('description['.$lang['id'].'][title]'))? 'has-error': ''; ?>">
																			<input class="form-control" name="description[<?php echo $lang['id']; ?>][title]" value="<?php echo set_value('description['.$lang['id'].'][title]',$description[$lang['id']]['title']); ?>" type="text" placeholder="Video Title"  />
																			<label for="video_title">
																				 Video Title<span class="text-danger">*</span> 
																			</label>
																			<?php echo form_error('description['.$lang['id'].'][title]','<span class="help-block">','</span>'); ?>
																		</div>
																		
																		<div class="form-group">
																			<textarea class="form-control" name="description[<?php echo $lang['id']; ?>][meta_description]" type="text" placeholder="Meta Description"><?php echo set_value('description['.$lang['id'].'][meta_description]',$description[$lang['id']]['meta_description']); ?></textarea>
																			<label for="meta_description">Meta Description</label>
																		
																		</div>
																		
																		<div class="form-group">
																			<input type="text" name="description[<?php echo $lang['id']; ?>][meta_tags]" value="<?php echo set_value('description['.$lang['id'].'][meta_tags]',$description[$lang['id']]['meta_tags']); ?>"  data-role="tagsinput" />
																			<label for="tags">Meta Video Tags</label>
																			<span class="help">Note: Type a word and press [Enter] button; Will be use on how the user will search the video</span>
																		</div>
																		
																	</div>
																		
																	<div class="col-md-6">
																	
																		<div class="form-group">
																			<textarea class="form-control tinymce" name="description[<?php echo $lang['id']; ?>][description]" type="text" placeholder="Video Detail" ><?php echo set_value('description['.$lang['id'].'][description]',$description[$lang['id']]['description']); ?></textarea>
																			<label for="vid_description">Video Description</label>
																		</div>
															
																	</div>
																</div>
																
																<?php } ?>
															</div>
														</div><!--end of Language -->
														
														
														<div class="col-md-6">
															<div class="form-group <?php echo (form_error('video_duration'))? 'has-error': ''; ?>">
																<input class="form-control" id="video_duration" name="video_duration" value="<?php echo set_value('video_duration',$rowdata['video_duration']); ?>" type="text" placeholder="Video Length Format"  />
																<label for="video_duration">
																	Full Video Time Length/Duration<span class="text-danger">*</span> <b>ex: 01:24:00</b>
																</label>
																<?php echo form_error('video_duration','<span class="help-block">','</span>'); ?>
															</div>
														</div>
														
														<div class="col-md-6">
															<div class="form-group">
																
																<select class="form-control" name="status">
																
																	<option value="1" <?php echo ($status==1)? 'selected="selected"': ''; ?> >Active</option>
																	<option value="0" <?php echo ($status==0)? 'selected="selected"': ''; ?> >Inactive</option>
																</select>
	
																<label for="client_name">
																	Status
																</label>
																
															</div>
														</div>
														
														
														<div class="clearfix"></div>
														
														<div class="col-md-6">
															
															<div class="form-group">
																
																<?php
																	$cover_image =  (!empty($rowdata['cover_image']))? str_replace(URL_FILEMANAGER_SOURCE,'',$rowdata['cover_image']): 'no_image.jpg';
																?>
																<input class="form-control" id="cover_image" name="cover_image" value="<?php echo set_value('cover_image',$cover_image); ?>" type="hidden"  />
																<br/>
																<div class="thumbnail">
																
																	<img src="<?php echo URL_FILEMANAGER_SOURCE.$cover_image; ?>" id="cover_image_preview" class="img-responsive" style="max-height:354px">
																	
																</div>
																<div class="btn btn-default-bright btn-loading-state" data-loading-text="&lt;i class='fa fa-spinner fa-spin'&gt;&lt;/i&gt; Loading..." data-toggle="modal" data-target="#fileManagerModal" data-urlpath="<?php echo  URL_FILEMANAGER.'?type=1&akey=admin&field_id=cover_image'; ?>"><span class="md md-my-library-books"></span>Browse</div>
																	
																<label for="client_name">
																	<span class="fa fa-picture-o"></span> Cover Image
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
																
																<?php
																	$poster_image =  (!empty($rowdata['poster_image']))? str_replace(URL_FILEMANAGER_SOURCE,'',$rowdata['poster_image']): 'no_image.jpg';
																?>
																
																<input class="form-control" id="poster_image" name="poster_image" value="<?php echo set_value('poster_image',$poster_image); ?>" type="hidden"  />
																<br/>
																<div class="thumbnail">
																
																	<img src="<?php echo URL_FILEMANAGER_SOURCE.$poster_image; ?>" id="poster_image_preview" class="img-responsive" style="max-height:354px">
																	
																</div>
																<div class="btn btn-default-bright btn-loading-state" data-loading-text="&lt;i class='fa fa-spinner fa-spin'&gt;&lt;/i&gt; Loading..." data-toggle="modal" data-target="#fileManagerModal" data-urlpath="<?php echo  URL_FILEMANAGER.'?type=1&akey=admin&field_id=poster_image'; ?>"><span class="md md-my-library-books"></span>Browse</div>
																	
																<label for="client_name">
																	<span class="fa fa-play-circle"></span> Video Poster Image 
																	<span class="help">
																		Click browse to change Image
																	</span>
																
																</label>
																
																<span class="help">
																	Note:  <br/>Preferred dimension: <b class="text-primary">960W × 662H</b> pixels
																</span>
																
															</div>

														</div>
														
														<div class="clearfix"></div>
														
														<div class="col-md-6">	
															<div class="form-group">
																
																<?php
																	$banner_image =  (!empty($rowdata['banner_image']))? str_replace(URL_FILEMANAGER_SOURCE,'',$rowdata['banner_image']): 'no_image.jpg';
																?>
																
																<input class="form-control" id="banner_image" name="banner_image" value="<?php echo set_value('banner_image',$banner_image); ?>" type="hidden"  />
																<br/>
																<div class="thumbnail">
																
																	<img src="<?php echo URL_FILEMANAGER_SOURCE.$banner_image; ?>" id="banner_image_preview" class="img-responsive" style="max-height:354px">
																	
																</div>
																<div class="btn btn-default-bright btn-loading-state" data-loading-text="&lt;i class='fa fa-spinner fa-spin'&gt;&lt;/i&gt; Loading..." data-toggle="modal" data-target="#fileManagerModal" data-urlpath="<?php echo  URL_FILEMANAGER.'?type=1&akey=admin&field_id=banner_image'; ?>"><span class="md md-my-library-books"></span>Browse</div>
																	
																<label for="client_name">
																	<span class="fa fa-photo"></span> Banner Image
																	<span class="help">
																		Click browse to change Image
																	</span>
																
																</label>
																
																<span class="help">
																	Note: <br/>Preferred max dimension: <b class="text-primary">1280W × 720H</b> pixels 
																	  <br/>Preferred min dimension: <b class="text-primary">720W × 480H</b> pixels
																</span>
																
															</div>

														</div>
														
												
														<div class="clearfix"></div>
														<hr/>
														
														<div class="col-md-6">
														<h4>Video Category</h4>
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
															
															
															<div class="form-group <?php echo (form_error('category[0]'))? 'has-error': ''; ?>">
																
																<select class="form-control " name="category[0]">
																	<option></option>
																	<?php foreach($main_category as $value){ ?>
																	<option value="<?php echo $value['id']; ?>" <?php echo (in_array($value['id'],$array_list))? 'selected="selected"': ''; ?>><?php echo $value['en_keyword'].' | '.$value['jp_keyword']; ?></option>
																	<?php } ?>
																</select>
																
																<label for="client_name">
																	Main Category<span class="text-danger">*</span> 
																</label>
																<?php echo form_error('category[0]','<span class="help-block">','</span>'); ?>
															</div>
														</div>
														
														<div class="clearfix"></div>
														
														<div class="col-md-12">
															<?php 
															/*<div class="panel-group" id="accordion1">
																<div class="card panel">
																	<div class="card-head card-head-xs collapsed" data-toggle="collapse" data-parent="#accordion1" data-target="#accordion1-1" aria-expanded="false">
																		<header><i class="md md-recent-actors"></i> Sub Category</header>
																		<div class="tools">
																			<a class="btn btn-icon-toggle"><i class="fa fa-angle-down"></i></a>
																		</div>
																	</div>
																	<div id="accordion1-1" class="collapse in" aria-expanded="false">
																		<div class="card-body">
																			<?php 
																			
																			$count=1; foreach($sub_category as $value){ ?>
																				
																				<label class="checkbox-styled checkbox-primary col-sm-4">
																					<input name="category[]" value="<?php echo $value['id']; ?>" <?php echo (in_array($value['id'],$array_list))? 'checked="checked"':''; ?>   data-name="<?php echo $value['en_keyword'].' | '.$value['jp_keyword']; ?>" type="checkbox"><span><?php echo $value['en_keyword'].' | '.$value['jp_keyword']; ?></span>
																				</label>
																				<?php $count++; } ?>
																				
																			<?php if($count==4){ $count=1; ?> <div class="clearfix"></div><?php } ?>
																		</div>
																	</div>
																</div><!--end .panel -->
																
															</div>
															*/ ?>
															
															<div class="panel-group" id="accordion2">
																<div class="card panel">
																	<div class="card-head card-head-xs collapsed" data-toggle="collapse" data-parent="#accordion2" data-target="#accordion2-1" aria-expanded="false">
																		<header><i class="md md-recent-actors"></i> Themes</header>
																		<div class="tools">
																			<a class="btn btn-icon-toggle"><i class="fa fa-angle-down"></i></a>
																		</div>
																	</div>
																	<div id="accordion2-1" class="collapse" aria-expanded="false">
																		<?php 
															
																		//initalized:
																		if(!isset($theme)){ //empty
																			$array_list = array(0); 
																		}elseif(is_array($theme) && count($theme)>0){ //atleast 1
																			$array_list = $theme;
																		}else{ //string (1,2) to array
																			$array_list = explode(',',$theme);
																		}

																		?>
																		
																		<div class="card-body">
																			<?php $count=1; foreach($theme_category as $value){ ?>
																				
																				<label class="checkbox-styled checkbox-primary col-sm-4">
																					<input name="theme[]" value="<?php echo $value['id']; ?>" <?php echo (in_array($value['id'],$array_list))? 'checked="checked"':''; ?> data-name="<?php echo $value['en_keyword'].' | '.$value['jp_keyword']; ?>" type="checkbox"><span><?php echo $value['en_keyword'].' | '.$value['jp_keyword']; ?></span>
																				</label>
																				<?php $count++; } ?>
																			<?php if($count==4){ $count=1; ?> <div class="clearfix"></div><?php } ?>
																			
																		</div>
																	</div>
																</div><!--end .panel -->
																
															</div>
															
															<div class="panel-group" id="accordion3">
																<div class="card panel">
																	<div class="card-head card-head-xs collapsed" data-toggle="collapse" data-parent="#accordion3" data-target="#accordion3-1" aria-expanded="false">
																		<header><i class="md md-recent-actors"></i>  Actress</header>
																		<div class="tools">
																			<a class="btn btn-icon-toggle"><i class="fa fa-angle-down"></i></a>
																		</div>
																	</div>
																	<div id="accordion3-1" class="collapse" aria-expanded="false">
																		
																		<?php 
															
																		//initalized:
																		if(!isset($actress)){ //empty
																			$array_list = array(0); 
																		}elseif(is_array($actress) && count($actress)>0){ //atleast 1
																			$array_list = $actress;
																		}else{ //string (1,2) to array
																			$array_list = explode(',',$actress);
																		}

																		?>
																	
																	
																		<div class="card-body">
																		<?php $count=1; foreach($actress_list as $value){ ?>
																				
																			<label class="checkbox-styled checkbox-primary col-sm-4">
																				<input name="actress[]" value="<?php echo $value['id']; ?>"  <?php echo (in_array($value['id'],$array_list))? 'checked="checked"':''; ?> data-name="<?php echo $value['en_name'].' | '.$value['jp_name']; ?>" type="checkbox"><span><?php echo $value['en_name'].' | '.$value['jp_name']; ?></span>
																			</label>
																			<?php $count++; } ?>
																		<?php if($count==4){ $count=1; ?> <div class="clearfix"></div><?php } ?>
																		</div>
																	</div>
																</div><!--end .panel -->
																
															</div>			
															<div class="clearfix"></div>
								
														</div>
												</div>
											</div>
										</div>
							
										<!--tab video-->
										<div id="video" class="tab-pane" >
											<h4>Video Path Location</h4>
											<div class="form-group">
												<label for="samplevideo1" class="col-sm-2 control-label">MP4 Sample Clip</label>
												
												<div class="col-sm-10">
													<div class="input-group">
														<div class="input-group-content">
															<input class="form-control" id="samplevideo1" name="clip_mp4" value="<?php echo set_value('clip_mp4',$rowdata['clip_mp4']); ?>" type="text"><div class="form-control-line"></div>
														</div>
														<div class="input-group-btn">
															<button type="button" class="btn btn-default" tabindex="-1">Action</button>
															<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" tabindex="-1" aria-expanded="false">
																<span class="caret"></span>
															</button>
															<ul class="dropdown-menu pull-right" role="menu">
																<li><a href="#" data-toggle="modal" data-target="#fileManagerModal" data-urlpath="<?php echo  URL_FILEMANAGER.'?type=3&akey=admin&field_id=samplevideo1'; ?>">Change</a></li>
																<li class="divider"></li>
																<li><a href="#" onclick="alert('Function not available')">Play</a></li>
																
															</ul>
														</div>
													</div><!--end .input-group -->
												</div><!--end .col -->
											</div>
											
											<div class="clearfix"></div>
											
											<div class="form-group">
												
												<label for="samplevideo2" class="col-sm-2 control-label">WebM Sample Clip</label>
												
												<div class="col-sm-10">
													<div class="input-group">
														<div class="input-group-content">
															<input class="form-control" id="samplevideo2" name="clip_webm" value="<?php echo set_value('clip_webm',$rowdata['clip_webm']); ?>" type="text"><div class="form-control-line"></div>
														</div>
														<div class="input-group-btn">
															<button type="button" class="btn btn-default" tabindex="-1">Action</button>
															<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" tabindex="-1" aria-expanded="false">
																<span class="caret"></span>
															</button>
															<ul class="dropdown-menu pull-right" role="menu">
																<li><a href="#" data-toggle="modal" data-target="#fileManagerModal" data-urlpath="<?php echo  URL_FILEMANAGER.'?type=3&akey=admin&field_id=samplevideo2'; ?>">Change</a></li>
																<li class="divider"></li>
																<li><a href="#" onclick="alert('Function not available')">Play</a></li>
																
															</ul>
														</div>
													</div><!--end .input-group -->
												</div><!--end .col -->
											</div>
											<div class="clearfix"></div>

											<div class="form-group">
												
												<label for="samplevideo3" class="col-sm-2 control-label">OGV/OGG Sample Clip</label>
												
												<div class="col-sm-10">
													<div class="input-group">
														<div class="input-group-content">
															<input class="form-control" id="samplevideo3" name="clip_ogv" value="<?php echo set_value('clip_ogv',$rowdata['clip_ogv']); ?>" type="text"><div class="form-control-line"></div>
														</div>
														<div class="input-group-btn">
															<button type="button" class="btn btn-default" tabindex="-1">Action</button>
															<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" tabindex="-1" aria-expanded="false">
																<span class="caret"></span>
															</button>
															<ul class="dropdown-menu pull-right" role="menu">
																<li><a href="#" data-toggle="modal" data-target="#fileManagerModal" data-urlpath="<?php echo  URL_FILEMANAGER.'?type=3&akey=admin&field_id=samplevideo3'; ?>">Change</a></li>
																<li class="divider"></li>
																<li><a href="#" onclick="alert('Function not available')">Play</a></li>
																
															</ul>
														</div>
													</div><!--end .input-group -->
												</div><!--end .col -->
											</div>
											
											<div class="clearfix"></div>
											<div class="form-group">
												
												<label for="samplevideo4" class="col-sm-2 control-label">VR Sample Clip</label>
												
												<div class="col-sm-10">
													<div class="input-group">
														<div class="input-group-content">
															<input class="form-control" id="samplevideo4" name="clip_360_vr" value="<?php echo set_value('clip_360_vr',$rowdata['clip_360_vr']); ?>" type="text"><div class="form-control-line"></div>
														</div> 	
														<div class="input-group-btn">
															<button type="button" class="btn btn-default" tabindex="-1">Action</button>
															<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" tabindex="-1" aria-expanded="false">
																<span class="caret"></span>
															</button>
															<ul class="dropdown-menu pull-right" role="menu">
																<li><a href="#" data-toggle="modal" data-target="#fileManagerModal" data-urlpath="<?php echo  URL_FILEMANAGER.'?type=3&akey=admin&field_id=samplevideo4'; ?>">Change</a></li>
																<li class="divider"></li>
																<li><a href="#" onclick="alert('Function not available')">Play</a></li>
																
															</ul>
														</div>
													</div><!--end .input-group -->
												</div><!--end .col -->
											</div>
											
											<div class="clearfix"></div>
											<span class="help">
												Note: You can either choose 2 video format: MP4 and WEBM 'OR' MP4 and OGV video format to save space.
												<br/>
												VR videos please choose supported VR file extension only. no need to add (mp4,ogv,webm).
											</span>
											<hr/>
											<div class="clearfix"></div>
											<div class="form-group">
												<label for="fullvideo1" class="col-sm-2 control-label">MP4 Full Clip</label>
												
												<div class="col-sm-10">
													<div class="input-group">
														<div class="input-group-content">
															<input class="form-control" id="fullvideo1" name="full_mp4" value="<?php echo set_value('full_mp4',$rowdata['full_mp4']); ?>" type="text"><div class="form-control-line"></div>
														</div>
														<div class="input-group-btn">
															<button type="button" class="btn btn-default" tabindex="-1">Action</button>
															<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" tabindex="-1" aria-expanded="false">
																<span class="caret"></span>
															</button>
															<ul class="dropdown-menu pull-right" role="menu">
																<li><a href="#" data-toggle="modal" data-target="#fileManagerModal" data-urlpath="<?php echo  URL_FILEMANAGER.'?type=3&akey=admin&field_id=fullvideo1'; ?>">Change</a></li>
																<li class="divider"></li>
																<li><a href="#" onclick="alert('Function not available')">Play</a></li>
																
															</ul>
														</div>
													</div><!--end .input-group -->
												</div><!--end .col -->
											</div>
											
											<div class="clearfix"></div>
											
											<div class="form-group">
												
												<label for="fullvideo2" class="col-sm-2 control-label">WebM Full Clip</label>
												
												<div class="col-sm-10">
													<div class="input-group">
														<div class="input-group-content">
															<input class="form-control" id="fullvideo2" name="full_webm" value="<?php echo set_value('full_webm',$rowdata['full_webm']); ?>" type="text"><div class="form-control-line"></div>
														</div> 
														<div class="input-group-btn">
															<button type="button" class="btn btn-default" tabindex="-1">Action</button>
															<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" tabindex="-1" aria-expanded="false">
																<span class="caret"></span>
															</button>
															<ul class="dropdown-menu pull-right" role="menu">
																<li><a href="#" data-toggle="modal" data-target="#fileManagerModal" data-urlpath="<?php echo  URL_FILEMANAGER.'?type=3&akey=admin&field_id=fullvideo2'; ?>">Change</a></li>
																<li class="divider"></li>
																<li><a href="#" onclick="alert('Function not available')">Play</a></li>
																
															</ul>
														</div>
													</div><!--end .input-group -->
												</div><!--end .col -->
											</div>
											<div class="clearfix"></div>

											<div class="form-group">
												
												<label for="fullvideo3" class="col-sm-2 control-label">OGV/OGG Full Clip</label>
												
												<div class="col-sm-10">
													<div class="input-group">
														<div class="input-group-content">
															<input class="form-control" id="fullvideo3" name="full_ogv" value="<?php echo set_value('full_ogv',$rowdata['full_ogv']); ?>" type="text"><div class="form-control-line"></div>
														</div>
														<div class="input-group-btn">
															<button type="button" class="btn btn-default" tabindex="-1">Action</button>
															<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" tabindex="-1" aria-expanded="false">
																<span class="caret"></span>
															</button>
															<ul class="dropdown-menu pull-right" role="menu">
																<li><a href="#" data-toggle="modal" data-target="#fileManagerModal" data-urlpath="<?php echo  URL_FILEMANAGER.'?type=3&akey=admin&field_id=fullvideo3'; ?>">Change</a></li>
																<li class="divider"></li>
																<li><a href="#" onclick="alert('Function not available')">Play</a></li>
																
															</ul>
														</div>
													</div><!--end .input-group -->
												</div><!--end .col -->
											</div>
											
											<div class="clearfix"></div>
											<div class="form-group">
												
												<label for="fullvideo4" class="col-sm-2 control-label">VR Full Clip</label>
												
												<div class="col-sm-10">
													<div class="input-group">
														<div class="input-group-content">
															<input class="form-control" id="fullvideo4" name="full_vr" value="<?php echo set_value('full_vr',$rowdata['full_vr']); ?>" type="text"><div class="form-control-line"></div>
														</div>
														<div class="input-group-btn">
															<button type="button" class="btn btn-default" tabindex="-1">Action</button>
															<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" tabindex="-1" aria-expanded="false">
																<span class="caret"></span>
															</button>
															<ul class="dropdown-menu pull-right" role="menu">
																<li><a href="#" data-toggle="modal" data-target="#fileManagerModal" data-urlpath="<?php echo  URL_FILEMANAGER.'?type=3&akey=admin&field_id=fullvideo4'; ?>">Change</a></li>
																<li class="divider"></li>
																<li><a href="#" onclick="alert('Function not available')">Play</a></li>
																
															</ul>
														</div>
													</div><!--end .input-group -->
												</div><!--end .col -->
											</div>
											
											<div class="clearfix"></div>
											<span class="help">
												Note: You can either choose 2 video format: MP4 and WEBM 'OR' MP4 and OGV video format to save space.
												<br/>
												VR videos please choose supported VR file extension only. no need to add (mp4,ogv,webm).
											</span>
											<div class="clearfix"></div>
											<hr/>
											<h4>Video Downloads</h4>
											<div class="form-group">
												
												
												<label for="viddownload1" class="col-sm-2 control-label">Downloadable MP4 FULL HD</label>
												
												<div class="col-sm-10">
													<div class="input-group">
														<div class="input-group-content">
															<input class="form-control" id="viddownload1" name="fullhd" value="<?php echo set_value('fullhd',$rowdata['fullhd']); ?>" type="text"><div class="form-control-line"></div>
														</div> 	 	 	
														<div class="input-group-btn">
															<button type="button" class="btn btn-default" tabindex="-1">Action</button>
															<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" tabindex="-1" aria-expanded="false">
																<span class="caret"></span>
															</button>
															<ul class="dropdown-menu pull-right" role="menu">
																<li><a href="#" data-toggle="modal" data-target="#fileManagerModal" data-urlpath="<?php echo  URL_FILEMANAGER.'?type=2&akey=admin&field_id=viddownload1'; ?>">Change</a></li>
																<li class="divider"></li>
																<li><a href="#" onclick="alert('Function not available')">Download</a></li>
																
															</ul>
														</div>
													</div><!--end .input-group -->
												</div><!--end .col -->
											</div>
											
											<div class="clearfix"></div>
											
											<div class="form-group">
												
												<label for="viddownload2" class="col-sm-2 control-label">Downloadable MP4 HD Lite</label>
												
												<div class="col-sm-10">
													<div class="input-group">
														<div class="input-group-content">
															<input class="form-control" id="viddownload2" name="hdlite" value="<?php echo set_value('hdlite',$rowdata['hdlite']); ?>" type="text"><div class="form-control-line"></div>
														</div>
														<div class="input-group-btn">
															<button type="button" class="btn btn-default" tabindex="-1">Action</button>
															<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" tabindex="-1" aria-expanded="false">
																<span class="caret"></span>
															</button>
															<ul class="dropdown-menu pull-right" role="menu">
																<li><a href="#" data-toggle="modal" data-target="#fileManagerModal" data-urlpath="<?php echo  URL_FILEMANAGER.'?type=2&akey=admin&field_id=viddownload2'; ?>">Change</a></li>
																<li class="divider"></li>
																<li><a href="#" onclick="alert('Function not available')">Download</a></li>
																
															</ul>
														</div>
													</div><!--end .input-group -->
												</div><!--end .col -->
											</div>
											<div class="clearfix"></div>

											<div class="form-group">
												
												<label for="viddownload3" class="col-sm-3 control-label">Downloadable MP4 Mobile( usually around 500mb )</label>
												
												<div class="col-sm-10">
													<div class="input-group">
														<div class="input-group-content">
															<input class="form-control" id="viddownload3" name="mobile" value="<?php echo set_value('mobile',$rowdata['mobile']); ?>" type="text"><div class="form-control-line"></div>
														</div>
														<div class="input-group-btn">
															<button type="button" class="btn btn-default" tabindex="-1">Action</button>
															<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" tabindex="-1" aria-expanded="false">
																<span class="caret"></span>
															</button>
															<ul class="dropdown-menu pull-right" role="menu">
																<li><a href="#" data-toggle="modal" data-target="#fileManagerModal" data-urlpath="<?php echo  URL_FILEMANAGER.'?type=2&akey=admin&field_id=viddownload3'; ?>">Change</a></li>
																<li class="divider"></li>
																<li><a href="#" onclick="alert('Function not available')">Download</a></li>
																
															</ul>
														</div>
													</div><!--end .input-group -->
												</div><!--end .col -->
											</div>
											
											<div class="clearfix"></div>
											<div class="form-group">
												
												<label for="viddownload4" class="col-sm-2 control-label">Downloadable VR Video</label>
												
												<div class="col-sm-10">
													<div class="input-group">
														<div class="input-group-content">
															<input class="form-control" id="viddownload4" name="vr_download" value="<?php echo set_value('vr_download',$rowdata['vr_download']); ?>" type="text"><div class="form-control-line"></div>
														</div>
														<div class="input-group-btn">
															<button type="button" class="btn btn-default" tabindex="-1">Action</button>
															<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" tabindex="-1" aria-expanded="false">
																<span class="caret"></span>
															</button>
															<ul class="dropdown-menu pull-right" role="menu">
																<li><a href="#" data-toggle="modal" data-target="#fileManagerModal" data-urlpath="<?php echo  URL_FILEMANAGER.'?type=2&akey=admin&field_id=viddownload4'; ?>">Change</a></li>
																<li class="divider"></li>
																<li><a href="#" onclick="alert('Function not available')">Download</a></li>
															</ul>
														</div>
													</div><!--end .input-group -->
												</div><!--end .col -->
											</div>
											<div class="clearfix"></div>
											<span class="help">
												Note: Downloadable video must be MP4/VLC/MOV (NEVER allow user to download ogv,webm)
												<br/>
												VR videos please choose supported VR file extension only.
											</span>
										</div>
										
										<!--tab vcontent-->
										<div id="vcontent" class="tab-pane" >
											<?php 
								
											//initalized:
											if(!isset($scene_content)){ //empty
												$array_list = array(0); 
											}elseif(is_array($scene_content) && count($scene_content)>0){ //atleast 1
												$array_list = $scene_content;
											}else{ //string (1,2) to array
												$array_list = explode(',',$scene_content);
											}

											?>
											
											<div class="form-group">
												<label class="control-label"> Click a category scene below and add scene details</label>
												<hr/>
												<div class="col-sm-12">
													<?php $scene_collect= array(); $count=1; foreach($scene_category as $value){ ?>
													
													<label class="checkbox-styled checkbox-primary col-sm-3">
														<input class="scene_category" name="scene_content[<?php echo $value['id']; ?>]" <?php echo (in_array($value['id'],$array_list))? 'checked="checked"':''; ?> value="<?php echo $value['id']; ?>" data-name="<?php echo $value['en_keyword'].' | '.$value['jp_keyword']; ?>" type="checkbox"><span><?php echo $value['en_keyword'].' | '.$value['jp_keyword']; ?></span>
													</label>
													<?php 
														$count++;
														if(in_array($value['id'],$array_list)){
															$scene_collect[$value['id']] = $value['en_keyword'].' | '.$value['jp_keyword'];// use for collecting name for post/existing data on table
														}
														
													} ?>
													<?php if($count==4){ $count=1; ?> <div class="clearfix"></div><?php }  ?>
																	
												</div><!--end .col -->
												<div class="clearfix"></div>
											</div>
											<hr/>
											
											<table class="table table-bordered border-top" id="scene_table">
												<thead>
													<tr>
														<td colspan="7" class="">
																<span class="text-primary"><i class="md md-equalizer"></i>Image scene</span>
																<span class="help">
																	Note: Preferred max dimension: <b class="text-primary">1280W × 720H</b> pixels  
																	Preferred min dimension: <b class="text-primary">720W × 405H</b> pixels
																</span>
														</td>
													</tr>
													<tr>
														<td>Image</td>
														<td>Scene</td>
														<td>Frame/Time</td>					
													</tr>
												</thead>
													<?php   if(count($video_scenes)>0){  foreach($video_scenes as $value){  ?>
														<tbody id="video_scenes_<?php echo $value['scene_id']; ?>">
															<?php $video_scenes_cover = (!empty($value['image']))? str_replace(URL_FILEMANAGER_SOURCE,'',$value['image']): 'no_image.jpg';   ?>
															
															<tr>
																<td class="text-center">
																	<img src="<?php echo URL_FILEMANAGER_SOURCE.$video_scenes_cover; ?>" id="video_scenes_img_<?php echo $value['scene_id']; ?>_preview" class="img-responsive thumbnail" style="border: 1px solid #CCC; max-height: 120px; display: inline;">
																	<input name="video_scenes[<?php echo $value['scene_id']; ?>][image]" value="<?php echo $video_scenes_cover; ?>" id="video_scenes_img_<?php echo $value['scene_id']; ?>" type="hidden">
																<br>
																<div class="btn btn-default-bright btn-loading-state" data-loading-text="&lt;i class='fa fa-spinner fa-spin'&gt;&lt;/i&gt; Loading..." data-toggle="modal" data-target="#fileManagerModal" data-urlpath="<?php echo  URL_FILEMANAGER.'?type=1&akey=admin&field_id=video_scenes_img_'.$value['scene_id']; ?>">
																	<span class="md md-my-library-books"></span>Browse</div>
																</td>
																<td><input value="<?php echo $value['scene_id']; ?>" name="video_scenes[<?php echo $value['scene_id']; ?>][scene_id]" type="hidden"><?php echo $scene_collect[$value['scene_id']]; ?></td>
																<td><input name="video_scenes[<?php echo $value['scene_id']; ?>][time_scene]" value="00:00:00" type="text">
																	<span class="help">Ex. <b>01:24:00</b> (it will not appear if wrong format)</span>
																</td>
																</tr>
														</tbody>
													<?php }} ?>
													
													<tfoot>
														<tr>
															<td colspan="7" class="text-right"><span class="help">Scene(s) will be automatically done after saving.</span></td>
														</tr>
													</tfoot>
												
											</table>
											
											<script>
													
													function addScnGallery($name,$scn_row){
													
														$html = '';
														$html+= '<tbody id="video_scenes_'+$scn_row+'">';
														$html+= '<tr>';
														
														$html += '<td class="text-center"><img src="<?php echo URL_FILEMANAGER_SOURCE.'no_image.jpg'; ?>" id="video_scenes_img_'+$scn_row+'_preview" class="img-responsive thumbnail" style="border: 1px solid #CCC; max-height: 120px; display: inline;">';
														$html += '<input type="hidden" name="video_scenes['+$scn_row+'][image]" value="" id="video_scenes_img_'+$scn_row+'"><br/>';
														$html += '<div class="btn btn-default-bright btn-loading-state" data-loading-text="&lt;i class=\'fa fa-spinner fa-spin\'&gt;&lt;/i&gt; Loading..." data-toggle="modal" data-target="#fileManagerModal" data-urlpath="<?php echo  URL_FILEMANAGER.'?type=1&akey=admin&field_id='; ?>video_scenes_img_'+$scn_row+'"><span class="md md-my-library-books"></span>Browse</div></td>';
														$html += '<td><input type="hidden" value="'+$scn_row+'" name="video_scenes['+$scn_row+'][scene_id]">'+$name+'</td>';
														$html += '<td><input type="text" name="video_scenes['+$scn_row+'][time_scene]" value="00:00:00"><span class="help">Ex. <b>01:24:00</b> (it will not appear if wrong format)</span></td>';
														//$html += '<td class="text-right"><span class="btn btn-icon-toggle" onclick="$(\'#video_scenes'+$scn_row+'\').remove();"><i class="fa fa-trash-o"></i></span></td>';
														$html += '</tr>';
														$html += '</tbody>';
														
														$('#scene_table tfoot').before($html);
												
													}
													
													function removeScnGallery($scn_row){
														//$html += '<td class="text-right"><span class="btn btn-icon-toggle" onclick="$(\'#video_scenes'+$scn_row+'\').remove();"><i class="fa fa-trash-o"></i></span></td>';
														
														$('#video_scenes_'+$scn_row).remove();
														
													}
													
											</script>
											
											
											<div class="clearfix"></div>
											
											<hr/>
											<h4>Gallery Download</h4>
											<div class="form-group">
												
												<label for="galdownload1" class="col-sm-3 control-label">Downloadable Gallery Scene Video</label>
												
												<div class="col-sm-9">
													<div class="input-group">
														<div class="input-group-content">
															<input class="form-control" id="galdownload1" name="scene_zip" value="<?php echo set_value('scene_zip',$rowdata['scene_zip']); ?>" type="text"><div class="form-control-line"></div>
														</div>
														<div class="input-group-btn">
															<button type="button" class="btn btn-default" tabindex="-1">Action</button>
															<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" tabindex="-1" aria-expanded="false">
																<span class="caret"></span>
															</button>
															<ul class="dropdown-menu pull-right" role="menu">
																<li><a href="#" data-toggle="modal" data-target="#fileManagerModal" data-urlpath="<?php echo  URL_FILEMANAGER.'?type=2&akey=admin&field_id=galdownload1'; ?>">Change</a></li>
																<li class="divider"></li>
																<li><a href="#" onclick="alert('Function not available')">Download</a></li>
															</ul>
														</div>
													</div><!--end .input-group -->
												</div><!--end .col -->
											</div>
											<div class="clearfix"></div>
											<span class="help">
												Note: Downloadable images must be in zip or rar. Leave empty if download is not available.
											</span>
										
										</div>
										
										<!--tab gallery-->
										<div id="gallery" class="tab-pane" >
											<div class="col-md-12">
												<table class="table table-bordered border-top" id="gallery_table">
													<thead>
														<tr>
															<td colspan="7" class="">
																	<span class="text-primary"><i class="md md-equalizer"></i>Video Gallery Image</span>
																	<span class="help">
																		Note: Preferred max dimension: <b class="text-primary">1280W × 720H</b> pixels  
																		Preferred min dimension: <b class="text-primary">720W × 405H</b> pixels
																	</span>
															</td>
														</tr>
														<tr>
															<td>Image</td>
															<td>Sort</td>
															<td>Status</td>
															<td>Action</td>
															
														</tr>
													</thead>
													<tbody id="galleryBody">
													<?php  $img_row = 1;  if(count($gallery)>0){  foreach($gallery as $value){ ?>
														
															<?php $gallery_cover = (!empty($value['image']))? str_replace(URL_FILEMANAGER_SOURCE,'',$value['image']): 'no_image.jpg';   ?>
														
															<tr id="gallery<?php echo $img_row; ?>">
																<td class="text-center">
																	<img src="<?php echo URL_FILEMANAGER_SOURCE.$gallery_cover; ?>" id="gallery_img<?php echo $img_row; ?>_preview" class="img-responsive thumbnail" style="border: 1px solid #CCC; max-height: 120px; display: inline;">
																	<input type="hidden" name="gallery[<?php echo $img_row; ?>][image]" value="<?php echo $value['image']; ?>" id="gallery_img<?php echo $img_row; ?>"><br/>
																	<div class="btn btn-default-bright btn-loading-state" data-loading-text="&lt;i class='fa fa-spinner fa-spin'&gt;&lt;/i&gt; Loading..." data-toggle="modal" data-target="#fileManagerModal" data-urlpath="<?php echo  URL_FILEMANAGER.'?type=1&akey=admin&field_id='; ?>gallery_img<?php echo $img_row; ?>"><span class="md md-my-library-books"></span>Browse</div>
																</td>
																<td><input type="text" class="sort_order" value="<?php echo $value['sort_order']; ?>" name="gallery[<?php echo $img_row; ?>][sort_order]"></td>
																<td>
														
																	<select class="form-control" name="gallery[<?php echo $img_row; ?>][status]">
																		<option value="1" <?php echo ($value['status']==1)? 'selected="selected"': ''; ?>>Enable</option>
																		<option value="0" <?php echo ($value['status']==0)? 'selected="selected"': ''; ?>>Disable</option>
																	</select>
																
																</td>
																<td class="text-right"><span class="btn btn-icon-toggle" onclick="$('#gallery<?php echo $img_row; ?>').remove();"><i class="fa fa-trash-o"></i></span></td>
															</tr>
														
													<?php $img_row++; }} ?>
													</tbody>
													<tfoot>
															<tr>
																<td colspan="7" class="text-right"><span class="btn btn-icon-toggle btn-primary" onclick="addGallery();"><i class="fa fa-plus"></i></span></td>
															</tr>
														</tfoot>
													
												</table>
												
											<div class="clearfix"></div>
											<hr/>
											<h4>Gallery Download</h4>
											<div class="form-group">
												
												<label for="galdownload2" class="col-sm-3 control-label">Downloadable Gallery Video</label>
												
												<div class="col-sm-9">
													<div class="input-group">
														<div class="input-group-content">
															<input class="form-control" id="galdownload2" name="gallery_zip" value="<?php echo set_value('gallery_zip',$rowdata['gallery_zip']); ?>" type="text"><div class="form-control-line"></div>
														</div>
														<div class="input-group-btn">
															<button type="button" class="btn btn-default" tabindex="-1">Action</button>
															<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" tabindex="-1" aria-expanded="false">
																<span class="caret"></span>
															</button>
															<ul class="dropdown-menu pull-right" role="menu">
																<li><a href="#" data-toggle="modal" data-target="#fileManagerModal" data-urlpath="<?php echo  URL_FILEMANAGER.'?type=2&akey=admin&field_id=galdownload2'; ?>">Change</a></li>
																<li class="divider"></li>
																<li><a href="#" onclick="alert('Function not available')">Download</a></li>
															</ul>
														</div>
													</div><!--end .input-group -->
												</div><!--end .col -->
												
											</div>
											
											<div class="clearfix"></div>
											<span class="help">
												Note: Downloadable images must be in zip or rar. Leave empty if download is not available.
											</span>
											
											<script>
											
													$img_row = <?php echo $img_row; ?>; 
													
													function addGallery(){
														$html = '';
														$html+= '<tr id="gallery'+$img_row+'">';
														
														$html += '<td class="text-center"><img src="<?php echo URL_FILEMANAGER_SOURCE.'no_image.jpg'; ?>" id="gallery_img'+$img_row+'_preview" class="img-responsive thumbnail" style="border: 1px solid #CCC; max-height: 120px; display: inline;">';
														$html += '<input type="hidden" name="gallery['+$img_row+'][image]" value="" id="gallery_img'+$img_row+'"><br/>';
														$html += '<div class="btn btn-default-bright btn-loading-state" data-loading-text="&lt;i class=\'fa fa-spinner fa-spin\'&gt;&lt;/i&gt; Loading..." data-toggle="modal" data-target="#fileManagerModal" data-urlpath="<?php echo  URL_FILEMANAGER.'?type=1&akey=admin&field_id='; ?>gallery_img'+$img_row+'"><span class="md md-my-library-books"></span>Browse</div></td>';
														$html += '<td><input class="sort_order" type="text" value="" name="gallery['+$img_row+'][sort_order]"></td>';
														$html += '<td><select name="gallery['+$img_row+'][status]"><option type="text" value="1" >Enable</option><option type="text" value="0" >Disable</option></select></td>';
														$html += '<td class="text-right"><span class="btn btn-icon-toggle" onclick="$(\'#gallery'+$img_row+'\').remove();"><i class="fa fa-trash-o"></i></span></td>';
														$html += '</tr>';
													
														
														$('#gallery_table tbody').append($html);
														
														sortOrderTable("#galleryBody");
														$img_row++;
														
													}
													
											</script>
											
											</div>
										</div>
										
										<!--tab comments-->
										<div id="comments" class="tab-pane" >
											
										
											<div class="col-sm-4">
												
												<div class="card alert alert-callout alert-mild  ">
													
													<div class="card-body">
														<h4>Track History</h4>
														<table class="table table-condensed no-margin">
															
															<tbody>
																<tr>
																	<td style="vertical-align: top;">View Count</td>
																	<td>
																		<?php echo $vidtracking['view_count']; ?> view(s)<br/>
																	</td>
																</tr>
																<tr>
																	<td style="vertical-align: top;">Last view: </td>
																	<td>
																		<?php echo ($vidtracking['date_last_viewed']<>'0000-00-00 00:00:00')? date('D, M j Y h:i:s A',strtotime($vidtracking['date_last_viewed'])): 'Not yet viewed'; ?>
																	</td>
																</tr>
																<tr>
																	<td style="vertical-align: top;">Date Added:</td>
																	<td>
																		<?php echo ($vidtracking['date_added']<>'0000-00-00 00:00:00')? date('D, M j Y h:i:s A',strtotime($vidtracking['date_added'])): '-----'; ?><br/>
																		User: <?php echo $vidtracking['added_by']; ?>
																	</td>
																</tr>
																<tr>
																	<td style="vertical-align: top;">Date Updated:</td>
																	<td>
																		<?php echo ($vidtracking['date_modified']<>'0000-00-00 00:00:00')? date('D, M j Y h:i:s A',strtotime($vidtracking['date_modified'])): '-----'; ?>
																		<br/>
																		User:  <?php echo $vidtracking['updated_by']; ?>
																	</td>
																</tr>
																
															</tbody>
														</table>
													</div><!--end .card-body -->
												</div><!--end .card -->
																					
											</div>
											
											<div class="col-sm-8 card">
												<h4>Comments</h4>
												
												<div id="comment_list" data-url="<?php echo site_url('videos/videos').'/load_comment_list/'.$rowdata['id']; ?>" class="card-body style-default-light height-10 scroll">
													
													<span  class="fa fa-spinner fa-spin"></span>Loading Please Wait..
												
												</div>
												<span class="help">Refresh every 10 sec.</span>
											</div>
											
											<div class="clearfix"></div>
											<hr/>	
										</div>
										
										<div class="clearfix"></div>
										<div class="form-group col-md-12">
											<div class="text-right pull-right col-md-2">
												<input type="submit" value="Save" class="btn btn-primary" />
												<a href="<?php echo site_url('videos/videos'); ?>"><div class="btn btn-default-bright">Back</div></a>
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
							
							<h4 class="modal-title">File Manager</h4>
						
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
	
	<div class="modal fade" id="simpleModal" tabindex="-1" role="dialog" aria-labelledby="simpleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
			<div class="modal-dialog modal-lg">
			<div class="modal-content">
					<div class="modal-header">
							
							<h3 class="modal-title">Modal View</h3>
						
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
							<button type="button" class="btn btn-primary btn-sm" onclick="post_comment(<?php echo $rowdata['id']; ?>);" >Save</button>
							
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
			$content=  '<iframe style="display:block; width: 100%; min-height: 450px;" src="'+action.data('urlpath')+'" frameborder="0" allowtransparency="true"></iframe>';
			modal.find('.modal-body').html($content);
				
		});
		
		$('#simpleModal').on('shown.bs.modal', function(event){
			var action = $(event.relatedTarget)
			var modal = $(this)
			$content = '';
			$('#meeting_save_button').removeClass('btn-warning').addClass('btn-default');
			modal.find('.modal-title').text(action.data('title'));
			modal.find('.modal-body').html('<span class="fa fa-spinner fa-spin"></span>Loading Please Wait').load(action.data('urlpath'));
			
		});
		
		//REALTIME COMMENT LISTING
		$flag = 'off'; //control the realtime: should be once only
		$('#comment_tab').click(function(){
			if($flag=='off'){
				realTime('comment_list');
				
			}
			$flag= 'on';
		});
		
	});
	
	function post_comment($video_id){ //add comment
	
		$text = $('#textarea_reply').val();
		$option = $('#comment_option').val();
		$parent_id = $('#comment_parent_id').val();
	
		if($text.length>3){
			if(confirm('Do you really want to post this comment/reply?')){
				$.ajax({
					url: '<?php echo site_url('videos/videos/post_comment'); ?>/'+$video_id+'/'+$parent_id,
					data:{'review_description':$text,'comment_option':$option},
					dataType:'json',
					type: 'post',
					success: function(d){
						makeToast(d.status,d.message);
						refresh('comment_list');
						$('#simpleModal').modal('hide');
						$('#simpleModal .modal-body').html('');
					},
					error: function(){
						makeToast('danger','Error changing comment status.');
					},
					complete: function(){
						//makeToast('danger','Error found.');
					}
					
				});
			}
		}else{
			$('#modal_notify_error').html('Your reply is too short. Please reply atleast min of 3 character.');
		}
		
		return false;
		
	}

	function status_comment($id,$status){ //actually hide only
		
		$question= ($status==1) ?  'Current status: ACTIVE.\nDo you want to hide this comment?':	'Current status: HIDDEN.\nDo you want to show/approve this comment?';
		
		if(confirm($question)){
			$.ajax({
				url: '<?php echo site_url('videos/videos/status_comment'); ?>/'+$id+'/'+$status,
				dataType:'json',
				type: 'get',
				success: function(d){
					makeToast(d.status,d.message);
					refresh('comment_list');
				},
				error: function(){
					makeToast('danger','Error changing comment status.');
				},
				complete: function(){
					//makeToast('danger','Error found.');
				}
				
			});
		}
	}
	
	function delete_comment($id){
		
		if(confirm('Do you want to delete this comment? This cannot be undone.')){
			$.ajax({
				url: '<?php echo site_url('videos/videos/delete_comment'); ?>/'+$id,
				dataType:'json',
				type: 'get',
				success: function(d){
					makeToast(d.status,d.message);
					if(d.status=='success'){
					$('#usercomment_'+$id).fadeOut(100).remove();
					}
				},
				error: function(){
					makeToast('danger','Error sending your reply.');
				},
				complete: function(){
					//makeToast('danger','Error found.');
				}
				
			});
		}
	}
	
	$("#galleryBody").sortable({
		stop: function( event, ui ) {
			
			sortOrderTable($(this));
		},
		cursor: "move",
		appendTo: "parent",
		helper: "clone"
	}).disableSelection();
	
	function sortOrderTable($elem){
		
		var sort_val = 1;
		
		$($elem).children('tr').each(function(){ //expecting a tr tag
			
			$(this).children('td').each(function(){ //expecting a td tag
				$(this).children('input.sort_order').val(sort_val); //change the input tag value
			});
			
			sort_val++;
		});
		
	}
	
	textEditor('.tinymce');
	
</script>	

<?php echo $footer; ?>