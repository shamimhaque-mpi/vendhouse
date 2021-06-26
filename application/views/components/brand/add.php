<div class="container-fluid">
    <div class="row">
	<?php echo $this->session->flashdata('confirmation'); ?>
        <div class="panel panel-default">

            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1><?php echo caption('Add_New'); ?> <?php echo caption('Brand'); ?></h1>
                </div>
            </div>

            <div class="panel-body">

                <?php $attr = array(
                    'class' =>'form-horizontal'
                    );
	            echo form_open('brand/brand/add',$attr); ?>

<?php /*
                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('Category_Name'); ?> <span class="req">*</span></label>
                        <div class="col-md-5">
                            <select name="category" class="form-control">
                                <option value="">-- <?php echo caption('Select'); ?> --</option>
                                <?php foreach ($product_cats as $key => $cat) { ?>
                                <option value="<?php echo $cat->category; ?>"><?php echo str_replace('_',' ',$cat->category); ?></option>>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
*/ ?>

                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('Brandname'); ?> <span class="req">*</span></label>
                        
                        <div class="col-md-5">
                            <input type="text" name="brand" placeholder="" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-md-7">
                        <div class="btn-group pull-right">
                            <input type="submit" value="<?php echo caption('Save'); ?>" name="catetory_submit" class="btn btn-primary">
                        </div>
                    </div>

                <?php echo form_close(); ?>

            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>

