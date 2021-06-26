
<div class="container-fluid none" <?php echo $subMenu; ?> style="margin-bottom: 10px;">
    <div class="row">	
		<a href="<?php echo site_url('employee/employee'); ?>" class="btn btn-default" id="add-new">
			<?php echo caption('Add_Employee') ;?>
		</a>
			
		<a href="<?php echo site_url('employee/employee/show_employee'); ?>" class="btn btn-default" id="all">
			<?php echo caption('All_Employee') ;?>
		</a>
    </div>
</div>