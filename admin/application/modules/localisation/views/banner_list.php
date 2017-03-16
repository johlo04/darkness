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
					
					<div class="table-responsive">
						
						<table class="table table-striped table-hover display nowrap" id="product-list">
							<thead>
							
								<tr>
									<td>Image</td>
									<td>Sort Order</td>
									<td class="text-center">Status</td>
									<td class="text-right">
									<a class="btn ink-reaction btn-raised btn-primary btn-sm" href="<?php echo site_url('extension/banner/add'); ?>"><span class="fa fa-plus"></span> Add Banner</a></td>	
								</tr>
								
							</thead>
							
							<tbody>
								<?php if(count($banner)>0){ ?>
									<?php foreach($banner as $value){ ?>
										<tr>
											<td><img src="<?php echo URL_FILEMANAGER_THUMBS; echo (!empty($value['image']))? $value['image']: 'no_image.jpg'; ?>" title="<?php echo $value['text_label']; ?>"></td>
											<td><?php echo $value['sort_order']; ?></td>
											
											<td class="text-center">
												
												<?php echo ($value['status'])? 'Enable': 'Disable'; ?>
												
											</td>
											<td class="text-right">
												<a class="btn ink-reaction btn-primary" href="<?php echo site_url('extension/banner/edit').'/'.$value['id']; ?>">
													<i class="fa fa-pencil"></i>
												</a>
											
												<a class="btn ink-reaction btn-primary" onclick="deleteProduct('<?php echo site_url('extension/banner/delete').'/'.$value['id']; ?>')">
													 <i class="fa fa-trash"></i>
												</a>
												
											</td>
											
										</tr>
									<?php }}else{ ?>
										<tr>
											<td colspan="8" class="text-center">No banner found.</td>
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

	function deleteProduct(url){
		if(confirm('Do you really want to delete this banner?')){
			location = url;
		}
	}
	
</script>

<?php echo $footer; ?>
