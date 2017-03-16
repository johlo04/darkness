<ul class="list">
<?php if(count($top_category)){ ?>
		<?php foreach($top_category as $value){ ?>
			<li class="tile">
			
				<div class="tile-content">
					
					<div class="tile-text font-12"><?php echo $value['service_name']; ?><?php echo ($value['category_name'])? '-'.$value['category_name']: ''; ?></div>
				</div>
				<a class="btn">
					<i class="text-default-light"><?php echo $value['counter']; ?></i>
				</a>
				
			</li>
	<?php } ?>
<?php } ?>
</ul>