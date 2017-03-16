<?php echo $header; ?>
<?php echo $sidebar_left; ?>

<div id="content">
	<section class="style-default-light">
		
		<div class="section-header">
			<h2 class="text-primary"><?php echo isset($page_title) ? $page_title : $system_title; ?></h2>
			<?php echo $breadcrumbs; ?>
			<div class="clearfix"></div>
		</div>
		
		<div class="section-body">
							
					<hr />
					<div class="col-md-12">
							<div class="card">
								<div class="card-head">
									<ul data-toggle="tabs" class="nav nav-tabs ">
										<li class="active"><a href="#general">Product</a></li>				
										<li class=""><a href="#track">Auction Tracking History</a></li>
									</ul>
								</div>				
								
								<div class="card-body tab-content">
									
										<div id="general" class="tab-pane active">

											<div class="col-md-6">
												<div class="form-group">
													<label for="name">Username </label>
													<div class="form-control" type="text"><?php echo $rowdata['username']; ?></div>
												</div>
												<div class="clearfix"></div>
												<div class="form-group">
													<label for="name">First Name </label>
													<div class="form-control" type="text"><?php echo $rowdata['firstname']; ?></div>
												</div>
												<div class="clearfix"></div>
												<div class="form-group">
													<label for="name">Last Name </label>
													<div class="form-control" type="text"><?php echo $rowdata['lastname']; ?></div>
												</div>
												<div class="clearfix"></div>
												<div class="form-group">
													<label for="name">Email </label>
													<div class="form-control" type="text"><?php echo $rowdata['email']; ?></div>
												</div>
											</div>
											
											<div class="col-md-6">
												<div class="form-group">
													<label for="name">Status</label>
													<div class="form-control" type="text"><?php echo $rowdata['status']; ?></div>
												</div>
												<div class="clearfix"></div>
												<div class="form-group">
													<label for="name">Date Joined</label>
													<div class="form-control" type="text"><?php echo ($rowdata['created_on']=='0000-00-00 00:00:00')? 'Date undefined': date('D, M j, Y h:i A',strtotime($rowdata['created_on'])); ?></div>
												</div>
												<div class="clearfix"></div>
												<div class="form-group">
													<label for="name">Last Login</label>
													<div class="form-control" type="text">
													<?php echo ($rowdata['last_login']=='0000-00-00 00:00:00')? 'Date undefined': date('D, M j, Y h:i A',strtotime($rowdata['last_login'])); ?>
													</div>
												</div>
												<div class="clearfix"></div>	
											</div>

										</div>
										
										<div id="track" class="tab-pane">
											<div class="col-md-6">
													
														<div class="card panel">
															<div class="card-head card-head-sm">
																<header>Won Auction List: </header>
															</div>
															<div class="card-body" id="won_auction" data-url="<?php echo site_url('users/member').'/load_auction_won/'.$rowdata['id']; ?>">
																<span  class="fa fa-spinner fa-spin"></span>Loading Please Wait..
															</div>
													
														</div>
												</div>
												
												<div class="col-md-6">
													
														<div class="card panel">
															<div class="card-head card-head-sm ">
																<header>Inquiry List:</header>
															
															</div>
															
															<div class="card-body" id="member_inquiry" data-url="<?php echo site_url('users/member').'/load_member_inquiry/'.$rowdata['id']; ?>">
																<span  class="fa fa-spinner fa-spin"></span>Loading Please Wait..
															</div>
														</div>
													
												</div>
										</div>
									
							
										<div class="clearfix"></div>
										
									
								</div><!--end .card-body -->
								
							</div>
					</div>
				
		</div>
	</section>
	

</div>	

<script type="text/javascript" src="<?php echo  base_url('/assets/resources/tinymce/tinymce/tinymce.min.js'); ?>"></script>	
<script>

	realTime('won_auction');
	realTime('member_inquiry');

</script>

<?php echo $footer; ?>