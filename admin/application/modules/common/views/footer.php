		</div><!--end #base-->
		<!-- END BASE -->
		<script>
		<?php if($this->session->flashdata('status') != '') { ?>
			makeToast("<?php echo $this->session->flashdata('status'); ?>", "<?php echo $this->session->flashdata('status_info'); ?>");
		<?php } ?>
		
		</script>
		<!-- BEGIN JAVASCRIPT -->
		<?php if(isset($scripts)) { ?>
		<?php foreach($scripts as $s) { ?>
		<script type="text/javascript" src="<?php echo $s; ?>"></script>
		<?php } ?>
		<?php } ?>
		<!-- END JAVASCRIPT -->

	</body>
</html>
