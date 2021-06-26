<style>
    @media print{
        aside, nav, .none, .panel-heading, .panel-footer {
            display: none !important;
        }
        .panel{
            border: 1px solid transparent;
            left: 0px;
            position: absolute;
            top: 0px;
            width: 100%;
        }
        .panel .hide{
            display: block !important;
        }
        .title{
            font-size: 25px;        
        }
    }
</style>

<div class="container-fluid">
    <div class="row">
	   <?php 
       $total = 0;
       echo $confirmation; 
       ?>

        <div class="panel panel-default">

            <div class="panel-heading panal-header">
                <div class="panal-header-title">
                    <h1 class="pull-left"><?php echo caption('All_Transaction') ;?></h1>
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

                <hr class="hide" style="border-bottom: 2px solid #ccc; margin-top: 5px;">

                <h4 class="hide text-center"  style="margin-top: -10px;"><?php echo caption('All_Transaction') ;?></h4>

                <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th><?php echo caption('SL') ;?> </th>
                        <th><?php echo caption('Date') ;?>  </th>
                        <th><?php echo caption('Transaction_By') ;?>  </th>
                        <th><?php echo caption('Bank_Name') ;?>  </th>
                        <th><?php echo caption('Account_Number') ;?>  </th>
                        <th><?php echo caption('Transaction_Type') ;?>  </th>
                        <th><?php echo caption('Amount') ;?>  </th>
                        <th class="none"><?php echo caption('Action') ;?>  </th>
                    </tr>

			        <?php foreach($all_tranc as $key=>$transaction){ ?>
                    <tr>
                        <td> <?php echo $key+1; ?> </td>
                        <td> <?php echo $transaction->transaction_date;?> </td>
                        <td> <?php echo $transaction->transaction_by;?></td>
                        <td> <?php echo str_replace("_"," ",$transaction->bank);?> </td>
                        <td> <?php echo $transaction->account_number;?> </td>
                        <td> <?php echo $ttype=$transaction->transaction_type;?> </td>

                        <td> 
                        <?php 
                            if($ttype=="Credit"){
                                $total += $transaction->amount;                            
                            }else{
                                $total -= $transaction->amount;                            
                            }
                            echo $transaction->amount;
                        ?> 
                        </td>

                        <td class="none" style="width: 60px;">
                            <?php if(ck_action("bank_transaction","delete")){ ?>
                            <a class="btn btn-danger" href="?id=<?php echo $transaction->id;?>" confirm-msg="Are You Sure to Delete This Transaction?">
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                            </a>
                            <?php } ?>                        
                        </td>
                    </tr>
                    <?php } ?>

                    <tr>
                        <th class="text-right" colspan="6"><?php echo caption('Total') ;?></th>
                        <th><?php echo $total; ?></th>
                        <th class="none">&nbsp;</th>
                    </tr>
                </table>
                </div>

            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>

