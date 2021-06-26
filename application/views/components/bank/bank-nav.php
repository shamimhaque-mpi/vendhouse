<div class="container-fluid none" <?php echo $subMenu; ?> style="margin-bottom: 10px;">
    <div class="row">	
		<a href="<?php echo site_url('bank/bankInfo/addBankName'); ?>" class="btn btn-default" id="bank_name">
			Bank Name
		</a>	
		<a href="<?php echo site_url('bank/bankInfo'); ?>" class="btn btn-default" id="add-new">
			<?php echo caption('Add_Account') ;?>
		</a>
		
		<a href="<?php echo site_url('bank/bankInfo/all_account'); ?>" class="btn btn-default" id="all-acc">
			<?php echo caption('All_Account') ;?>
		</a>
			
		<?php if(ck_menu("bank_transaction")){ ?>
		<a href="<?php echo site_url('bank/bankInfo/transaction'); ?>" class="btn btn-default" id="add">
			<?php echo caption('Add_Transaction') ;?> 
		</a>
		<?php } ?>
    </div>
</div>