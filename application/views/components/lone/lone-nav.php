
<div class="container-fluid none" <?php echo $subMenu; ?> style="margin-bottom: 10px;">
    <div class="row">	
		<a href="<?php echo site_url('lone/lone'); ?>" class="btn btn-default" id="add-new">
			Take Installment
		</a>
			
		<a href="<?php echo site_url('lone/lone/show_lone'); ?>" class="btn btn-default" id="all">
			All Installment
		</a>

		<a href="<?php echo site_url('lone/getTodaysInstallmentList'); ?>" class="btn btn-default" id="list">
			Today's List
		</a>
    </div>
</div>