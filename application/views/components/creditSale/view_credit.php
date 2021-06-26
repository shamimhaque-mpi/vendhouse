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
    .wid-150{
        width: 150px;
    }
</style>

<div class="container-fluid">
    <div class="row">
    <?php echo $confirmation; ?>
        <div class="panel panel-default ">

            <div class="panel-heading none">
                <div class="panal-header-title">
                    <h1 class="pull-left">Details</h1>
                    <a class="btn btn-primery pull-right" style="font-size: 14px; margin-top: 0;" onclick="window.print()"><i class="fa fa-print"></i> প্রিন্ট</a>
                </div>
            </div>

            <!--pre><?php print_r($result);?></pre-->

            <div class="panel-body">
                <div class="row">
                    <div class="view-profile">
                        <div class="col-xs-2">
                            <figure class="pull-left">
                                <img class="img-responsive" src="<?php echo site_url('private/images/logo.png'); ?>" style="width: 100px; height: 100px;" alt="">
                            </figure>
                        </div>

                        <div class="col-xs-8">
                            <div class="institute">
                                <?php $heading = config_item('heading'); ?>
                                <h2 class="text-center title" style="margin-top: 10; font-weight: bold;"><?php echo $heading['title']; ?></h2>
                                <h3 class="text-center" style="margin: 0;"><?php echo $heading['place']; ?></h3>
                            </div>
                        </div>
                        <?php
                           $where=array('member_id'=>$result[0]->member_id);
                           $loanWhere=array('voucher_number'=>$result[0]->voucher_number,'member_id'=>$result[0]->member_id);
                           $info=$this->action->read('members',$where);
                           $loanInfo=$this->action->read('loan',$loanWhere);
                        ?>                       

                        <div class="col-xs-2">
                            <figure class="pull-right">
                                <img class="img-responsive" src="<?php if($info != NULL){ echo site_url($info[0]->member_photo); } ?>" style="width: 100px; height: 100px;" alt="">
                            </figure>
                        </div>
                       
                    </div>
                </div>
                <!--pre><?php print_r($info);?></pre-->

                <hr style="border-bottom: 2px solid #ccc; margin: 5px 0 10px;">              

                <label>Date: <?php echo $result[0]->date;?></label> <br>
                <label style="margin-bottom: 10px;">Vouture Number: <?php echo $result[0]->voucher_number;?></label> <br>

                <table class="table table-bordered">
                    <tr>
                        <th>SL</th>
                        <th>Product Name</th>
                        <th>Godown</th>
                        <th>Unit</th>
                        <th>Quantity</th>
                        <th>Sub Total</th>                       
                    </tr>
                    <?php foreach ($result as $key => $value) { ?>
                      <tr>
                        <td style="width: 50px;"><?php echo $key + 1;?></td>
                        <td ><?php echo $value->product;?></td>
                        <td ><?php echo $value->godown;?></td>
                        <td class="wid-150"><?php echo $value->price;?></td>
                        <td class="wid-150"><?php echo $value->quantity;?></td>
                        <td class="wid-150"><?php echo $value->subtotal;?></td>
                       
                    </tr>  
                    <?php } ?>
                    <tr>
                        <th class="text-right" colspan="5">Totla</th><td><?php echo $result[0]->total;?></td>
                    </tr>
                    <tr>
                        <th class="text-right" colspan="5">Down Payment </th><td><?php echo $result[0]->paid;?></td>
                    </tr>
                    <tr>
                        <th class="text-right" colspan="5">Due</th><td><?php echo $result[0]->due;?></td>
                    </tr>
                    
                </table>                

                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-bordered">
                            <tr>
                               <td>Member ID</td>
                                <td><?php if($info != NULL){ echo $info[0]->member_id;} ?></td> 
                            </tr>

                            <tr>
                               <td>Name</td>
                                <td><?php if($info != NULL){ echo $info[0]->member_full_name;} ?></td> 
                            </tr>

                            <tr>
                               <td>Address</td>
                                <td>
                                  <?php
                                    echo $info[0]->member_thorp." ,".$info[0]->member_village." ,".$info[0]->member_police_station." ,".$info[0]->member_district.".";
                                  ?>
                                </td> 
                            </tr>

                            <tr>
                               <td>Mobile Number</td>
                                <td><?php if($info != NULL){ echo $info[0]->member_mobile_number;} ?></td> 
                            </tr>
                        </table>
                    </div>
                  <?php if($loanInfo != NULL) { ?>
                    <div class="col-md-6">
                     <!--pre><?php print_r($loanInfo);?></pre-->
                        <table class="table table-bordered">
                            <tr>
                               <td>Installment Type</td>
                                <td><?php if($loanInfo != NULL){ echo filter($loanInfo[0]->installment_type);}?></td> 
                            </tr>

                            <tr>
                               <td>Installment Quantity</td>
                                <td><?php if($loanInfo != NULL){ echo $loanInfo[0]->installment_no;}?></td> 
                            </tr>

                            <tr>
                               <td>Amount / installment</td>
                                <td><?php if($loanInfo != NULL){ echo $loanInfo[0]->amount_per_installment;} ?></td> 
                            </tr>
                            <?php if($loanInfo[0]->installment_day != NULL){ ?>
                                <tr>
                                   <td>Installment Day</td>
                                    <td> <?php echo $loanInfo[0]->installment_day; ?> </td> 
                                </tr>
                            <?php } ?>

                             <?php if($loanInfo[0]->installment_date != NULL){ ?>
                                <tr>
                                   <td>Installment Date</td>
                                    <td> <?php echo $loanInfo[0]->installment_date; ?> </td> 
                                </tr>
                            <?php } ?>

                             
                        </table>
                    </div>
                    <?php } ?>
                </div>
            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>