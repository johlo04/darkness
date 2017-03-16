<?php echo $header; ?>
<?php echo $sidebar_left; ?>

<div id="content" class="animated fadeIn">
	<section class="style-default-light">
		<div class="section-header">
			<h2 class="text-primary"><?php echo isset($page_title) ? $page_title : $system_title; ?></h2>
			<?php echo $breadcrumbs; ?>
		</div>

		<div class="section-body">
			<hr />
			<div style="display: block;" class="card">
			
				<div class="card-body">
				
				
						<div class="row">
							<div class="col-sm-4">
								<div class="form-group">
									<label class="col-sm-4" for="Firstname5">Search<br/>Video Title</label>
									<div class="col-sm-6">
										<input type="text" id="filter_video_name" class="form-control" name="videos_name" value="<?php echo $filter_video_name; ?>">
									</div>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label class="col-sm-4" for="Lastname5">Search<br/>Artist Name</label>
									<div class="col-sm-8">
										<select id="filter_actress" class="form-control">
											<?php if(count($actress_list)>0){ ?>
												<option></option>
												<?php foreach($actress_list as $actress){ ?>
													<option value="<?php echo $actress['id']; ?>" <?php echo ($actress['id']==$filter_actress)? 'selected="selected"': ''; ?> ><?php echo $actress['en_name'].' | '.$actress['jp_name']; ?></option>
												<?php } ?>
											<?php } ?>
										</select>
									</div>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label class="col-sm-4" for="Lastname5">Search&nbsp;<br/> Video Status</label>
									<div class="col-sm-8">
										<select id="filter_status" class="form-control">
												<option></option>
												<option value="active" <?php echo ($filter_status=='active')? 'selected="selected"': ''; ?> >Active</option>
												<option value="inactive" <?php echo ($filter_status=='inactive')? 'selected="selected"': ''; ?> >Inactive</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-sm-2 text-right">
								<div class="form-group">
								<span class="btn btn-default" onclick="filter();"><i class="md md-search"></i>Filter</span>
								</div>	
							</div>	
						</div>	
					
					<hr />
					
					<div class="table-responsive">
					
						<table class="table table-striped table-hover display nowrap" id="videos-list">
							<thead>
							
								<tr>
									<td></td>
									<td>Video Title</td>
									<td>Category</td>
									<td>Actress</td>
									<td>Duration</td>
									<td>Views</td>
									<td class="text-center">Status</td>
									<td>Date Posted</td>
									<td class="text-right">
									<a class="btn ink-reaction btn-raised btn-primary btn-sm" href="<?php echo site_url('videos/videos/add'); ?>"><span class="fa fa-plus"></span> Post Video</a></td>
						
								</tr>
							</thead>
							
							<tbody>
								<?php if(count($videos)>0){ ?>
									<?php foreach($videos as $key => $value){ ?>
										<tr>
											<td><img src="<?php echo URL_FILEMANAGER_THUMBS; echo (!empty($value['cover_image']))? $value['cover_image']: 'no_image.jpg'; ?>"></td>
											<td>
												
												<i><?php echo $value['eng_title']; ?></i><br />
												<?php echo $value['jap_title']; ?>
											</td>
											<td>
												<?php if(count($value['category'])){ ?>
													<?php foreach($value['category'] as $category){ ?>
														<a class="text-primary" href="<?php echo site_url('option/category').'/'.$category['id']; ?>"><?php echo $category['en_keyword'].' | '.$category['jp_keyword']; ?></a><br/>
													<?php } ?>
												<?php } ?>
											</td>
											<td>
												<?php if(count($value['actress'])){ ?>
													<?php foreach($value['actress'] as $actress){ ?>
														<a class="text-primary" href="<?php echo site_url('option/category').'/'.$actress['id']; ?>"><?php echo $actress['en_name'].' | '.$actress['jp_name']; ?></a><br/>
													<?php } ?>
												<?php } ?>
											</td>
											<td><span class="<?php echo ($value['video_duration']=='00:00:00')? 'text-danger': ''; ?>"><?php echo $value['video_duration']; ?></span></td>
											<td><?php echo $value['view_count']; ?></td>
											<td>
												<?php echo ($value['status'])? 'Active': 'Inactive'; ?>
											</td>
											<td><?php echo $value['date_added']; ?></td>
											
											
											<td class="text-right">
												<?php if($value['is_featured']){ ?>
													<span class="btn ink-reaction btn-warning" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Featured Video">
														<i class="fa fa-star"></i>
													</span>
													
												<?php }else{ ?>
													<span class="btn ink-reaction style-gray-bright" data-toggle="tooltip" data-placement="bottom" title="" ondblclick="set_featured(<?php echo $value['id']; ?>);" data-original-title="Click to set as featured" >
														<i class="fa fa-star"></i>
													</span>
													
												<?php } ?>
												
												<a class="btn ink-reaction btn-primary" href="<?php echo site_url('videos/videos/edit').'/'.$value['id']; ?>">
														<i class="fa fa-pencil"></i>
													</a>
																	
												<a class="btn ink-reaction btn-danger" onclick="deleteProduct('<?php echo site_url('videos/videos/delete').'/'.$value['id'].'/'.strtotime($value['date_modified']); ?>')">
														 <i class="fa fa-trash"></i>
												</a>
												
											</td>
											
										</tr>
									<?php }}else{ ?>
										<tr>
											<td colspan="9" class="text-center">No videos found.</td>
										</tr>
									<?php } ?>
							</tbody>
							
						</table>
					</div>
				</div>
				
			</div>
		</div>
		<?php echo $this->pagination->create_links(); ?>
	</section>
</div>
<script>
	function filter(){
		
			url = '<?php echo site_url('videos/videos'); ?>/'; //'<?php echo current_url(); ?>';
			flag = 0; // for parameter
			
			var filter_video_name = document.getElementById('filter_video_name').value;
			
			if (filter_video_name) {
				url += (flag)? '&':'?';
				url += 'filter_video_name=' + encodeURIComponent(filter_video_name);
				flag= 1;
			}
			
			var filter_actress = document.getElementById('filter_actress').value;
			
			if (filter_actress) {
				
				url += (flag)? '&':'?';
				url += 'filter_actress=' + encodeURIComponent(filter_actress);
				flag= 1;
			}
			
			var filter_status = document.getElementById('filter_status').value;
			
			if (filter_status) {
				
				url += (flag)? '&':'?';
				url += 'filter_status=' + encodeURIComponent(filter_status);
				flag= 1;
			}
			
			
			location = url;
	}
	
	function deleteProduct(url){
		if(confirm('Do you really want to delete this videos?')){
			location = url;
		}
	}
	
	function deleteProduct(url){
		if(confirm('Do you really want to delete this videos?')){
			location = url;
		}
	}
	
	function set_featured($id){
		
		$question=  '<h4 class="text-primary">Confirmation:</h4>Set this video as featured?';
		$.confirm({
			text: $question,
			confirm: function(button) {
				$.ajax({
					url: '<?php echo site_url('videos/videos/set_featured'); ?>/'+$id,
					dataType:'json',
					type: 'get',
					success: function(d){
					
						window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>';
					},
					error: function(){
						makeToast('danger','Error changing featured status.');
					},
					complete: function(){
						//makeToast('danger','Error found.');
					}
					
				});
			},
			cancel: function(button) {
				//alert("You cancelled.");
			}
		});
		
		/*
		native:
		
		if(confirm($question)){
			$.ajax({
				url: '<?php echo site_url('videos/videos/set_featured'); ?>/'+$id,
				dataType:'json',
				type: 'get',
				success: function(d){
				
					window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>';
				},
				error: function(){
					makeToast('danger','Error changing featured status.');
				},
				complete: function(){
					//makeToast('danger','Error found.');
				}
				
			});
		}
		*/
	}
	
	$("tbody").sortable({
	change: function( event, ui ) { alert('change'); },
	cursor: "move",
    appendTo: "parent",
    helper: "clone"
	}).disableSelection();
	
	
</script>

<?php echo $footer; ?>
