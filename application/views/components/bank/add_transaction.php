<div class="container-fluid">
    <div class="row">
	<?php echo $confirmation; ?>
        <div class="panel panel-default">

            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1><?php echo caption('Add_Transaction') ;?> </h1>
                </div>
            </div>

            <div class="panel-body">

                <?php
	                $attr=array('class'=>'form-horizontal');
	                echo form_open('',$attr);
                ?>

                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('Date') ;?> <span class="req">*</span></label>
                        
                        <div class="input-group date col-md-5" id="datetimepicker1">
                            <input type="text" name="date" placeholder="YYYY-MM-YY" value="<?php echo date("Y-m-d"); ?>" class="form-control" <?php if($privilege == 'user'){ echo 'disabled'; } ?> required>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>

                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('Bank_Name') ;?> <span class="req">*</span></label>
                        
                        <div class="col-md-5">
                            <select name="bank_name" id="bank_name" class="form-control" required>
                                <option value="" selected disabled>-- <?php echo caption('Select') ;?> --</option>
                               <?php foreach ($bank_list as $key => $value) { ?>
                               <option value="<?php echo $value->bank_name; ?>"><?php echo str_replace("_"," ",$value->bank_name); ?></option>
                               <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('Account_Number') ;?> <span class="req">*</span></label>

                        <div class="col-md-5">
                            <select id="account_number" name="account_number" class="form-control" required>
                                <option value="" selected disabled>-- <?php echo caption('Select') ;?> --</option>                       
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('Transaction_Type') ;?> <span class="req">*</span></label>

                        <div class="col-md-5">
                            <select name="transaction_type" class="form-control" required>
                                <option value="Debit">Debit</option>
                                <option value="Credit" selected>Credit</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-2 control-label"> Fund Source <span class="req">*</span></label>
                        <div class="col-md-5">
                            <select name="fund_source" class="form-control" required>
                                <option value="Cash" >Cash</option>
                                <option value="Others" selected >Others</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('Amount') ;?> <span class="req">*</span></label>
                        <div class="col-md-5">
                            <input type="text" name="amount" placeholder="BDT" class="form-control" required>
                        </div>
                    </div>                    

                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('Transaction_By') ;?> <span class="req">*</span></label>
                        <div class="col-md-5">
                            <input type="text" name="transaction_by" placeholder="Maximum 100 Digit" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-md-7">
                    <div class="btn-group pull-right">
                        <input type="submit" value="<?php echo caption('Save') ;?>" name="add_transaction" class="btn btn-primary">
                    </div>
                    </div>

                <?php echo form_close(); ?>

            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>
<script>
	$(document).ready(function(){
		$("#bank_name").on("change",function(){
		var bank_name=$(this).val();
			 function view_data(){
				$.ajax({
					type:"POST",
					data:{bankName: bank_name},
					url:"<?php echo base_url('bank/bankInfo/ajax_account_list');?>"
				}).success(function(response){
					var data=JSON.parse(response);
					var per_data=[];
					$.each(data,function(key,fieldName){
						per_data.push('<option value="'+fieldName.account_number+'">'+fieldName.account_number+'</option>');
					});
					//$("#account_number").append(per_data);
					document.getElementById("account_number").innerHTML='<option value="">-- Select one --</option>'+per_data;
				});
			 }
			 view_data();
		});
	});
</script>
