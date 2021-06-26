<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panal-header-title pull-left">
            <h1>Purchase Limitation</h1>
        </div>
    </div>

    <div class="panel-body">

        <?php
            $attr=array('class'=>'form-horizontal');
            echo form_open('',$attr);
            echo $confirmation;
        ?>
        

            <div class="form-group">
                <label class="col-md-3 control-label">Purchase Limit <span class="req">*</span></label>
                <div class="col-md-5">
                    <input type="number" name="amount" placeholder="Your Purchase Limit" class="form-control" required>
                </div>
                <?php if($limit != null) {?>
                <div class="col-md-3">
                    <h4 class="text-center">Your Current Purchase Limit</h4>
                    <strong class="text-center" style="display: block;"> <?php echo $limit[0]->amount; ?> TK. </strong>
                </div>
                <?php } ?>
            </div>

            <div class="col-md-8">
            <div class="btn-group pull-right">
                <input type="submit" value="<?php echo caption('Save') ;?>" name="limit" class="btn btn-primary">
            </div>
            </div>

        <?php echo form_close(); ?>

    </div>

    <div class="panel-footer">&nbsp;</div>
</div>