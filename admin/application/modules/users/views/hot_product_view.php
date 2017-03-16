<table class="table table-condensed">
	<thead>
		<tr>
			<td>Product Name</td>
			<td>Bidder Count</td>
			<td>Opening Price</td>
			<td>Highest Bid</td>
			<td>Top Bidder</td>
			<td>View</td>
			
		</tr>
	</thead>
	<tbody>
		<?php if(count($product)>0) { foreach($product as $value){ ?>
		<tr>
			<td><?php echo ($value['is_hot']>=10)? '<span class="glyphicon glyphicon-fire text-danger"></span>': ''; ?> <?php echo $value['product_name']; ?></td>
			<td><?php echo $value['count_bidder']; ?></td>
			<td><?php echo ($value['starting_price'])? number_format($value['starting_price'],2, '.', ','): '0.00'; ?></td>
			<td><?php echo ($value['lastbid']['bidding_price'])? @number_format($value['lastbid']['bidding_price'],2, '.', ','): '0.00'; ?></td>
			<td><?php echo (empty($value['lastbid']['username']))? '<span class="md-warning text-danger"></span>'.'No bidder': $value['lastbid']['username']; ?></td>
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
			<td colspan="6" class="text-center">No hot active product to bid.</td>
		</tr>
		<?php } ?>
	</tbody>
</table>