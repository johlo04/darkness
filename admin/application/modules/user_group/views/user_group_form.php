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
					<?php echo form_open($form_user_group_link, array('class' => 'form')); ?>
					
					<div class="col-md-6">
						
							<div class="form-group <?php echo (form_error('name'))? 'has-error': ''; ?>">
								<input class="form-control" id="group-name" value="<?php echo $rowdata['name']; ?>" name="name" type="text" placeholder="Group name" />
								<input type="hidden" value="<?php echo $rowdata['id']; ?>" name="id">
								<label for="group-name">Group Name <span class="text-danger">*</span></label>
							</div>
							<?php echo form_error('name','<span class="help-block">','</span>'); ?>
							
					</div>
					
					<div class="col-md-6">
						<div class="form-group">
								<textarea class="form-control" name="definition"><?php echo $rowdata['definition']; ?></textarea>
								
								
								<label for="group-name">Group Definition </label>
							</div>
					
					</div>
					
					<div class="col-md-12">
					
						<div class="form-group">
								<label for="group-name">Group Permission</label>
								<br/>
							
								<div class="card col-md-3">
									
									<div class="margin-top"><span class="fa fa-search"></span> View<span class="help">View and access the page content.</span></div>
									<div class="card-body">
									
									<?php $count=1; foreach($path as $value){ ?>
										<input type="checkbox" name="view_privilege[]" id="view<?php echo $count; ?>" value="<?php echo $value; ?>" <?php echo (in_array($value,$rowdata['view_privilege']))? ' checked="checked" ': ''; ?> > <label for="view<?php echo $count; ?>"><?php echo $value; ?></label><br/>
									<?php $count++; } ?>
									
									</div>
								</div>
								
								<div class="card col-md-3">
									
									<div class="margin-top"><span class="fa fa-pencil"></span> Add/Edit<span class="help">Make modification on the page content.</span></div>
									<div class="card-body">
									
									<?php $count=1; foreach($path as $value){  ?>
										<input type="checkbox" name="modify_privilege[]" id="modify<?php echo $count; ?>" value="<?php echo $value; ?>" <?php echo (in_array($value,$rowdata['modify_privilege']))? ' checked="checked" ': ''; ?>> <label for="modify<?php echo $count; ?>"><?php echo $value; ?></label><br/>
									<?php $count++; } ?>
									
									</div>
								</div>
								
								<div class="card col-md-3">
									
									<div class="margin-top"><span class="fa fa-trash"></span> Delete<span class="help">Allow to delete page content.</span></div>
									<div class="card-body">
									
									<?php $count=1; foreach($path as $value){ ?>
										<input type="checkbox" name="delete_privilege[]" id="delete<?php echo $count; ?>" value="<?php echo $value; ?>" <?php echo (in_array($value,$rowdata['delete_privilege']))? ' checked="checked" ': ''; ?>> <label for="delete<?php echo $count; ?>"><?php echo $value; ?></label><br/>
									<?php $count++; } ?>
									
									</div>
								</div>
								
								<div class="card col-md-3">
									
									<div class="margin-top"><span class="fa fa-star-o"></span> Special<span class="help">Allow to upload or make special/featured action.</span></div>
									<div class="card-body">
									
									<?php $count=1; foreach($path as $value){  ?>
										<input type="checkbox" name="special_privilege[]" id="special<?php echo $count; ?>" value="<?php echo $value; ?>"  <?php echo (in_array($value,$rowdata['special_privilege']))? ' checked="checked" ': ''; ?>> <label for="special<?php echo $count; ?>"><?php echo $value; ?></label><br/>
									<?php $count++; } ?>
									
									</div>
								</div>
							
								
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<div class="text-right">
							
								<input type="submit" name="submit_user" value="submit" value="Register Account" class="btn btn-primary btn-block" />
								
							</div>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<div class="text-right">
							
								<a href="<?php echo site_url('user_group/user_group'); ?>"><span class="btn btn-default btn-block">Back</span></a>
							</div>
						</div>
					</div>
			
					<?php echo form_close(); ?>
				</div>
				</div>

			</div>
		</div>
	</section>

</div>

<?php echo $footer; ?>