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
    <?php echo $confirmation; ?>
        <div class="panel panel-default none">

            <div class="panel-heading">
                <div class="panal-header-title pull-left">
                    <h1>All Credit Sale </h1>
                </div>
            </div>

            <div class="panel-body">

                <?php
                $attr=array("class"=>"form-horizontal");
                echo form_open("",$attr);?>

                <div class="form-group">
                    <label class="col-md-2 control-label">Member ID </label>

                    <div class="col-md-4">
                        <input type="text" name="search[member_id]" class="form-control" >
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label">From </label>
                    <div class="input-group date col-md-4" id="datetimepickerFrom">
                        <input type="text" name="date[from]" class="form-control" placeholder="YYYY-MM-DD">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label">To </label>
                    <div class="input-group date col-md-4" id="datetimepickerTo">
                        <input type="text" name="date[to]" class="form-control" placeholder="YYYY-MM-DD">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
                   
                <div class="col-md-6">
                    <div class="btn-group pull-right">
                        <input type="submit" name="show" value="Show" class="btn btn-primary">
                    </div>
                </div>
                    
                <?php echo form_close(); ?>
            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>

        <?php if($result != NULL){ ?>

        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panal-header-title ">
                    <h1 class="pull-left">Result</h1>
                    <a class="btn btn-primery pull-right" style="font-size: 14px; margin-top: 0;" onclick="window.print()"><i class="fa fa-print"></i> Print</a>
                </div>
            </div>

            <div class="panel-body">

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


                <hr class="hide" style="border-bottom: 1px solid #ccc; margin-top: 0;">
                <h4 class="text-center hide" style="margin-top: -10px;">All Credit Sales</h4>
                
                <table class="table table-bordered table2">
                    <tr>
                        <th>SL</th>
                        <th>Date</th>
                        <th>Member Name</th>
                        <th>Member ID</th>
                        <th>Price</th>
                        <th>Sales Type</th>
                        <th class="none">Action</th>
                    </tr>
               
                   <?php foreach($result as $key => $row){ ?>
                    <tr>
                        <td style="width: 50px;"> <?php echo ($key + 1); ?> </td>
                        <td style="width: 100px;"> <?php echo $row->date; ?> </td>

                        <td style="width: 100px;"> 
                            <?php 
                            $where = array('member_id' => $row->member_id); 
                            $info = $this->action->read('members', $where);
                            echo $info[0]->member_full_name;
                            ?> 
                        </td>

                        <td style="width: 100px;"> <?php echo $row->member_id; ?> </td>
                        <td style="width: 100px;"> <?php echo $row->total; ?> </td>
                        <td style="width: 100px;"> <?php echo ucwords(str_replace('_',' ',$row->status)); ?> </td>

                        <td class="none" style="width: 115px;">
                            <a title="View" class="btn btn-primary" href="<?php echo site_url('creditSale/viewcreditSale?vno=' . $row->voucher_number); ?>">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </a>
                            
                            <a title="Edit" class="btn btn-warning" href="<?php echo site_url('creditSale/editcreditSale?vno=' . $row->voucher_number); ?>">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </a>
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