<style>
    @media print{
        aside, .panel-heading, .panel-footer, nav, .none{display: none !important;}
        .panel{border: 1px solid transparent;left: 0px;position: absolute;top: 0px;width: 100%;}
        .hide{display: block !important;}
        table tr th,table tr td{font-size: 12px;}
    }
    .action-btn a{
        margin-right: 0;
        margin: 3px 0;
    }
</style>

<div class="container-fluid" ng-controller="AddClientCtrl">
    <div class="row">
        <?php echo $this->session->flashdata('confirmation'); ?>

        <div class="panel panel-default none">
            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1>Add New Field</h1>
                </div>
            </div>

            <div class="panel-body">
                <!-- horizontal form -->
                <?php
                $attr = array("class" => "form-horizontal");
                echo form_open_multipart('sr/sr/field', $attr); ?>

                <div class="form-group">
                    <label class="col-md-2 control-label">Field Name <span class="req">*</span></label>
                    <div class="col-md-6">
                        <input type="text" name="field_name" class="form-control" required>
                    </div>
                </div>

                <div class="col-md-8">
	                    <div class="btn-group pull-right">
	                        <input type="submit" name="add_field" value="Save" class="btn btn-primary">
	                    </div>
                </div>

                <?php echo form_close(); ?>
            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>


        <div class="panel panel-default" id="data">
            <div class="panel-heading">
                <div class="panal-header-title">
                    <h1 class="pull-left">All SR Field</h1>
                    <a class="btn btn-primery pull-right" style="font-size: 14px; margin-top: 0;" onclick="window.print()"><i class="fa fa-print"></i> Print</a>
                </div>
            </div>

            <div class="panel-body">

                <!-- Print banner -->
                
                <div class="row hide">
                    <div class="view-profile">

                        <div class="institute">
                            <h2 class="text-center title" style="margin-top: 10px; font-weight: bold;">
                                <?php $print_header = config_item('heading');echo $print_header['title']; ?>
                            </h2>
                            <h4 class="text-center" style="margin: 0;">
                                <?php $print_header = config_item('heading');echo $print_header['place']; ?>
                            </h4>
                            <h4 class="text-center" style="margin: 0;">
                              Mobile: <?php $print_header = config_item('heading');echo $print_header['mobile']; ?>
                            </h4>
                        </div>                          
                      
                    </div>
                </div>

                <h4 class="text-center hide" style="margin-top: 0px;">All SR Field</h4>

                <table class="table table-bordered table-hover">
                    <tr>
                        <th width="50">SL</th>
                        <th>Field Name</th>
                        <th class="none" style="width: 60px;">Action</th>
                    </tr>

                    <?php foreach ($fieldInfo as $key => $value) { ?>
                    <tr>
                        <td><?php echo $key+1; ?></td>
                        <td><?php echo $value->field_name; ?></td>
                        <td class="none action-btn">

                            <?php if (ck_action('sr_menu','delete')) { ?>
                            <a
                                onclick="return confirm('Do you want to delete this SR Field?');" class="btn btn-danger"
                                title="Delete"
                                href="<?php echo site_url('sr/sr/delete_field/'.$value->id); ?>">
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                            </a>
                            <?php }  ?>

                        </td>
                    </tr>
                    <?php } ?>
                </table>
            </div>

            <div class="panel-footer">&nbsp;</div>
    </div>
</div>
