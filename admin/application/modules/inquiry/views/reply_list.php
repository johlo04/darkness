<?php if(count($reply_list)>0){ ?>
<?php 	foreach($reply_list as $value){ ?>
<?php 		if($value['user_group']=='member'){ ?>

				<div class="col-md-12 alert alert-callout <?php echo ($value['is_check']==1)? 'alert-brown': 'alert-danger'; ?> col-md-12 no-margin-bot" id="reply_<?php echo $value['id']; ?>">
					<div class="col-md-12 ">
						<p class="clearfix">
							
							<span class="pull-left">
								<span class="badge style-<?php echo ($value['is_check']==1)? 'success': 'danger'; ?>"><?php echo $username = ($value['user_group']=='admin') ?  phantom_db_picker('aauth_users','name',array('id'=>$value['user_id'])):'Member'; ?> </span><br/>
								<span class=""><?php echo ($value['date_added']=='0000-00-00 00:00:00')? 'Date: Undefined': date('D, M j, Y h:i:s A',strtotime($value['date_added'])); ?></span>
								
							</span>
							<?php if($value['is_check']==0){ ?>
							<span id="read_<?php echo $value['id']; ?>" class="pull-right " onclick="read_reply('<?php echo $value['id']; ?>');">
								<i class="md md-markunread" title="Mark As Read"></i>Mark As Read
							</span>
							<?php } ?>
							
						</p>
					</div>
					
					<div class="col-md-2 text-center">
						<span id="readicon_<?php echo $value['id']; ?>" class="fa fa-fw fa-envelope-o fa-2x text-danger"></span>
					</div>

					<div class="col-md-10">
						<em><?php echo $value['reply_detail'] ?></em>
					</div>
					
				</div><!--end .col -->
				
			<?php }else{ ?>
				<div class="col-md-12  alert alert-callout alert-brown col-md-12 no-margin-bot" id="reply_<?php echo $value['id']; ?>">
					<div class="col-md-12">
						<p class="clearfix">
							
							<span class="pull-left">
								<span class="badge style-success"><?php echo $username = ($value['user_group']=='admin') ?  phantom_db_picker('aauth_users','name',array('id'=>$value['user_id'])):'Member'; ?> </span><br/>
								
								<?php echo date('D, M j Y h:i:s A',strtotime($value['date_added'])); ?></span>
								
							</span>
							
							<span class="pull-right" onclick="delete_reply('<?php echo $value['id']; ?>');">
								<i class="fa fa-trash" title="Hide Message"></i>Delete
							</span>
							
						</p>
					</div>
					
					
					<div class="col-md-2 text-center">
						<span class="fa fa-fw fa-envelope-o fa-2x"></span>
					</div>

					<div class="col-md-10">
						<em><?php echo $value['reply_detail'] ?></em>
					</div>
					
				</div><!--end .col -->

<?php }}}else{ ?>
	<div class="col-xs-12">
	
		<div>
			<em>No reply found.</em>
		</div>
		
	</div><!--end .col -->

<?php } ?>