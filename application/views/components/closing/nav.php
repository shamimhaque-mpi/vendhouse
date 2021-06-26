<div class="container-fluid none" <?php echo $subMenu; ?> style="margin-bottom: 10px;">
    <div class="row">	
		<a href="<?php echo site_url('closing/closing'); ?>" class="btn btn-default" id="add-new">
			<?php echo caption('Daily');?>
		</a>
		<a href="<?php echo site_url('closing/closing/report'); ?>" class="btn btn-default" id="report">
			<?php echo caption('Report');?>
		</a>
		<?php if ($opening<1) { ?>
		<a href="<?php echo site_url('closing/closing/opening'); ?>" class="btn btn-default" id="opening">
			<?php echo caption('Opening');?>
		</a>
		<?php } ?>

		<!-- <a href="<?php echo site_url('category/category/allCategory'); ?>" class="btn btn-default" id="all">
			<?php echo caption('All_Category');?>
		</a> -->
		
    </div>
</div>