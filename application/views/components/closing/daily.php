<div class="container-fluid">
    <div class="row">
	<?php echo $confirmation; ?>
        <div class="panel panel-default">

            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1><?php echo caption('Daily');?></h1>
                </div>
            </div>

            <div class="panel-body">
                <div class="row">

                   <div class="col-md-3">
                        <div class="dash-box dash-box-5">
                            <span><?php echo caption('Opening');?></span>
                            <h1><?php echo $pre_Cash; ?></h1>
                        </div>                    
                    </div>

                   <div class="col-md-3">
                        <div class="dash-box dash-box-1">
                            <span><?php echo caption('Income');?></span>
                            <h1><?php echo $income; ?></h1>
                        </div>                    
                    </div>

                    <div class="col-md-3">
                        <div class="dash-box dash-box-2">
                            <span><?php echo caption('Cost');?></span>
                            <h1><?php echo $cost; ?></h1>
                        </div>                    
                    </div>

                    <div class="col-md-3">
                        <div class="dash-box dash-box-3">
                            <span><?php echo caption('Bank');?></span>
                            <h1><?php echo $bank; ?></h1>
                        </div>                    
                    </div>

                    <div class="col-md-3">
                        <div class="dash-box dash-box-4">
                            <span><?php echo caption('Cash_In_Hand');?></span>
                            <h1><?php echo $curr_Cash; ?></h1>
                        </div>                    
                    </div> 
                </div>
                <?php echo form_open(''); ?>
                <input type="hidden" name="cost" value="<?php echo $cost ?>">
                <input type="hidden" name="bank" value="<?php echo $bank ?>">
                <input type="hidden" name="curr_Cash" value="<?php echo $curr_Cash ?>">
                <input type="hidden" name="income" value="<?php echo $income ?>">
                <input type="hidden" value="<?php echo $pre_Cash; ?>" class="form-control" name="init_balance">
                <div class="pull-right">
                <input type="submit" name="submit" class="btn btn-primary pull-right" value="Close">
                </div>
                <?php echo form_close(); ?>
            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>

