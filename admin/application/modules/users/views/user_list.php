<?php echo $header; ?>
<?php echo $sidebar_left; ?>
<?php echo $sidebar_right; ?>
<div id="content">
	<section class="style-default-light">

		<div class="section-header">
			<h2 class="text-primary"><?php echo isset($page_title) ? $page_title : $system_title; ?></h2>
			<ol class="breadcrumb">
				<?php echo $breadcrumbs; ?>
			</ol>
		</div>

		<div class="section-body">
			<hr />
			<div style="display: block;" class="card">
				<div class="card-head"><header></header></div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered table-striped table-hover">
							<thead>
								<tr>
									<th>Account Name</th>
									<th>Email Address</th>
									<th>User Group</th>
									<th class="text-center">
										<a href="<?php echo site_url('users/user/add_user'); ?>" class="btn ink-reaction btn-raised btn-primary btn-sm"><span class="fa fa-plus"></span> Add User</a>
									</th>
								</tr>
							</thead>
							<tbody>
								<?php if($user_list) { ?>
									<?php foreach($user_list as $g) { ?>
										<tr>
											<td>
												<label><?php echo $g['name']; ?></label>
											</td>
											<td>
												<label><?php echo $g['email']; ?></label>
											</td>
											<td>
												<label><?php echo $g['group']; ?></label>
											</td>
											<td class="text-center">
												<a href="<?php echo site_url('users/user/edit_user?user_id=' . $g['id']); ?>" class="btn btn-icon-toggle btn-primary"><span class="fa fa-pencil"></span></a>
												<?php if($g['id'] != 1) { ?>
													<button type="button" onClick="deleteUser(<?php echo $g['id']; ?>)" class="btn btn-icon-toggle btn-danger"><i class="fa fa-trash-o"></i></button>
													<button type="button" onClick="changePassword(<?php echo $g['id']; ?>, '<?php echo $g['name']; ?>')" class="btn btn-icon-toggle btn-info"><span class="fa fa-lock"></span></button>
												<?php } ?>
											</td>
										</tr>
									<?php } ?>
								<?php } else { ?>
									<tr>
										<td colspan="4" class="text-center">
											<p>There are no user group set</p>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<script type="text/javascript">

function changePassword(user_id, username) {

	console.log(user_id);
	console.log(username);

	var form_html 	= 	"<div class='row'>";
		form_html	+=	"	<div class='col-md-12'>";
		form_html	+=	"		<div class='form-group text-center'>";
		form_html	+=	"			<p class='text-warning'>Note: This will change original password into 6 random numbers</p>";
		form_html	+=	"			<p class='text-warning'>This process CANNOT be undone.</p>";
		form_html	+=	"			<div class='well' id='generated-password'><p>Click GENERATE to create temporary password</p></div>";
		form_html	+=	"		</div>";
		form_html	+=	"	</div>";
		form_html	+=	"	<div class='col-md-12 text-left' id='form-status'></div>";
		form_html 	+= 	"</div>";

	bootbox.dialog({
		title: "Reset Password for <span class='text-info'>" + username.toUpperCase() + "</span>",
		message: form_html,
		buttons: {
			success: {
				label: "<span class='fa fa-refresh'></span> GENERATE",
				className: "btn-success",
				callback: function() {
					$.ajax({
						url: '<?php echo site_url("users/user/reset_password"); ?>',
						data: {user_id: user_id},
						dataType: 'json',
						type: 'post',
						beforeSend: function() {},
						success: function(d) {
							$('#generated-password').html('');
							$('#generated-password').html('<p>Temporary password is <b class="text-info">' + d.generated + '</b></p>');
							if(d.status) {
								$('#form-status').html('<p class="text-success">' + d.message + '</p>');
								$('.modal-footer .btn-success').remove();
								$('.modal-footer .btn-default').text('Close');
							} else {
								$('#form-status').html('<p class="text-danger">' + d.message + '</p>');
							}
						},
						error: function() {
							alert('Error Occured!');
						}
					});
					return false;
				}
			},
			danger: {
					label: "Cancel",
					className: "btn-default",
					callback: function() {
						$(this).modal('hide');
					}
			}
		}
	});
}

function deleteUser(user_id) {
	bootbox.dialog({
		message: "Are you sure you want to remove this user?",
		title: "Notification",
		size: 'small',
		buttons: {
			success: {
				label: "Yes, remove it",
				className: "btn-danger btn-sm",
				callback: function() {
					$.ajax({
						url: "<?php echo site_url('users/user/deleteUser'); ?>",
						data: {user_id: user_id},
						dataType: 'json',
						type: 'post',
						beforeSend: function() {
							console.log('Loading...');
						}, 
						success: function(d) {
							if(d.status) {
								location.reload();
							} else {
								alert('Error Occured!');
							}
						}, 
						error: function() {
							alert('Error Found!');
						}
					});
				}
			},
			danger: {
				label: "Cancel",
				className: "btn-default btn-sm",
				callback: function() {
					$(this).modal('hide');
				}
			}
	  	}
	});
}

</script>
<?php echo $footer; ?>