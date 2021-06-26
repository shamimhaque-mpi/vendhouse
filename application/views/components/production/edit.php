<div class="container-fluid">
    <div class="row">
	    <?php echo $confirmation; ?>

        <div class="panel panel-default">
            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1>প্রোডাকশন</h1>
                </div>
            </div>

            <div class="panel-body">
                <?php 
                $attr = array('class' => 'form-horizontal');
	            echo form_open_multipart('', $attr); 
                ?>

		<div class="row">
	                <div class="form-group">
	                    <label class="col-md-2 control-label">উপাদানের নাম <span class="req">*</span></label>
	                    <div class="col-md-5">
	                        <select class="form-control" required>
	                        	<option value="gold_1">Gold 1</option>
	                        	<option value="gold_2">Gold 2</option>
	                        </select>
	                    </div>
	                </div>
	
	                <div class="form-group">
	                    <label class="col-md-2 control-label">পরিমাণ (গ্রাম) <span class="req">*</span></label>
	                    <div class="col-md-5">
	                        <input type="text" name="qty" class="form-control">
	                    </div>
	                </div>
	
	                <div class="col-md-7">
	                    <div class="btn-group pull-right">
	                        <a href="#" class="btn btn-success" style="margin-bottom:20px;">যোগ করুন</a>
	                    </div>
	                </div>
                </div>
                
                <table class="table table-bordered">
                	<tr>
                		<th>ক্রঃনংঃ</th>
                		<th>উপাদান</th>
                		<th>পরিমাণ</th>
                		<th style="width:70px;">একশন</th>
                	</tr>
                	<tr>
                		<td>1</td>
                		<td>Gold 1</td>
                		<td>10</td>
                		<td><a href="#" class="btn btn-danger"><i class="fa fa-times"></i></a></td>
                	</tr>
                </table>
                
		<div class="row">
	                <div class="form-group">
	                    <label class="col-md-2 control-label">রগোল্ড  <span class="req">*</span></label>
	                    <div class="col-md-5">
	                        <input type="text" name="rowGold" class="form-control">
	                    </div>
	                </div>
	
	                <div class="form-group">
	                    <label class="col-md-2 control-label">পরিমাণ (গ্রাম) <span class="req">*</span></label>
	                    <div class="col-md-5">
	                        <input type="text" name="rowGold_qty" class="form-control">
	                    </div>
	                </div>
	
	                <div class="col-md-7">
	                    <div class="btn-group pull-right">
	                        <input type="submit" class="btn btn-primary" name="save" value="সেইভ">
	                    </div>
	                </div>
                </div>
                
                <?php echo form_close(); ?>
            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>