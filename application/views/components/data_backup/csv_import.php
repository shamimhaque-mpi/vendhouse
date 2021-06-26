<div class="container-fluid">
    <div class="row">
    <?php echo $this->session->flashdata('confirmation'); ?>
        <div class="panel panel-default">

            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1><?php echo caption('Import_Data'); ?> From CSV</h1>
                </div>
            </div>

            <div class="panel-body">

                <?php
                     $attr=array("class"=>"form-horizontal");
                     echo form_open_multipart('', $attr);
                 ?>

                  <div class="form-group">
                     <label class="col-md-2 control-label">Table <span class="req">*</span></label>
                     <div class="col-md-5">
                         <select class="form-control" name="table" required>
                             <option value="" disabled selected>Select Table Name</option>
                             <?php
                                if($allTables != NULL){
                                foreach ($allTables as $key => $value) { ?>
                                    <option value="<?php echo $value->Tables_in_supershop; ?>"><?php echo $value->Tables_in_supershop; ?></option>
                              <?php } } ?>
                         </select>
                     </div>
                  </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('Select_File'); ?> <span class="req">*</span></label>
                        <div class="col-md-5">
                            <input id="input-test" type="file" name="datafile" class="form-control file" data-show-preview="false" data-show-upload="false" data-show-remove="false" accept=".csv" required>
                        </div>
                     </div>


                    <div class="col-md-7">
                    <div class="btn-group pull-right">
                        <input type="submit" name="upload" value="Import" class="btn btn-primary">
                    </div>
                    </div>

                <?php echo form_close(); ?>

            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>
