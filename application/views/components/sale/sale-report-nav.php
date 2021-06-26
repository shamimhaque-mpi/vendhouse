<div class="container-fluid none" <?php echo $subMenu; ?> style="margin-bottom: 10px;">
    <div class="row">
        
		<a href="<?php echo site_url('sale/saleToday'); ?>" class="btn btn-default" id="today">
			Today's Sales
		</a>

		<a href="<?php echo site_url('sale/searchSale'); ?>" class="btn btn-default" id="all">
			<?php echo caption('All_Sales'); ?>
		</a>

        <a href="<?php echo site_url('sale/saleChalan'); ?>" class="btn btn-default" id="chalan">
            Sale's Chalan
        </a>

		<a href="<?php echo site_url('sale/searchSale/monthly_report')?>" class="btn btn-default" id="monthly_report">
			Monthly Report
		</a>

		<?php if($privilege != "user"){ ?>
		<a href="<?php echo site_url('sale_return/sale_return/all'); ?>" class="btn btn-default" id="all-return">
			All Return
		</a>
		<?php } ?>
		
    </div>
</div>
