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
							
							<div class="card-body tab-content">
								<div class="col-sm-6">
										<div class="card card-underline">
													<div class="card-head">
															<header><span class="fa fa-database"></span> Database Tables</header>
															<span class="pull-right"><input type="checkbox" id="checkAll">Check/Uncheck All &nbsp;</span>
													</div>
							
													<div class="card-body height-10 scroll style-default-bright no-padding-vertical" id="top_category_content">
														<ul class="list">
														<?php if(count($tables)>0){ foreach($tables as $key=> $value){ ?>
															<li class="tile" >
			
																<input class="myTables" name="table_name[]" id="key<?php echo $key; ?>" value="<?php echo $value['Tables_in_'.$this->db->database]; ?>"  type="checkbox">	<label for="key<?php echo $key; ?>"><?php echo $value['Tables_in_'.$this->db->database]; ?></label>
																
															
														<?php }} ?>
														</ul>
													</div>
									
										</div>
								</div>
								
								<div class="col-sm-6">
									<span class="fa fa-cubes"></span> DATABASE PROCESS
									<div class="col-sm-12">
										<span>List of Table you chosen:</span><span class="pull-right">Total Count: <i id="tablecount">0</i></span>
										<div  class="card">
											<div id="table_checked" class="card-body height-4 scroll style-default-bright no-padding-vertical">
											</div>
										</div>
										
										<div><span class="help">Click an action to apply on chosen tables.</span></div>
										
										<div class="col-sm-2">Actions: </div>
										<div class="col-sm-10" id="action_holder">
											<div class="btn btn-default margin-bot" onclick="backup(0);">Backup</div>
											<div class="btn btn-default margin-bot" onclick="repair();">Repair</div>
											<div class="btn btn-default margin-bot" onclick="optimized();">Optimized</div>
											<div class="btn btn-default margin-bot" onclick="backup(1);">Backup & Download</div>
										</div>
										<div id="request_handler" style="display:none;"><div class="text-info"><span class="fa fa-spinner fa-spin"></span>Processing your request.</div></div>
										<div>&nbsp;</div>
										<div>
											Filename: <input type="text" id="filename"><br/>
											<span class="help">Enter a filename(default will be used if empty)</span>
										</div>
										
										<?php /*<div >Status: </div>
										<div class="card">
											<div class="card-body height-2 scroll style-default-bright no-padding-vertical"></div> 
										</div>
										*/ ?>
									
									</div>
								</div>
								
								
							</div><!--end .card-body -->
						</div>
			</div>
			
			
			</div>
		</div>
				
	</section>
	
</div>
<script type="text/javascript">
checkedValues = [];
$("#checkAll").change(function () {
    $("input:checkbox").prop('checked', $(this).prop("checked"));
	checboxer();
});

$('.myTables').on('click',function(){
	checboxer();

});

function checboxer(){
	checkedValues= $('.myTables:checkbox:checked').map(function() {
		return this.value;
	}).get();
	
	$seperator = (checkedValues.length>0)? '✔': '';
	//$seperator = (checkedValues.length>0)? ' <span class="fa fa-cube"></span>': '';
	
	$('#table_checked').html($seperator+checkedValues.join(' '+$seperator));
	$('#tablecount').text(checkedValues.length);
}

//ajax
function showAction(){
	$('#action_holder').show();
	$('#request_handler').hide();
}
function hideAction(){
	$('#action_holder').hide();
	$('#request_handler').show();
}
function backup($d){
	
	hideAction();
	
	$url= '<?php echo site_url('system/database/backup'); ?>/'+$d;
	
	$.ajax({
		type: 'post',
		data: {'table': checkedValues,'filename':$('#filename').val() },
		url:  $url,
		dataType: 'json',
		error: function(e){
			makeToast('danger','Error found.');
			showAction();
		},
		success: function(data){
			
			if(data.downloadlink){ // this will receive a download link
				downloadBackup(data.downloadlink);
			}else{
				
				makeToast('success','Backup file has been successfully created.');
				showAction();
			}
		}

	});
}

function downloadBackup($id) {
	  makeToast('','Preparing downloadable file.');
	  showAction();
	  url = '<?php echo site_url("system/database/download");?>';
	  url += '/'+$id;
	 
	  var win = window.open(url, '_blank');
	  setTimeout(win, 5000);
	  //win.focus();
}

function optimized(){
	hideAction();
	$url= '<?php echo site_url('system/database/optimized'); ?>/';
	
	$.ajax({
		type: 'post',
		data: {'table': checkedValues},
		url:  $url,
		dataType: 'json',
		error: function(e){
			makeToast('danger','Error found.');
			showAction();
		},
		success: function(data){
		
			makeToast(data.status,data.message);
			showAction();
		}

	});
	
}

function repair(){
	hideAction();
	$url= '<?php echo site_url('system/database/repair'); ?>/';
	
	$.ajax({
		type: 'post',
		data: {'table': checkedValues},
		url:  $url,
		dataType: 'json',
		error: function(e){
			makeToast('danger','Error found.');
			showAction();
		},
		success: function(data){
			makeToast(data.status,data.message);
			showAction();
		}

	});
	
}


$('[data-toggle="tooltip"]').tooltip();
</script>
<?php echo $footer; ?>