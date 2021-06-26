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
        <!-- pre><?php print_r($result); ?></pre -->

        <?php if($result != NULL) { ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panal-header-title ">
                    <h1 class="pull-left">Todays List</h1>
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


                <hr class="hide" style="border-bottom: 1px solid #ccc; margin-top: 5px;" >
                <h4 class="text-center hide" style="margin-top: -10px;">Todays List</h4>
                
                <table class="table table-bordered table2">
                    <tr>
                        <th>SL</th>
                        <th>Name</th>
                        <th>Mobile Number</th>
                        <th>Deposit</th>
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
</style></th>
                        <th>Deposit Type</th>                        
                    </tr>
                    <?php 
                    foreach ($result as $key => $row) { 
                        $info = $this->action->read('members', array('member_id' => $row->member_id));
                    ?>
                    <tr>
                        <td> <?php echo $key+1; ?> </td>
                        <td> <?php echo $info[0]->member_full_name; ?> </td>
                        <td> <?php echo $info[0]->member_mobile_number; ?> </td>
                        <td> <?php echo $row->amount_per_installment; ?> </td>                    
                        <td> <?php echo filter($row->installment_type); ?> </td>                    
                    </tr>
                  <?php  } ?>                  
                </table>
            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
        <?php } ?>
    </div>
</div>
