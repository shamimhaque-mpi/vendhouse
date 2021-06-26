

<div class="container-fluid">
    <div class="row">
        <?php echo $confirmation; ?>
        <div class="panel panel-default">

            <div class="panel-heading">
                <div class="panal-header-title pull-left">
                    <h1><?php echo caption('Opening') ;?></h1>
                </div>
            </div>

            <div class="panel-body none">

                <div class="row">
                    <?php 
                    $attr = array (
                        'class' => 'form-horizontal'
                    );
                    echo form_open('', $attr); 
                    ?>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Opening</label>
                        <div class="col-md-5">
                            <input type="text" name="opening_amount" value="<?php echo custom_fetch($opening_val,"hand_cash"); //$opening_val[0]->hand_cash; ?>" class="form-control">
                        </div>
                    </div>

                    <?php 

                        $name   = "update";
                        $value  = caption('Update');

                        if ($opening<1) {
                            $name   = "submit";
                            $value  = caption('Save');
                        }
                    ?>

                    <div class="col-xs-7">
                        <div class="btn-group pull-right">
                            <input type="submit" value="<?php echo $value; ?>" name="<?php echo $name; ?>" class="btn btn-primary">
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>

        <div class="panel-footer">&nbsp;</div>
        </div>
        
           