<section class="container">
    <div class="panel panel-default" style="margin-top: 30px;">
        <?php echo $this->session->flashdata('confirmation'); ?>
        <div class="panel-heading user_header">
            <h3>Order's Details</h3>
        </div>
    
        <!-- Order Panel -->
        <div class="panel-body" ng-controller="userAccountCtrl">
            <div class="row">
                <?php
                    $this->load->view('frontend/include/user_aside', $this->data);
        	    ?>
                <div class="col-md-9">
                    <div style="padding:8px 15px; background:#F9F9F9; display: inline-block; margin-bottom: 8px; width: 100%;">
                       <?php if($orderInfo != null ){ ?>
                        <span class="pull-left">Order No : <?php echo $orderInfo[0]->order_no; ?></span>
                        <span class="pull-right">Date and time : <?php echo $orderInfo[0]->order_date."&nbsp;&nbsp;".$orderInfo[0]->time; ?></span>
                        <?php } ?>
                    </div>
                    <table class="table table-striped table-bordered" style="margin-bottom: 0;">
                        <tr>
                            <th width="40">SL</th>
                            <th>Product's Name</th>
                            <th>Unite</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th width="200">Total</th>
                        </tr>

                        <?php
                             $total = $delivaryCost = $discount = 0;
                            foreach ($orderInfo as $key => $value) {
                            $total += $value->sub_total;
                            $delivaryCost = $value->delivery_charge;
                            $discount     = $value->discount;
                        ?>

                        <tr>
                            <td><?php echo $key+1; ?></td>
                            <td><?php echo $value->product; ?></td>
                            <td><?php echo $value->unit; ?></td>
                            <td><?php echo $value->price; ?></td>
                            <td><?php echo $value->quantity; ?></td>
                            <td><?php echo $value->sub_total; ?></td>
                        </tr>
                        <?php } ?>

                        <tr>
                            <th colspan="4">&nbsp;</th>
                            <th class="text-right">Total</th>
                            <th><?php echo $total; ?> Tk</th>
                        </tr>
                        <tr>
                            <th colspan="4">&nbsp;</th>
                            <th class="text-right">Discount</th>
                            <th><?php echo $discount; ?> Tk</th>
                        </tr>
                        <tr>
                            <th colspan="4">&nbsp;</th>
                            <th class="text-right">Delevery Cost</th>
                            <th><?php echo $delivaryCost; ?> Tk</th>
                        </tr>
                        <tr>
                            <th colspan="4">&nbsp;</th>
                            <th class="text-right">Grand total</th>
                            <th><?php echo $total+$delivaryCost; ?> Tk</th>
                        </tr>
                    </table>
                    <br>
                    <a style="border-radius: 0;" href="<?php echo site_url('subscriber/dashboard');?>" class="btn btn-warning">Back</a>
                </div>
            </div>
        </div>
    </div>
</section>
