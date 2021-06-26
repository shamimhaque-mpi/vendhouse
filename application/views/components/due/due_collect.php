<style>
    .form-control{
        margin-bottom:12px;
    }
</style>

<div class="container-fluid" ng-controller="dueCollectionCtrl" ng-cloak>
    <div class="row">
        <?php //echo $confirmation; ?>
        <?php echo $this->session->flashdata('confirmation'); ?>
       
        <div class="panel panel-default">
            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1>Due Collection</h1>
                </div>
            </div>
            
            <?php if($result != null ) { ?>
            
            <div class="panel-body">
                <!-- horizontal form -->
                <?php
                $attr = array("class" => "form-horizontal");
                echo form_open('', $attr);
                ?>
                
                <div class="col-md-12">
                    
                    <label class="col-md-2 control-label">Date</label>
                    <div class="col-md-4">
                        <input type="text" name="name" class="form-control" value="<?php echo $result[0]->date; ?>" readonly>
                    </div>
                    
                    
                    <label class="col-md-2 control-label">Sale Type </label>
                    <div class="col-md-4">
                        <input type="text" name="mobile" class="form-control" value="<?php echo $result[0]->sale_type;?>" readonly>
                    </div>
                    
                    <label class="col-md-2 control-label">Time</label>
                    <div class="col-md-4">
                        <input type="text" name="name" class="form-control" value="<?php echo $result[0]->time; ?>" readonly>
                    </div>
                    
                    <?php $user_info = $this->action->read("users",array("username"=>$username)); ?>
                    <label class="col-md-2 control-label">Sold By</label>
                    <div class="col-md-4">
                        <input type="text" name="contact_person" class="form-control" value="<?php echo $user_info[0]->name; ?>" readonly >
                    </div>
                    
                    <label class="col-md-2 control-label">Name</label>
                    <div class="col-md-4">
                        <input type="text" name="name" class="form-control" value="<?php echo $result[0]->name; ?>" readonly>
                    </div>
                    
                    
                    <label class="col-md-2 control-label">Paid</label>
                    <div class="col-md-4">
                        <input type="text" name="paid" class="form-control" ng-init="previous_paid= '<?php echo $result[0]->paid;?>' " ng-model="previous_paid" readonly >
                    </div>
                    
                    <label class="col-md-2 control-label">Mobile</label>
                    <div class="col-md-4">
                        <input type="text" name="mobile" class="form-control" value="<?php echo $result[0]->mobile;?>"  readonly>
                    </div>
                    
                    <label class="col-md-2 control-label">Due</label>
                    <div class="col-md-4">
                        <input type="text" name="due" class="form-control" ng-value="dueCalcFn()"  readonly >
                    </div>
                    
                    
                    <label class="col-md-2 control-label">Voucher</label>
                    <div class="col-md-4">
                        <input type="text" name="voucher" class="form-control" value="<?php echo $result[0]->voucher_number;?>" readonly>
                    </div>
                    
                    
                    <label class="col-md-2 control-label">Amount<span class="req">*</span></label>
                    <div class="col-md-4">
                        <input type="number" name="amount" class="form-control" ng-model="current_paid" ng-change="dueCalcFn()" min="0" max="{{ old_due }}" ng-init="old_due='<?php echo $result[0]->due;?>' " step="any" required>
                    </div>
                    
                    <label class="col-md-2 control-label">Grand Total</label>
                    <div class="col-md-4">
                        <input type="text" name="grand_total" class="form-control" ng-init="grand_total='<?php echo $result[0]->grand_total;?>'" ng-model="grand_total" readonly>
                    </div>
                    
                </div>
               
                <div class="col-md-11">
                    <div class="btn-group pull-right">
                        <input type="submit" name="save" value="Paid" class="btn btn-primary">
                    </div>
                </div>

                <?php echo form_close(); ?>
            </div>
            <?php } ?>
            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>