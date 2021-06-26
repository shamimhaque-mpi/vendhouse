<div class="container-fluid">
    <div class="row">
    <?php echo $confirmation;
     ?>
        <div class="panel panel-default">

            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1>Add Member</h1>
                </div>
            </div>

            <div class="panel-body">
                <!-- horizontal form -->
                <?php
                $attr = array("class"=>"form-horizontal");
                echo form_open_multipart('', $attr);
                ?>

                <div class="form-group">
                    <label class="col-md-2 control-label">Member ID <span class="req">*</span></label>
                    <div class="col-md-5">
                        <input type="text" name="member_id" class="form-control" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label">Name <span class="req">*</span></label>
                    <div class="col-md-5">
                        <input type="text" name="full_name" class="form-control" required>
                    </div>
                </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Profession <span class="req">*</span></label>
                        <div class="col-md-5">
                            <input type="text" name="profession" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Father Name   <span class="req">*</span></label>
                        <div class="col-md-5">
                            <input type="text" name="father_name" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Thorp <span class="req">*</span></label>
                        <div class="col-md-5">
                            <input type="text" name="thorp" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Village  <span class="req">*</span></label>
                        <div class="col-md-5">
                            <input type="text" name="village" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Upazila <span class="req">*</span></label>
                        <div class="col-md-5">
                            <input type="text" name="police_station" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">District <span class="req">*</span></label>
                        <div class="col-md-5">
                            <input type="text" name="district" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Mobile Number <span class="req">*</span></label>
                        <div class="col-md-5">
                            <input type="text" name="mobile_number" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Photo <span class="req">*</span></label>
                        <div class="col-md-5">
                            <input id="input-test" type="file" name="attachFile" class="form-control file" data-show-preview="false" data-show-upload="false" data-show-remove="false">
                        </div>
                    </div> 

                    <div class="form-group" >
                        <label class="col-md-2 control-label">Signature <span class="req">&nbsp;</span></label>
                        <div class="col-md-5">
                            <input id="input-test" type="file" name="signature" class="form-control file" data-show-preview="false" data-show-upload="false" data-show-remove="false">
                        </div>
                    </div>

                    <div class="form-group" >
                        <label class="col-md-2 control-label">Employee <span class="req">&nbsp;</span></label>
                        <div class="col-md-5">
                            <select name="employee" class="form-control" required>
                                <option value="">&nbsp;</option>
                                <?php 
                                if($employee != null){
                                    foreach($employee as $key => $row){
                                ?>
                                <option value="<?php echo $row->emp_id; ?>">
                                    <?php echo $row->name; ?>
                                </option>
                                <?php }} ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-7">
                        <div class="btn-group pull-right">
                            <input type="submit" name="add_member" value="Save" class="btn btn-primary">
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
        $(".teachers_option").hide();
        $(".staff_option").hide();
        $("select#teacher_type").on("change", function(){
            if($(this).val() == "staff"){
                $(".teachers_option").fadeOut('slow');
                $(".staff_option").fadeIn('slow');
                $(".staff_option").show();
            }
            else{
                $(".teachers_option").fadeIn('slow');
                $(".teachers_option").show();
                $(".staff_option").fadeOut('slow');
            }
            
        });

        $("#permanent_address").on("click",function(){
            
            if ($(this).is(":checked")) {
                $("#per_addr").val($("#pre_addr").val());
            }
            else{
                $("#per_addr").val("");
            }
        });
    });
</script>