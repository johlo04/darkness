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
										<input type="text" id="filter_keyword" class="form-control" name="product_name" value="<?php echo $filter_keyword; ?>">
									</div>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label class="col-sm-4" for="Lastname5">Filter Status</label>
									<div class="col-sm-6">
										<select id="filter_status" class="form-control">
										<option value=""></option>
										<option value="0" <?php echo ($filter_status=='0')? ' selected="selected" ': ''; ?>>Active</option>
										<option value="1" <?php echo ($filter_status=='1')? ' selected="selected" ': ''; ?>>Ignored</option>
										<option value="2" <?php echo ($filter_status=='2')? ' selected="selected" ': ''; ?>>Closed</option>
										
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
									
									<td>Subject</td>
									<td>Message</td>
									<td>Unread Replies</td>
									<td class="text-center">Status</td>
									<td class="text-right"><a href="<?php echo site_url('inquiry/inquiry/add'); ?>"><div class="btn btn-primary"><span class="fa fa-plus"></span> Add Product</div></a></td>
									
								</tr>
							</thead>
							
							<tbody>
								<?php if(count($inquiry)>0){ ?>
									<?php foreach($inquiry as $value){ ?>
										<tr>
								
											<td>
												<b><?php echo $value['title']; ?></b><br/>
												from: <?php echo $value['username']; ?><br/>
											
											</td>
											
											<td style="max-width:300px;">
											<?php echo readMoreJS($value['detail'],''); ?></td>
										
											<td><span class="<?php echo ($value['unread'])? 'text-danger': ''; ?>"><?php echo $value['unread']; ?></span></td>
											<td class="text-center"><?php echo ucwords($value['status']); ?></td>
											<td class="text-right">
												<a href="<?php echo site_url('inquiry/inquiry/view').'/'.$value['id']; ?>">
													<label class="btn ink-reaction btn-primary">
													 <i class="fa fa-envelope"></i>
													</label>
												</a>
											
												<a onclick="deleteInquiry('<?php echo site_url('inquiry/inquiry/delete').'/'.$value['id'].'/'.strtotime($value['date_modified']); ?>')">
													<label class="btn ink-reaction btn-primary">
													 <i class="fa fa-trash"></i>
													</label>
												</a>
												
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
		
			url = '<?php echo site_url('inquiry/inquiry'); ?>/'; //'<?php echo current_url(); ?>';
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
	
	function deleteInquiry(url){
		if(confirm('Do you really want to delete this product?')){
			location = url;
		}
	}
	
</script>

<?php echo $footer; ?>
