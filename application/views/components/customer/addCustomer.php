<div class="container-fluid">
    <div class="row">
	<?php echo $confirmation; ?>
        <div class="panel panel-default">

            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1><?php echo caption('Add_Category'); ?></h1>
                </div>
            </div>

            <div class="panel-body">

                <?php $attr = array(
                    'class' =>'form-horizontal'
                    );
	            echo form_open('',$attr); ?>

                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('Category_Name'); ?><span class="req">*</span></label>
                        
                        <div class="col-md-4">
                            <input type="text" name="category_name" placeholder="" class="form-control" required>
                        </div>
                        <div class="col-md-2">
                            <div class="btn-group">
                                <input type="submit" value="<?php echo caption('Add_New'); ?>" name="submit" class="btn btn-primary">
                            </div>
                        </div>
                    </div>

                <?php echo form_close(); ?>

            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>

