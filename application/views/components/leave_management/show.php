<style>
      @media print{
        aside{
            display: none !important;
        }
        nav{
            display: none;
        }
        .panel{
            border: 1px solid transparent;
            width: 100%;
            top: 0;
            left: 0;
            position: absolute;
        }
        .none{
            display: none;
        }
        .panel-heading{
            display: none;
        }
        .panel-footer{
            display: none;
        }
        .hide{
            display: block !important;
        }
    }
</style>

<div class="container-fluid">
    <div class="row">

        <div class="panel panel-default none">

            <div class="panel-heading">
                <div class="panal-header-title pull-left">
                    <h1><?php echo caption('All_Leave_list'); ?></h1>
                </div>
            </div>

            <div class="panel-body">
                <!-- horizontal form -->
                <?php 
                $attribute = array("class" => "form-horizontal");
                echo form_open('', $attribute);
                ?>
                <div>
                    <label class="col-md-2 control-label">
                        <?php echo caption('Employee_Name'); ?>
                        <span class="req">*</span>
                    </label>

                    <div class="col-md-5">
                        <select name="id" class="form-control" required>
                            <option value="" selected disabled>-- <?php echo caption("Select"); ?> --</option>
                            <?php 
                            if($employee != null){
                                foreach($employee as $key => $row){
                            ?>
                            <option value="<?php echo $row->emp_id; ?>">
                                <?php echo $row->name; ?>
                            </option>
                            <?php }} ?>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <div class="btn-group">
                            <input type="submit" value="<?php echo caption('View'); ?>" name="show" class="btn btn-primary">
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>

            </div>
            <div class="panel-footer">&nbsp;</div>
        </div>


        <?php if($leave != null){ ?>
        <div class="panel panel-default">
            <div class="panel-heading none">
                <div class="panal-header-title">
                    <h1 class="pull-left"><?php echo caption('Show_Result'); ?></h1>
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

                <h4 class="hide text-center" style="margin: -10px 0 20px 0;">Leave List</h4>

                <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th><?php echo caption('SL'); ?></th>
                        <th><?php echo caption('Form'); ?></th>
                        <th><?php echo caption('To'); ?></th>
                        <th><?php echo caption('Day'); ?></th>
                        <th><?php echo caption('For_the_holidays'); ?></th>
                        <th style="width: 60px;" class="none"><?php echo caption('Action'); ?></th>
                    </tr>

                    <?php foreach($leave as $key => $val){ ?>
                    <tr>
                        <td><?php echo ($key + 1); ?></td>
                        <td><?php echo $val->date_from; ?></td>
                        <td><?php echo $val->date_to; ?></td>
                        <td>
                        <?php 
                        $from = date_create($val->date_from);
                        $to = date_create($val->date_to);
                        $diff = date_diff($from, $to);
                        echo ($diff->days + 1) . " Days";
                        // echo $diff->format("%a days");
                        ?>
                        </td>
                        <td><?php echo $val->cause; ?></td>
                        <td class="none" style="width: 60px;">
                            <?php if(ck_action("leave_management","delete")){ ?>
                            <a class="btn btn-danger" href="<?php echo site_url('leave_management/leaveView/delete?id=' . $val->id); ?>" onclick="return confirm('Are you sure?')">
                               <i class="fa fa-trash-o" aria-hidden="true"></i>
                            </a>
                            <?php } ?>                        
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                </div>
            </div>
            <div class="panel-footer">&nbsp;</div>
        </div>
        <?php } ?>

    </div>
</div>

<script>
    // linking between two date
    $('#datetimepickerSMSFrom').datetimepicker({
        format: 'YYYY-MM-DD',
        useCurrent: false
    });
    $('#datetimepickerSMSTo').datetimepicker({
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

