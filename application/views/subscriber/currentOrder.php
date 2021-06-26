 <section class="container">
    <div class="panel panel-default" style="margin-top: 30px;">
        <?php echo $this->session->flashdata('confirmation'); ?>
        <div class="panel-heading user_header">
            <h3>Current Orders</h3>
        </div>
    
        <!-- Order Panel -->
        <div class="panel-body" ng-controller="userAccountCtrl">
            <div class="row">
                <?php
                    $this->load->view('frontend/include/user_aside', $this->data);
        	    ?>
                <div class="col-md-9">
                    <?php if($currentOrder != null ){ ?>
                        <table class="table table-striped table-bordered" style="margin-bottom: 0;">
                            <tr>
                                <th width="60">SL</th>
                                <th width="200">Date</th>
                                <th>Time</th>
                                <th>Order No</th>
                                <th>Total amount</th>
                                <th>Status</th>
                                <th style="text-align: right; width: 90px;">Action</th>
                            </tr>
    
                            <?php
                                $total = 0;
                                foreach ($currentOrder as $key => $value) {
                                $total +=$value->grand_total;
                            ?>
    
                            <tr>
                                <td><?php echo $key+1; ?></td>
                                <td><?php echo $value->order_date; ?></td>
                                <td><?php echo $value->time; ?></td>
                                <td><?php echo $value->order_no; ?></td>
                                <td><?php echo $value->grand_total; ?></td>
                                <td><?php echo filter($value->status); ?></td>
                                <td class="text-right">
                                    <a class="btn btn-sm btn-warning" href="<?php echo site_url('subscriber/currentOrder/productView?order_no='.$value->order_no) ;?>"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    <a title="cancel" <?php if($value->status != 'pending'){echo 'disabled';} ?> 
                                        class="btn btn-sm btn-danger" 
                                        onclick="return confirm('Are you sure to cancel this Order ?');"
                                        href="<?php if($value->status == 'pending'){ echo site_url('subscriber/allOrder/orderCancel?order_no='.$value->order_no) ;}else{} ?>">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php } ?>
    
                            <tr>
                                <th colspan="3">&nbsp;</th>
                                <th class="text-right">Total</th>
                                <th><?php echo $total; ?> Tk</th>
                                <th colspan="2">&nbsp;</th>
                            </tr>
                        </table>
                    <?php } else{?>
                    <h3 style="background: rgb(219, 44, 15);padding: 10px;color: #fff;font-size: 16px; text-align: center;" >Order 0</h3>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>
