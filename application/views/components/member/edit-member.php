<style>
    .mrgb-15{
        margin-bottom: 15px;
    }
</style>
<div class="container-fluid">
    <div class="row">
<?php //echo "<pre>"; print_r($emp_info); echo "</pre>"; ?>
<?php echo $confirmation; ?>

        <div class="panel panel-default">
            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1>Edit</h1>
                </div>
            </div>

            <div class="panel-body">
                <?php
                $attr = array("class"=>"form-horizontal");
                echo form_open_multipart('member/member/edit_member?id=' . $this->input->get("id"), $attr);
                ?>
                
                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Member ID <span class="req">*</span></label>
                                <div class="col-md-8">
                                    <input type="text" name="member_id" value="<?php echo $member[0]->member_id; ?>" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Name </label>
                                <div class="col-md-8">
                                    <input type="text" name="full_name" placeholder="Type Full Name" value="<?php echo $member[0]->member_full_name; ?>" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Profession </label>
                                <div class="col-md-8">
                                    <input type="text" name="profession" value="<?php echo $member[0]->member_profession; ?>" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Father Name </label>
                                <div class="col-md-8">
                                    <input type="text" name="father_name" value="<?php echo $member[0]->member_father_name; ?>" class="form-control" required>
                                </div>
                            </div>

                            <!-- <div class="form-group">
                                <label class="col-md-2 control-label">মাতার নাম </label>
                                <div class="col-md-5">
                                    <input type="text" name="mother_name" class="form-control" required>
                                </div>
                            </div> -->

                            <div class="form-group">
                                <label class="col-md-4 control-label">Thorp </label>
                                <div class="col-md-8">
                                    <input type="text" name="thorp" value="<?php echo $member[0]->member_thorp; ?>" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Village </label>
                                <div class="col-md-8">
                                    <input type="text" name="village" value="<?php echo $member[0]->member_village; ?>" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Upazila </label>
                                <div class="col-md-8">
                                    <input type="text" name="police_station" value="<?php echo $member[0]->member_police_station; ?>" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">District </label>
                                <div class="col-md-8">
                                    <input type="text" name="district" value="<?php echo $member[0]->member_district; ?>" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Mobile Number </label>
                                <div class="col-md-8">
                                    <input type="text" name="mobile_number" value="<?php echo $member[0]->member_mobile_number; ?>" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Photo </label>
                                <div class="col-md-8">
                                    <input id="input-test" type="file" name="attachFile" class="form-control file" data-show-preview="false" data-show-upload="false" data-show-remove="false">
                                </div>
                            </div> 

                            <div class="form-group" >
                                <label class="col-md-4 control-label">Signature </label>
                                <div class="col-md-8">
                                    <input id="input-test" type="file" name="signature" class="form-control file" data-show-preview="false" data-show-upload="false" data-show-remove="false">
                                </div>
                            </div>

                        <div class="form-group" >
                            <label class="col-md-4 control-label">Employee <span class="req">&nbsp;</span></label>
                            <div class="col-md-8">
                                <select name="employee" class="form-control" required>
                                    <option value="">&nbsp;</option>
                                    <?php 
                                    if($employee != null){
                                        foreach($employee as $key => $row){
                                    ?>
                                    <option value="<?php echo $row->emp_id; ?>" <?php if($member[0]->employee_id == $row->emp_id){echo "selected";} ?>>
                                        <?php echo $row->name; ?>
                                    </option>
                                    <?php }} ?>
                                </select>
                            </div>
                        </div>

                            <div class="btn-group pull-right">
                                <input type="submit" name="update_member" value="Update" class="btn btn-success">
                            </div>

                        </div>

                        <div class="col-md-5">
                            <div class="form-group">
                                <img src="<?php echo site_url($member[0]->member_photo); ?>" width="150px" height="150px" alt="Photo not found..!">
                            </div>
                            <div class="form-group">
                                <img src="<?php echo site_url($member[0]->member_sign); ?>" width="150px" height="50px" alt="Photo not found..!">
                            </div>
                        </div>
                    </div>
                <?php echo form_close(); ?>
            </div>
            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>
