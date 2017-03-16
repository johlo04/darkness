<?php echo $header; ?>
<?php echo $sidebar_left; ?>
<div id="content">
	<section>
		<div class="section-header">
			<ol class="breadcrumb">
				<?php if(isset($breadcrumb)) { ?>
					<?php 
						end($breadcrumb);
						$last_key = key($breadcrumb); 
					?>
					<?php foreach($breadcrumb as $name => $link) { ?>
						<li class="<?php echo ($name == $last_key) ? 'active' : ''; ?>"><a href="<?php echo $link; ?>"><?php echo $name; ?></a></li>
					<?php } ?>
				<?php } ?>
			</ol>
		</div>
		<div class="section-body contain-lg">
			<div class="row">
				<div class="col-lg-12 text-center">
					<h1><span class="fa fa-lock"></span> Authorized User Only!</h1>
					<h2 class="text-light">You are not allowed to view the <b class="text-warning"><?php echo ucwords(str_replace('_',' ',$page)); ?></b> page</h2>
					<p>Please ask Administrator for assistance</p>
				</div>
			</div>
		</div>
	</section>

</div>
<?php echo $footer; ?>