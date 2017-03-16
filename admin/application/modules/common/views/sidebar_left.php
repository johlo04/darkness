<!-- BEGIN MENUBAR-->
<div id="menubar" class="menubar-inverse animate">
	<div class="menubar-fixed-panel">
		<div>
			<a class="btn btn-icon-toggle btn-default menubar-toggle" data-toggle="menubar" href="javascript:void(0);">
				<i class="fa fa-bars"></i>
			</a>
		</div>
		<div class="expanded">
			<a href="#">
			
				<?php echo $header_title; ?>
			</a>
		</div>
	</div>
	<div class="menubar-scroll-panel">

		<ul id="main-menu" class="gui-controls">

			<li>
				<a href="<?php echo site_url('users/user'); ?>" class="<?php echo ($module == 'user') ? 'active' : ''; ?>">
					<div class="gui-icon"><i class="md md-home"></i></div>
					<span class="title">Dashboard</span>
				</a>
			</li>
			
			<li class="gui-folder">

				<a>
					<div class="gui-icon"><i class="md md-video-collection"></i></div>
					<span class="title">Videos Management</span>
				</a>
				
				<ul>
					<li>
						<a href="<?php echo site_url('videos/videos'); ?>" class="<?php echo ($module == 'videos') ? 'active' : ''; ?>">
						<span class="title">Videos</span>
						</a>
					</li>
					
					<li>
						<a href="<?php echo site_url('inquiry/inquiry'); ?>" class="<?php echo ($module == 'inquiry') ? 'active' : ''; ?>">
						<span class="title">Client Inquiry</span>
						</a>
					</li>
				</ul>
				
			</li>
			<li class="gui-folder">
								
				<a>
					<div class="gui-icon"><i class="md md-recent-actors"></i></div>
					<span class="title">Category Option</span>
				</a>
				
				<ul>
				<?php /*
					<li>
						<a href="<?php echo site_url('option/category'); ?>" class="<?php echo ($module == 'category') ? 'active' : ''; ?>">
						<span class="title">Category</span>
						</a>
					</li>
				*/ ?>
					<li>
						<a href="<?php echo site_url('option/actress'); ?>" class="<?php echo ($module == 'actress') ? 'active' : ''; ?>">
						<span class="title">Actress</span>
						</a>
					</li>
					
					<li>
						<a href="<?php echo site_url('option/actresstype'); ?>" class="<?php echo ($module == 'actresstype') ? 'active' : ''; ?>">
						<span class="title">Actress Type</span>
						</a>
					</li>
					
					<li>
						<a href="<?php echo site_url('option/theme'); ?>" class="<?php echo ($module == 'theme') ? 'active' : ''; ?>">
						<span class="title">Theme</span>
						</a>
					</li>
					
					<li>
						<a href="<?php echo site_url('option/vidcontent'); ?>" class="<?php echo ($module == 'vidcontent') ? 'active' : ''; ?>">
						<span class="title">Video Content</span>
						</a>
					</li>
					
					
					
				</ul>
				
			</li>

			<?php if($this->group_permission->is_allow_view('users')) {  ?> 
			<li class="gui-folder">
				<a>
					<div class="gui-icon"><i class="fa fa-users fa-fw"></i></div>
					<span class="title">Account Management</span>
				</a>
				<ul>
					<li><a href="<?php echo site_url('users/member'); ?>" class="<?php echo ($module == 'member') ? 'active' : ''; ?>" ><span class="title">Member List</span></a></li>
					<li><a href="<?php echo site_url('users/user/user_list'); ?>" class="<?php echo ($module == 'user_list') ? 'active' : ''; ?>" ><span class="title">Admin List</span></a></li>
					<?php if($this->group_permission->is_allow_view('user_group')) { ?> 
						<li><a href="<?php echo site_url('user_group/user_group'); ?>" class="<?php echo ($module == 'user_group') ? 'active' : ''; ?>" ><span class="title">Admin Group List</span></a></li>
					<?php } ?>
				</ul>
			</li>
			<?php } ?>
			
			<?php if($this->group_permission->is_allow_view('extension')) {  ?> 
			<li class="gui-folder">
				<a>
					<div class="gui-icon"><i class="fa fa-puzzle-piece fa-fw"></i></div>
					<span class="title">Extension Module</span>
				</a>
				<ul>
					<li><a href="<?php echo site_url('extension/banner'); ?>" class="<?php echo ($module == 'banner') ? 'active' : ''; ?>" ><span class="title">Home Banner Slider</span></a></li>
					<li><a href="<?php echo site_url('extension/homepage'); ?>" class="<?php echo ($module == 'homepage') ? 'active' : ''; ?>" ><span class="title">Homepage Setting</span></a></li>
				</ul>
			</li>
			<?php } ?>

			<?php if($this->group_permission->is_allow_view('system')) { ?> 
			<li class="gui-folder">
				<a>
					<div class="gui-icon"><i class="fa fa-wrench"></i></div>
					<span class="title">System</span>
				</a>
				<ul>
					<li><a href="<?php echo site_url('system/system'); ?>" class="<?php echo ($module == 'system') ? 'active' : ''; ?>"><span class="title">System Setting</span></a></li>
					<li><a href="<?php echo site_url('system/filemanager'); ?>" class="<?php echo ($module == 'filemanager') ? 'active' : ''; ?>"><span class="title">Filemanager</span></a></li>
					<li><a href="<?php echo site_url('system/database'); ?>" class="<?php echo ($module == 'database') ? 'active' : ''; ?>"><span class="title">Database Management</span></a></li>
					
				</ul>
			</li>
			<?php } ?>

		</ul>

		<div class="menubar-foot-panel">
			<small class="no-linebreak hidden-folded"><span class="md md-timer"></span><span id="currentTime"> </span><br/><sup>(Tokyo/Asia)</sup></small> 
			
			<small class="no-linebreak hidden-folded">
				<span class="opacity-75">Copyright &copy; <?php echo date('Y'); ?></span> <?php echo $header_title; ?>
			</small>
		</div>
	</div>
</div>
<script>
	//https://github.com/moment/moment-timezone/blob/develop/data/packed/latest.json
	moment.tz.add("Asia/Manila|PHT PHST JST|-80 -90 -90|010201010|-1kJI0 AL0 cK10 65X0 mXB0 vX0 VK10 1db0|24e6");
	$maintime =	setInterval(function () { //start interval
		$('#currentTime').text(moment().tz('Asia/Manila').format('lll'));
	}, 1000);

</script>
<!-- END MENUBAR -->