<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?php echo $system_title; ?></title>

		<!-- BEGIN META -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="keywords" content="your,keywords">
		<meta name="description" content="Short explanation about this website">
		<meta name="title" content="<?php echo $system_title; ?>">
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
	<body class="menubar-hoverable header-fixed menubar-pin">

		<!-- BEGIN HEADER-->
		<header id="header" >
			<div class="headerbar">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="headerbar-left">
					<ul class="header-nav header-nav-options">
						<li class="header-nav-brand" >
							<div class="brand-holder">
								<a href="<?php echo site_url('users/user'); ?>">
									<img src="<?php echo base_url('pccw.gif'); ?>" class="img-responsive" style="display: inline; height: 30px;" />
									<span style="display: inline-block; vertical-align: middle;">
										<span class="text-lg text-bold text-primary text"><?php echo $header_title; ?></span>
									</span>
								</a>
							</div>
						</li>
						<li>
							<a class="btn btn-icon-toggle menubar-toggle" data-toggle="menubar" href="javascript:void(0);">
								<i class="fa fa-bars"></i>
							</a>
						</li>
					</ul>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="headerbar-right">
					<ul class="header-nav header-nav-options">
					
						<li class="dropdown hidden-xs">
							<a href="javascript:void(0);" class="btn btn-icon-toggle btn-default" data-toggle="dropdown">
								<i class="fa fa-bell"></i><sup class="badge style-danger" id="notify_counter"><?php echo $notify_counter; ?></sup>
							</a>
							<ul class="dropdown-menu animation-expand">
								<li class="dropdown-header">Latest's messages</li>
								
								<!-- ASSIGNED OFFICER -->
								<?php if(count($notification) > 0) { ?>
									<?php foreach($notification as $s) { ?>
										<li>
											<?php 
											$extension = ($s['variablename'])? '?'.$s['variablename'].'=': '/';
											$url = site_url().'/'.$s['path_group'].$extension.$s['id_pointer']; ?>
											<a class="alert alert-callout <?php echo $s['status']; ?>" href="<?php echo $url; ?>">
												<?php echo $s['detail']; ?>
											</a>
										</li>
									<?php } ?>
								<?php } else { ?>
									<li>
										<a class="alert alert-callout alert-info" href="javascript:void(0);">
											<p>There are no notification for you.</p>
										</a>
									</li>
								<?php } ?>
							</ul><!--end .dropdown-menu -->
						</li><!--end .dropdown -->
	
					</ul><!--end .header-nav-options -->

					<ul class="header-nav header-nav-profile">
						<li class="dropdown">
							<a href="javascript:void(0);" class="dropdown-toggle ink-reaction" data-toggle="dropdown">
								<!-- <img src="" alt="" /> -->
								<span class="profile-info">
									<?php echo isset($admin_name) ? $admin_name : 'Administrator'; ?>
									<small><?php echo isset($user_group) ? $user_group : 'Admin Staff'; ?></small>
								</span>
							</a>
							<ul class="dropdown-menu animation-dock">
								<li class="dropdown-header">Menus</li>
								<li><a href="<?php echo $profile; ?>">My profile</a></li>
								<li class="divider"></li>
								<li><a href="<?php echo $homepage; ?>" target="_blank"><i class="fa fa-fw fa-home"></i> Website</a></li>
								<li class="divider"></li>
								<li><a href="<?php echo site_url('users/auth/logout'); ?>"><i class="fa fa-fw fa-power-off text-danger"></i> Logout</a></li>
							</ul><!--end .dropdown-menu -->
						</li><!--end .dropdown -->
					</ul><!--end .header-nav-profile -->

					<ul class="header-nav header-nav-toggle">
						<li>
							<a class="btn btn-icon-toggle btn-default" href="#offcanvas-search" data-toggle="offcanvas" data-backdrop="false">
								<i class="fa fa-ellipsis-v"></i>
							</a>
						</li>
			
					</ul><!--end .header-nav-toggle -->

				</div><!--end #header-navbar-collapse -->
				
				
			</div>
			
		</header>
		<!-- END HEADER-->

		<!-- BEGIN BASE-->
		<div id="base">

			<!-- BEGIN OFFCANVAS LEFT -->
			<div class="offcanvas">
			</div><!--end .offcanvas-->
			<!-- END OFFCANVAS LEFT -->
