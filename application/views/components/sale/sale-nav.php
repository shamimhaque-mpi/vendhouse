<div class="container-fluid none" <?php echo $subMenu; ?> style="margin-bottom: 10px;">
    <div class="row">
		<a href="<?php echo site_url('sale/sale'); ?>" class="btn btn-default" id="add-new">
			<?php echo caption('Add_Sales'); ?>
		</a>
		<a href="<?php echo site_url('sale/sale'); ?>" target="_blank" class="btn btn-default" id="new">
			New Tab
		</a>
		
		<?php if($privilege != "user"){ ?>

		<a href="<?php echo site_url('sale_return/sale_return'); ?>" class="btn btn-default" id="add-sale-return">
			Sale Return
		</a>
		
		
		<?php } ?>




    </div>
</div>
