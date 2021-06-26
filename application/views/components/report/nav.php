<div class="container-fluid none" <?php echo $subMenu; ?> style="margin-bottom: 10px;">
    <div class="row">
        <?php if(ck_action("report_menu","supplier_report")){ ?>
		<!--<a href="<?php //echo site_url('report/supplier_report'); ?>" class="btn btn-default" id="supplier_report">
			Supplier Report
		</a>-->
		<?php } ?>
		
		<?php if(ck_action("report_menu","sr_report")){ ?>
		<a href="<?php echo site_url('report/sr_report'); ?>" class="btn btn-default" id="sr_report">
			Sr Report
		</a>
		<?php } ?>
    </div>
</div>