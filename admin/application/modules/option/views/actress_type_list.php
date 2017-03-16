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
									<label class="col-sm-4" for="Firstname5">Search<br/>Category Name</label>
									<div class="col-sm-6">
										<input type="text" id="filter_category_name" class="form-control" name="videos_name" value="<?php echo $filter_category_name; ?>">
									</div>
								</div>
							</div>
							
							<div class="col-sm-4">
								<div class="form-group">
									<label class="col-sm-4" for="Lastname5"> Status</label>
									<div class="col-sm-8">
										<select id="filter_status" class="form-control">
												<option></option>
												<option value="active" <?php echo ($filter_status=='active')? 'selected="selected"': ''; ?> >Active</option>
												<option value="inactive" <?php echo ($filter_status=='inactive')? 'selected="selected"': ''; ?> >Inactive</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-sm-4 text-right">
								<div class="form-group">
								<span class="btn btn-primary" onclick="filter();"><i class="md md-search"></i>Filter</span>
								</div>	
							</div>	
						</div>	
					
					<hr />
					
					<div class="table-responsive">
					
						<table class="table table-striped table-hover display nowrap" id="videos-list">
							<thead>
							
								<tr>
									
									<td>Actress Type Category</td>
									
									<td class="text-center">Status</td>
									<td class="text-right">
									<a class="btn ink-reaction btn-raised btn-primary btn-sm" href="<?php echo site_url('option/actresstype/add'); ?>"><span class="fa fa-plus"></span> Add Actress Type</a></td>
						
								</tr>
							</thead>
							
							<tbody>
								<?php if(count($category)>0){ ?>
									<?php foreach($category as $key => $value){ ?>
										<tr>
											<td>
												
												<i><?php echo $value['en_keyword']; ?></i> | 
												<?php echo $value['jp_keyword']; ?>
											</td>
											
											<td>
												<?php echo ($value['status'])? 'Active': 'Inactive'; ?>
											</td>
											
											<td class="text-right">
												
												<a class="btn ink-reaction btn-primary" href="<?php echo site_url('option/actresstype/edit').'/'.$value['id']; ?>">
													<i class="fa fa-pencil"></i>
												</a>
											<?php if(in_array($value['id'],array(1,2,3))){ ?>
												<a class="btn ink-reaction btn-primary" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Lock Category" >
													 <i class="md md-lock"></i>
												</a>
											<?php }else{ ?>
												<a class="btn ink-reaction btn-primary" onclick="deleteProduct('<?php echo site_url('option/actresstype/delete').'/'.$value['id']; ?>')">
													 <i class="fa fa-trash"></i>
												</a>
											<?php } ?>
											</td>
											
										</tr>
									<?php }}else{ ?>
										<tr>
											<td colspan="9" class="text-center">No category found.</td>
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
		
			url = '<?php echo site_url('option/actresstype'); ?>/'; //'<?php echo current_url(); ?>';
			flag = 0; // for parameter
			
			var filter_category_name = document.getElementById('filter_category_name').value;
			
			if (filter_category_name) {
				url += (flag)? '&':'?';
				url += 'filter_category_name=' + encodeURIComponent(filter_category_name);
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
	
</script>

<?php echo $footer; ?>
