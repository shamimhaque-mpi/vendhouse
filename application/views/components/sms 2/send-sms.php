<style>
    p{
        display: inline-block;
        float: right;
    }
    p span .sms{
        border: 1px solid transparent;
        width: 40px;
    }
</style>

<div class="container-fluid" ng-controller="CustomSMSCtrl">
    <div class="row">

       <?php echo $confirmation;?>

        <div class="panel panel-default">

            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1><?php echo caption('Send_SMS'); ?></h1>
                </div>
            </div>



            <div class="panel-body">

                <?php
                    $attr=array('class'=>'form-horizontal');
                    echo form_open('', $attr);
                ?>

                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('Class'); ?> <span class="req">*</span></label>

                        <div class="col-md-5">
                            <select name="search[class]" class="form-control">
                                <option value="">&nbsp;</option>
                                <?php 
                                    foreach (config_item('classes') as $key => $value) {?>
                                        <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                    <?php
                                    }
                                ?>
                                
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('Section'); ?> <span class="req">*</span></label>

                        <div class="col-md-5">
                            <select name="search[session]" class="form-control">                       
                                <option value="">&nbsp;</option>
                               <?php foreach ($session_list as $key => $value) { ?>
                               <option value="<?php echo $value->session; ?>"><?php echo $value->session; ?></option>
                               <?php } ?>
                               
                            </select>
                        </div>
                    </div> 

                    <div class="col-md-7">
                    <div class="btn-group pull-right">
                        <input type="submit" value="<?php echo caption('Show_btn'); ?>" name="viewQuery" class="btn btn-primary">
                    </div>
                    </div> 

                <?php echo form_close(); ?>

            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panal-header-title pull-left">
                    <h1><?php echo caption('Mobile_number_and_SMS'); ?></h1>
                </div>
            </div>

            <div class="panel-body">

                <blockquote class="form-head">

                <!--h4>Set Subjects & Marks</h4-->
                <?php 
                	$sent_sms=0;
                	foreach($all_sms as $sms){
                		$sent_sms+=$sms->total_messages;
                	}

                ?>
                    <ol style="font-size: 14px;">
                        <li><?php echo caption('Select_mobile_number_and_click_send'); ?></li>
                        <li><?php echo caption('Total_SMS'); ?> <strong><?php echo $total_sms; ?></strong>, &nbsp;  <?php echo caption('Total_Send_SMS'); ?> <strong><?php echo $sent_sms; ?></strong>, &nbsp; <?php echo caption('Remaining_SMS'); ?> <strong><?php echo $total_sms-$sent_sms; ?></strong></li>
                    </ol>

                </blockquote>

                <?php
                    $attr=array('class'=>'form-horizontal');
                    echo form_open('', $attr);
                    if ($student_info!=null) {
                ?>

                    <div class="form-group">
                        <label class="col-md-3 control-label"><?php echo caption('Mobile'); ?> <span class="req">*</span></label>

                        <div class="col-md-9">
                            <div class="form-element table-responsive" style="height: 130px;">
                            <table class="table">
                                <tr>
                                    <th><?php echo caption('Name'); ?></th>
                                    <th><?php echo caption('Roll'); ?></th>
                                    <th><?php echo caption('Mobile'); ?></th>
                                </tr>
                            <?php 
                             foreach ($student_info as $key => $student) { 
                               $info=$this->retrieve->read("registration",array('id'=>$student->student_id));
                               //print_r($info);
                                ?>
                                <tr>
                                    <td><?php echo $info[0]->name;?></td>
                                    <td><?php echo $student->roll;?></td>
                                    <td>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="mobile[]" value="<?php echo $info[0]->student_mobile; ?>" checked><?php echo $info[0]->student_mobile;?></label>        
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                            </table>
                            </div>
                        </div>
                    </div>
                    <?php } ?>

                    <div class="form-group">
                        <label class="control-label col-md-3"><?php echo caption('Message'); ?> <span class="req">*</span></label>
                        <div class="col-md-9">
                            <textarea name="message" ng-model="msgContant" class="form-control" cols="30" rows="5" placeholder="<?php echo caption('Type_Your_Message'); ?>" required></textarea>
                        </div>
                    </div>

                    <div class="clearfix">
                        <p>
                            <span><strong><?php echo caption('Total_characters'); ?></strong> 
                                <input name="total_characters" ng-model="totalChar" class="sms" type="text" >
                            </span>
                            &nbsp;  
                            <span><strong><?php echo caption('SMS_Size'); ?></strong> 
                                <input class="sms" name="total_messages" ng-model="msgSize" type="text" >
                            </span>
                        </p>
                    </div>

                    <div class="btn-group pull-right">
                        <input type="submit" name="sendSms" value="<?php echo caption('Send'); ?>" class="btn btn-primary">
                    </div>

                <?php echo form_close(); ?>

            </div>
            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>

