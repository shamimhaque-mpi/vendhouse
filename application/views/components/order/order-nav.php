<div class="container-fluid none" <?php echo $subMenu; ?> style="margin-bottom: 10px;">
    <div class="row">	
        <?php if(ck_action("order_menu","all")){ ?>
		<a href="<?php echo site_url('order/order'); ?>" class="btn btn-default" id="all">
			<?php echo ('All Order'); ?>
		</a>
        <?php } ?>

        <?php if(ck_action("order_menu","sr")){ ?>
		<!--<a href="<?php echo site_url('order/order/srOrder'); ?>" class="btn btn-default" id="sr">
			<?php echo ('SR Order'); ?>
		</a>-->
        <?php } ?>

        <?php if(ck_action("order_menu","search")){ ?>
		<a href="<?php echo site_url('order/order/searchOrder'); ?>" class="btn btn-default" id="search">
			<?php echo ('Search Order'); ?>
		</a>
		<?php } ?>
    </div>
</div>