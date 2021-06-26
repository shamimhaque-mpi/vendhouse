<style>
    .topOfTable span{width: 35%; display: inline-block;}
    .tdNoBorder tr td{border-top: 1px solid transparent !important;}
    .v1 tr td{padding:2px 8px !important;}
    .table{margin-bottom: 0 !important; max-height: 528px !important;}
    @media print{
        .tab1{max-width: 288px;}
        .tab2{max-width: 480px;}
        aside, nav, .none, .panel-heading, .panel-footer{display: none !important;}
        .panel{
            border: 1px solid transparent;
            left: 0px;
            position: absolute;
            top: 0px;
            width: 100%;
        }
        .hide{display: block !important;}
        .font9{font-size: 9px !important;}
        .font11{font-size: 11px !important;}
    }
    .wid-150{width: 150px;}
    table tr td, table tr th{vertical-align: middle !important;}
</style>

<div class="container-fluid">
    <div class="row">

        <div class="panel panel-default ">
            <div class="panel-heading none">
                <div class="panal-header-title">
                    <h1 class="pull-left"><?php echo caption('Details'); ?></h1>               
                    <a class="btn btn-primery pull-right" style="font-size: 14px; margin-top: 0;" onclick="window.print()"><i class="fa fa-print"></i> <?php echo caption('Print'); ?></a>
                </div>
            </div>
            
            <div class="panel-body">
                <div class="col-xs-12 ">

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
                
                    <div class="table-responsive">
                        <table class="table topOfTable tdNoBorder">
		                <tr>
		                    <td><span><b>Client <?php echo caption('Name'); ?></b></span> :&nbsp; <?php echo filter($result[0]->name); ?></td>
		                    <td><span><b>Voucher No</b></span> :&nbsp; <?php echo $result[0]->voucher_number; ?></td>
		                </tr>
		                <tr>
		                    <td><span><b>Mobile </b></span> :&nbsp; <?php echo $result[0]->mobile; ?></td>
		                    <td><span><b><?php echo caption('Date'); ?></b></span> :&nbsp; <?php echo $result[0]->date; ?></td>
		                </tr>
		                <tr>
		                    <td>
		                        <?php $user_info = $this->action->read("users",array("username"=>$username)); ?>
		                        <span><b>Sales Man</b></span> :&nbsp; <?php echo filter($user_info[0]->name); ?>
		                    </td>
		                    <td><span><b>Time</b></span> :&nbsp; <?php echo $result[0]->time; ?></td>
		                </tr>
		                <tr>
		                    <td><span><b><?php echo caption('Total'); ?></b></span> :&nbsp; <?php echo $result[0]->total; ?> Tk</td>
		                </tr>
		            </table>
                    </div>
            
                    <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th width="50"><?php echo caption('SL'); ?></th>
                            <th class="text-center"><?php echo caption('Date');?></th>
                            <th class="text-center"><?php echo caption('Paid');?></th>
                            <th class="text-center"><?php echo caption('Due');?></th>
                            <th class="text-center">Discount</th>
                        </tr>
    
                        <?php foreach($dueHisroty as $key => $row){ ?>
                        <tr>
                            <td><?php echo $key+1; ?></td>
                            <td class="text-center"><?php echo $row->date; ?></td>
                            <td class="text-center"><?php echo $row->paid; ?></td>
                            <td class="text-center"><?php echo $row->due; ?></td>
                            <td class="text-center"><?php echo $row->remission; ?></td>
                        </tr>
                        <?php } ?>
                        <tr>
                            <th colspan="2" style="font-weight:bold;text-align:right"><?php echo caption('Total');?></th>
                            <th class="text-center">
				<?php
					$totalPaid = 0;
					echo $totalPaid = $result[0]->total - ($totalResult[0]->due + $totalResult[0]->remission); 
				?>
			    </th>
                            <th class="text-center"><?php echo $totalResult[0]->due; ?></th>
                            <th class="text-center"><?php echo  $totalResult[0]->remission; ?></th>
                        </tr>  						
                    </table>
                    </div>
                </div>              
            </div>          

            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?php echo site_url('private/js/inwordbn.js'); ?>"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#inword").html(inWordbn(<?php echo $result[0]->grand_total; ?>));
        $("#inword2").html(inWordbn(<?php echo $result[0]->grand_total; ?>));
    });
</script>