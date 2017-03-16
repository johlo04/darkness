<?php 

if(count($comments)>0){
		foreach($comments as $value){ ?>
			
			<div id="usercomment_<?php echo $value['id']; ?>" class="<?php echo ($value['status'])? '':'opacity-hide'; ?> alert alert-callout alert-mild col-md-12 no-margin-bot">
					
					<span class="badge style-success"><?php echo $username = ($value['user_group']=='admin') ?  phantom_db_picker('aauth_users','name',array('id'=>$value['user_id'])):'Member'; ?> </span><br/>
					
					<em><?php echo $value['review_description']; ?></em>
					</br>
					<span class="pull-right small-txt">
						<?php echo ($value['user_group']=='admin')? '<span class="small-txt badge">Admin</span>': ''; ?> |
						<?php if($value['status']){ ?>
								<i class="fa fa-check-circle-o" onclick="status_comment(<?php echo $value['id']; ?>,<?php echo $value['status']; ?>)" title="Active Post"></i>
							<?php }else{ ?>
								<i class="fa fa-eye-slash" onclick="status_comment(<?php echo $value['id']; ?>,<?php echo $value['status']; ?>)" title="Hidden Post"></i>
							<?php } ?>
							|
							<i class="fa fa-trash-o" onclick="delete_comment(<?php echo $value['id']; ?>)" title="Delete"></i> |
							<?php echo date('D, M j Y h:i:s A',strtotime($value['date_added'])); ?></span>
					</span>
				
					<?php if(count($value['subcomment'])>0){ foreach($value['subcomment'] as $svalue){ ?>
							<div id="usercomment_<?php echo $svalue['id']; ?>" class="<?php echo ($svalue['status'])? '':'opacity-hide'; ?> alert alert-callout alert-brown col-md-12 no-margin-bot">
								<span class="badge style-success"><?php echo $username = ($svalue['user_group']=='admin') ?  phantom_db_picker('aauth_users','name',array('id'=>$svalue['user_id'])):'Member'; ?> </span><br/>
								<em><?php echo $svalue['review_description']; ?></em>
								</br><span class="pull-right small-txt">
									<?php echo ($value['user_group']=='admin')? '<span class="small-txt badge">Admin</span>': ''; ?> |
									<?php if($svalue['status']){ ?>
										<i class="fa fa-check-circle-o" onclick="status_comment(<?php echo $svalue['id']; ?>,<?php echo $svalue['status']; ?>)" title="Active Post"></i>
									<?php }else{ ?>
										<i class="fa fa-eye-slash" onclick="status_comment(<?php echo $svalue['id']; ?>,<?php echo $svalue['status']; ?>)" title="Hidden Post"></i>
									<?php } ?>
									|
									<i class="fa fa-trash-o" onclick="delete_comment(<?php echo $svalue['id']; ?>)" title="Delete"></i> |
									<?php echo date('D, M j Y h:i:s A',strtotime($svalue['date_added'])); ?></span>
							</div>
					<?php }} ?>
				<br/>
				<div class="clearfix"></div>
				<div class="card-actionbar-row">
					<?php if($value['status']){ ?>
					<a href="javascript:void(0);" data-toggle="modal" data-target="#simpleModal" data-urlpath="<?php echo site_url('videos/videos/comment_form').'/'.$value['id'].'/'.$value['ref_id'].'/'.$username; ?>" data-title="Reply to Comment" class="btn btn-sm btn-default "><i class="fa fa-reply"></i>Reply</a>
					<?php } ?>
				</div>
				
			</div>
			
			
<?php } }else{ ?>
	
		 No comment found for this actress.
		
<?php } ?>