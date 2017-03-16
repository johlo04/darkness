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
							<div class="col-sm-6">
								<div class="form-group">
									<label class="col-sm-4" for="Firstname5">Search Keyword</label>
									<div class="col-sm-6">
										<input type="text" id="filter_keyword" class="form-control" name="product_name" value="">
									</div>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label class="col-sm-4" for="Lastname5">Filter Status</label>
									<div class="col-sm-6">
										<select id="filter_status" class="form-control">
										<option value=""></option>
										
										</select>
									</div>
								</div>
							</div>
							<div class="col-sm-2 text-right">
								<div class="form-group">
								<span class="btn btn-primary" onclick="filter();">Filter</span>
								</div>	
							</div>	
						</div>	
					
					<hr />
					
					<div class="table-responsive">
						
						<table class="table table-striped table-hover display nowrap" id="product-list">
							<thead>
							
								<tr>
									
									<td>Username</td>
									<td>Name</td>
									
									<td class="text-center">Status</td>
									<td class="text-right"></td>
						
								</tr>
							</thead>
							
							<tbody>
								<?php if(count($members)>0){ ?>
									<?php foreach($members as $value){ ?>
										<tr>
											
											<td><?php echo $value['username']; ?></td>
											<td><?php echo $value['firstname'].' '.$value['lastname']; ?></td>
											
											<td class="text-center"><?php switch($value['status']){
														case 1: echo'Active'; break;
														case 2: echo'Banned'; break;
														default : echo'Inactive'; break;
														}
											?></td>
											
											
											<td class="text-right">
											
												<a href="<?php echo site_url('users/member/view').'/'.$value['id']; ?>" class="btn btn-icon-toggle btn-primary"><span class="fa fa-eye"></span></a>
												<button type="button" onClick="alert('Not Available');" class="btn btn-icon-toggle btn-info"><span class="fa fa-lock"></span></button>
												
											</td>
											
										</tr>
									<?php }} ?>
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
		
			url = '<?php echo site_url('users/member'); ?>/'; //'<?php echo current_url(); ?>';
			flag = 0;
			
			var filter_status = document.getElementById('filter_status').value;
			
			if (filter_status) {
				
				url += (flag)? '&':'?';
				url += 'filter_status=' + encodeURIComponent(filter_status);
				flag= 1;
			}
			
			var filter_keyword = document.getElementById('filter_keyword').value;
			
			if (filter_keyword) {
				url += (flag)? '&':'?';
				url += 'filter_keyword=' + encodeURIComponent(filter_keyword);
				flag= 1;
			}
			
			location = url;
	}
	
	function deleteProduct(url){
		if(confirm('Do you really want to delete this product?')){
			location = url;
		}
	}
	
</script>

<?php echo $footer; ?>
