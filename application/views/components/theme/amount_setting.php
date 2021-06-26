<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" />
<div class="container-fluid" ng-controller="delivery_charge_ctrl" ng-cloak>
 <div class="row">
   <?php echo $this->session->flashdata('confirmation'); ?>
    <div class="panel panel-default">

    <div class="panel-heading">
        <div class="panal-header-title pull-left">
            <h1>Delivery Charge Setting</h1>
        </div>
    </div>

    <div class="panel-body">
         <?php
            $attr=array(
                "class"=>"form-horizontal"
            );
            echo form_open('theme/delivery_charge/delivery_charge/', $attr);
         ?>


            <div class="form-group">
                <label class="col-md-3 control-label"> Upazilla </label>
                <div class="col-md-5">
                <div class="row">
                    <select  name="area" ng-model="area" ng-change="get_delivery_charge();" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                        <option value="" selected disabled>-- Select Area --</option>
                        <!--<option value="Jessore Sadar">Jessore Sadar</option>-->
                        <!--<option value="Others">Others</option>-->
                        <?php foreach($this->config->config['upazila'] as $upazila) { ?><option value="<?= $upazila ?>"><?= $upazila ?></option><?php } ?>
                    </select>
                </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label">Delivery Charge </label>
                <div class="col-md-5">
                    <div class="row">
                    <input type="text" ng-value="amount" name="amount" class="form-control">
                </div>
                </div>
            </div>

           <div class="col-md-12" style="margin-left: 15px;">
                <div class="btn-group pull-right">
                    <input type="submit" ng-value="button_name" name="submit" class="btn {{ button_class}}">
                </div>
           </div>
        <?php echo form_close(); ?>

    </div>

    <div class="panel-footer">&nbsp;</div>
</div>

<!-- ======================== Delivery Charge Setting End Here ====================== -->


<!-- ======================== cupon Setting Start Here ====================== -->

<div class="panel panel-default">

    <div class="panel-heading">
        <div class="panal-header-title pull-left">
            <h1>Coupon Setting</h1>
        </div>
    </div>

    <div class="panel-body">
         <?php
            $attr=array(
                "class"=>"form-horizontal"
            );
            echo form_open('theme/delivery_charge/delivery_charge/', $attr);
         ?>

            <input type="hidden" name="id" value="<?php echo '1'; ?>">


            <div class="form-group">
                <label class="col-md-3 control-label">Coupon No </label>
                <div class="col-md-5">
                    <div class="row">
                    <input type="text" value="<?php if(isset($coupon[0]->coupon_no)){ echo $coupon[0]->coupon_no; } ?>" name="coupon_no" class="form-control">
                </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label">Coupon Discount (%)</label>
                <div class="col-md-5">
                    <div class="row">
                    <input type="text" value="<?php if(isset($coupon[0]->coupon_discount)){ echo $coupon[0]->coupon_discount; } ?>" name="coupon_discount" class="form-control">
                </div>
                </div>
            </div>

            <?php
                $value='Save';
                $name="submit_coupon";
                $class="btn-primary";

                if (count($coupon)>0) {
                   // echo count($vatInfo);
                    $value='Update';
                    $name="update_coupon";
                    $class="btn-success";
                }
            ?>

           <div class="col-md-12" style="margin-left: 15px;">
                <div class="btn-group pull-right">
                    <input type="submit" value="<?php echo $value; ?>" name="<?php echo $name; ?>" class="btn <?php echo $class; ?>">
                </div>
           </div>
        <?php echo form_close(); ?>

    </div>

    <div class="panel-footer">&nbsp;</div>
</div>

<!-- ======================== Cupon Setting End Here ====================== -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>