<div class="container-fluid none" <?php echo $subMenu; ?> style="margin-bottom: 10px;">
    <div class="row">
		<?php if(ck_menu("bank_transaction")){ ?>
		<a href="<?php echo site_url('bank/bankInfo/allTransaction'); ?>" class="btn btn-default" id="all">
			<?php echo caption('All_Transaction') ;?>
		</a>
		<?php } ?>		
		
		<a href="<?php echo site_url('bank/bankInfo/searchViewTransaction'); ?>" class="btn btn-default" id="search">
			<?php echo caption('Custom_Search') ;?>
		</a>
    </div>
</div>