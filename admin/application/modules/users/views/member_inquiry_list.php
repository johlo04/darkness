<table class="table table-condensed">
	<thead>
		<tr>
			<td>Product Name</td>
			<td>Subject</td>
			<td>Date</td>
			<td>Status</td>
			<td>View</td>
		</tr>
	</thead>
	<tbody >
		<?php if(count($inquiry)>0) { foreach($inquiry as $value){ ?>
		<tr>
			<td><?php echo $value['product_name']; ?></td>
			<td><?php echo $value['subject']; ?></td>
			<td><?php echo $value['date_added']; ?></td>
			<td><?php echo $value['status']; ?></td>

			<td>
				<a href="<?php echo site_url('inquiry/inquiry/view').'/'.$value['id']; ?>">
					<label class="btn ink-reaction btn-primary">
					 <i class="fa fa-pencil"></i>
					</label>
				</a>
			</td>
		</tr>
		<?php }}else{ ?>
		<tr>
			<td colspan="6" class="text-center">No inquiry found.</td>
		</tr>
		<?php } ?>
	</tbody>
</table>