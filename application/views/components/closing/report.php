<style>
    @media print{
        aside, nav, .panel-heading, .none, .panel-footer{
            display: none !important;
        }
        .panel{
            border: 1px solid transparent;
            left: 0px;
            position: absolute;
            top: 0px;
            width: 100%;
        }
        .panel .box-width{
            width: 100%;
            float: left;
        }
        .hide{
            display: block !important;
        }
    }
</style>

<div class="container-fluid">
    <div class="row">

        <div class="panel panel-default">

            <div class="panel-heading">
                <div class="panal-header-title pull-left">
                    <h1><?php echo caption('Report') ;?></h1>
                </div>
            </div>

            <div class="panel-body none">
                <div class="row">
                    <?php 
                    $attr = array ('class' => 'form-horizontal');
                    echo form_open('', $attr); 
                    ?>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Date</label>
                        <div class="input-group date col-md-5" id="datetimepickerFrom">
                            <input type="text" name="date" class="form-control" placeholder="YYYY-MM-DD" value="<?php echo date(Y-m-d); ?>" <?php if($privilege == 'user'){ echo 'disabled'; } ?> >

                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>

                    <div class="col-xs-7">
                        <div class="btn-group pull-right">
                            <input type="submit" value="<?php echo caption('Show') ;?>" name="search" class="btn btn-primary">
                        </div>
                    </div>

                    <?php echo form_close(); ?>
                </div>
            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
        



            <?php if($resultset != null){ ?>
            <div class="panel panel-default">
                
                <div class="panel-heading">
                    <div class="panal-header-title">
                        <h1 class=" pull-left"><?php echo caption('Result') ;?></h1>
                        <a class="btn btn-primery pull-right" style="font-size: 14px; margin-top: 0;" onclick="window.print()"><i class="fa fa-print"></i><?php echo caption('Print') ;?> </a>
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

                    <h4 class="hide text-center" style="margin-top: -10px;"><?php echo caption('Report') ;?></h4>
                   
                    <div class="row">
                        <div class="col-md-12 box-width">
                            <!-- pre><?php print_r($resultset); ?></pre -->

                            <div class="table-responsive">
                            <table class="table table-bordered ">
                            <?php foreach($resultset as $key => $row){ ?>
                                <tr>
                                    <td width="50%"><?php echo caption('Opening_Balance'); ?></td>
                                    <td><?php echo $row->opening; ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo caption('Income'); ?></td>
                                    <td><?php echo $row->income; ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo caption('Cost'); ?></td>
                                    <td><?php echo $row->cost; ?></td>
                                 </tr> 
                                 <tr>  
                                    <td><?php echo caption('Bank'); ?></td>
                                    <td><?php echo $row->bank; ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo caption('Cost'); ?>Cash In hand</td>
                                    <td><?php echo $row->hand_cash; ?></td>
                                </tr>
                                    
                                <?php } ?>                           
                            </table>
                            </div>
                       </div>                  
                    </div>
                </div>

                <div class="panel-footer">&nbsp;</div>
            </div>
            <?php } ?>
 
        </div>
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


