<div class="container-fluid none" <?php echo $subMenu; ?> style="margin-bottom: 10px;">
    <div class="row">
        <?php if(ck_action("subCategory_menu","add-new")){ ?>
		<a href="<?php echo site_url('subCategory/subCategory'); ?>" class="btn btn-default" id="add-new">
			<?php echo caption('Add_New'); ?>
		</a>
		<?php } ?>
		
        <?php if(ck_action("subCategory_menu","all")){ ?>
		<a href="<?php echo site_url('subCategory/subCategory/allsubCategory'); ?>" class="btn btn-default" id="all">
			<?php echo caption('All'); ?> <?php echo caption('Sub_Category'); ?>
		</a>
		<?php } ?>
    </div>
</div>