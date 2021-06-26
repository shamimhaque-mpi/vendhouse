
<div class="container-fluid none" <?php echo $subMenu; ?> style="margin-bottom: 10px;">
    <div class="row">	
		<a href="<?php echo site_url('supplier_tran/supplier_tran'); ?>" class="btn btn-default" id="add-new">
			<?php echo caption('Add_Supplier_Transaction'); ?>
		</a>
			
		<a href="<?php echo site_url('supplier_tran/supplier_tran/all_supplier_tran'); ?>" class="btn btn-default" id="all">
			<?php echo caption('All_Supplier_Transaction'); ?>
		</a>
    </div>
</div>