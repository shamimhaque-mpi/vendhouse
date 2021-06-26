<div class="container-fluid">
    <div class="row">

        <?php echo $confirmation; ?>

        <div class="panel panel-default">
            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1>Add Client</h1>
                </div>
            </div>

            <div class="panel-body">
                <?php
                $attribute = array("class" => "form-horizontal");
                echo form_open("party/client/edit?id=".$this->input->get("id"), $attribute);
                ?>

                <div class="form-group">
                    <label class="col-md-2 control-label">
                        Name
                        <span class="req">*</span>
                    </label>
                    
                    <div class="col-md-5">
                        <input type="text" name="name" value="<?php echo $resultset[0]->name; ?>" class="form-control" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label">
                        Mobile
                        <span class="req">*</span>
                    </label>

                    <div class="col-md-5">
                        <input type="text" name="mobile" value="<?php echo $resultset[0]->mobile; ?>" class="form-control" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label">
                        <?php echo caption('Address'); ?> 
                        <span class="req">*</span>
                    </label>

                    <div class="col-md-5">
                        <textarea name="address" rows="4" class="form-control" required><?php echo $resultset[0]->address; ?></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label">
                        Type
                        <span class="req">*</span>
                    </label>

                    <div class="col-md-5">
                        <select name="type" class="form-control" required>
                            <option value="regular" <?php if($resultset[0]->status == 'regular'){echo 'selected';} ?>>Regular</option>
                            <option value="irregular" <?php if($resultset[0]->status == 'irregular'){echo 'selected';} ?>>Irregular</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-7">
                    <div class="btn-group pull-right">
                        <input type="submit" name="change" value="Change" class="btn btn-primary">
                    </div>
                </div>
                    
                <?php echo form_close(); ?>
            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>