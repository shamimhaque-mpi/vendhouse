<style>
    @media print{
        aside, nav, .none, .panel-heading, .panel-footer {
            display: none !important;
        }
        .panel{
            border: 1px solid transparent;
            left: 0px;
            position: absolute;
            top: 0px;
            width: 100%;
        }
        .panel .hide{
            display: block !important;
        }
        .title{
            font-size: 25px;        
        }
    }
</style>
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
                        <label class="col-md-2 control-label">Bank Name <span class="req">*</span></label>
                        <div class="col-md-5">
                            <input type="text" name="bank_name" placeholder="Your Bank Name" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-md-7">
                    <div class="btn-group pull-right">
                        <input type="submit" value="<?php echo caption('Save') ;?>" name="sub" class="btn btn-primary">
                    </div>
                    </div>

                <?php echo form_close(); ?>

            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
        
        <div class="panel panel-default">
            <div class="panel-heading panal-header">
                <div class="panal-header-title">
                    <h1 class="pull-left">All Bank</h1>
                    <a class="btn btn-primery pull-right" style="font-size: 14px; margin-top: 0;" onclick="window.print()"><i class="fa fa-print"></i> <?php echo caption('Print') ;?></a>
                </div>
            </div>
            
            <div class="panel-body">
            
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th width="65"><?php echo caption('SL') ;?> </th>
                            <th width="150"><?php echo caption('Date') ;?>  </th>
                            <th><?php echo caption('Bank_Name') ;?>  </th>
                            <th width="65"><?php echo caption('Action') ;?>  </th>
                        </tr>
                        <?php foreach($all_bank as $key => $bank){?>
                        <tr>
                            <td> <?php echo $key+1; ?> </td>
                            <td> <?php echo $bank->date; ?> </td>
                            <td> <?php echo str_replace("_"," ",$bank->bank_name); ?>  </td>
                            
                            <td class="none" style="width: 115px;">                          
                                <?php if(ck_action("bank","delete")){ ?>
                                    <a class="btn btn-danger" onclick="return confirm('Are You Sure Want To Delete This Data ?');" href="?id=<?php echo $bank->id; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                <?php } ?>                        
                            </td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
            
            </div>
            
            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>