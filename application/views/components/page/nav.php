<div class="container-fluid none" <?php echo $subMenu; ?> style="margin-bottom: 10px;">
    <div class="row">
        <?php if(ck_action("page_menu","add-new")){ ?>
		<a href="<?php echo site_url('page'); ?>" class="btn btn-default" id="add-new">
			<?php echo caption('Add_New'); ?>
		</a>
		<?php } ?>
		
        <?php if(ck_action("page_menu","all")){ ?>
		<a href="<?php echo site_url('page/all'); ?>" class="btn btn-default" id="all">
			All
		</a>
        <?php } ?>
    </div>
</div>

