<div class="container-fluid">
    <div class="row">
	<?php echo $this->session->flashdata('confirmation'); ?>
	
        <div class="panel panel-default">

            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1> Add Payment Method</h1>
                </div>
            </div>

            <div class="panel-body">

                <?php $attr = array(
                    'class' =>'form-horizontal'
                    );
	            echo form_open('paymentmethod/paymentmethod',$attr); ?>


                    <div class="form-group">
                        <label class="col-md-2 control-label">Method Name<span class="req">*</span></label>
                        <div class="col-md-5">
                            <select name="name" class="form-control" required>
                                <option value="">-- <?php echo caption('Select'); ?> --</option>
                                <option value="bkash"> Bkash</option>
                                <option value="nagad"> Nagad</option>
                                <option value="rocket"> Rocket</option>
                               
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-2 control-label">Type<span class="req">*</span></label>
                        <div class="col-md-5">
                            <select name="type" class="form-control" required>
                                <option value="">-- <?php echo caption('Select'); ?> --</option>
                                <option value="personal"> Personal</option>
                                <option value="agent"> Agent</option>
                                <option value="marchent"> Marchent</option>
                               
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-2 control-label">Number<span class="req">*</span></label>
                        
                        <div class="col-md-5">
                            <input type="text" name="number" placeholder="" class="form-control" required>
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
        
        
        <div class="panel panel-default">

            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1> All Payment Method</h1>
                </div>
            </div>

            <div class="panel-body">

                <table class="table table-bordered">
                    <tr>
                        <th>Sl</th>
                        <th>Name</th>
                        <th>Number</th>
                        <th>Type</th>
                        <th class="text-right">Action</th>
                    </tr>
                    
                    <?php foreach($methods as $key => $value){?>
                    <tr>
                        <td><?php echo $key+1;?></td>
                        <td><?php echo ucwords($value->name);?></td>
                        <td><?php echo $value->number;?></td>
                        <td><?php echo ucwords($value->type);?></td>
                        <td class="text-right">
                            <a onclick="deleteAlert(`<?php echo site_url('paymentmethod/paymentmethod/delete/'.$value->id)?>`)" class="btn btn-danger" href="">
                               <i class="fa fa-trash-o" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                    <?php }?>
                </table>

            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>

