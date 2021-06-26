<style>
    @media print{
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
</style>

<div class="container-fluid">
    <div class="row">
        <?php  echo $this->session->flashdata('confirmation');  ?>
        <div class="panel panel-default none">

            <div class="panel-heading">
                <div class="panal-header-title pull-left">
                    <h1>All Free Products</h1>
                </div>
            </div>

            <div class="panel-body">

                <?php
                $attr = array("class" => "form-horizontal");
                echo form_open("", $attr);
                ?>

                <div class="form-group">
                    <label class="col-md-2 control-label"><?php echo caption('From'); ?> </label>
                    <div class="input-group date col-md-4" id="datetimepickerFrom">
                        <input type="text" name="date[from]" class="form-control" value="" placeholder="YYYY-MM-DD">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label"><?php echo caption('To'); ?> </label>
                    <div class="input-group date col-md-4" id="datetimepickerTo">
                        <input type="text" name="date[to]" class="form-control" placeholder="YYYY-MM-DD">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="btn-group pull-right">
                        <input type="submit" name="show" value="<?php echo caption('Show'); ?>" class="btn btn-primary">
                    </div>
                </div>

                <?php echo form_close(); ?>
            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>

   <?php if($result != NULL) { ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panal-header-title ">
                    <h1 class="pull-left"><?php echo caption('Result'); ?></h1>
                    <a class="btn btn-primery pull-right" style="font-size: 14px; margin-top: 0;" onclick="window.print()"><i class="fa fa-print"></i> <?php echo caption('Print'); ?></a>
                </div>
            </div>

            <div class="panel-body">
                <!-- Print Banner -->

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

                <hr class="hide" style="border-bottom: 2px solid #ccc; margin-top: 5px;">

                <table class="table table-bordered table2">
                    <tr>
                        <th><?php echo caption('SL'); ?></th>
                        <th>From <?php echo caption('Date'); ?></th>
                        <th>To  <?php echo caption('Date'); ?></th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Free Product</th>
                        <th>Free Quantity</th>
                        <th>Relation</th>
                        <th style="width: 150px;" class="none text-center"><?php echo caption('Action'); ?></th>
                    </tr>
                    <?php 
                      $relation = config_item('relation');
                      foreach ($result as $key => $value) { 
                    ?>
                        <tr>
                            <td><?php echo $key+1; ?></td>
                            <td><?php echo $value->from_date; ?></td>
                            <td><?php echo $value->to_date; ?></td>
                            <td><?php echo filter($value->product); ?></td>
                            <td><?php echo $value->quantity; ?></td>
                            <td><?php echo filter($value->free_product); ?></td>
                            <td><?php echo $value->free_quantity; ?></td>
                            <td><?php echo $relation[$value->relation]; ?></td>
                            <td class="text-center none">
                               <a class="btn btn-warning" href="<?php echo site_url('free_product/free_product/edit/'.$value->id) ;?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                               <a class="btn btn-danger" href="<?php echo site_url('free_product/free_product/delete/'.$value->id) ;?>" onclick="return confirm('Are you sure want to Delete this Data?');"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
    <?php } ?>

    </div>
</div>

<script>
    // linking between two date
    $('#datetimepickerFrom').datetimepicker({
        format: 'YYYY-MM-DD',
        useCurrent: false
    });
    $('#datetimepickerTo').datetimepicker({
        format: 'YYYY-MM-DD',
        useCurrent: false
    });
    $("#datetimepickerSMSFrom").on("dp.change", function (e) {
        $('#datetimepickerSMSTo').data("DateTimePicker").minDate(e.date);
    });
    $("#datetimepickerSMSTo").on("dp.change", function (e) {
        $('#datetimepickerSMSFrom').data("DateTimePicker").maxDate(e.date);
    });
</script>
