<table class="table table-condensed">
	<thead>
		<tr>
			<td>Product Name</td>
			
			<td>Date Closed</td>
			<td>Billed Price</td>
			<td>Top Bidder</td>
			<td>View</td>
		</tr>
	</thead>
	<tbody >
		<?php if(count($product)>0) { foreach($product as $value){ ?>
		<tr>
			<td><?php echo $value['product_name']; ?></td>
			
			<td><?php echo $value['billed_date']; ?></td>
			<td><?php echo $value['final_price']; ?></td>
			
			<td><?php echo $value['lastbid']['username']; ?></td>
			<td>
				<a href="<?php echo site_url('products/product/edit').'/'.$value['id']; ?>">
					<label class="btn ink-reaction btn-primary">
					 <i class="fa fa-pencil"></i>
					</label>
				</a>
			</td>
		</tr>
		<?php }}else{ ?>
		<tr>
			<td colspan="6" class="text-center">No pending payment.</td>
		</tr>
		<?php } ?>
	</tbody>
</table>