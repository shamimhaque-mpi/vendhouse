<div class="container-fluid">
    <div class="row">
	<?php echo $confirmation; ?>
        <div class="panel panel-default">

            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1><?php echo caption('Edit') ;?></h1>
                </div>
            </div>

            <div class="panel-body">

                <?php
                $attr=array("class"=>"form-horizontal");
                echo form_open('bank/bankInfo/editAccount?id='.$this->input->get('id'),$attr);
                ?>

                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('Date') ;?> <span class="req">*</span></label>
                        
                        <div class="input-group date col-md-5" id="datetimepicker">
                            <input type="text" name="date" placeholder="YYYY-MM-YY" class="form-control" value="<?php echo date('Y-m-d'); ?>" <?php if($privilege == 'user'){ echo 'disabled'; } ?>>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>

                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('Bank_Name') ;?> </label>
                        
                        <div class="col-md-5">
                            <select name="bank_name" class="form-control" >
				<option <?php if($all_account[0]->bank_name=="Sonali_Bank_Limited"){echo "selected";} ?> value="Sonali_Bank_Limited">Sonali Bank Limited</option>
				<option <?php if($all_account[0]->bank_name=="Janata_Bank_Limited"){echo "selected";} ?> value="Janata_Bank_Limited">Janata Bank Limited</option>
				<option <?php if($all_account[0]->bank_name=="Agrani_Bank_Limited"){echo "selected";} ?> value="Agrani_Bank_Limited">Agrani Bank Limited</option>
				<option <?php if($all_account[0]->bank_name=="Rupali_Bank_Limited"){echo "selected";} ?> value="Rupali_Bank_Limited">Rupali Bank Limited</option>
				<option <?php if($all_account[0]->bank_name=="AB_Bank_Limited"){echo "selected";} ?> value="AB_Bank_Limited">AB Bank Limited</option>
				<option <?php if($all_account[0]->bank_name=="Jamuna_Bank_Limited"){echo "selected";} ?> value="Jamuna_Bank_Limited">Jamuna Bank Limited</option>
				<option <?php if($all_account[0]->bank_name=="National_Bank_Limited"){echo "selected";} ?> value="National_Bank_Limited">National Bank Limited</option>
				<option <?php if($all_account[0]->bank_name=="NCC_Bank_Limited"){echo "selected";} ?> value="NCC_Bank_Limited">NCC Bank Limited</option>
				<option <?php if($all_account[0]->bank_name=="Prime_Bank_Limited"){echo "selected";} ?> value="Prime_Bank_Limited">Prime Bank Limited</option>
				<option <?php if($all_account[0]->bank_name=="Standard_Bank_Limited"){echo "selected";} ?> value="Standard_Bank_Limited">Standard Bank Limited</option>
				<option <?php if($all_account[0]->bank_name=="The_City_Bank_Limited"){echo "selected";} ?> value="The_City_Bank_Limited">The City Bank Limited</option>
				<option <?php if($all_account[0]->bank_name=="Trust_Bank_Limited"){echo "selected";} ?> value="Trust_Bank_Limited">Trust Bank Limited</option>
				<option <?php if($all_account[0]->bank_name=="Islami_Bank_Bangladesh_Limited"){echo "selected";}; ?> value="Islami_Bank_Bangladesh_Limited">Islami Bank Bangladesh Limited</option>
				<option <?php if($all_account[0]->bank_name=="The_City_Bank_Limited"){echo "selected";} ?> value="The_City_Bank_Limited">The City Bank Limited</option>
				<option <?php if($all_account[0]->bank_name=="Dutch_Bangla_Bank"){echo "selected";} ?> value="Dutch_Bangla_Bank">Dutch Bangla Bank</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('Account_Holder_Name') ;?> </label>
                        
                        <div class="col-md-5">
                            <input type="text" name="account_holder_name" placeholder="<?php echo caption('Type_Account_Holder_Name') ;?>" value="<?php echo $all_account[0]->holder_name; ?>" class="form-control" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('Account_Number') ;?> </label>
                        
                        <div class="col-md-5">
                            <input type="text" name="account_number" placeholder="<?php echo caption('Maximum') ;?>" value="<?php echo $all_account[0]->account_number; ?>" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('Previous_Balance') ;?> </label>
                        
                        <div class="col-md-5">
                            <input type="text" name="previous_balance" value="<?php echo $all_account[0]->pre_balance; ?>" placeholder="<?php echo caption('BDT') ;?>" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-7">
                    <div class="btn-group pull-right">
                        <input type="submit" value="<?php echo caption('Update') ;?>" name="edit_account" class="btn btn-success">
                    </div>
                    </div>

                </form>

            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#datetimepicker').datetimepicker({
            format: 'YYYY-MM-DD'
        });
    });
</script>