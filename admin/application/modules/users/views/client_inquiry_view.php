<table class="table table-condensed">
	<thead>
		<tr>
			<td>Product</td>
			<td>User</td>
			<td>Subject</td>
			<td>View</td>
			
		</tr>
	</thead>
	<tbody>
		<?php if(count($inquiry)>0) { foreach($inquiry as $value){ ?>
		
		<tr>
			<td><?php echo $value['product_name']; ?></td>
			<td><?php echo $value['username']; ?></td>
			<td><?php echo ($value['is_urgent'])? '<span class="md-warning text-danger"></span>': ''; ?><?php echo $value['subject']; ?></td>
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
			<td colspan="6" class="text-center">No new inquiry.</td>
		</tr>
		<?php } ?>
	</tbody>
</table>	
					