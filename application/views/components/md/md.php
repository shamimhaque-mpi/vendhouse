<div class="container-fluid">
    <div class="row">
	<?php echo $confirmation; ?>
        <div class="panel panel-default">
            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1>MD Transaction</h1>
                </div>
            </div>

            <div class="panel-body">
                <?php 
                $attribute = array('class' => 'form-horizontal');
                echo form_open('', $attribute);
                ?>
                <div class="form-group row">
                    <label class="col-md-2 control-label"><?php echo caption('Date'); ?> <span class="req">*</span></label>
                    <div class="input-group date col-md-5" id="datetimepicker1">
                        <input type="text" name="date" placeholder="YYYY-MM-YY" class="form-control" value="<?php echo date(Y-m-d); ?>" <?php if($privilege == 'user'){ echo 'disabled'; } ?> required>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-2 control-label"><?php echo caption('Type'); ?> <span class="req">*</span></label>
                    <div class="col-md-5">
                        <select name="transaction_type" class="form-control" required>
                            <option value="" selected disabled>-- <?php echo caption('Select'); ?> --</option>
                            <option value="প্রদান"><?php echo caption('Payable'); ?></option>
                            <option value="গ্রহন"><?php echo caption('Receivable'); ?></option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-md-2 control-label"><?php echo caption('Transaction_by'); ?> <span class="req">*</span></label>
                    <div class="col-md-5">
                        <input type="text"  name="transaction_by" class="form-control" required />
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-2 control-label"><?php echo caption('Amount'); ?> <span class="req">*</span></label>
                    <div class="col-md-5">
                        <input type="text" name="amount" placeholder="<?php echo caption('BDT'); ?>" class="form-control" required>
                    </div>
                </div>   

                <div class="col-md-7">
                    <div class="btn-group pull-right">
                        <input type="submit" value="<?php echo caption('Save'); ?>" name="save" class="btn btn-primary">
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
        
        <?php if($transaction!= null){?>
        <div class="panel panel-default">
            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1>All Transaction</h1>
                </div>
            </div>

            <div class="panel-body">
            	<table class="table table-bordered">
            		<tr class="active">
            			<th>SL</th>
            			<th>Date</th>
            			<th>Transaction Type</th>
            			<th>Transaction By</th>
            			<th>Amount</th>
            		</tr>
            		<?php foreach($transaction as $key => $value) {?>
            		<tr>
            			<td><?php echo $key+1; ?></td>
            			<td><?php echo $value->date; ?></td>
            			<td><?php echo $value->transaction_type; ?></td>
            			<td><?php echo $value->transaction_by; ?></td>
            			<td><?php echo $value->amount; ?></td>
            		</tr>
            		<?php } ?>
            	</table>
            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
        <?php } ?>
    </div>
</div>

