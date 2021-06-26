<div class="container-fluid">
    <div class="row">
    <?php echo $confirmation;
     ?>
        <div class="panel panel-default">

            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1><?php echo caption('Add_Employee') ;?> </h1>
                </div>
            </div>

            <div class="panel-body">


                <!-- horizontal form -->
                <?php
                    $attr=array("class"=>"form-horizontal");
                    echo form_open_multipart('', $attr);
                ?>

                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('ID') ;?> <span class="req">*</span></label>
                        <div class="col-md-5">
                            <input type="text" name="emp_id" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('Name') ;?> <span class="req">*</span></label>
                        <div class="col-md-5">
                            <input type="text" name="full_name" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('Joining_Date') ;?> <span class="req">*</span></label>
                        <div class="input-group date col-md-5" id="datetimepicker1">
                            <input type="text" name="joining_date" class="form-control" value="<?php echo date('Y-m-d'); ?>" <?php if($privilege == 'user'){ echo 'disabled'; } ?> required>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                    
                    <script type="text/javascript">
                            $(document).ready(function(){
		                $('#datetimepicker1').datetimepicker({
		                    format: 'YYYY-MM-DD'
		                });
		            });
                    </script>

                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('Gender') ;?> <span class="req">*</span></label>
                        <div class="col-md-5">
                            <label class="radio-inline">
                                <input type="radio" name="gender" value="Male" checked> <?php echo caption('Male') ;?> 
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="gender" value="Female" > <?php echo caption('Female') ;?> 
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('Mobile_Number') ;?> <span class="req">*</span></label>
                        <div class="col-md-5">
                            <input type="text" name="mobile_number" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('Email') ;?> <span class="req">&nbsp; </span></label>
                        <div class="col-md-5">
                            <input type="text" name="email" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('Present_Address') ;?> <span class="req">*</span></label>
                        <div class="col-md-5">
                            <textarea name="present_address" id="pre_addr" class="form-control" cols="30" rows="5" required></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('Permanent_Address') ;?><span class="req">*</span></label>
                        <div class="col-md-5">
                            <input type="checkbox" id="permanent_address" value="0"> <label for="permanent_address"><?php echo caption('Same_As_Present_Address') ;?> </label>
                            <textarea name="permanent_address" id="per_addr" class="form-control" cols="30" rows="5" required></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('Designation') ;?>  <span class="req">*</span></label>
                        <div class="col-md-5" >
                            <select name="designation" class="form-control" >
                                <option value="">-- <?php echo caption('Select') ;?> --</option>
                                <?php foreach (config_item('desigation') as $value) { ?>
                                    <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                                <?php } ?>

                            </select>
                        </div>
                    </div>

                    <div class="form-group" >
                        <label class="col-md-2 control-label"><?php echo caption('Salary') ;?> </label>
                        <div class="col-md-5">
                            <input type="text" name="salary" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('Image') ;?>  <span class="req">*</span></label>
                        <div class="col-md-5">
                            <input id="input-test" type="file" name="attachFile" class="form-control file" data-show-preview="false" data-show-upload="false" data-show-remove="false">
                        </div>
                    </div>


                    <div class="col-md-7">
                        <div class="btn-group pull-right">
                            <input type="submit" name="add_emp" value="<?php echo caption('Save') ;?>" class="btn btn-primary">
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
