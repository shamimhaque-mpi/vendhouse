<div class="container-fluid">
    <div class="row">
    <?php echo $this->session->flashdata("confirmation");?>

        <div class="panel panel-default">

            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1>Affiliate Product</h1>
                </div>
            </div>

            <div class="panel-body">
                <!-- horizontal form -->

                <div class="col-xs-12 no-padding">
                    <?php
                    $attr=array(
                        'class'=>'form-horizontal'
                        );
                     echo form_open("",$attr); ?>
                    <div class="form-group">
                        <label class="col-md-2 control-label"> Embed Code<span class="req">*</span></label>

                        <div class="col-md-5">
                          <textarea class="form-control" name="embed_code" rows="5"></textarea>
                        </div>
                    </div>
                       
                    <div class="col-md-7">
                    <div class="btn-group pull-right">
                        <input type="submit" name="save" value="Save" class="btn btn-primary">
                    </div>
                    </div>
                <?php form_close(); ?>
                </div>
            </div>
            <div class="panel-footer">&nbsp;</div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1>All Affiliate Products</h1>
                </div>
            </div>

            <div class="panel-body">
            <?php if ($products != null) {?>

                <table class="table table-bordered">
                    <tr>
                        <th>SL</th>
                        <th>Affiliate Product</th>
                        <th width="80">Action</th>
                    </tr>

                    <?php foreach ($products as $key => $row) { ?>

                    <tr>
                        <td><?php echo $key+1; ?></td>
                        <td><?php echo $row->embed_code; ?></td>
                        <td>
                            <a class="btn btn-danger" onclick="return confirm('Are you sure to delete this Data?');" href="?delete_token=<?php echo $row->id ?>"><i class="fa fa-trash"></i> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
            <?php }else{
                    echo "<h4 style='text-align:center;color:#d00;'>No Advertisement Found!</h4>";
                } ?>
            </div>
            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>

