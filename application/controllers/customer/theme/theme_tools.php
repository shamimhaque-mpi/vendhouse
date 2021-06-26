<div class="container-fluid">
    <div class="row">
        <?php echo $confirmation; ?>

        <!--===================================================================================================-->
        <!--===============================Language Change Section Start here==================================-->
        <!--===================================================================================================-->
        <div class="panel panel-default">

            <div class="panel-heading">
                <div class="panal-header-title pull-left">
                    <h1><?php echo caption('Change_Language');?></h1>
                </div>
            </div>

            <div class="panel-body">
                 <?php
                    $attr=array(
                        "class"=>"form-horizontal"
                    );
                    echo form_open('', $attr);
                 ?>

                    <input type="hidden" name="theme_id" value="<?php echo custom_fetch($theme_data,'id')?>">
                    <div class="form-group">
                        <label class=" col-md-2 control-label"><?php echo caption('Language');?></label>
                        <div class="col-md-5">
                            <select class="form-control" name="language" id="">
                                <option <?php if($theme_data[0]->language=="en"){echo "selected";}?> value="en">English</option>
                                <option <?php if($theme_data[0]->language=="bn"){echo "selected";}?> value="bn">বাংলা</option>
                            </select>
                        </div>
                    </div>
                   
                    
                    <?php
                        $value=caption('Save');
                        $name="submit_language";
                        $class="btn-primary";

                        if (count($theme_data)>0) {
                            $value=caption('Update');
                            $name="update_language";
                            $class="btn-success";
                        }
                    ?>
                    
                    <div class="btn-group pull-right">
                        <input type="submit" value="<?php echo $value; ?>" name="<?php echo $name; ?>" class="btn <?php echo $class; ?>">
                    </div>
                <?php echo form_close(); ?>
                      
            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
        <!--===================================================================================================-->
        <!--=================================Language Change Section End here==================================-->
        <!--===================================================================================================-->
    </div>
</div>