<?php echo $header; ?>
<?php echo $sidebar_left; ?>
<?php echo $sidebar_right; ?>

<div id="content" >
	<section>
		<div class="section-header">
			<h2 class="text-primary"><?php echo $page_title; ?></h2>
		</div>
		
		<div class="section-body">
			<div class="row">	
				
				<div class="col-md-6 animated animated-order-0  fadeIn">
					<div class="card card-underline">
							<div class="card-head">
								<header><span class="md-shopping-cart"></span>Most Viewed VR Video Today </header>
								<small class="marginized fa fa-question-circle pull-right" data-toggle="tooltip" data-placement="left" title="List out all closing and opening product."></small>
							</div>
							<div class="card-body height-6 scroll style-default-bright no-padding-top" id="bidding_today" data-url="<?php echo site_url("users/user/load_bidding_today"); ?>">
								
							</div><!--end .card-body -->
							<div class="btn btn-default  pull-right marginized btn-loading-state" data-loading-text="&lt;i class='fa fa-spinner fa-spin'&gt;&lt;/i&gt; Loading..." data-toggle="modal" data-content="bidding_today" data-target="#simpleModal"> View All</div>
					
							
					</div>
				</div>
				
				<div class="col-md-6 animated animated-order-1  fadeIn">
					<div class="card card-underline">
							<div class="card-head">
								<header><span class="md-shopping-cart"></span>Pusher </header>
								<small class="marginized fa fa-question-circle pull-right" data-toggle="tooltip" data-placement="left" title="List out all closing and opening product."></small>
							</div>
							<div class="card-body height-6 scroll style-default-bright no-padding-top" id="bidding_today" data-url="<?php echo site_url("users/user/load_bidding_today"); ?>">
											
											
											<script src="https://js.pusher.com/4.0/pusher.min.js"></script>
											  <script>

												// Enable pusher logging - don't include this in production
												notify_counter = 0;
												Pusher.logToConsole = true;

												var pusher = new Pusher('9c6f60fbd947dd151cfa', {
												  encrypted: true
												});

												var channel = pusher.subscribe('my-channel');
												channel.bind('my-event', function(data) {
													++notify_counter;
													$('#notify_counter').text(notify_counter);
													makeToast(data.status,data.message);
												});
												
												var channel2 = pusher.subscribe('my-channel2');
												channel2.bind('my-event2', function(data) {
													++notify_counter;
													$('#notify_counter').text(notify_counter);
													makeToast(data.status,data.message);
												});
												
											  </script>

											<p id="event">Waiting on event...</p>
											<p>Go to <strong><a href="/cleancms/admin/index.php/users/user/trigger_event" target="_blank">/example/trigger_event</a></strong> in a new tab to trigger event.</p>
											<p>Go to <strong><a href="/cleancms/admin/index.php/users/user/trigger_event2" target="_blank">/example/trigger_event 2</a></strong> in a new tab to trigger event.</p>








							
							</div><!--end .card-body -->
							<div class="btn btn-default  pull-right marginized btn-loading-state" data-loading-text="&lt;i class='fa fa-spinner fa-spin'&gt;&lt;/i&gt; Loading..." data-toggle="modal" data-content="bidding_today" data-target="#simpleModal"> View All</div>
					
							
					</div>
				</div>
				
				<div class="col-md-6 animated animated-order-2 fadeIn">
					<div class="card card-underline">
							<div class="card-head">
								<header><span class="md-shopping-cart"></span>Most Viewed VR Video Today </header>
								<small class="marginized fa fa-question-circle pull-right" data-toggle="tooltip" data-placement="left" title="List out all closing and opening product."></small>
							</div>
							<div class="card-body height-6 scroll style-default-bright no-padding-top" id="bidding_today" data-url="<?php echo site_url("users/user/load_bidding_today"); ?>">
								
							</div><!--end .card-body -->
							<div class="btn btn-default  pull-right marginized btn-loading-state" data-loading-text="&lt;i class='fa fa-spinner fa-spin'&gt;&lt;/i&gt; Loading..." data-toggle="modal" data-content="bidding_today" data-target="#simpleModal"> View All</div>
					
							
					</div>
				</div>
				
				

			</div>
		</div>
	</section>
	
</div>

<div class="modal fade" id="simpleModal" tabindex="-1" role="dialog" aria-labelledby="simpleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog modal-lg">
		<div class="modal-content">
				<div class="modal-header">
						
						<h3 class="modal-title"><span class="fa fa-search"></span> Full List View </h3>
					
						<div class="tools stick-top-right">
							<div class="btn-group">
								<?php /*<a class="btn btn-icon-toggle btn-refresh"><i class="md md-refresh"></i></a>*/ ?>
								<a class="btn btn-icon-toggle btn-close" data-dismiss="modal" aria-hidden="true"><i class="md md-close"></i></a>
							</div>
						
						</div>
				
				</div>
				
				<div class="modal-body height-6 scroll"> 
					
				</div>
				
				<div class="modal-footer">
					<div class="col-md-12 text-right">
						<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
					</div>
				</div>
			</div>
		</div>
	</div>

<script>
	$(document).ready(function(){
		$('#bidding_today').load('<?php echo site_url("users/user/load_bidding_today"); ?>');
		$('#hot_product').load('<?php echo site_url("users/user/load_hot_product"); ?>');
		$('#waiting_payment').load('<?php echo site_url("users/user/load_waiting_payment"); ?>');
		$('#client_inquiry').load('<?php echo site_url("users/user/load_client_inquiry"); ?>');
		
		$('#simpleModal').on('shown.bs.modal', function(event){
			$type= $('#ranking_based').text();
			
			var action = $(event.relatedTarget)
			var modal = $(this)
			$content = '';
			
			$('#meeting_save_button').removeClass('btn-warning').addClass('btn-default');
			
			if(action.data('content')=='bidding_today'){
				$url = '<?php echo site_url("users/user/load_bidding_today"); ?>';
			} else if (action.data('content')=='hot_product'){
				$url = '<?php echo site_url("users/user/load_hot_product"); ?>';
			} else if (action.data('content')=='waiting_payment'){
				$url = '<?php echo site_url("users/user/load_waiting_payment"); ?>';
			} else if (action.data('content')=='client_inquiry'){
				$url = '<?php echo site_url("users/user/load_client_inquiry"); ?>';
			} else{
				$url = '<?php echo site_url("users/user/load_bidding_today"); ?>';
			}
			
			//loads content
			modal.find('.modal-body').html('<span class="fa fa-spinner fa-spin"></span> Loading Please Wait').load(""+$url+"");
			
		});
		
	});

</script>

<?php echo $footer; ?>