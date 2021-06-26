<div class="container-fluid">
    <div class="row">
    <?php echo $confirmation;
     ?>
        <div class="panel panel-default">

            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1><?php echo caption('Edit_Supplier_Transaction'); ?></h1>
                     <blockquote style="font-size: 15px !important;margin-top: 11px auto !important;">
                         <?php echo caption('Minus'); ?><br/>  
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
                            <input name="supplier_name" value="<?php echo $transaction[0]->supplier_name; ?>" class="form-control" readonly required>                                
                        </div>
                    </div>
                     <input type="hidden" name="voucher_number" value="<?php echo $transaction[0]->voucher_number; ?>">
                     <input type="hidden" name="id" value="<?php echo $transaction[0]->id; ?>">
                     <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('Company_Name'); ?> <span class="req">&nbsp;</span></label>
                        <div class="col-md-5">
                            <input type="text" readonly name="company_name" value="<?php echo $transaction[0]->company_name; ?>" class="form-control">
                        </div>
                    </div>

                     <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('Balance_(Tk)'); ?> <span class="req">*</span></label>
                        <div class="col-md-5">
                             <div class="input-group">
                                <span class="input-group-addon">
                                    <?php if($transaction[0]->net_balance >=0) { echo "+"; } else { echo "-"; } ?>
                                </span>
                                <input type="text"  name="balance" value="<?php echo $transaction[0]->net_balance; ?>" class="form-control" readonly required>                                
                            </div>

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('Type_of_Payment'); ?> <span class="req">*</span></label>
                        <div class="col-md-5">
                            <select name="payment_type" class="form-control"> 
                                <option <?php if($transaction[0]->payment_type=="Cash"){echo"Selected";} ?> value="Cash">Cash</option>                             
                                <option <?php if($transaction[0]->payment_type=="Check"){echo"Selected";} ?> value="Check">Check</option>                                
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('Payment'); ?> <span class="req">*</span></label>
                        <div class="col-md-5">
                            <input type="number" name="payment"  max="<?php echo $transaction[0]->balance; ?>" value="0"  class="form-control" step="any" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('Net_Balance'); ?> <span class="req">*</span></label>
                        <div class="col-md-5">
                             <div class="input-group">
                                <span class="input-group-addon" id="netBlanceSign">
                                   <?php if($transaction[0]->net_balance >=0) { echo "+"; } else { echo "-"; } ?> 
                                </span>
                                <input type="text"  name="net_balance" value="<?php echo $transaction[0]->net_balance; ?>"  class="form-control" readonly required>                               
                            </div>

                        </div>
                    </div>               

                    <div class="col-md-7">
                        <div class="btn-group pull-right">
                            <input type="submit" name="edit" value="<?php echo caption('Update'); ?>" class="btn btn-primary">
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

     $(document).ready(function(){
        $('input[name="payment"]').on("keyup",function(){
            var due=0;
            var balance=parseFloat($('input[name="balance"]').val());
            var payment=parseFloat($(this).val());
            due=balance-payment;
            $('input[name="net_balance"]').val(due);
            if(due >=0){
                $('span#netBlanceSign').text("+");
            }else{
                $('span#netBlanceSign').text("-");
            }
        });
     });
</script>