<style>
    @media print {
        aside, nav, .none, .panel-heading, .panel-footer{
            display: none !important;
        }
        .panel{
            border: 1px solid transparent;
            left: 0px;
            position: absolute;
            top: 0px;
            width: 100%;
        }
        .hide{
            display: block !important;
        }
    }
    
    figure{
        height: 110px;
    }
    figure img {
        width: 100%;
        height: 100%;
        vertical-align: top;
        position: absolute;
    }
</style>


<div class="container-fluid">
    <div class="row">
        <?php if(isset($confirm)){echo $confirm;} ?>

        <div class="panel panel-default">
            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1>Global Images</h1>
                </div>
            </div>

            <div class="panel-body">
                    <!-- horizontal form -->
                    <?php
                        $attr=array("class"=>"form-horizontal");
                        echo form_open_multipart('', $attr);

                    $global = json_decode($global[0]->global);
                    ?>
                    
                    <div class="form-group">
                        <div class="col-md-12">
                            <figure>
                                <img class="img-responsive" style="width: 95%;" src="<?php echo site_url($global->path); ?>" alt="Pic Not Update !">
                            </figure>
                        </div>
                    </div>
                    
                    
                    <input type="hidden" name="old" value="<?php echo $global->path; ?>">
                    <div class="form-group">
                        <label class="col-md-offset-1 col-md-3 control-label">Global Image</label>
                        <div class="col-md-5">
                            <input id="input-test" type="file" name="attachFile" class="form-control file" data-show-preview="true" data-show-upload="true" data-show-remove="false">
                            <small>Image size must be : 1170px X 110px</small>
                        </div>
                    </div>


                    <div class="col-md-9">
                        <div class="btn-group pull-right">
                            <input type="submit" name="save" value="Save" class="btn btn-success">
                        </div>
                    </div>

                <?php echo form_close(); ?>
            </div>
            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>