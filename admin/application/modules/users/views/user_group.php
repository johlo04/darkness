<?php echo $header; ?>
<?php echo $sidebar_left; ?>
<div id="content">

	<section class="style-default-light">

		<div class="section-header">
			<h2 class="text-primary"><?php echo isset($page_title) ? $page_title : $system_title; ?></h2>
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

		<div class="section-body">
			<hr />
			<div style="display: block;" class="card">
				<div class="card-head"><header></header></div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered table-striped table-hover" id="user-group-list">
							<thead>
								<tr>
									<th>Group Name</th>
									<th>Description</th>
									<th class="text-center">Modules</th>
									<th class="text-center">
										<a href="<?php echo $add_group; ?>" class="btn ink-reaction btn-raised btn-primary btn-sm"><span class="fa fa-plus"></span></a>
									</th>
								</tr>
							</thead>
							<tbody>
								<?php if($user_groups) { ?>
									<?php foreach($user_groups as $g) { ?>
										<tr>
											<td>
												<label><?php echo $g['name']; ?></label>
											</td>
											<td>
												<label><?php echo $g['definition']; ?></label>
											</td>
											<td class="text-center"><a href="<?php echo site_url('users/user/get_list_permission?group_id=' . $g['id']); ?>" class="btn btn-primary btn-sm">View Modules</a></td>
											<td class="text-center">
												<a class="btn btn-icon-toggle btn-primary edit_group" onClick="editUserGroup(<?php echo $g['id']; ?>)"><i class="fa fa-pencil"></i></a>
												<?php if($g['id'] > 2) { ?>
													<a class="btn btn-icon-toggle btn-danger remove_group" onClick="removeUserGroup(<?php echo $g['id']; ?>)"><i class="fa fa-trash-o"></i></a>
												<?php } ?>
											</td>
										</tr>
									<?php } ?>
								<?php } else { ?>
									<tr>
										<td colspan="3" class="text-center">
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

function editUserGroup(group_id) {

	$.ajax({
		url: "<?php echo site_url('users/user/get_user_group_info'); ?>",
		dataType: 'json',
		data: {group_id: group_id},
		type: 'post',
		beforeSend: function () {
			console.log('loading...');
		},
		success: function(d) {

			var form_html 	= 	"<div class='row'>";
				form_html	+=	"	<div class='col-md-12'>";
				form_html	+=	"		<p class='text-info'>Note: All fields are required</p>";
				form_html	+=	"		<div class='form-group'>";
				form_html	+=	"			<label>Group Name: </label>";
				form_html	+=	"			<input type='text' class='form-control' id='form-group-name' placeholder='Group Name' value='" + d.name + "' />";
				form_html	+=	"		</div>";
				form_html	+=	"	</div>";
				form_html	+=	"	<div class='col-md-12'>";
				form_html	+=	"		<div class='form-group'>";
				form_html	+=	"			<label>Group Definition: </label>";
				form_html	+=	"			<textarea class='form-control' id='form-group-definition' placeholder='Group definition'>" + d.definition + "</textarea>";
				form_html	+=	"			<input type='hidden' id='form-group-id' value='" + d.id + "' />";
				form_html	+=	"		</div>";
				form_html	+=	"	</div>";
				form_html	+=	"	<div class='col-md-12 text-left'><p id='form-error'></p></div>";
				form_html 	+= 	"</div>";

			bootbox.dialog({
				title: "Update User Group",
				message: form_html,
				buttons: {
					success: {
						label: "<span class='fa fa-pencil'></span> Update Info",
						className: "btn-info",
						callback: function() {
							
							var id = $('#form-group-id').val();
							var name = $('#form-group-name').val();
							var definition = $('#form-group-definition').val();

							if(definition == '' || name == '') {
								$('#form-errpr').addClass('text-danger');
								$('#form-error').text('All fields are required!');
							} else {
								
								$.ajax({
									url: "<?php echo site_url('users/user/edit_user_group'); ?>",
									data: {group_id: id, group_name: name, group_definition: definition},
									dataType: 'json',
									type: 'post',
									beforeSend: function() {
										console.log('Loading...');
									},
									success: function(d) {
										if(d.status) {
											$('#form-error').removeClass('text-danger');
											$('#form-error').addClass('text-success');
											$('#form-error').text('Successfully updated!');
										} else {
											$('#form-errpr').addClass('text-danger');
											$('#form-error').text('Oops! there is an error in the query!');
										}
									},
									error: function() {
										alert('Error Occured!');
									}
								});

							}

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
				},
				onEscape: function() {
					
    			}
			});

		},
		error: function() {
			alert('Error Occured!');
		}
	});

}

function removeUserGroup(group_id) {
	bootbox.dialog({
		message: "Are you sure you want to remove the group?",
		title: "Notification",
		size: 'small',
		buttons: {
			success: {
				label: "Yes, remove it",
				className: "btn-danger btn-sm",
				callback: function() {
					$.ajax({
						url: "<?php echo site_url('users/user/remove_user_group'); ?>",
						data: {group_id: group_id},
						dataType: 'json',
						type: 'post',
						beforeSend: function() {
							console.log('Loading...');
						}, 
						success: function(d) {
							loadUserGroup();
							makeToast(d.status, d.toast_info);
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

function loadUserGroup() {
	$.ajax({
		url: "<?php echo site_url('users/user/load_group_list'); ?>",
		dataType: 'json',
		beforeSend: function() {

			var loader =  "<tr>";
				loader += "	<td colspan='4' class='text-center'><span class='fa fa-spinner fa-pulse fa-3x'></span></td>";
				loader += "</tr>";

			$('#user-group-list tbody').empty();
			$('#user-group-list tbody').html(loader);
		},
		success: function(data) {
			$('#user-group-list tbody').empty();
			var group_list = '';
			$.each(data.user_groups, function(k, v){

				var group_id = v.id;
				var group_name = v.name;
				var link = "<?php echo site_url('users/user/get_list_permission?group_id=" +  v.id + "'); ?>";


				group_list += "<tr>";
				group_list += "	<td><label>" + v.name + "</label></td>";
				group_list += "	<td><label>" + v.definition + "</label></td>";
				group_list += "	<td class='text-center'><a href='" + link + "' class='btn btn-primary btn-sm'>View Modules</a></td>";
				group_list += "	<td class='text-center'>";
				group_list += "		<a class='btn btn-icon-toggle btn-primary edit_group' onClick='editUserGroup(" + v.id + ")'><span class='fa fa-pencil'></span></a>";
				if(v.id > 2) {
					group_list += "		<a class='btn btn-icon-toggle btn-danger remove_group' onClick='removeUserGroup(" + group_id + ")'><span class='fa fa-trash-o'></span></a>";
				}
				group_list += "	</td>";
				group_list += "</tr>";

			});

			$('#user-group-list tbody').html(group_list);

		},
		error: function() {
			alert('Error Occured!');
		}
	});
}
</script>
<?php echo $footer; ?>