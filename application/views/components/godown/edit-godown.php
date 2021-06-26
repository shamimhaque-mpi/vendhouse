<div class="container-fluid">
    <div class="row">
        <?php echo $this->session->flashdata('confirmation'); ?>

        <div class="panel panel-default">
            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1><?php echo caption('Edit_Godown'); ?></h1>
                </div>
            </div>

            <div class="panel-body">
                <!-- pre><?php print_r($result); ?></pre -->
                <?php
                $attr = array("class" => "form-horizontal");
                echo form_open('godown/godown/edit_godown?id='.$this->input->get('id'), $attr);
                ?>

                <div class="form-group">
                    <label class="col-md-2 control-label"><?php echo caption('Place'); ?> </label>
                    <div class="col-md-5">
                        <input type="text" name="place" value="<?php echo $result[0]->place; ?>" class="form-control" >
                    </div>
                </div>

                 <div class="form-group">
                    <label class="col-md-2 control-label"><?php echo caption('Supervisor'); ?> </label>
                    <div class="col-md-5">
                        <input type="text" name="supervisor" value="<?php echo $result[0]->supervisor; ?>" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label"><?php echo caption('Contact_Number'); ?> </label>
                    <div class="col-md-5">
                        <input type="text" name="mobile" value="<?php echo $result[0]->contact_no; ?>" class="form-control">
                    </div>
                </div>

                
                <div class="form-group">
                    <label class="col-md-2 control-label"><?php echo caption('Address'); ?> <span class="req">*</span></label>
                    <div class="col-md-5">
                        <textarea name="address" rows="4" class="form-control" ><?php echo $result[0]->address; ?></textarea>
                    </div>
                </div> 

                <div class="col-md-7">
                    <div class="btn-group pull-right">
                        <input type="submit" name="update" value="<?php echo caption('Update'); ?>" class="btn btn-success">
                    </div>
                </div>
                    
                <?php echo form_close(); ?>
            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>

    </div>
</div>
