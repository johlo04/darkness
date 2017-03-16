<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?php echo isset($page_title) ? $page_title : 'Admin'; ?></title>

		<!-- BEGIN META -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="keywords" content="your,keywords">
		<meta name="description" content="Short explanation about this website">
		<!-- END META -->

		<!-- BEGIN STYLESHEETS -->
		<?php foreach($styles as $link_style) { ?>
			<link rel="stylesheet" type="text/css" href="<?php echo $link_style; ?>" />
		<?php } ?>
		<!-- END STYLESHEETS -->
		<link rel='shortcut icon' type='image/x-icon' href='<?php echo base_url('favicon.ico'); ?>' />

		<?php if(isset($scripts)) { ?>
			<?php foreach($scripts as $s) { ?>
				<script type="text/javascript" src="<?php echo $s; ?>"></script>
			<?php } ?>
		<?php } ?>

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script type="text/javascript" src="<?php echo base_url('/assets/js/libs/utils/html5shiv.js?1403934957'); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('/assets/js/libs/utils/respond.min.js?1403934956'); ?>"></script>
		<![endif]-->
	</head>
	<body class="menubar-hoverable header-fixed ">

		<section class="section-account">
			<div class="img-backdrop" style="background: rgba(0, 0, 0, 0) url('<?php echo base_url('/assets/img/pattern.png'); ?>') repeat scroll 0 0"></div>
			<div class="spacer"></div>
			<div class="card contain-sm style-transparent">
				<div class="card-body">
					<div class="row">
						<div class="col-md-offset-3 col-md-6">
							<br/>
							<div class="well">
							<?php echo $system_title; ?></span>
							<br/><br/>
		
							<?php echo form_open('users/auth/login', array('class' => 'form', 'role' => 'form')); ?>	
								<div class="form-group">
									<input type="text" class="form-control" id="username" name="username" placeholder="Username" />
									<label for="username">Username</label>
								</div>
								<div class="form-group">
									<input type="password" class="form-control" id="password" name="password" placeholder="Password" />
									<label for="password">Password</label>
									<!-- <p class="help-block"><a href="#">Forgotten?</a></p> -->
								</div>
								<div class="form-group">
									<?php echo "<span class='text-danger'>" . $this->session->flashdata('note') . "</span>"; ?>
								</div>
								<br/>
								<div class="row">
									<!-- <div class="col-xs-6 text-left">
										<div class="checkbox checkbox-inline checkbox-styled">
											<label>
												<input type="checkbox"> <span>Remember me</span>
											</label>
										</div>
									</div> -->
									<div class="col-xs-6 col-xs-offset-6 text-right">
										<button class="btn btn-primary btn-raised btn-ink btn-sm" type="submit">Login Account</button>
									</div>
								</div>
							<?php echo form_close(); ?>
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- BEGIN JAVASCRIPT -->
		<script src="<?php echo base_url('/assets/js/libs/jquery/jquery-1.11.2.min.js'); ?>"></script>
		<script src="<?php echo base_url('/assets/js/libs/jquery/jquery-migrate-1.2.1.min.js'); ?>"></script>
		<script src="<?php echo base_url('/assets/js/libs/bootstrap/bootstrap.min.js'); ?>"></script>
		<!-- END JAVASCRIPT -->

	</body>
</html>
