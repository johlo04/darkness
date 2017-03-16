<table class="table table-condensed">
	<thead>
		<tr>
			<td>Product Name</td>
			<td>Status</td>
			<td>Highest Bid</td>
			<td>Top Bidder</td>
			<td>View</td>
		</tr>
	</thead>
	<tbody>
		<?php if(count($product)>0) { foreach($product as $value){ ?>
		<tr>
			<td><?php echo $value['product_name']; ?></td>
			<td>
				<?php if($value['status']==2){ //0 for bidding, 1 bidding close, 2 cancel ?>
					<span class="">Cancel</span>
				<?php }elseif($value['status']==1){ ?>
					<span class="text-success">Ended / Close</span>
				<?php }else{ ?>
					<span class="text-primary product_status<?php echo $value['id']; ?>">For bidding</span><br/>
					<span class="endtime<?php echo $value['id']; ?>"></span><br/>
					<span class="md md-timer"></span>
					<span class="countdown<?php echo $value['id']; ?>"></span>
					<script>
						bid_process(<?php echo $value['id']; ?>,"<?php echo $value['datetime_end']; ?>","<?php echo $value['product_name']; ?>","<?php echo site_url('products/product/set_closebid');?>");
										
					</script>
				<?php } ?>
			</td>
			<td><?php echo (empty($value['lastbid']['username']))? '<span class="md-warning text-danger"></span>'.'No bidder': $value['lastbid']['username']; ?></td>
			<td><?php echo ($value['lastbid']['bidding_price'])? @number_format($value['lastbid']['bidding_price'],2, '.', ','): '0.00'; ?></td>
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
			<td colspan="5" class="text-center">No product to bid.</td>
		</tr>
		<?php } ?>
	</tbody>

</table>