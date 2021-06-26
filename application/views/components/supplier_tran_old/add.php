<div class="container-fluid">
    <div class="row" ng-controller="supplierTransactionCtrl">
    <?php echo $confirmation;
     ?>
        <div class="panel panel-default">

            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1><?php echo caption('Add_Supplier_Transaction'); ?></h1>
                    <blockquote style="font-size: 15px !important;margin-top: 11px auto !important;">
                         <?php echo caption('Minus'); ?><br>
                         <?php echo caption('Plus'); ?>
                    </blockquote>  
                </div>
            </div>

            <div class="panel-body">


                <!-- horizontal form -->
                <?php
                    $attr=array("class"=>"form-horizontal");
                    echo form_open_multipart('', $attr);
                ?>                  
                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('Supplier_Name'); ?> <span class="req">*</span></label>
                        <div class="col-md-5">
                            <select name="supplier_name" ng-model="supplier_name" class="form-control"  ng-change="getsupplierInfo();" required>
                                <option value="">-- <?php echo caption('Select'); ?> --</option>
                                 <?php foreach ($vendors as $key => $value) { ?>
                                    <option value="<?php echo $value->id; ?>"><?php echo $value->vendor_name; ?></option> 
                                 <?php } ?>                             
                             </select>
                        </div>
                    </div>
                     <input type="hidden" name="voucher_number" ng-value="voucher_number">
                    
                     
                    
                     <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('Company_Name'); ?> <span class="req">&nbsp;</span></label>
                        <div class="col-md-5">
                            <input type="text" readonly name="company_name" ng-model="company_name" class="form-control">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('Mobile'); ?> <span class="req">&nbsp;</span></label>
                        <div class="col-md-5">
                            <input type="text" readonly name="mobile" ng-model="mobile" class="form-control">
                        </div>
                    </div>

                     <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('Balance_(Tk)'); ?> <span class="req">*</span></label>
                        <div class="col-md-5">
                             <div class="input-group">
                                <span class="input-group-addon" ng-bind="balanceSign"></span>
                                <input type="text"  ng-model="totalBalance" class="form-control" readonly required>
                                <input type="hidden" name="balance" ng-value="total_original_Balance">
                            </div>

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('Type_of_Payment'); ?> <span class="req">*</span></label>
                        <div class="col-md-5">
                            <select name="payment_type" class="form-control"> 
                                <option value="Cash">Cash</option>                             
                                <option value="Check">Check</option>                                
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('Payment'); ?> <span class="req">*</span></label>
                        <div class="col-md-5">
                            <input type="number" name="payment" ng-model="payment"  ng-keyup="claculateDue();" class="form-control" step="any" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('Net_Balance'); ?> <span class="req">*</span></label>
                        <div class="col-md-5">
                             <div class="input-group">
                                <span class="input-group-addon" ng-bind="netbalanceSign"></span>
                                <input type="text"  ng-model="netBalance" class="form-control" readonly required>
                                <input type="hidden" name="net_balance" ng-value="net_original_Balance">
                            </div>

                        </div>
                    </div>               

                    <div class="col-md-7">
                        <div class="btn-group pull-right">
                            <input type="submit" name="submit" value="<?php echo caption('Save'); ?>" class="btn btn-primary">
                        </div>
                    </div>
                    
                <?php echo form_close(); ?>

            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>

<script>
     $('#datetimepicker').datetimepicker({
        format: 'YYYY-MM-DD',
        useCurrent: false
    });
</script>