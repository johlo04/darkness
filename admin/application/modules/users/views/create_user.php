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

				<div class="card-body">
					<p>Please input correctlly all the details below</p>
					<p>Fields marked with <span class="text-danger">*</span> are required</p>
					<hr />
					<div class="col-md-12">
						<?php echo form_open('users/user/add_user', array('class' => 'form')); ?>
						<div class="col-md-6">
							<div class="form-group <?php echo (form_error('user_name')) ? 'has-error' : ''; ?>">
								<input class="form-control" id="user-name" name="user_name" type="text" placeholder="Username" value="<?php echo set_value('user_name'); ?>" />
								<?php echo form_error('user_name', '<span class="help-block">', '</span>'); ?>
								<label for="name">Username <span class="text-danger">*</span></label>
							</div>

							<div class="form-group <?php echo (form_error('user_lastname')) ? 'has-error' : ''; ?>">
								<input class="form-control" id="user-lastname" name="user_lastname" type="text" placeholder="Last Name" value="<?php echo set_value('user_lastname'); ?>" />
								<?php echo form_error('user_lastname', '<span class="help-block">', '</span>'); ?>
								<label for="user-lastname">Lastname <span class="text-danger">*</span></label>
							</div>

							<div class="form-group <?php echo (form_error('user_firstname')) ? 'has-error' : ''; ?>">
								<input class="form-control" id="user-firstname" name="user_firstname" type="text" placeholder="First Name" value="<?php echo set_value('user_firstname'); ?>" />
								<?php echo form_error('user_firstname', '<span class="help-block">', '</span>'); ?>
								<label for="user-firstname">Firstname <span class="text-danger">*</span></label>
							</div>

							<div class="form-group <?php echo (form_error('user_email')) ? 'has-error' : ''; ?>">
								<input class="form-control" id="user-email" name="user_email" type="text" placeholder="email@mail.com" value="<?php echo set_value('user_email'); ?>" />
								<?php echo form_error('user_email', '<span class="help-block">', '</span>'); ?>
								<label>Email Address <span class="text-danger">*</span></label>
							</div>

							<div class="form-group control-width-normal">
								<div class="input-group date" id="user-birthday">
									<div class="input-group-content">
										<input class="form-control" type="text" name="user_birthday" placeholder="yyyy-mm-dd" value="<?php echo set_value('user_birthday'); ?>" />
										<label>Birthday</label>
									</div>
									<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
								</div>
							</div>
							<div class="form-group <?php echo (form_error('user_phone1')) ? 'has-error' : ''; ?>">
								<input class="form-control" id="user-contact1" type="text" name="user_phone1" placeholder="Phone 1" value="<?php echo set_value('user_phone1'); ?>" />
								<?php echo form_error('user_phone1', '<span class="help-block">', '</span>'); ?>
								<label for="contact1">Primary Contact # </label>
							</div>
							<div class="form-group <?php echo (form_error('user_phone2')) ? 'has-error' : ''; ?>">
								<input class="form-control" id="user-contact2" type="text" name="user_phone2" placeholder="Phone 2" value="<?php echo set_value('user_phone2'); ?>" />
								<?php echo form_error('user_phone2', '<span class="help-block">', '</span>'); ?>
								<label for="contact2">Secondary Contact #</label>
							</div>
					</div>
					
					<div class="col-md-6">
							<div class="form-group <?php echo (form_error('user_address1')) ? 'has-error' : ''; ?>">
								<textarea name="user_address1" class="form-control" id="user-address1" placeholder="Address 1"><?php echo set_value('user_address1'); ?></textarea>
								<?php echo form_error('user_address1', '<span class="help-block">', '</span>'); ?>
								<label for="contact1">Primary Address </label>
							</div>
							<div class="form-group <?php echo (form_error('user_address2')) ? 'has-error' : ''; ?>">
								<textarea name="user_address2" class="form-control" id="user-address2" placeholder="Address 2"><?php echo set_value('user_address2'); ?></textarea>
								<?php echo form_error('user_address2', '<span class="help-block">', '</span>'); ?>
								<label for="contact1">Secondary Address</label>
							</div>
							<div class="form-group <?php echo (form_error('user_password1')) ? 'has-error' : ''; ?>">
								<input class="form-control" name="user_password1" id="user-password1" placeholder="*******" type="password" />
								<?php echo form_error('user_password1', '<span class="help-block">', '</span>'); ?>
								<label for="placeholder1">Password <span class="text-danger">*</span></label>
							</div>
							<div class="form-group <?php echo (form_error('user_password2')) ? 'has-error' : ''; ?>">
								<input class="form-control" name="user_password2" id="user-password2" placeholder="*******" type="password" />
								<?php echo form_error('user_password2', '<span class="help-block">', '</span>'); ?>
								<label for="placeholder1">Confirm Password <span class="text-danger">*</span></label>
							</div>
							<div class="form-group <?php echo (form_error('user_group')) ? 'has-error' : ''; ?>">
								<select id="user-group" name="user_group" class="form-control">
									<?php if(isset($user_groups)) { ?>
										<option value=""> -- Select group --</option>
										<?php foreach($user_groups as $g) { ?>
											<option value="<?php echo $g['id']; ?>" <?php echo set_select('user_group', $g['id']); ?>><?php echo $g['group_name']; ?> -- <?php echo $g['definition']; ?></option>
										<?php } ?>
									<?php } else { ?>
										<option value=""> -- There are no group -- </option>
									<?php } ?>
								</select>
								<?php echo form_error('user_group', '<span class="help-block">', '</span>'); ?>
								<label for="select1">Access Group <span class="text-danger">*</span></label>
							</div>
							<div class="form-group">
								<div class="text-right">
									<button type="submit" class="btn btn-primary btn-sm">Add User</button>
									<a href="<?php echo site_url('users/user/user_list'); ?>" class="btn btn-danger btn-sm">Back to list</a>
								</div>
							</div>
						<?php echo form_close(); ?>
					</div>
				</div>
				</div>

			</div>
		</div>
	</section>

</div>
<script type="text/javascript">

$(document).ready(function() {
	
	moment.tz.add('Asia/Tokyo|JCST|-90|0|');
	$('#user-birthday').datetimepicker({
		format: 'YYYY-MM-DD'
	});

});
</script>
<?php echo $footer; ?>