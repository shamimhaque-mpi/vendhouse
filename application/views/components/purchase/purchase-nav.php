<div class="container-fluid none" <?php echo $subMenu; ?> style="margin-bottom: 10px;">
    <div class="row">	
		<?php /*** <a href="<?php echo site_url('purchase/purchase'); ?>" class="btn btn-default" id="add-new">
			<?php echo caption('Add_Purchase'); ?>
		</a> ****/ ?>

		<a href="<?php echo site_url('purchase/purchase/show_Purchase'); ?>" class="btn btn-default" id="purchase">
			<?php echo caption('All_Purchase'); ?>
		</a>
		
		<a href="<?php echo site_url('purchase/purchase/purchaseList'); ?>" class="btn btn-default" id="list">
		Purchase Items
		</a>
    </div>
</div>