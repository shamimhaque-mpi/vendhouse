
<div class="container-fluid none" <?php echo $subMenu; ?> style="margin-bottom: 10px;">
    <div class="row">
        <?php if(ck_action("sr_menu","field")){ ?>
    	<a href="<?php echo site_url('sr/sr/field'); ?>" class="btn btn-default" id="field">
			Add Field
		</a>
		<?php } ?>
		
        <?php if(ck_action("sr_menu","add")){ ?>
		<a href="<?php echo site_url('sr/sr'); ?>" class="btn btn-default" id="add">
			Add SR
		</a>
		<?php } ?>
		
        <?php if(ck_action("sr_menu","all")){ ?>
		<a href="<?php echo site_url('sr/sr/view_all'); ?>" class="btn btn-default" id="all">
			All SR
		</a>
        <?php } ?>
    </div>
</div>
