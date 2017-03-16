<div class="col-md-6">
	
		<div class="alert alert-callout alert-mild col-md-12 no-margin-bot ">
					
					<?php echo $username; ?> :<br/>
					<em><?php echo $current_comment; ?></em>
		</div>
		<div class="clearfix"></div>
</div>

<div class="col-md-6">
	<div class="form-group">
	
	<input type="hidden" id="comment_parent_id" value="<?php echo $parent_id; ?>">
		<label for="textarea_reply">
				Your comment/Reply:
		</label>
		
		<textarea class="form-control" name="" id="textarea_reply"></textarea>
		<div class="clearfix"></div>
		<span id="modal_notify_error" class="text-danger  help-block"></span>
		<div class="clearfix"></div>
		<select id="comment_option">
			<option value="0">Post as new comment.</option>
			<option value="1" selected="">Reply to this comment</option>
		</select>
	</div>
</div>

<div class="clearfix"></div>
