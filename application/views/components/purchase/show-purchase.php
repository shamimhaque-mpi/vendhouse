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
        <div class="panel panel-default none">

            <div class="panel-heading">
                <div class="panal-header-title pull-left">
                    <h1><?php echo caption('All_Purchase'); ?></h1>
                </div>
            </div>

            <div class="panel-body">

                <?php
                echo $this->session->flashdata('deleted');

                $attr = array("class" => "form-horizontal");
                echo form_open("", $attr);
                ?>

                <div class="col-sm-5">
                    <div class="form-group">
                        <label class="col-md-4 control-label"><?php echo caption('Voucher_number'); ?> </label>
                        <div class="col-md-8">
                            <input type="text" name="search[voucher_no]" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label"><?php echo caption('Supplier_Name'); ?> </label>
                        <div class="col-md-8">
                            <select name="search[vendor_id]" class="form-control">
                                <option value="" selected disabled></option>
                                <?php if($allVendors != null){ foreach($allVendors as $key => $row){ ?>
                                <option value="<?php echo $row->id; ?>">
                                    <?php echo filter($row->name); ?>
                                </option>
                                <?php }} ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Category</label>
                        <div class="col-md-8">
                            <select name="search[category]" class="form-control">
                                <option value="" selected disabled></option>
                                <?php if($allCategory != null){ foreach($allCategory as $key => $row){ ?>
                                <option value="<?php echo $row->category; ?>">
                                    <?php echo filter($row->category); ?>
                                </option>
                                <?php }} ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="form-group">
                    <label class="col-md-4 control-label"><?php echo caption('From'); ?> </label>
                        <div class="input-group date col-md-8" id="datetimepickerFrom">
                            <input type="text" name="date[from]" class="form-control" placeholder="YYYY-MM-DD">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label"><?php echo caption('To'); ?> </label>
                        <div class="input-group date col-md-8" id="datetimepickerTo">
                            <input type="text" name="date[to]" class="form-control" placeholder="YYYY-MM-DD">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-4 control-label">Subcategory</label>
                        <div class="col-md-8">
                            <select name="search[subcategory]" class="form-control">
                                <option value="" selected disabled></option>
                                <?php if($allSubCategory != null){ foreach($allSubCategory as $key => $row){ ?>
                                <option value="<?php echo $row->subcategory; ?>">
                                    <?php echo filter($row->subcategory); ?>
                                </option>
                                <?php }} ?>
                            </select>
                        </div>
                    </div>
                </div>
                   
                <div class="col-md-10">
                    <div class="btn-group pull-right">
                        <input type="submit" name="show" value="<?php echo caption('Show'); ?>" class="btn btn-primary">
                    </div>
                </div>
                    
                <?php echo form_close(); ?>
            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
        
        <!--pre><?php //print_r($result);?></pre-->

        <?php if($result != null){ ?>
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
                                <?php $print_header = config_item('heading'); echo $vheaderInfo[0]->name; ?>
                            </h2>
                            <h4 class="text-center" style="margin: 0;">
                                <?php $print_header = config_item('heading'); echo $vheaderInfo[0]->address; ?>
                            </h4>
                            <div class="col-md-12">&nbsp;</div>
                            <h5 class="text-center" style="margin: 0;">
                              Mobile: <?php $print_header = config_item('heading'); echo $vheaderInfo[0]->mobile; ?>
                            </h5>
                            <div class="col-md-12">&nbsp;</div>
                        </div>                           
                      
                    </div>
                </div>
                
                <hr class="hide" style="border-bottom: 2px solid #ccc; margin-top: 5px;">

                <table class="table table-bordered table2">
                    <tr>
                        <th><?php echo caption('SL'); ?></th>
                        <th><?php echo caption('Date'); ?></th>
                        <th><?php echo caption('Voucher_number'); ?></th>
                        <th><?php echo caption('Supplier_Name'); ?></th>                      
                        <th><?php echo caption('Grand_Total'); ?></th>
                        <th><?php echo caption('Paid'); ?></th>
                        <th><?php echo caption('Due'); ?></th>
                        <th class="none text-center"><?php echo caption('Action'); ?></th>
                    </tr>
                    
                    <?php 
                     $total = $totalPaid = $totalDue =$transport_total =  0;
                     foreach($result as $key => $val){ ?>
                    <tr>
                        <td style="width: 50px;"><?php echo ($key + 1); ?></td>
                        <td><?php echo $val->date; ?></td>
                        <td><?php echo $val->voucher_no; ?></td>

                        <td>
                        <?php 
                        $where = array('id' => $val->vendor_id); 
                        $info = $this->action->read('vendor', $where);
                        if(count($info)>0){
                        	 echo $info[0]->vendor_name;
                        }else{
                        	echo "N/A";
                        }
                   
                        
                        ?>
                        </td>	
		
            			<td><?php echo $val->grand_total;  $total += $val->grand_total; ?></td>
            			<td><?php echo $val->paid; $totalPaid +=$val->paid; ?></td>
            			<td><?php echo $val->due;  $totalDue +=$val->due; ?></td>

                        <td class="none" style="width: 70px;">
                            <div class="dropdown pull-right">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-cog"></i>
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right ulbordertop">
                                    <li></li>
                                    
                                    <?php if(ck_action("purchase","view")){ ?>
                                    <li>
                                        <a href="<?php echo site_url('purchase/purchase/view?vno=' . $val->voucher_no); ?>"><?php echo caption('View'); ?> </a>
                                    </li>
                                    <?php } ?>

                                    <?php if(ck_action("purchase","edit")){ ?>                                    
                                    <li>
                                        <a href="<?php echo site_url('purchase/editPurchase?vno=' . $val->voucher_no); ?>"> <?php echo caption('Edit'); ?></a>
                                    </li>
                                    <?php } ?>

                                    <li>
                                        <a href="<?php echo site_url('purchase/return_purchase?vno=' . $val->voucher_no); ?>"> <?php echo caption('Return'); ?></a>
                                    </li>


                                    <!--li>
                                        <a onclick="return confirm('Are you sure to delete this data?');" href="<?php echo site_url('purchase/purchase/delete_purchase?vno=' . $val->voucher_no); ?>"><?php echo caption('Delete'); ?> </a>
                                    </li-->
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                    <tr>
                      <th class="text-right" colspan="4">Total</th>
                      <td><strong><?php echo $total; ?>&nbsp; TK</strong></td>
                      <td><strong><?php echo $totalPaid; ?>&nbsp; TK</strong></td>
                      <td><strong><?php echo $totalDue; ?>&nbsp; TK</strong></td>
                      <td></td>
                    </tr>
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