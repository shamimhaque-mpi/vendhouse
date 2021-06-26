
<div class="container-fluid none" <?php echo $subMenu; ?> style="margin-bottom: 10px;">
    <div class="row">
        <?php if(ck_action("theme_menu","basic")){ ?>
		<a href="<?php echo site_url('theme/themeSetting'); ?>" class="btn btn-default" id="basic">
			Basic Settings
		</a>
        <?php } ?>

        <?php if(ck_action("theme_menu","amount")){ ?>
		<a href="<?php echo site_url('theme/delivery_charge/delivery_charge'); ?>" class="btn btn-default" id="amount">
			Amount Settings
		</a>
        <?php } ?>

        <?php if(ck_action("theme_menu","limit")){ ?>
		<a href="<?php echo site_url('theme/limit'); ?>" class="btn btn-default" id="limit">
			Purchase Limitation
		</a>
		<?php } ?>
    </div>
</div>
