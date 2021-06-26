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

        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panal-header-title ">
                    <h1 class="pull-left"><?php echo caption('Due_List'); ?></h1>
                    <a class="btn btn-primery pull-right" style="font-size: 14px; margin-top: 0;" onclick="window.print()"><i class="fa fa-print"></i> <?php echo caption('Print'); ?></a>
                </div>
            </div>

            <div class="panel-body">
		<?php
                    $attr=array("class"=>"form-horizontal");
                    echo form_open('', $attr);
                ?>
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
                
                <div class="col-md-4">
	                <div class="form-group">
				<input type="text" id="search" class="form-control" placeholder="Search....">
	                </div>
	        </div>
                <?php if($allDue != null){ ?>
                <table id="table" class="table table-bordered table2">
                    <tr>
                        <th style="width: 70px;"><label><input type="checkbox" id="check_all"> <?php echo caption('SL'); ?></label></th>
                        <th><?php echo caption('Date'); ?></th>
                        <th><?php echo caption('Name'); ?></th>
                        <th><?php echo caption('Mobile'); ?></th>
                        <th><?php echo caption('Voucher_number'); ?></th>                        
                        <th><?php echo caption('Amount'); ?></th>
                        <th><?php echo caption('Payment'); ?></th>
                        <th><?php echo caption('Due'); ?></th>
                        <th>Discount</th>
                        <th width="165" class="none"><?php echo caption('Action'); ?></th>
                    </tr>
                    
                    <?php 
                    	$total_1 = 0;
                    	$total_2 = 0;
                    	$total_3 = 0;
                    	$total_4 = 0;
                    	foreach($allDue as $key => $row){ 
                    ?>
                    <tr class="tb_row">
                        <td><label><input type="checkbox" name="mobiles[]" value="<?php echo $row->mobile; ?>"> <?php echo ($key + 1); ?></label></td>
                        <td><?php echo $row->date; ?></td>
                        <td><?php echo $row->name; ?></td>
                        <td><?php echo $row->mobile; ?></td>
                        <td><?php echo $row->voucher_number; ?></td>                        
                        <td><?php echo $row->grand_total; ?></td>
                        <td><?php echo $row->paid; ?></td>
                        <td><?php echo $row->due; ?></td>
                        <td><?php echo $row->remission; ?></td>
                        <td class="none">
                            <a href="<?php echo site_url('sale/due/due_payment_view?vno=' . $row->voucher_number); ?>" class="btn btn-primary"><i class="glyphicon glyphicon-eye-open"></i></a>
                            <a href="<?php echo site_url('sale/due/due_payment?vno=' . $row->voucher_number); ?>" class="btn btn-primary"><i class="glyphicon glyphicon-usd"></i></a>
                            <a href="<?php echo site_url('sale/due/send_custom_sms?mob=' . $row->mobile); ?>" class="btn btn-success"><i class="glyphicon glyphicon-envelope"></i></a>
                        </td>
                    </tr>
                    <?php  

                         $total_1 += $row->grand_total;
                         $total_2 += $row->paid;
                         $total_3 += $row->due;
                         $total_4 += $row->remission;

                     } ?>
                     
                     <tr>
                        <td colspan="5" class="text-right"><strong>Total</strong></td>
                        <td colspan="1"><strong><?php echo $total_1; ?></strong></td>
                        <td colspan="1"><strong><?php echo $total_2; ?></strong></td>
                        <td colspan="1"><strong><?php echo $total_3; ?></strong></td>
                        <td colspan="1"><strong><?php echo $total_4; ?></strong></td>
                        <td colspan="1"><strong></strong></td>
                    </tr>
                </table>
                <?php } ?>
                <div class="col-md-offset-2 col-md-8">
			<div class="form-group">
				<textarea rows="4" class="form-control" ></textarea>
			</div>
                </div>
                <div class="col-md-2">
			<div class="btn-group" style="margin-top: 25px;">
				<input type="submit" value="Send" name="send" class="btn btn-info">
			</div>
                </div>
                <?php echo form_close(); ?>
            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>
<script>

//Check All Start here
    $('#check_all').on('change',  function(event) {
        if($(this).is(":checked")==true){
            $('input[name="mobiles[]"]').prop("checked",true);
        }else{
            $('input[name="mobiles[]"]').prop("checked",false);
        }
    });
//Check All End here

//Search All Start here
  var $rows = $('#table .tb_row');
  $('#search').keyup(function(){    
    //var val = '^(?=.*\\b' + $.trim($(this).val()).split(/\s+/).join('\\b)(?=.*\\b') + ').*$',
    var val = $(this).val(),
      reg = RegExp(val, 'i'),
      text;

      //console.log(reg);
    
    $rows.show().filter(function() {
      text = $(this).text().replace(/\s+/g, ' ')
      //console.log(text);
      return !reg.test(text);
    }).hide();
  });
//Search All end here
</script>