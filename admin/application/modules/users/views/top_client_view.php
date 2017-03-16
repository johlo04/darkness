<ul class="list">
	<?php if(count($top_client)){ ?>
		<?php foreach($top_client as $value){ ?>
			<li class="tile">
			
				<div class="tile-content">
					<div class="tile-text font-12"><?php echo $value['client_name']; ?></div>
				</div>
				<a class="btn">
					<i class="text-default-light"><?php echo $value['counter']; ?></i>
				</a>
			</li>
		<?php } ?>
	<?php } ?>
	
</ul>