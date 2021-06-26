<div class="container-fluid none" <?php echo $subMenu; ?> style="margin-bottom: 10px;">
    <div class="row">	
		<a href="<?php echo site_url('leave_management/leaveView'); ?>" class="btn btn-default" id="add-new">
			 <?php echo caption('Add_New'); ?>
		</a>
			
		<a href="<?php echo site_url('leave_management/leaveView/show'); ?>" class="btn btn-default" id="all">
			<?php echo caption('Show_Leave'); ?>
		</a>
    </div>
</div>