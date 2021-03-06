<?php echo $header; ?>
<?php echo $sidebar_left; ?>

<div id="content">
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
									<label class="col-sm-4" for="Lastname5">Search<br/>Artist Name</label>
									<div class="col-sm-8">
										<input type="text" id="filter_actress" class="form-control" name="filter_actress" value="<?php echo $filter_actress; ?>">
									
									</div>
								</div>
							</div>
							<div class="col-sm-4">
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
								<span class="btn btn-primary" onclick="filter();"><i class="md md-search"></i>Filter</span>
								</div>	
							</div>	
						</div>	
					
					<hr />
					
					<div class="table-responsive">
					
						<table class="table table-striped table-hover display nowrap" id="actress-list">
							<thead>
							
								<tr>
									<td></td>
									<td>Actress</td>
									<td>Views</td>
									<td class="text-center">Status</td>
									<td>Date Added</td>
									<td class="text-right">
									<a class="btn ink-reaction btn-raised btn-primary btn-sm" href="<?php echo site_url('option/actress/add'); ?>"><span class="fa fa-plus"></span> Add Actress</a></td>
						
								</tr>
							</thead>
							
							<tbody>
								<?php if(count($actress)>0){ ?>
									<?php foreach($actress as $key => $value){ ?>
										<tr>
											<td><img src="<?php echo URL_FILEMANAGER_THUMBS; echo (!empty($value['cover_image']))? $value['cover_image']: 'no_image.jpg'; ?>"></td>
											<td>
												
												<i><?php echo $value['eng_name']; ?></i> | <?php echo $value['jap_name']; ?>
											</td>
											<td><?php echo $value['view_count']; ?></td>
											<td>
												<?php echo ($value['status'])? 'Active': 'Inactive'; ?>
											</td>
											<td><?php echo $value['date_added']; ?></td>
											<td class="text-right">
												<?php if($value['is_featured']){ ?>
													<span class="btn ink-reaction btn-danger" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Featured Video">
														<i class="fa fa-star"></i>
													</span>
													
												<?php }else{ ?>
													<span class="btn ink-reaction style-gray-bright" data-toggle="tooltip" data-placement="bottom" title="" ondblclick="set_featured(<?php echo $value['id']; ?>);" data-original-title="Click to set as featured">
														<i class="fa fa-star"></i>
													</span>
													
												<?php } ?>
												<a class="btn ink-reaction btn-primary" href="<?php echo site_url('option/actress/edit').'/'.$value['id']; ?>">
													<i class="fa fa-pencil"></i>
												</a>
											
												<a class="btn ink-reaction btn-primary" onclick="deleteProduct('<?php echo site_url('option/actress/delete').'/'.$value['id'].'/'.strtotime($value['date_modified']); ?>')">
													 <i class="fa fa-trash"></i>
												</a>
												
											</td>
											
										</tr>
									<?php }}else{ ?>
										<tr>
											<td colspan="9" class="text-center">No actress found.</td>
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
		
			url = '<?php echo site_url('option/actress'); ?>/'; //'<?php echo current_url(); ?>';
			flag = 0; // for parameter
			
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
		if(confirm('Do you really want to delete this actress?')){
			location = url;
		}
	}
	
	function set_featured($id){
		
		$question=  'Set this actress as featured?';
		
		if(confirm($question)){
			$.ajax({
				url: '<?php echo site_url('option/actress/set_featured'); ?>/'+$id,
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
	}
	
</script>

<?php echo $footer; ?>
