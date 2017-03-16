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
							
							
								<div class="card-body tab-content">
									
										<div id="general" class="tab-pane active">				
									
											<div class="col-md-12">
												
													<div id="general" class="tab_content">

														<div class="col-md-12">
															<div class="col-md-6">
																<div class="h4">Subject: <b class=""><?php echo	$rowdata['title']; ?></b></div>
																<div class="h5 opacity-50">Posted by: <span class=""><?php echo $rowdata['username']; ?></span><br/>
																Date: <script>
																	var start = '<?php echo $rowdata['date_added']; ?>';
																	
																	if(moment(start).isValid()){
																		document.write(moment(start).format('llll'));
																	}
																
																</script>
																</div>
															</div>
															
															<div class="clearfix"></div>
																<div class="h4 text-primary col-sm-6">
																	Inquiry Message:	
																</div>
																
																<div class="h4 text-primary col-sm-6 text-left">
																	<div class="pull-right">Status: 
																	<select id="inquiry_status">
																		<option value="open" <?php echo ($rowdata['status']=='open')? 'selected="selected"': ''; ?>>Open/Active</option>
																		<option value="close" <?php echo ($rowdata['status']=='close')? 'selected="selected"': ''; ?>>Closed Inquiry</option>
																		<option value="ignore" <?php echo ($rowdata['status']=='ignore')? 'selected="selected"': ''; ?>>Ignored Inquiry</option>
																	</select>
																	<span class="btn btn-default btn-sm" onclick="status_inquiry(<?php echo $rowdata['id']; ?>)">Apply</span>
																	</div>
																</div>
																
																<div class="clearfix"></div>
															<div class="card">
																
																	<div class="card-body">
																		<?php echo	$rowdata['detail']; ?>
																	</div>
																	
															</div>
														<hr/>	
															
														</div>
																
														<div class="col-md-6 ">	
																
																<div class="col-md-6 col-xs-6 ">
																<span class="h4 text-primary">Inquiry Replies:</span>	
																</div>
															
																<div class="col-md-6 col-xs-6 text-right">
																	<div class="btn btn-default btn-sm pull-right marginized btn-loading-state" data-loading-text="&lt;i class='fa fa-spinner fa-spin'&gt;&lt;/i&gt; Loading..." onclick="refresh('reply_list');"> <i class="fa fa-refresh"></i> Refresh</div>
																
																</div>
																<br/><br/>
																<div class="clearfix"></div>
																
																<div class="card">
																	<div id="reply_list" data-name="reply_list" data-url="<?php echo site_url('inquiry/inquiry/load_replies').'/'.$rowdata['id']; ?>" class="list-results list-results-underlined card-body height-8 scroll ">
																		<span class="fa fa-spinner fa-spin"></span> Loading Please Wait...
																		<!-- LOAD REPLY LIST -->	
																		
																	</div>
																</div>
															
															
														</div>
														
														<div class="col-md-6 ">
																<div class="col-md-6 col-xs-6">
																	<div class="h4 text-primary">
																		Inquiry Reply Form:	
																	</div>
																</div>
																<div class="col-md-6 col-xs-6 text-right">
																	
																	
																</div>
																
																<div class="clearfix"></div>
																
																<div class="col-md-12">
																	
																	<div class="form-group">
																		
																		<textarea class="form-control tinymce" name="product_detail" type="text" placeholder="Product Detail" ></textarea>
																		<div class="clearfix"></div>
																	</div>
																	<span onclick="send_reply();" class="btn btn-default">Reply</span>
																	<a href="<?php echo site_url('inquiry/inquiry'); ?>"><div class="btn btn-default-bright">Back</div></a>
																	
																</div>
														</div>
												<div class="clearfix"></div>
											</div>	
											<hr/>
										</div>	
						
										<div class="clearfix"></div>
										
									
								</div><!--end .card-body -->
								
							</div>
					</div>
					<em class="text-caption">
						Please fill up the required inputs.
					</em>
	
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
	
	function send_reply(){
		if(confirm('Do you want to send this reply?')){
			var $message= tinyMCE.activeEditor.getContent();
			var $date= moment().tz('Asia/Tokyo').format('YYYY-MM-DD HH:mm:ss');
		
			$.ajax({
				url: '<?php echo site_url('inquiry/inquiry/add_reply').'/'.$rowdata['id']; ?>',
				data:{ message: $message, date_added: $date},
				dataType:'json',
				type: 'post',
				success: function(d){
					makeToast(d.status,d.message);
					tinyMCE.activeEditor.setContent('');
					//refresh('reply_list');
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
	
	function delete_reply($id){ 
		if(confirm('Do you want to delete this reply?')){
			$.ajax({
				url: '<?php echo site_url('inquiry/inquiry/delete_reply'); ?>/'+$id,
				dataType:'json',
				type: 'get',
				success: function(d){
					makeToast(d.status,d.message);
					$('#reply_'+$id).fadeOut(100);
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
	
	function read_reply($id){ 
		
			$.ajax({
				url: '<?php echo site_url('inquiry/inquiry/read_reply'); ?>/'+$id,
				dataType:'json',
				type: 'get',
				success: function(d){
					makeToast(d.status,d.message);
					refresh('reply_list');
					$('#readicon_'+$id).removeClass('text-danger');
				},
				error: function(){
					//makeToast('danger','Error sending your reply.');
				},
				complete: function(){
					//makeToast('danger','Error found.');
				}
				
			});
		
	}

	function status_inquiry($id){ //actually hide only
		if(confirm('Do you want to update the inquiry status?')){
			var $inquiry_status = $('#inquiry_status').val();
			$.ajax({
				url: '<?php echo site_url('inquiry/inquiry/status_inquiry'); ?>/'+$id,
				dataType:'json',
				type: 'post',
				data: {'status': $inquiry_status},
				success: function(d){
					makeToast(d.status,d.message);
				
					$('#reply_'+$id).fadeOut(100);
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

	realTime('reply_list');
	textEditor('.tinymce');

</script>

<?php echo $footer; ?>