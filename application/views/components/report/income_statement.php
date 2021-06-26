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
    table tr td:nth-child(3), table tr td:nth-child(4){
        text-align: center;
    }
</style>

<div class="container-fluid">
    <div class="row">

        <div class="panel panel-default">

            <div class="panel-heading">
                <div class="panal-header-title pull-left">
                    <h1><?php echo caption('Income_Statement') ;?></h1>
                </div>
            </div>

            <div class="panel-body none">

                <div class="row">
                    <?php 
                    $attr = array (
                        'id'    => '',
                        'name'  => '',
                        'class' => 'form-horizontal'
                    );
                    echo form_open('', $attr); 
                    ?>

                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('From') ;?></label>
                        <div class="input-group date col-md-5" id="datetimepickerFrom">
                            <input type="text" name="date[from]" class="form-control" placeholder="YYYY-MM-DD">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('To') ;?></label>
                        <div class="input-group date col-md-5" id="datetimepickerTo">
                            <input type="text" name="date[to]" class="form-control" placeholder="YYYY-MM-DD">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>

                    <div class="col-xs-7">
                        <div class="btn-group pull-right">
                            <input type="submit" value="<?php echo caption('Show') ;?>" name="show" class="btn btn-primary">
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>

        <div class="panel-footer">&nbsp;</div>
        </div>

            <div class="panel panel-default">
                
                <div class="panel-heading">
                    <div class="panal-header-title">
                        <h1 class=" pull-left"><?php echo caption('Result') ;?></h1>
                        <a class="btn btn-primery pull-right" style="font-size: 14px; margin-top: 0;" onclick="window.print()"><i class="fa fa-print"></i> <?php echo caption('Print') ;?></a>
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

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <caption style="background: rgba(189, 187, 187, 0.1);text-align: center;color: #111;border: 1px solid #ddd;border-bottom: none;font-size: 18px;padding: 10px;">
                            <?php echo caption('Income_Statement') ;?> <br> January 26,2017 - Julay 26,2017 
                        </caption>
                        <tr>
                            <th width="45"><?php echo caption('SL') ;?></th>
                            <th><?php echo caption('Purpose') ;?> </th>
                            <th class="text-center"><?php echo caption('Debit') ;?></th>
                            <th class="text-center"><?php echo caption('Cradit') ;?></th>
                        </tr>
                        <tr>
                            <td>01</td>
                            <td>Cash</td>
                            <td>4500</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>02</td>
                            <td>Account Receivable</td>
                            <td>4500</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>03</td>
                            <td>All Cost Field</td>
                            <td>4500</td>
                            <td></td>
                        </tr>
                        <tr style="font-weight: bold;">
                            <td>04</td>
                            <td class="text-right"><?php echo caption('Total_Revenues') ;?></td>
                            <td></td>
                            <td style="text-align: right;">45,0000</td>
                        </tr>
                        <tr style="font-weight: bold;">
                            <td>05</td>
                            <td><?php echo caption('Expenses_Losses') ;?></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>06</td>
                            <td>Rent</td>
                            <td>4500</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>07</td>
                            <td>5 Salaries</td>
                            <td>4500</td>
                            <td></td>
                        </tr>
                         <tr>
                            <td>08</td>
                            <td>Wages</td>
                            <td>4500</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>09</td>
                            <td>Utility Expense </td>
                            <td>4500</td>
                            <td></td>
                        </tr>
                         <tr>
                            <td>10</td>
                            <td>Purchase </td>
                            <td>4500</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>11</td>
                            <td>Advertising</td>
                            <td>4500</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>12</td>
                            <td>Other Expense</td>
                            <td>4500</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>13</td>
                            <td>Account Payable</td>
                            <td></td>
                            <td>2000</td>
                        </tr>
                        <tr>
                            <td>14</td>
                            <td>Bank Load </td>
                            <td></td>
                            <td>2000</td>
                        </tr>
                        <tr>
                            <td>15</td>
                            <td>Sales </td>
                            <td></td>
                            <td>2000</td>
                        </tr>
                        <tr>
                            <td>16</td>
                            <td>Owner Investment </td>
                            <td></td>
                            <td>2000</td>
                        </tr>
                        <tr>
                            <td>17</td>
                            <td>Owner WithDrawl</td>
                            <td></td>
                            <td>2000</td>
                        </tr>
                        <tr style="font-weight: bold;">
                            <td colspan="2" class="text-right"><?php echo caption('Total_Expenses_Losses') ;?></td>
                            <td></td>
                            <td style="text-align: right;">(20,0000)</td>
                        </tr>
                        <tr style="font-weight: bold;">
                            <td colspan="2" class="text-right"><?php echo caption('Net_Income') ;?> </td>
                            <td></td>
                            <td style="text-align: right;">(20,0000)</td>
                        </tr>
                    </table>
                </div>

                <div class="panel-footer">&nbsp;</div>

            </div>

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
