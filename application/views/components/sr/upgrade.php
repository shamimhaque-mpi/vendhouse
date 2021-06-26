<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" />
<div class="container-fluid">
    <div class="row">
        <?php echo $confirmation; ?>

        <div class="panel panel-default">
            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1>Edit</h1>
                </div>
            </div>

            <div class="panel-body">
                <!-- horizontal form -->
                <?php
                $attr = array("class" => "form-horizontal"); 
                echo form_open('sr/sr/edit' . '?id=' . $this->input->get('id'), $attr);
                ?>
                <div class="form-group">
                    <label class="col-md-2 control-label">Code <span class="req">*</span></label>
                    <div class="col-md-6">
                        <input type="text" name="code" class="form-control" value="<?php echo $SrInfo[0]->code; ?>" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label">SR Name</label>
                    <div class="col-md-6">
                        <input type="text" name="name" value="<?php echo $SrInfo[0]->name; ?>" class="form-control" >
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label">Username</label>
                    <div class="col-md-6">
                        <input type="text" name="username" value="<?php echo $SrInfo[0]->username; ?>" class="form-control" >
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label">Password</label>
                    <div class="col-md-6">
                        <input type="text" name="pass" value="<?php echo $SrInfo[0]->password; ?>" class="form-control" >
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label">Mobile</label>
                    <div class="col-md-6">
                        <input type="text" name="contact" value="<?php echo $SrInfo[0]->mobile; ?>" class="form-control"  >
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label">Field</label>
                    <div class="col-md-6">
                         <select name="field" class="selectpicker form-control" data-show-subtext="true" data-live-search="true" required>
                            <?php foreach($fieldInfo as $value){?>
                            <option <?php if( $value->field_name == $SrInfo[0]->field ){ echo 'selected';} ?> value="<?php echo $value->field_name; ?>"><?php echo ucfirst($value->field_name); ?></option>
                            <?php }?>
                        </select>
                        <!-- <input type="text" name="field" value="<?php echo $SrInfo[0]->field; ?>" class="form-control"  > -->
                    </div>
                </div>

                 <div class="form-group">
                    <label class="col-md-2 control-label">Target</label>
                    <div class="col-md-6  input-group">
                        <input type="number" name="target" min="0" value="<?php echo $SrInfo[0]->target; ?>"  class="form-control" step="any" >
                        <div class="input-group-addon">TK / month</div>
                    </div>
                </div>


                <div class="col-md-8">
                    <div class="btn-group pull-right">
                        <input type="submit" name="update" value="Update" class="btn btn-success">
                    </div>
                </div>

                <?php echo form_close(); ?>
            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js" ></script>