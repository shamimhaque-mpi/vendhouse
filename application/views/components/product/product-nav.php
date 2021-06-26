<div class="container-fluid none" <?php echo $subMenu; ?> style="margin-bottom: 10px;">
    <div class="row">	
        <?php if(ck_action("product_menu","add-new")){ ?>
		<a href="<?php echo site_url('product/product'); ?>" class="btn btn-default" id="add-new">
			<?php echo caption('Add_Product') ;?>
		</a>
		<?php } ?>
		
        <?php if(ck_action("product_menu","all")){ ?>
		<a href="<?php echo site_url('product/product/allProduct'); ?>" class="btn btn-default" id="all">
			<?php echo caption('All_Product') ;?>
		</a>
		<?php } ?>
    </div>
</div>